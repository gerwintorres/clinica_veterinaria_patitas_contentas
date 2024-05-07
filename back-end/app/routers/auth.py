from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED
from sqlalchemy import text 
from sqlalchemy.orm import Session
from database.db import conn
from models.models import clientes
from schemas.schemas import ClienteSchema, AdministradorSchema, MedicoSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")


class CredencialesSchema(BaseModel):
    email: str
    clave: str

@router.get("/")
def root():
    return {"Message": "Hi, I'm root of kickcoders plataform"}

@router.post("/register/client")
def registrar_cliente(cliente: ClienteSchema):
    #with engine.connect() as conn:
    new_client = cliente.dict()
    new_client["clave"] = f.encrypt(cliente.clave.encode("utf-8"))
    result = conn.execute(clientes.insert().values(new_client))
    conn.commit()
    print(result)
    return Response(status_code=HTTP_201_CREATED)

@router.post('/login/cliente')
def login_cliente(credenciales: CredencialesSchema):
    # Buscar usuario en la base de datos por correo electrónico
    query = text(f"SELECT clave FROM cliente WHERE email = '{credenciales.email}'")
    result = conn.execute(query).fetchone()

    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    
    clave_encriptada = result[0]
    clave_desencriptada = f.decrypt(clave_encriptada.encode()).decode()
    if credenciales.clave != clave_desencriptada:
        raise HTTPException(status_code=401, detail="Credenciales inválidas")

    return Response(status_code=200)

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
