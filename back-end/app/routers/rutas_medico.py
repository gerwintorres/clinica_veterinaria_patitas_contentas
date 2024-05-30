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
from fastapi.responses import JSONResponse

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_medico = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

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