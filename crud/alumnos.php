<?php
    // Importar el archivo de conexión a la base de datos
    require_once 'conexion.php';

    // Conectar a la base de datos
    $con = conectar();

    // Consulta para obtener todos los alumnos
    $sql = "SELECT * FROM alumnos";

    // Ejecutar la consulta
    $query = $con->query($sql);

    $editando = false;
    $alumno_editar = [
        "id" => '',
        "nombre" => '',
        "apellido_p" => '',
        "apellido_m" => '',
        "edad" => '',
    ];

    if (isset($_GET["id"])) {
        $editando = true;
        $id_editar = $_GET["id"];

        $sql_editar = "SELECT * FROM alumnos WHERE id = '$id_editar'";
        $resultado_editar = $con->query($sql_editar);

        if ($resultado_editar && mysqli_num_rows($resultado_editar) > 0) {
            $alumno_editar = $resultado_editar->fetch_assoc();
        };

    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
</head>
<body>
    <div
        style="max-width: 800px; margin: 0 auto;"
    >
        <h1>Tabla de alumnos</h1>
        <table style="">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $query->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido_p']; ?></td>
                        <td><?php echo $row['apellido_m']; ?></td>
                        <td><?php echo $row['edad']; ?></td>
                        <td>
                            <a href="alumnos.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div>
        <h1><?php echo $editando ? "Editar alumno" : "Insertar Alumno" ?></h1>
        <form action="<?php echo $editando ? "editar.php" : "insertar.php" ?>" method="POST" style="display: flex; flex-direction: column; gap: 10px; max-width: 400px;">
            <div style="display: flex; flex-direction: column; gap: 10px; max-width: 400px;">
                <?php if ($editando) { ?>
                    <input type="hidden" name="id_original" value="<?php echo $alumno_editar["id"] ?>">
                <?php } ?>

                <div>
                    <label for="matricula">Matricula</label>
                    <input type="text" name="matricula" id="matricula" placeholder="Matricula"
                        value="<?php echo $alumno_editar["id"] ?>"
                    >
                </div>
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                        value="<?php echo $alumno_editar["nombre"] ?>"
                    >
                </div>
                <div>
                    <label for="apellido_p">Apellido paterno:</label>
                    <input type="text" name="apellido_p" id="apellido_p" placeholder="Apellido paterno"
                        value="<?php echo $alumno_editar["apellido_p"] ?>"
                    >
                </div>
                <div>
                    <label for="apellido_m">Apellido materno:</label>
                    <input type="text" name="apellido_m" id="apellido_m" placeholder="Apellido materno"
                        value="<?php echo $alumno_editar["apellido_m"] ?>"
                    >
                </div>
                <div>
                    <label for="edad">Edad:</label>
                    <input type="number" name="edad" id="edad" placeholder="Edad"
                        value="<?php echo $alumno_editar["edad"] ?>"
                    >
                </div>
                <div>
                    <input type="submit" value="<?php echo $editando ? "Editar" : "Insertar" ?>">

                    <?php if ($editando) { ?>
                        <a href="alumnos.php">Cancelar</a>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>