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

router = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

#login, register, medicos, clientes y administrador
#archivo de rutas para cada entidad


@router.get("/")
def root():
    return {"Message": "Hi, I'm root of kickcoders plataform"}


