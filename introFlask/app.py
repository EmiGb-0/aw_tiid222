# Importamos flask para poder crear nuestra aplicación web
from flask import Flask, render_template, redirect, request
from werkzeug.security import generate_password_hash
# Hacemos la conexion a la base de datos
from flask_mysqldb import MySQL

# Creamos una instancia de la clase Flask, que representa nuestra aplicación web
app = Flask(__name__)
app.config["TEMPLATES_AUTO_RELOAD"] = True  # Configuramos la aplicación para recargar automáticamente las plantillas HTML cuando se modifiquen


# Configuramos la conexión a la base de datos MySQL
app.config['MYSQL_HOST'] = 'localhost'  # Dirección del servidor de la base de datos
app.config['MYSQL_USER'] = 'root'  # Nombre de usuario de la base de datos
app.config['MYSQL_PASSWORD'] = ''  # Contraseña de la base de datos
app.config['MYSQL_DB'] = 'flask_login'  # Nombre de la base de datos

mysql = MySQL(app)

@app.route('/')
def home():
    return render_template("index.html")  # Renderizamos la plantilla index.html cuando se accede a la ruta raíz /

@app.route('/guardar')
def guardar():
    return "Producto agregado correctamente!"

@app.route("/login")
def login():
    return render_template("login.html")  # Renderizamos la plantilla login.html cuando se accede a la ruta /login
@app.route("/logout")
def logout():
    return redirect("/login")  # Redirigimos al usuario a la ruta raíz / después de cerrar sesión
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        # 1. Obtener los datos enviados del formulario
        nombre = request.form['nombre']
        apellido_p = request.form['apellido_p']
        apellido_m = request.form['apellido_m']
        correo = request.form['correo']
        contraseña = request.form['contraseña']
        id_rol = request.form['id_rol']

        password_hash = generate_password_hash(contraseña)  # Hasheamos la contraseña para mayor seguridad
        
        cursor = mysql.connection.cursor()  # Creamos un cursor para interactuar con la base de datos
        
        cursor.execute(
            "SELECT id FROM usuarios WHERE correo = %s",
            (correo, )
        )
        
        if cursor.fetchone():
            cursor.close()
            return render_template('register.html', error='El correo ya está registrado.')  # Si el correo ya existe, mostramos un mensaje de error
        
        
        cursor.execute(
            """INSERT INTO usuarios (nombre, apellido_p, apellido_m, correo, contraseña, id_rol)
            VALUES (%s, %s, %s, %s, %s, %s)""",
            (nombre, apellido_p, apellido_m, correo, password_hash, id_rol)
        )
        mysql.connection.commit()
        cursor.close()
        return redirect('/login')  # Redirigimos al usuario a la página de login después de registrarse exitosamente

    # Si la petición es GET, simplemente renderizas la plantilla del formulario
    return render_template('register.html')


if __name__ == '__main__':
    app.run(port=5000, debug=True)  # Ejecutamos la aplicación en el puerto 5000 y activamos el modo de depuración

# CREATE DATABASE nombre_de_tu_base_de_datos;
# USE nombre_de_tu_base_de_datos;
# CREATE TABLE usuarios (
#     id INT AUTO_INCREMENT PRIMARY KEY,
#     nombre VARCHAR(100) NOT NULL,
#     apellido_p VARCHAR(100) NOT NULL,
#     apellido_m VARCHAR(100) NOT NULL,
#     correo VARCHAR(100) NOT NULL UNIQUE,
#     contraseña VARCHAR(255) NOT NULL,
#     id_rol INT NOT NULL,
#     FOREIGN KEY (id_rol) REFERENCES roles(id)
# );
# CREATE TABLE roles (
#     id_rol INT AUTO_INCREMENT PRIMARY KEY,
#     nombre_rol VARCHAR(50) NOT NULL
# );
# INSERT INTO roles (nombre_rol) VALUES ('admin'), ('usuario');

