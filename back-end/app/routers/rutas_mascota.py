from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update, insert
from sqlalchemy.orm import Session
from database.db import conn
from datetime import datetime, date, timedelta
from models.models import clientes, mascotas, guarderia, historias_clinicas
from schemas.schemas import MascotaSchema, MascotaUpdateSchema, GuarderiaSchema, UpdateGuarderiaSchema
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


#registro de mascota
@router_mascota.post("/register/mascota")
def registrar_mascota(mascota: MascotaSchema):
    nueva_mascota = mascota.dict()
    
    result = conn.execute(
        insert(mascotas).values(nueva_mascota)
    )
    
    conn.commit()
    id_mascota = result.lastrowid
    
    historia = {
        "id_mascota": id_mascota,
        "id_cliente": mascota.id_cliente
    }
    
    conn.execute(insert(historias_clinicas).values(historia))
    conn.commit()
    
    return JSONResponse(content=nueva_mascota, status_code=HTTP_201_CREATED)

#actualización de los datos de una mascota
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

#retorna lista de mascotas pertenecientes a un cliente
@router_mascota.get("/mascota/lista/{id_cliente}", response_model=List[MascotaSchema])
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
            "id_cliente": row[6]
        }
        mascotas.append(mascota)

    return JSONResponse(status_code=200, content=mascotas)

#registro de mascota en guardería
@router_mascota.post("/mascota/guarderia")
def registrar_mascota_guarderia(mascota: GuarderiaSchema):
    nueva_mascota_guarderia = mascota.dict()
    result = conn.execute(guarderia.insert().values(nueva_mascota_guarderia))
    conn.commit()
    print(result)

    return JSONResponse(content=nueva_mascota_guarderia, status_code=HTTP_201_CREATED)

#eliminación de la mascota de una cliente
@router_mascota.delete("/delete/mascota/{id_mascota}")
def eliminar_mascota(id_mascota: int):
    query = mascotas.delete().where(mascotas.c.id_mascota == id_mascota)
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Mascota no encontrada")

    return JSONResponse(content={"message": "Mascota eliminada correctamente"}, status_code=200)

#listar estancias de las mascotas de un cliente
@router_mascota.get("/mascota/guarderia/lista/{id_cliente}", response_model=List[dict])
def listar_estadias_cliente(id_cliente: int):
    query = text("""
        SELECT 
            g.id_registro,
            m.nombre AS nombre_mascota,
            m.tipo_mascota,
            g.fecha,
            g.hora,
            m.peso
        FROM 
            guarderia g
        JOIN 
            mascotas m ON g.id_mascota = m.id_mascota
        WHERE 
            m.id_cliente = :id_cliente
    """)
    
    result = conn.execute(query, {"id_cliente": id_cliente}).fetchall()

    if not result:
        raise HTTPException(status_code=404, detail="No se encontraron estancias para el cliente dado")

    estadias = []
    for row in result:
        estancia = {
            "id_registro": row[0],
            "nombre_mascota": row[1],
            "tipo_mascota": row[2],
            "fecha": row[3].isoformat() if isinstance(row[3], (date, datetime)) else row[3],
            "hora": str(row[4]) if isinstance(row[4], timedelta) else row[4].isoformat() if isinstance(row[4], (date, datetime)) else row[4],
            "peso": row[5]
        }
        estadias.append(estancia)

    return JSONResponse(status_code=200, content=estadias)


@router_mascota.put("/update/guarderia/{id_registro}")
def actualizar_estadia_guarderia(id_registro: int, request: UpdateGuarderiaSchema):
    update_data = {key: value for key, value in request.dict().items() if value is not None}

    if not update_data:
        raise HTTPException(status_code=400, detail="Por favor verifica los datos ingresados")

    query = (
        update(guarderia)
        .where(guarderia.c.id_registro == id_registro)
        .values(**update_data)
    )
    
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Registro de estadia no encontrado")

    return JSONResponse(content={"message": "Estadia actualizada exitosamente"}, status_code=200)