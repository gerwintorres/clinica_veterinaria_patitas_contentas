from sqlalchemy import create_engine, MetaData


"""
Aquí agregan las credenciales de su base de datos local (llamenla bd_clinica), de preferencia usen el usuario root

Estructura guía: "mysql+pymysql://user:contrasena@localhost:port/bd_clinica"
"""

engine = create_engine("mysql+pymysql://root:0000@localhost:3306/bd_clinica")
conn = engine.connect()

meta_data = MetaData()
