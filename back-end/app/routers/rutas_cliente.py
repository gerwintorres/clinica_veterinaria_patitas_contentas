from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update, select, insert
from sqlalchemy.orm import Session
from database.db import conn
from models.models import clientes, mascotas, medico, colaborador, citas, servicio
from schemas.schemas import ClienteSchema, CredencialesSchema, ContactoSchema, RestablecerPasswordSchema, ClienteUpdateSchema, CitaSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet
from fastapi.responses import JSONResponse
from typing import List
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from datetime import datetime, timedelta
import smtplib
import os
from dotenv import load_dotenv
from sqlalchemy.sql.expression import func

#Carga de variables de entorno
load_dotenv()

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_cliente = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")


def get_random_medico():
    query = select(medico.c.id_medico).order_by(func.random()).limit(1)
    result = conn.execute(query).fetchone()
    if result:
        return result[0]
    else:
        return None

def get_random_colaborador(labor: str):
    query = select(colaborador.c.id_colaborador).where(colaborador.c.labor == labor).order_by(func.random()).limit(1)
    result = conn.execute(query).fetchone()
    if result:
        return result[0]
    else:
        return None

@router_cliente.post("/register/client")
def registrar_cliente(cliente: ClienteSchema):
    #with engine.connect() as conn:
    new_client = cliente.dict()
    #new_client["clave"] = f.encrypt(cliente.clave.encode("utf-8"))
    result = conn.execute(clientes.insert().values(new_client))
    conn.commit()
    return Response(status_code=HTTP_201_CREATED)


@router_cliente.post('/login/client')
def login_cliente(credenciales: CredencialesSchema):
    query = text(f"SELECT id_cliente, nombres, clave FROM cliente WHERE email = :email")
    result = conn.execute(query, {"email": credenciales.email}).fetchone()
    
    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    
    id_cliente, nombres, clave = result

    if credenciales.clave != clave:
        raise HTTPException(status_code=401, detail="Credenciales inválidas")

    return JSONResponse(content={"id_cliente": id_cliente, "nombres": nombres}, status_code=200)


def send_email(subject: str, body: str, to_email: str):
    try:
        from_email = os.getenv("EMAIL_USER")
        password = os.getenv("EMAIL_PASSWORD")
        
        # Crear el mensaje
        msg = MIMEMultipart()
        msg['From'] = from_email
        msg['To'] = to_email
        msg['Subject'] = subject
        
        msg.attach(MIMEText(body, 'plain'))
        
        # Conectar al servidor SMTP de Gmail
        server = smtplib.SMTP('smtp.gmail.com', 587)
        server.starttls()
        server.login(from_email, password)
        text = msg.as_string()
        server.sendmail(from_email, to_email, text)
        server.quit()
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Error al enviar el correo: {e}")


#Endpoint para obtener la información detallada de un cliente
@router_cliente.get("/cliente/{id_cliente}", response_model=ClienteSchema)
def obtener_cliente(id_cliente: int):
    query = text("SELECT * FROM cliente WHERE id_cliente = :id_cliente")
    result = conn.execute(query, {"id_cliente": id_cliente}).fetchone()

    if not result:
        raise HTTPException(status_code=404, detail="Cliente no encontrado")

    return result


#Endpoint para actualizar la información de un cliente
@router_cliente.put("/update/cliente/{id_cliente}")
def actualizar_cliente(id_cliente: int, cliente: ClienteUpdateSchema):
    # Convert the schema to a dictionary and filter out None values
    update_data = {key: value for key, value in cliente.dict().items() if value is not None}

    if not update_data:
        raise HTTPException(status_code=400, detail="No se proporcionaron datos para actualizar")

    # Create the update query
    query = (
        update(clientes)
        .where(clientes.c.id_cliente == id_cliente)
        .values(**update_data)
    )

    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Cliente no encontrado")

    return JSONResponse(content={"message": "Cliente actualizado correctamente"}, status_code=200)


#Endpoint para la sección de contacto
@router_cliente.post("/contacto")
def enviar_contacto(formulario: ContactoSchema):
    subject = f"Mensaje de {formulario.nombres} {formulario.apellidos}"
    body = f"""
    Nombres: {formulario.nombres}
    Apellidos: {formulario.apellidos}
    Email: {formulario.email}
    Número de Contacto: {formulario.numero_contacto}

    Mensaje:
    {formulario.mensaje}
    """
    send_email(subject, body, os.getenv("EMAIL_TO"))

    return JSONResponse(content={"message": "Mensaje enviado correctamente"}, status_code=200)


# Endpoint para restablecer la contraseña
@router_cliente.post('/cliente/password-reset')
def password_reset(request: RestablecerPasswordSchema):
    token = request.token
    new_password = request.new_password

    query = text("SELECT * FROM tokens_recuperacion WHERE token = :token")
    result = conn.execute(query, {"token": token}).fetchone()

    if not result:
        raise HTTPException(status_code=404, detail="Token inválido")

    expiration = datetime.strptime(result.expiration, '%Y-%m-%d %H:%M:%S')
    if datetime.utcnow() > expiration:
        raise HTTPException(status_code=400, detail="El token ha expirado")

    email = result.email
    hashed_password = pwd_context.hash(new_password)

    # Actualizar la contraseña del médico
    update_query = text("UPDATE cliente SET clave = :clave WHERE email = :email")
    conn.execute(update_query, {"clave": new_password, "email": email})

    # Eliminar el registro de recuperación de contraseña
    delete_query = text("DELETE FROM tokens_recuperacion WHERE token = :token")
    conn.execute(delete_query, {"token": token})
    conn.commit()

    return JSONResponse(content={"message": "Contraseña restablecida exitosamente"}, status_code=200)


# Función para obtener el nombre del servicio basado en id_servicio
def get_servicio_procedimiento(id_servicio: int) -> str:
    stmt = select(servicio.c.nombre).where(servicio.c.id == id_servicio)
    result = conn.execute(stmt).scalar_one_or_none()
    if not result:
        raise HTTPException(status_code=404, detail="Servicio no encontrado")
    return result

#Endpoint para el agendamiento de cita medica 
@router_cliente.post("/cliente/agendar_cita")
def agendar_cita(cita: CitaSchema):
    # Obtener el nombre del servicio basado en id_servicio
    cita.procedimiento = get_servicio_procedimiento(cita.id_servicio)
    
    if cita.procedimiento.lower() == "cita":
        cita.id_medico = get_random_medico()
        if not cita.id_medico:
            raise HTTPException(status_code=404, detail="No hay médicos disponibles")
        cita.id_colaborador = None
    elif cita.procedimiento.lower() == "peluqueria":
        cita.id_colaborador = get_random_colaborador("peluquero")
        if not cita.id_colaborador:
            raise HTTPException(status_code=404, detail="No hay peluqueros disponibles")
        cita.id_medico = None
    else:
        cita.id_colaborador = get_random_colaborador("auxiliar")
        if not cita.id_colaborador:
            raise HTTPException(status_code=404, detail="No hay auxiliares disponibles")
        cita.id_medico = None

    new_cita = {
        "hora": cita.hora,
        "fecha": cita.fecha,
        "procedimiento": cita.procedimiento,
        "id_medico": cita.id_medico,
        "id_colaborador": cita.id_colaborador,
        "id_servicio": cita.id_servicio,
        "id_mascota": cita.id_mascota
    }

    query = insert(citas).values(**new_cita)
    conn.execute(query)
    conn.commit()

    return JSONResponse(content={"message": "Cita agendada correctamente"}, status_code=200)