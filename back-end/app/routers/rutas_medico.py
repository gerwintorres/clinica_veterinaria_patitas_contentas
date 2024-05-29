from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text 
from sqlalchemy.orm import Session
from database.db import conn
#from models.models import clientes
from schemas.schemas import CredencialesSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_medico = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

@router_medico.post('/login/medico')
def login_medico(credenciales: CredencialesSchema):
    query = text(f"SELECT clave FROM medico WHERE email = '{credenciales.email}'")
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