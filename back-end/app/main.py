from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from routers.auth import router
from routers.rutas_medico import router_medico

app = FastAPI()

app.include_router(router)
app.include_router(router_medico)


# Configuración de CORS
origins = [
    "http://localhost",
    "http://localhost:8000",
    "http://localhost:3000",
    "http://localhost:8001",
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["GET", "POST", "PUT", "DELETE"],
    allow_headers=["*"],  
)