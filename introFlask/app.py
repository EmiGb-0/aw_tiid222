# Importamos flask para poder crear nuestra aplicación web
from flask import Flask, render_template

# Creamos una instancia de la clase Flask, que representa nuestra aplicación web
app = Flask(__name__)
app.config["TEMPLATES_AUTO_RELOAD"] = True  # Configuramos la aplicación para recargar automáticamente las plantillas HTML cuando se modifiquen

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


if __name__ == '__main__':
    app.run(port=5000, debug=True)  # Ejecutamos la aplicación en el puerto 5000 y activamos el modo de depuración