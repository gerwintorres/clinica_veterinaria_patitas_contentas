from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text 
from sqlalchemy.orm import Session
from database.db import conn
from models.models import clientes
from schemas.schemas import ClienteSchema, AdministradorSchema, MedicoSchema, CredencialesSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet

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
    query = text(f"SELECT clave FROM cliente WHERE email = '{credenciales.email}'")
    result = conn.execute(query).fetchone()
    print(result)
    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    
    clave = result[0]
    print(clave)
    #clave_desencriptada = f.decrypt(clave_encriptada.encode()).decode()
    if credenciales.clave != clave:
        
        raise HTTPException(status_code=401, detail="Credenciales inválidas")

    return Response(status_code=200)