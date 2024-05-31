from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from fastapi.responses import JSONResponse
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update
from sqlalchemy.orm import Session
from database.db import conn
from models.models import administrador, colaborador
#from models.models import clientes
from schemas.schemas import CredencialesSchema, ColaboradorSchema, ColaboradorUpdateSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet
from typing import List

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_admin = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

@router_admin.post('/login/admin')
def login_admin(credenciales: CredencialesSchema):
    query = text(f"SELECT id_administrador, nombre, clave FROM administrador WHERE email = :email")
    result = conn.execute(query, {"email": credenciales.email}).fetchone()
    
    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    
    id_admin, nombres, clave = result
    
    #clave_desencriptada = f.decrypt(clave_encriptada.encode()).decode()
    if credenciales.clave != clave:
        raise HTTPException(status_code=401, detail="Credenciales inválidas")

    return JSONResponse(content={"id_administrador": id_admin, "nombres": nombres}, status_code=200)


@router_admin.post("/register/colaborador")
def registrar_colaborador(colab: ColaboradorSchema):
    nuevo_colaborador = colab.dict()
    result = conn.execute(colaborador.insert().values(nuevo_colaborador))
    conn.commit()
    print(result)
    return JSONResponse(content=nuevo_colaborador, status_code=HTTP_201_CREATED)

@router_admin.put("/update/colaborador/{id_colaborador}")
def actualizar_colaborador(id_colaborador: int, colab: ColaboradorUpdateSchema):
    update_data = {key: value for key, value in colab.dict().items() if value is not None}

    if not update_data:
        raise HTTPException(status_code=400, detail="No se proporcionaron datos para actualizar")

    query = (
        update(colaborador)
        .where(colaborador.c.id_colaborador == id_colaborador)
        .values(**update_data)
    )
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Colaborador no encontrador")

    return JSONResponse(content={"message": "Colaborador actualizado correctamente"}, status_code=200)

@router_admin.get("/admin/colaboradores", response_model=List[ColaboradorSchema])
def obtener_colaboradores():
    query = text("SELECT * FROM colaborador")
    result = conn.execute(query).fetchall()

    if not result:
        raise HTTPException(status_code=404, detail="Error al obtener colaboradores")

    colaboradores = []
    for row in result:
        colaborador = {
            "id_colaborador": row[0],
            "nombres": row[1],
            "apellidos": row[2],
            "labor": row[3],
            "telefono": row[5],
        }
        colaboradores.append(colaborador)

    return JSONResponse(status_code=200, content=colaboradores)

"""@router.post("/registro/administrador")
def registrar_administrador(administrador: AdministradorSchema, db: Session = Depends(get_db)):
    hashed_password = pwd_context.hash(administrador.clave)
    administrador.clave = hashed_password

    db_administrador = Administrador(**administrador.dict())
    db.add(db_administrador)
    db.commit()
    db.refresh(db_administrador)

    return administrador

@router.post("/registro/medico")
def registrar_medico(medico: MedicoSchema, db: Session = Depends(get_db)):
    hashed_password = pwd_context.hash(medico.clave)
    medico.clave = hashed_password

    db_medico = Medico(**medico.dict())
    db.add(db_medico)
    db.commit()
    db.refresh(db_medico)

    return medico"""
