<?php
    require_once 'conexion.php';
    $con = conectar();

    // Verificar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Obtener los datos del formulario
        $id_original = $_POST['id_original'];
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
        // actualizar los datos en la base de datos
        $sql = "UPDATE alumnos SET id = '$matricula', nombre = '$nombre', apellido_p = '$apellido_paterno', apellido_m = '$apellido_materno', edad = '$edad' WHERE id = '$id_original'";

        // Ejecutar la consulta y verificar si fue exitosa
        if ($con->query($sql) === TRUE) {
            echo "Alumno actualizado correctamente.";
            header("Location: alumnos.php"); // Redirigir a la página de alumnos después de insertar
            exit;
        } else {
            echo "Error al actualizar alumno: " . $con->error;
        }
    }
