<?php

function conectar() {
    // Configuración de la conexión a la base de datos
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "crud_libros";

    // Crear la conexión
    $conexion = new mysqli($host, $user, $pass, $db);


    // Verificar si hubo un error en la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Retornar la conexión
    return $conexion;
}

?>
