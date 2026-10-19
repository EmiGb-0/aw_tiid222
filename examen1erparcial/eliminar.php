<?php
    require_once 'conexion.php';
    $con = conectar();
    // editar.php?id=<?php echo $row['id']; lo utilizamos para obtener el id del alumno que queremos eliminar
    // Debemos obtener el id del alumno que queremos eliminar
    if (!isset($_GET['id'])) {
        echo "No se ha especificado el id del libro a eliminar.";
        exit;
    }
    $id = $_GET['id'];

    // Construir la consulta SQL para eliminar el alumno
    $sql = "DELETE FROM libros WHERE id = '$id'";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($con->query($sql) === TRUE) {
        echo "Libro eliminado correctamente.";
        header("Location: index.php"); // Redirigir a la página de alumnos después de insertar
        exit;
    } else {
        echo "Error al eliminar libro: " . $con->error;
    }
