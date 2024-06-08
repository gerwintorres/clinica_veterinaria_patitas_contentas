from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update, insert
from sqlalchemy.orm import Session
from database.db import conn
#from models.models import clientes
from schemas.schemas import CredencialesSchema, SolicitarTokenSchema, RestablecerPasswordSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet
from fastapi.responses import JSONResponse
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from datetime import datetime, timedelta
import secrets
import smtplib
import os


key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_medico = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

#Inicio de sesión de médico
@router_medico.post('/login/medico')
def login_medico(credenciales: CredencialesSchema):
    query = text(f"SELECT id_medico, nombres, clave FROM medico WHERE email = :email")
    result = conn.execute(query, {"email": credenciales.email}).fetchone()
    
    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    
    id_medico, nombres, clave = result

    if credenciales.clave != clave:
        raise HTTPException(status_code=401, detail="Credenciales inválidas")

    return JSONResponse(content={"id_medico": id_medico, "nombres": nombres}, status_code=200)

# Función para enviar correo electrónico
def send_recovery_email(to_email: str, token: str):
    try:
        from_email = os.getenv("EMAIL_USER")
        password = os.getenv("EMAIL_PASSWORD")
        
        subject = "Recuperación de contraseña"
        body = f"Utiliza el siguiente token para restablecer tu contraseña: {token}"
        
        msg = MIMEMultipart()
        msg['From'] = from_email
        msg['To'] = to_email
        msg['Subject'] = subject
        
        msg.attach(MIMEText(body, 'plain'))
        
        server = smtplib.SMTP('smtp.gmail.com', 587)
        server.starttls()
        server.login(from_email, password)
        text = msg.as_string()
        server.sendmail(from_email, to_email, text)
        server.quit()
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Error al enviar el correo: {e}")

# Inicio de sesión de médico
@router_medico.post('/login/medico')
def login_medico(credenciales: CredencialesSchema):
    query = text(f"SELECT id_medico, nombres, clave FROM medico WHERE email = :email")
    result = conn.execute(query, {"email": credenciales.email}).fetchone()
    
    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    
    id_medico, nombres, clave = result

    if credenciales.clave != clave:
        raise HTTPException(status_code=401, detail="Credenciales inválidas")

    return JSONResponse(content={"id_medico": id_medico, "nombres": nombres}, status_code=200)



# Endpoint para iniciar el proceso de recuperación de contraseña
@router_medico.post('/password-recovery')
def tokens_recuperacion(request: SolicitarTokenSchema):
    email = request.email
    token = secrets.token_urlsafe(32)
    expiration = (datetime.utcnow() + timedelta(minutes=15)).strftime('%Y-%m-%d %H:%M:%S')
    created_at = datetime.utcnow().strftime('%Y-%m-%d %H:%M:%S')

    query = text("SELECT * FROM tokens_recuperacion WHERE email = :email")
    result = conn.execute(query, {"email": email}).fetchone()
    
    if result:
        # Actualizar el token y la fecha de expiración
        update_query = text("UPDATE tokens_recuperacion SET token = :token, expiration = :expiration WHERE email = :email")
        conn.execute(update_query, {"token": token, "expiration": expiration, "email": email})
    else:
        # Insertar un nuevo registro
        insert_query = text("INSERT INTO tokens_recuperacion (email, token, expiration, created_at) VALUES (:email, :token, :expiration, :created_at)")
        conn.execute(insert_query, {"email": email, "token": token, "expiration": expiration, "created_at": created_at})

    # Enviar el token al correo del médico
    send_recovery_email(email, token)
    conn.commit()

    return JSONResponse(content={"message": "Si el correo está registrado, recibirás un enlace de recuperación"}, status_code=200)

# Endpoint para restablecer la contraseña
@router_medico.post('/medico/password-reset')
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
    update_query = text("UPDATE medico SET clave = :clave WHERE email = :email")
    conn.execute(update_query, {"clave": new_password, "email": email})

    # Eliminar el registro de recuperación de contraseña
    delete_query = text("DELETE FROM tokens_recuperacion WHERE token = :token")
    conn.execute(delete_query, {"token": token})
    conn.commit()

    return JSONResponse(content={"message": "Contraseña restablecida exitosamente"}, status_code=200)


#Endpoint para obtener la programación del día de un medico
@router_medico.get("/medico/programacion_del_dia/{id_medico}/{fecha}")
def obtener_programacion_del_dia(id_medico: int, fecha: str):
    # Definir la consulta
    query = text("""
        SELECT 
            citas.hora,
            mascotas.nombre AS nombre_mascota,
            cliente.nombres AS nombre_cliente,
            mascotas.tipo_mascota,
            mascotas.id_cliente
        FROM 
            citas
        JOIN 
            mascotas ON citas.id_mascota = mascotas.id_mascota
        JOIN 
            cliente ON mascotas.id_cliente = cliente.id_cliente
        WHERE
            citas.id_medico = :id_medico AND citas.fecha = :fecha
    """)

    # Ejecutar la consulta
    result = conn.execute(query, {"id_medico": id_medico, "fecha": fecha}).fetchall()

    if not result:
        raise HTTPException(status_code=404, detail="No se encontraron citas para el médico en la fecha especificada")

    # Formatear el resultado en una lista de diccionarios
    programacion = []
    for row in result:
        if isinstance(row.hora, timedelta):
            hora_inicio = (datetime.min + row.hora).time()
        else:
            hora_inicio = row.hora

        hora_fin = (datetime.combine(datetime.today(), hora_inicio) + timedelta(minutes=30)).time()
        programacion.append({
            "hora_inicio": hora_inicio.strftime('%H:%M:%S'),
            "hora_fin": hora_fin.strftime('%H:%M:%S'),
            "nombre_mascota": row.nombre_mascota,
            "nombre_cliente": row.nombre_cliente,
            "tipo_mascota": row.tipo_mascota,
            "id_cliente": row.id_cliente,
        })

    return JSONResponse(status_code=200, content=programacion)
    