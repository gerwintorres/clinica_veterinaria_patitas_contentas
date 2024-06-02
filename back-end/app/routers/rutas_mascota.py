from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update, insert
from sqlalchemy.orm import Session
from database.db import conn
from datetime import datetime
from models.models import clientes, mascotas, guarderia
from schemas.schemas import MascotaSchema, MascotaUpdateSchema, GuarderiaSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet
from fastapi.responses import JSONResponse
from typing import List

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_mascota = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")


@router_mascota.post("/register/mascota")
def registrar_mascota(mascota: MascotaSchema):
    nueva_mascota = mascota.dict()
    result = conn.execute(mascotas.insert().values(nueva_mascota))
    conn.commit()
    print(result)
    return JSONResponse(content=nueva_mascota, status_code=HTTP_201_CREATED)


@router_mascota.put("/update/mascota/{id_mascota}")
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


@router_mascota.get("/mascota/{id_cliente}", response_model=List[MascotaSchema])
def obtener_mascota(id_cliente: int):
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

@router_mascota.post("/mascota/guarderia")
def registrar_mascota_guarderia(mascota: GuarderiaSchema):
    nueva_mascota_guarderia = mascota.dict()
    result = conn.execute(guarderia.insert().values(nueva_mascota_guarderia))
    conn.commit()
    print(result)

    return JSONResponse(content=nueva_mascota_guarderia, status_code=HTTP_201_CREATED)


@router_mascota.delete("/delete/mascota/{id_mascota}")
def eliminar_mascota(id_mascota: int):
    query = mascotas.delete().where(mascotas.c.id_mascota == id_mascota)
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Mascota no encontrada")

    return JSONResponse(content={"message": "Mascota eliminada correctamente"}, status_code=200)