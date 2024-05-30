from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update
from sqlalchemy.orm import Session
from database.db import conn
from models.models import clientes, mascotas
from schemas.schemas import ClienteSchema, CredencialesSchema, MascotaSchema, MascotaUpdateSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet
from fastapi.responses import JSONResponse
from typing import List

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_cliente = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")


@router_cliente.post("/register/client")
def registrar_cliente(cliente: ClienteSchema):
    #with engine.connect() as conn:
    new_client = cliente.dict()
    #new_client["clave"] = f.encrypt(cliente.clave.encode("utf-8"))
    result = conn.execute(clientes.insert().values(new_client))
    conn.commit()
    print(result)
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


@router_cliente.post("/register/mascota")
def registrar_mascota(mascota: MascotaSchema):
    nueva_mascota = mascota.dict()
    result = conn.execute(mascotas.insert().values(nueva_mascota))
    conn.commit()
    print(result)
    return JSONResponse(content=nueva_mascota, status_code=HTTP_201_CREATED)


@router_cliente.put("/update/mascota/{id_mascota}")
def actualizar_mascota(id_mascota: int, mascota: MascotaUpdateSchema):
    update_data = {key: value for key, value in mascota.dict().items() if value is not None}

    if not update_data:
        raise HTTPException(status_code=400, detail="No se proporcionaron datos para actualizar")

    query = (
        update(mascotas)
        .where(mascotas.c.id_mascota == id_mascota)
        .values(**update_data)
    )
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Mascota no encontrada")

    return JSONResponse(content={"message": "Mascota actualizada correctamente"}, status_code=200)


@router_cliente.get("/mascotas/{id_cliente}", response_model=List[MascotaSchema])
def obtener_mascotas(id_cliente: int):
    query = text("SELECT * FROM mascotas WHERE id_cliente = :id_cliente")
    result = conn.execute(query, {"id_cliente": id_cliente}).fetchall()

    if not result:
        raise HTTPException(status_code=404, detail="No se encontraron mascotas para el cliente dado")

    mascotas = []
    for row in result:
        mascota = {
            "id_mascota": row[0],
            "nombre": row[1],
            "tipo_mascota": row[2],
            "raza": row[3],
            "edad": row[4],
            "peso": row[5],
            "historia_clinica": row[6],
            "id_cliente": row[7]
        }
        mascotas.append(mascota)

    return JSONResponse(status_code=200, content=mascotas)