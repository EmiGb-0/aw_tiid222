<?php
    require_once 'conexion.php';
    $con = conectar();
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $paginas = $_POST['paginas'];
    $precio = $_POST['precio'];

    if (empty($id) || empty($titulo) || empty($autor) || empty($paginas) || empty($precio)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $sql = "INSERT INTO libros (id, titulo, autor, paginas, precio) VALUES ('$id', '$titulo', '$autor', '$paginas', '$precio')";


    if ($con->query($sql) === TRUE) {
        echo "Libro insertado correctamente.";
        header("Location: index.php"); 
        exit;
    } else {
        echo "Error al insertar un Libro: " . $con->error;
    }
