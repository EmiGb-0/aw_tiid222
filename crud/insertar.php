<?php
    require_once 'conexion.php';
    $con = conectar();

    // Verificar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Obtener los datos del formulario
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_p'];
        $apellido_materno = $_POST['apellido_m'];
        $edad = $_POST['edad'];

        // Validar que todos los campos estén llenos
        if (empty($matricula) || empty($nombre) || empty($apellido_paterno) || empty($apellido_materno) || empty($edad)) {
            echo "Todos los campos son obligatorios.";
            exit;
        }
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO alumnos (id, nombre, apellido_p, apellido_m, edad) VALUES ('$matricula', '$nombre', '$apellido_paterno', '$apellido_materno', '$edad')";

        // Ejecutar la consulta y verificar si fue exitosa
        if ($con->query($sql) === TRUE) {
            echo "Alumno insertado correctamente.";
            header("Location: alumnos.php"); // Redirigir a la página de alumnos después de insertar
            exit;
        } else {
            echo "Error al insertar alumno: " . $con->error;
        }
    }
