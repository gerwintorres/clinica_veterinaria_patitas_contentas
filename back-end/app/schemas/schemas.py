from pydantic import BaseModel
from typing import Optional

class CargoSchema(BaseModel):
    id_cargo: int
    nombre_cargo: str

class ServicioSchema(BaseModel):
    id_servicio: int
    nombre: str
    precio: int

class ClienteSchema(BaseModel):
    id_cliente: int
    nombres: str
    apellidos: str
    tipo_documento: str
    telefono: int
    email: str
    clave: str
    direccion: str

class MascotaSchema(BaseModel):
    id_mascota: int
    nombre: str
    tipo_mascota: str
    raza: str
    edad: int
    peso: float
    historia_clinica: Optional[str] = None
    id_cliente: int

class MedicoSchema(BaseModel):
    id_medico: int
    nombres: str
    apellidos: str
    email: str
    clave: str
    telefono: int


class ColaboradorSchema(BaseModel):
    id_colaborador: int
    nombres: str
    apellidos: str
    cargo: str
    email: str
    telefono: int
    id_cargo: int

class CitaSchema(BaseModel):
    id_cita: int
    hora: str
    fecha: str
    procedimiento: str
    id_medico: int
    id_colaborador: int
    id_servicio: int
    id_mascota: int


class OrdenMedicaSchema(BaseModel):
    id_orden: int
    descripcion: str
    id_cita: int
    id_servicio: int


class GuarderiaSchema(BaseModel):
    id_registro: int
    hora: str
    fecha: str
    comentarios: Optional[str] = None
    id_mascota: int



class LoteSchema(BaseModel):
    id_lote: int
    lote: int
    id_producto: int


class ProductoSchema(BaseModel):
    id_producto: int
    nombre: str
    fecha_vencimiento: str
    cantidad: int
    precio_compra: float
    precio_venta: float
    id_lote: Optional[int] = None


class ProveedorSchema(BaseModel):
    id_proveedor: int
    nombre: str
    ubicacion: str
    email: str
    telefono: str


class RegistroProductoSchema(BaseModel):
    id_registro: int
    id_producto: int
    id_proveedor: int



class AdministradorSchema(BaseModel):
    id_administrador: int
    nombre: str
    apellido: str
    email: str
    clave: str