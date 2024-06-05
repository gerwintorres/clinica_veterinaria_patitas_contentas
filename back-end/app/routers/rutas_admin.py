from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from fastapi.responses import JSONResponse
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text, update, delete, select
from sqlalchemy.orm import Session
from database.db import conn
from models.models import administrador, colaborador, proveedor, productos, registro_productos, servicio
#from models.models import clientes
from schemas.schemas import (
    ServicioSchema, ClienteSchema, HistoriaSchema, ProductoUpdateSchema, RegistroProductoSchema, 
    CredencialesSchema, ColaboradorSchema, ColaboradorUpdateSchema, ProveedorSchema, ProveedorUpdateSchema, ProductoSchema, RestablecerPasswordSchema)

from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet
from typing import List
from datetime import datetime, timedelta

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

@router_admin.delete("/delete/colaboradores/{id_colaborador}")
def eliminar_colaborador(id_colaborador: int):

    query = (colaborador.delete().where(colaborador.c.id_colaborador == id_colaborador))
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Colaborador no encontrado")

    return JSONResponse(content={"message": "Colaborador eliminado correctamente"}, status_code=200)


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

@router_admin.delete("/delete/proveedor/{id_proveedor}")
def eliminar_proveedor(id_proveedor: int):
    
    query1 = (
        select(registro_productos.c.id_producto)
        .where(registro_productos.c.id_proveedor == id_proveedor)
    )
    
    result_list = conn.execute(query1)
    ids = [row[0] for row in result_list.fetchall()]
    
    for id_producto in ids:
        
        query2 = (
            delete(registro_productos)
            .where(registro_productos.c.id_producto == id_producto)
        )
        
        result = conn.execute(query2)
        conn.commit()
            
        query3 = (
            delete(productos)
            .where(productos.c.id_producto == id_producto)
        )
        
        result1 = conn.execute(query3)
        conn.commit()
        
    query4 = (
        delete(proveedor)
        .where(proveedor.c.id_proveedor == id_proveedor)
    )
    
    result2 = conn.execute(query4)
    conn.commit()

    if result2.rowcount == 0:
        raise HTTPException(status_code=404, detail="Proveedor no encontrado")
    

    
    return JSONResponse(content={"message": "Proveedor eliminado correctamente"}, status_code=200)



    


@router_admin.get("/admin/productos", response_model=List[ProductoSchema])
def obtener_productos():
    query = text("SELECT * FROM productos")
    result = conn.execute(query).fetchall()
    
    print(result)

    
    if not result:
        raise HTTPException(status_code=404, detail="Error al obtener productos")

    productos_lista = []
    
    for row in result:
        query = text(f"SELECT id_proveedor FROM registro_productos WHERE id_producto = {row[0]}")
        id_proveedor = conn.execute(query).fetchone()

        producto = {
            "id_producto": row[0],
            "nombre": row[1],
            "fecha_vencimiento": str(row[2]),
            "cantidad": row[3],
            "id_proveedor": id_proveedor[0],
            "precio_compra": row[4],
            "precio_venta": row[5],
            "lote": row[6],
        }
        
        productos_lista.append(producto)
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
    
    
    query = conn.execute(text("SELECT id_producto FROM productos ORDER BY id_producto DESC LIMIT 1"))
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

@router_admin.delete("/delete/producto/{id_producto}")
def eliminar_producto(id_producto: int):
    
    query1 = (
        delete(registro_productos)
        .where(registro_productos.c.id_producto == id_producto)
    )
    
    result1 = conn.execute(query1)    
    conn.commit()
    
    query2 = (
        delete(productos)
        .where(productos.c.id_producto == id_producto)
    )
    result2 = conn.execute(query2)
    conn.commit()

    if result2.rowcount == 0:
        raise HTTPException(status_code=404, detail="Producto no encontrado")

    return JSONResponse(content={"message": "Producto eliminado correctamente"}, status_code=200)

