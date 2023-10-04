<?php
session_start();
$varsesion = $_SESSION['correo'];
if ($varsesion == null || $varsesion == '') {
    session_destroy();
    header("Location:LogRegAdmin.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Ruta</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('./Autobus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: inline-block;
            justify-content: flex-start;
            /* Alinea el contenido al lado izquierdo */
            align-items: center;
            padding-left: 5%;
            /* Agrega un espacio izquierdo para evitar que esté pegado al borde */
        }

        h3 {
            font-size: 1.5rem;
            color: black;
            margin-bottom: 20px;
        }

        form {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 5px;
        }

        label {
            font-size: 1.2rem;
            color: black;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 1rem;
        }

        button {
            background-color: white;
            color: black;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0;
        }

        button:hover {
            background-color: rgba(20, 20, 128, .5);
            border: 2px solid blue;
            color: white;
        }

        #titulo {
            margin-left: 30%;
            display: flex;
            align-items: right;
            margin-top: 40px;
        }

        #divSalir {
            margin-left: 43%;
            display: flex;
            align-items: right;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <div>
        <div id="titulo">
            <center>
                <h1 class="title">BUSCOMP</h1>
            </center>
            <h4>ADMIN</h4>
        </div>
        <center>
            <h3>Eliminar Ruta</h3>
        </center>
        <form action="php/eliminarRuta_be.php" method="POST">
            <label for="ruta">Selecciona una Ruta:</label>
            <select name="ruta" id="ruta">
                <?php
                include 'php/cargarRutas_be.php';//Aqui se hace referencia al php de cargar rutas
                ?>
            </select>
            <button type="submit">Eliminar</button>
            
        </form>
        <div id="divSalir">
                <button id="btnSalir" onclick="salir()">Cancelar</button>
            </div>
    </div>
    <script>
        function salir() {
            window.location.href = 'MenuAdmin.php';
        }
    </script>
</body>

</html>