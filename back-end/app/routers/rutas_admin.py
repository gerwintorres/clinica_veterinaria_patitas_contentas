from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from fastapi.responses import JSONResponse
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update
from sqlalchemy.orm import Session
from database.db import conn
from models.models import administrador, colaborador, proveedor, productos, registro_productos
#from models.models import clientes
from schemas.schemas import ProductoUpdateSchema, RegistroProductoSchema, CredencialesSchema, ColaboradorSchema, ColaboradorUpdateSchema, ProveedorSchema, ProveedorUpdateSchema, ProductoSchema
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
    
    if not result:
        raise HTTPException(status_code=404, detail="Error al registrar cliente, por favor verifique los datos ingresador")
    
    conn.commit()

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
            "tipo_documento": row[3],
            "labor": row[4],
            "telefono": row[5],
        }
        colaboradores.append(colaborador)

    return JSONResponse(status_code=200, content=colaboradores)


@router_admin.get("/admin/proveedores", response_model=List[ProveedorSchema])
def obtener_proveedores():
    query = text("SELECT * FROM proveedor")
    result = conn.execute(query).fetchall()
    if not result:
        raise HTTPException(status_code=404, detail="Error al obtener proveedores")

    proveedores = []
    for row in result:
        proveedor = {
            "id_proveedor": row[0],
            "nombre": row[1],
            "ubicacion": row[2],
            "email": row[3],
            "telefono": row[4],
        }
        proveedores.append(proveedor)

    return JSONResponse(status_code=200, content=proveedores)

@router_admin.post("/register/proveedor")
def registrar_proveedor(p: ProveedorSchema):
    nuevo_proveedor = p.dict()
    result = conn.execute(proveedor.insert().values(nuevo_proveedor))
    
    if not result:
        raise HTTPException(status_code=404, detail="Error al registrar proveedor, por favor verifique los datos ingresados")
    
    conn.commit()
    return JSONResponse(content=nuevo_proveedor, status_code=HTTP_201_CREATED)

@router_admin.put("/update/proveedor/{id_proveedor}")
def actualizar_proveedor(id_proveedor: int, colab: ProveedorUpdateSchema):
    update_data = {key: value for key, value in colab.dict().items() if value is not None}

    if not update_data:
        raise HTTPException(status_code=400, detail="Por favor verfica los datos ingresados")

    query = (
        update(proveedor)
        .where(proveedor.c.id_proveedor == id_proveedor)
        .values(**update_data)
    )
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Proveedor no encontrador")

    return JSONResponse(content={"message": "Proveedor actualizado correctamente"}, status_code=200)


@router_admin.get("/admin/productos", response_model=List[ProductoSchema])
def obtener_productos():
    query = text("SELECT * FROM productos")
    result = conn.execute(query).fetchall()
    
    if not result:
        raise HTTPException(status_code=404, detail="Error al obtener productos")

    productos_lista = []
    for row in result:
        producto = {
            "id_producto": row[0],
            "nombre": row[1],
            "fecha_vencimiento": str(row[2]),
            "cantidad": row[3],
            "precio_compra": row[4],
            "precio_venta": row[5],
            "lote": row[6],
            
        }
        productos_lista.append(producto)
        print(productos_lista)
    return JSONResponse(status_code=200, content = productos_lista)

@router_admin.post("/register/producto")
def registrar_productos(p: RegistroProductoSchema):

    nuevo_producto = {
        "nombre": p.nombre,
        "fecha_vencimiento": p.fecha_vencimiento,
        "cantidad": p.cantidad,
        "precio_compra": p.precio_compra,
        "precio_venta": p.precio_venta,
        "lote": p.lote
    }
    result1 = conn.execute(productos.insert().values(nuevo_producto))
    
    if not result1:
        raise HTTPException(status_code=404, detail="Error al registrar producto, por favor verifique los datos ingresados")
    conn.commit()
    
    
    query = conn.execute(text("SELECT COUNT(*) FROM productos"))
    count = query.scalar()
    
    registro_producto = {
        "id_producto": count,
        "id_proveedor": p.id_proveedor,
    }
    
    result2 = conn.execute(registro_productos.insert().values(registro_producto))
        
    if not result2:
        raise HTTPException(status_code=404, detail="Error al registrar producto, por favor verifique los datos ingresados")
    
    conn.commit()
    return JSONResponse(content=nuevo_producto, status_code=HTTP_201_CREATED)

@router_admin.put("/update/producto/{id_producto}")
def actualizar_producto(id_producto: int, producto: ProductoUpdateSchema):
    
    update_data_register = {
        "id_proveedor" : producto.id_proveedor,    
    }

    if not update_data_register:
        raise HTTPException(status_code=400, detail="Por favor verifica los datos ingresados")

    query = (
        update(registro_productos)
        .where(registro_productos.c.id_producto == id_producto)
        .values(**update_data_register)
    )
    
    result1 = conn.execute(query)
    conn.commit()

    if result1.rowcount == 0:
        raise HTTPException(status_code=404, detail="Producto no encontrado")
    
    producto.id_proveedor = None
    
    update_data_product = {key: value for key, value in producto.dict().items() if value is not None}
    
    print(update_data_product)
    if not update_data_product:
        raise HTTPException(status_code=400, detail="Por favor verifica los datos ingresados")

    query = (
        update(productos)
        .where(productos.c.id_producto == id_producto)
        .values(**update_data_product)
    )
    result2 = conn.execute(query)
    conn.commit()

    if result2.rowcount == 0:
        raise HTTPException(status_code=404, detail="Producto no encontrado")

    return JSONResponse(content={"message": "Producto actualizado correctamente"}, status_code=200)


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
