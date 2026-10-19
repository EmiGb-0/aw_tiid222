<?php
    require_once 'conexion.php';
    $con = conectar();
    // editar.php?id=<?php echo $row['id']; lo utilizamos para obtener el id del alumno que queremos eliminar
    // Debemos obtener el id del alumno que queremos eliminar
    if (!isset($_GET['id'])) {
        echo "No se ha especificado el id del alumno a eliminar.";
        exit;
    }
    $matricula = $_GET['id'];

    // Construir la consulta SQL para eliminar el alumno
    $sql = "DELETE FROM alumnos WHERE id = '$matricula'";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($con->query($sql) === TRUE) {
        echo "Alumno eliminado correctamente.";
        header("Location: alumnos.php"); // Redirigir a la página de alumnos después de insertar
        exit;
    } else {
        echo "Error al eliminar alumno: " . $con->error;
    }
