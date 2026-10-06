<?php
    // Importar el archivo de conexión a la base de datos
    require_once 'conexion.php';

    // Conectar a la base de datos
    $con = conectar();

    // Consulta para obtener todos los alumnos
    $sql = "SELECT * FROM libros";

    // Ejecutar la consulta
    $query = $con->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 1er Parcial</title>

    <style>

        .barra {
            text-align: center;
            margin: 0 auto;
            padding: 20px;
            background-color: #9d0000;
            color: #fff;
        }

        .formulario {
            display: flex;
            justify-content: space-around;
            align-items: start;
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .form {
            background-color: #ffe9b7;
            width: 100%;
            padding: 10px;
        }

        .tabla {
            width: 100%;
        }

        .card {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .card_item {
            text-align: center;
            text-decoration: none;
            background-color: #0092ac;
            color: #fff;
            gap: 10px;
            margin: 10px;
            padding: 10px;

        }

        .card_item:hover {
            background-color: #01abc9;
        }

        .datos {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            align-items: center;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div>
        <header class="barra">
            <h1>Examen 1er Parcial</h1>
        </header>

        <div class="formulario">
            <div class="form">
                <form action="insertar.php" method="POST" style="display: flex; flex-direction: column; gap: 10px; max-width: 400px;">
                    <div style="display: flex; flex-direction: column; gap: 10px; max-width: 400px;">
                        <div>
                            <label for="id">id</label>
                            <input type="text" name="id" id="id" placeholder="Id">
                        </div>
                        <div>
                            <label for="titulo">titulo:</label>
                            <input type="text" name="titulo" id="titulo" placeholder="Titulo">
                        </div>
                        <div>
                            <label for="autor">Autor:</label>
                            <input type="text" name="autor" id="autor" placeholder="Autor">
                        </div>
                        <div>
                            <label for="paginas">Paginas:</label>
                            <input type="text" name="paginas" id="paginas" placeholder="Paginas">
                        </div>
                        <div>
                            <label for="precio">Precio:</label>
                            <input type="text" name="precio" id="precio" placeholder="Precio">
                        </div>
                        <div>
                        </div>
                        <div>
                            <input type="submit" value="Insertar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="tabla">
                <h2>Tabla de Libros</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Pagina</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['titulo']; ?></td>
                                <td><?php echo $row['autor']; ?></td>
                                <td><?php echo $row['paginas']; ?></td>
                                <td><?php echo $row['precio']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card">
            <a 
                class="card_item"
                href="docs/appweb_intro_git.pdf"
                target="_blank"
            >
                R1 - Introduccion a Git y Github
            </a>
            <a 
                class="card_item"
                href="docs/appweb_R2.pdf"
                target="_blank"
            >
                R2 - HTML + CSS + Box Model
            </a>
            <a 
                class="card_item"
                href="docs/appweb_grid&flex.pdf"
                target="_blank"
            >
                R3 - Flex y Grid
            </a>
        </div>

        <div class="datos">
            <div
                style="
                    margin: 0 auto;
                "
            >
                <img 
                    style="width: 80px;
                    background-color: #414141;
                    border-radius: 100px;"
                    src="../img/cv_img.png" alt="Imagen de fotos"
                >
            </div>

            <div>
                <h3>Emiliano Gonzalez Barron</h3>
                <p>
                    Muy aburrido, ha sido divertido en ocasiones cuando creamos proyectos (ya que es lo que me gusta).

                    De ahi en fuera se me hace aburrido todo ya que para mi cada cuatrimestre es ver los temas que ya me se desde hace mucho tiempo.
                </p>
            </div>

            <div
                style="
                    margin: 0 auto;
                "
            >
                <img 
                    style="width: 80px;
                    background-color: #414141;
                    border-radius: 100px;"
                    src="../img/upq.png" alt="Imagen de fotos"
                >
            </div>
        </div>
    </div>

</body>
</html>