@router_admin.get("/admin/historias", response_model=List[HistoriaSchema])
def obtener_historias():
    query = text("SELECT * FROM mascotas")
    result = conn.execute(query).fetchall()
    
    if not result:
        raise HTTPException(status_code=404, detail="Error al obtener historias clínicas")

    historias = []
    
    for row in result:
        historia = {
            "codigo": row[0],
            "id_cliente": row[7],
            "nombre": row[1],
        }
        historias.append(historia)

    return JSONResponse(status_code=200, content=historias)

@router_admin.get("/admin/clientes", response_model=List[ClienteSchema])
def obtener_clientes():
    query = text("SELECT * FROM cliente")
    result = conn.execute(query).fetchall()
    
    if not result:
        raise HTTPException(status_code=404, detail="Error al obtener clientes")

    clientes = []
    
    for row in result:
        cliente = {
            "id_cliente": row[0],
            "nombres": row[1],
            "apellidos": row[2],
            "tipo_documento": row[3],
        }
        clientes.append(cliente)

    return JSONResponse(status_code=200, content=clientes)

@router_admin.get("/admin/precios", response_model=List[ServicioSchema])
def obtener_precios():
    query = text("SELECT * FROM servicio")
    result = conn.execute(query).fetchall()
    if not result:
        raise HTTPException(status_code=404, detail="Error al obtener precios de los servicios")

    servicios = []
    for row in result:
        servicio = {
            "id_servicio": row[0],
            "nombre": row[1],
            "precio": row[2],
        }
        servicios.append(servicio)

    return JSONResponse(status_code=200, content=servicios)

@router_admin.post("/register/precios")
def registrar_precios(p: ServicioSchema):
    
    nuevo_precio = p.dict()
    
    result = conn.execute(servicio.insert().values(nuevo_precio))
    
    if not result:
        raise HTTPException(status_code=404, detail="Error al registrar precio del servicio, por favor verifique los datos ingresados")
    
    conn.commit()
    return JSONResponse(content=nuevo_precio, status_code=HTTP_201_CREATED)


@router_admin.put("/update/precios/{id_servicio}")
def actualizar_procedimiento(id_servicio: int, serv: ServicioSchema):
    update_data = {key: value for key, value in serv.dict().items() if value is not None}

    if not update_data:
        raise HTTPException(status_code=400, detail="Por favor verifica los datos ingresados")

    query = (
        update(servicio)
        .where(servicio.c.id_servicio == id_servicio)
        .values(**update_data)
    )
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Procedimiento no encontrado")

    return JSONResponse(content={"message": "Procedimiento actualizado correctamente"}, status_code=200)


@router_admin.delete("/delete/precios/{id_servicio}")
def eliminar_procedimiento(id_servicio: int):

    query = (
        delete(servicio)
        .where(servicio.c.id_servicio == id_servicio)
    )
    result = conn.execute(query)
    conn.commit()

    if result.rowcount == 0:
        raise HTTPException(status_code=404, detail="Procedimiento no encontrado")

    return JSONResponse(content={"message": "Procedimiento eliminado correctamente"}, status_code=200)


# Endpoint para restablecer la contraseña
@router_admin.post('/admin/password-reset')
def password_reset(request: RestablecerPasswordSchema):
    token = request.token
    new_password = request.new_password

    query = text("SELECT * FROM tokens_recuperacion WHERE token = :token")
    result = conn.execute(query, {"token": token}).fetchone()

    if not result:
        raise HTTPException(status_code=404, detail="Token inválido")

    expiration = datetime.strptime(result.expiration, '%Y-%m-%d %H:%M:%S')
    if datetime.utcnow() > expiration:
        raise HTTPException(status_code=400, detail="El token ha expirado")

    email = result.email
    hashed_password = pwd_context.hash(new_password)

    # Actualizar la contraseña del médico
    update_query = text("UPDATE administrador SET clave = :clave WHERE email = :email")
    conn.execute(update_query, {"clave": new_password, "email": email})

    # Eliminar el registro de recuperación de contraseña
    delete_query = text("DELETE FROM tokens_recuperacion WHERE token = :token")
    conn.execute(delete_query, {"token": token})
    conn.commit()

    return JSONResponse(content={"message": "Contraseña restablecida exitosamente"}, status_code=200)