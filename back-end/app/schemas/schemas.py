from pydantic import BaseModel, EmailStr
from datetime import datetime, date, timedelta
from typing import Optional

class CargoSchema(BaseModel):
    id_cargo: int
    nombre_cargo: str
    

class ServicioSchema(BaseModel):
    #id_servicio: int
    nombre: str
    precio: int


class ClienteSchema(BaseModel):
    id_cliente: int
    nombres: str
    apellidos: str
    tipo_documento: str
    telefono: str
    email: str
    clave: str
    direccion: str


class ClienteUpdateSchema(BaseModel):
    # nombres: str
    # apellidos: str
    telefono: str
    email: str
    clave: str
    direccion: str


class MascotaSchema(BaseModel):
    #id_mascota: int
    nombre: str
    tipo_mascota: str
    raza: str
    edad: int
    peso: float
    id_cliente: int

class MascotaUpdateSchema(BaseModel):
    nombre: str = None
    tipo_mascota: str = None
    raza: str = None
    edad: int = None
    peso: float

class HistoriaSchema(BaseModel):
    id_historia_clinica: int
    id_cliente: int
    nombre_cliente: str
    nombre_mascota: str
    
class UpdateDescripcionSchema(BaseModel):
    descripcion: str

class VerHistoriaSchema(BaseModel):
    nombre_mascota: str
    nombre_cliente: str
    direccion: str
    telefono: str
    raza: str
    peso: float 
    edad: int
    descripcion: str
    

class MedicoSchema(BaseModel):
    id_medico: int
    nombres: str
    apellidos: str
    email: str
    clave: str
    telefono: str
    
class ColaboradorSchema(BaseModel):
    id_colaborador: int
    nombres: str
    apellidos: str
    tipo_documento: str
    labor: str
    telefono: str


class ColaboradorUpdateSchema(BaseModel):
    nombres: str
    apellidos: str
    labor: str
    telefono: str

# class CitaSchema(BaseModel):
#     id_cita: int
#     hora: str
#     fecha: str
#     procedimiento: str
#     id_medico: int
#     id_colaborador: int
#     id_servicio: int
#     id_mascota: int

class CitaUpdateSchema(BaseModel):
    hora: str
    fecha: str
    
class ContactoSchema(BaseModel):
    nombres: str
    apellidos: str
    email: EmailStr
    numero_contacto: str
    mensaje: str


class OrdenMedicaSchema(BaseModel):
    #id_orden: int
    descripcion: str
    id_cita: int
    id_servicio: int


class GuarderiaSchema(BaseModel):
    #id_registro: int
    hora: str
    fecha: str
    comentarios: Optional[str] = None
    id_mascota: int


class UpdateGuarderiaSchema(BaseModel):
    hora: str
    fecha: str
    comentarios: Optional[str]


class CitaSchema(BaseModel):
    hora: str
    fecha: date
    procedimiento: str
    id_medico: Optional[int] = None
    id_colaborador: Optional[int] = None
    id_servicio: int
    id_mascota: int


# Esquema para la solicitud de recuperación de contraseña
class SolicitarTokenSchema(BaseModel):
    email: EmailStr

# Esquema para restablecer la contraseña
class RestablecerPasswordSchema(BaseModel):
    token: str
    new_password: str

class ProductoSchema(BaseModel):
    id_producto: int
    nombre: str
    fecha_vencimiento: str
    cantidad: int
    id_proveedor: int
    precio_compra: float
    precio_venta: float
    lote: Optional[int] = None
    
class ProductoUpdateSchema(BaseModel):
    nombre: str
    fecha_vencimiento: str
    cantidad: int
    id_proveedor: int
    precio_compra: float
    precio_venta: float
    lote: Optional[int] = None


class ProveedorSchema(BaseModel):
    #id_proveedor: int
    nombre: str
    ubicacion: str
    email: str
    telefono: str

class ProveedorUpdateSchema(BaseModel):
    nombre: str
    ubicacion: str
    email: str
    telefono: str

class RegistroProductoSchema(BaseModel):
    id_proveedor: int
    nombre: str
    fecha_vencimiento: str
    cantidad: int
    precio_compra: float
    precio_venta: float
    lote: Optional[int] = None


class AdministradorSchema(BaseModel):
    id_administrador: int
    nombre: str
    apellido: str
    email: str
    clave: str

#esquema para recibir información de credenciales
class CredencialesSchema(BaseModel):
    email: str
    clave: str


class CheckinSchema(BaseModel):
    #id_cobro: int
    #total: Optional[float] = None
    id_registro: int
    fecha_entrada: str
    hora_entrada: str
    #hora_salida: Optional[str] = None

class CheckoutSchema(BaseModel):
    id_cobro: int
    id_registro: int
    total: Optional[float] = None
    fecha_salida: str
    hora_salida: str