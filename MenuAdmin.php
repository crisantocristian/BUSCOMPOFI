<?php
session_start(); // Inicia la sesión si aún no está iniciada
error_reporting(0);
$varsesion = $_SESSION['correo'];
if ($varsesion == null || $varsesion == '') {

    echo 'ACCESO DENEGADO';
    session_destroy();
    header("Location:LogRegAdmin.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusComp</title>
    <style>
        body {

            font-family: Arial, sans-serif;
            background-image: url('./Autobus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding-left: 5%;
            width: 50%;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0);
            padding: 20px;
            border-radius: 5px;
        }

        .title {
            font-size: 4.5rem;
            /* Tamaño de la fuente del título aumentado */
            color: black;
            margin-bottom: 20px;
        }

        .button {
            background-color: white;
            color: black;
            padding: 20px 40px;
            /* Tamaño de los botones aumentado */
            font-size: 1.5rem;
            /* Tamaño de la fuente de los botones aumentado */
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0;
            text-align: center;
            width: 400px;
            display: block;
        }


        .button:hover {
            background-color: rgba(20, 20, 128, .5);
            border: 2px solid blue;
            color: white;
        }

        #salir:hover {
            background-color: rgba(128, 20, 20, .8);
            border: 2px solid red;
            color: white;
        }

        #titulo {
            display: flex;
        }

        #salir {
            width: auto;
        }
    </style>
</head>

<body>
    <div>
        <div id="titulo">
            <h1 class="title">BUSCOMP</h1>
            <h2>ADMIN</h2>
        </div>
        <br>
        <div class="content">
            <button class="button" onclick="crearRuta()" id="crearRuta">Crear Ruta</button>
            <button class="button" onclick="modificarRuta()" id="modificarRuta">Modificar Ruta</button>
            <button class="button" onclick="verRutas()" id="verRutas">Ver Rutas</button>
            <button class="button" onclick="eliminarRuta()" id="eliminarRuta">Eliminar Ruta</button>
            <button class="button" onclick="registrarse()" id="Registrar nuevo administrador">Nuevo
                administrador</button>
            <button class="button" onclick="salir()" id="salir">Salir</button>
        </div>
    </div>



    <script>
        function crearRuta() {
            window.location.href = 'crearRuta.php';
        }

        function modificarRuta() {
            window.location.href = 'ModificarRuta.php';
        }

        function verRutas() {
            window.location.href = 'verRutas.php';
        }


        function eliminarRuta() {
            window.location.href = 'EliminarRuta.php';
        }

        function registrarse() {
            window.location.href = 'Registro.php';
        }

        function salir() {

            window.location.href = 'php/logout_be.php'; // Redirigir a un archivo PHP que destruya la sesión en el servidor
        }
    </script>
</body>

</html>