<?php
    // Importar el archivo de conexión a la base de datos
    require_once 'conexion.php';

    // Conectar a la base de datos
    $con = conectar();

    // Consulta para obtener todos los alumnos
    $sql = "SELECT * FROM alumnos";

    // Ejecutar la consulta
    $query = $con->query($sql);
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
                            <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div>
        <h1>Insertar Alumno</h1>
        <form action="insertar.php" method="POST" style="display: flex; flex-direction: column; gap: 10px; max-width: 400px;">
            <div style="display: flex; flex-direction: column; gap: 10px; max-width: 400px;">
                <div>
                    <label for="matricula">Matricula</label>
                    <input type="text" name="matricula" id="matricula" placeholder="Matricula">
                </div>
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                </div>
                <div>
                    <label for="apellido_p">Apellido paterno:</label>
                    <input type="text" name="apellido_p" id="apellido_p" placeholder="Apellido paterno">
                </div>
                <div>
                    <label for="apellido_m">Apellido materno:</label>
                    <input type="text" name="apellido_m" id="apellido_m" placeholder="Apellido materno">
                </div>
                <div>
                    <label for="edad">Edad:</label>
                    <input type="number" name="edad" id="edad" placeholder="Edad">
                </div>
                <div>
                    <input type="submit" value="Insertar">
                </div>
            </div>
        </form>
    </div>
</body>
</html>