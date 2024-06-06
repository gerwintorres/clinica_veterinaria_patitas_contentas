from sqlalchemy import MetaData, Table, Column, Integer, String, ForeignKey, Float, Text, Date, Time
from database.db import engine, meta_data


"""cargo = Table(
    "cargo",
    meta_data,
    Column("id_cargo", Integer, primary_key=True),
    Column("nombre_cargo", String(100), nullable=False)
)"""

servicio = Table(
    "servicio",
    meta_data,
    Column("id_servicio", Integer, autoincrement = True, primary_key=True),
    Column("nombre", String(100), nullable=False),
    Column("precio", Integer, nullable=False)
)

clientes = Table(
    "cliente",
    meta_data,
    Column("id_cliente", Integer, primary_key=True),
    Column("nombres", String(100), nullable=False),
    Column("apellidos", String(100), nullable=False),
    Column("tipo_documento", String(50), nullable=False),
    Column("telefono", String(100), nullable=False, unique=True),
    Column("email", String(255), nullable=False, unique=True),
    Column("clave", String(100), nullable=False),
    Column("direccion", String(50), nullable=False)
)

mascotas = Table(
    "mascotas",
    meta_data,
    Column("id_mascota", Integer, primary_key=True),
    Column("nombre", String(100), nullable=False),
    Column("tipo_mascota", String(100), nullable=False),
    Column("raza", String(50), nullable=False),
    Column("edad", String(20), nullable=False),
    Column("peso", Float, nullable=False),
    Column("id_cliente", Integer, ForeignKey("cliente.id_cliente"), nullable=False)
)

historias_clinicas = Table(
    "historias_clinicas",
    meta_data,
    Column("id_historia_clinica", Integer, autoincrement = True, primary_key=True),
    Column("descripcion", Text),
    Column("id_cliente", Integer, ForeignKey("cliente.id_cliente"), nullable=False),
    Column("id_mascota", Integer, ForeignKey("mascotas.id_mascota"), nullable=False)
)

medico = Table(
    "medico",
    meta_data,
    Column("id_medico", Integer, primary_key=True),
    Column("nombres", String(100), nullable=False),
    Column("apellidos", String(100), nullable=False),
    Column("email", String(100), nullable=False, unique=True),
    Column("clave", String(255), nullable=False),
    Column("telefono", String(100), nullable=False, unique=True)
)

colaborador = Table(
    "colaborador",
    meta_data,
    Column("id_colaborador", Integer, primary_key=True),
    Column("nombres", String(100), nullable=False),
    Column("apellidos", String(100), nullable=False),
    Column("tipo_documento", String(20), nullable=False),    
    Column("labor", String(50), nullable=False),
    Column("telefono", String(100), nullable=False, unique=True),
    #Column("id_cargo", Integer, ForeignKey("cargo.id_cargo"), nullable=False)
)

citas = Table(
    "citas",
    meta_data,
    Column("id_cita", Integer, primary_key=True),
    Column("hora", Time, nullable=False),
    Column("fecha", Date, nullable=False),
    Column("procedimiento", String(100), nullable=False),
    Column("id_medico", Integer, ForeignKey("medico.id_medico"), nullable=False),
    Column("id_colaborador", Integer, ForeignKey("colaborador.id_colaborador"), nullable=False),
    Column("id_servicio", Integer, ForeignKey("servicio.id_servicio"), nullable=False),
    Column("id_mascota", Integer, ForeignKey("mascotas.id_mascota"), nullable=False)
)

orden_medica = Table(
    "orden_medica",
    meta_data,
    Column("id_orden", Integer, primary_key=True),
    Column("descripcion", Text, nullable=False),
    Column("id_cita", Integer, ForeignKey("citas.id_cita"), nullable=False),
    Column("id_servicio", Integer, ForeignKey("servicio.id_servicio"), nullable=False)
)

guarderia = Table(
    "guarderia",
    meta_data,
    Column("id_registro", Integer, primary_key=True),
    Column("hora", Time, nullable=False),
    Column("fecha", Date, nullable=False),
    Column("comentarios", Text),
    Column("id_mascota", Integer, ForeignKey("mascotas.id_mascota"), nullable=False)
)

productos = Table(
    "productos",
    meta_data,
    Column("id_producto", Integer, primary_key=True),
    Column("nombre", String(100), nullable=False),
    Column("fecha_vencimiento", Date, nullable=False),
    Column("cantidad", Integer, nullable=False),
    Column("precio_compra", Float, nullable=False),
    Column("precio_venta", Float, nullable=False),
    Column("lote", Integer, nullable=True)
)

proveedor = Table(
    "proveedor",
    meta_data,
    Column("id_proveedor", Integer, primary_key=True),
    Column("nombre", String(100), nullable=False),
    Column("ubicacion", String(100), nullable=False),
    Column("email", String(100), nullable=False, unique=True),
    Column("telefono", String(100), nullable=False, unique=True)
)

registro_productos = Table(
    "registro_productos",
    meta_data,
    Column("id_registro", Integer, autoincrement = True,  primary_key=True),
    Column("id_producto", Integer, ForeignKey("productos.id_producto"), nullable=False),
    Column("id_proveedor", Integer, ForeignKey("proveedor.id_proveedor"), nullable=False)
)


administrador = Table(
    "administrador",
    meta_data,
    Column("id_administrador", Integer, primary_key=True),
    Column("nombre", String(100), nullable=False),
    Column("apellido", String(100), nullable=False),
    Column("email", String(255), nullable=False, unique=True),
    Column("clave", String(100), nullable=False)
)

meta_data.create_all(engine)