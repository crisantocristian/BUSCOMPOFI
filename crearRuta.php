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
    <title>Crear Ruta - BusComp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('./Autobus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 15%;
            align-items: left;
        }

        .container {
            background-color: rgba(255, 255, 255, 0);
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }

        .title {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        label {
            font-size: 1.2rem;
            color: white;
        }

        input[type="text"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
            margin-bottom: 15px;
            border: 1px solid #000;
            border-radius: 5px;
        }

        button {
            background-color: white;
            color: black;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgba(20, 20, 128, .5);
            border: 2px solid blue;
            color: white;
        }

        #titulo {
            margin-left: 10%;
            display: flex;
        }

        input[type="time"] {
            width: auto;
        }

        #divSalir {
            display: flex;
            flex-direction: column;
            gap: 40px;
            width: 500px;
        }

        #btnSalir {
            display: block;
            margin-top: 20px;
            align-self: center;
            padding: 15px 20px;
            background-color: white;
            color: black;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 1.1rem;
            margin-right: 15%;
        }
    </style>
</head>

<body>
    <div id="titulo">
        <h1 class="title">BUSCOMP</h1>
        <h3>ADMIN</h3>
    </div>
    <form class="container" onsubmit="return validarHoras();" action="php/crearRuta_be.php" method="POST">

        <label for="nombreRuta">Nombre de la Ruta:</label>
        <input type="text" id="nombreRuta" name="nombreRuta" placeholder="Ingrese el nombre de la ruta" required>

        <label for="nombreConductor">Nombre del Conductor:</label>
        <input type="text" id="nombreConductor" name="nombreConductor" placeholder="Ingrese el nombre del conductor"
            pattern="[A-Za-z\s]+" required>

        <label for="nombreUnidad">Nombre de la Unidad:</label>
        <input type="text" id="nombreUnidad" name="nombreUnidad" placeholder="Ingrese el nombre de la unidad" required>

        <label for="horaSalida">Hora de salida:</label>
        <input type="time" id="horaSalida" name="horaSalida" required><br>
        <label for="horaLlegada">Hora de llegada:</label>
        <input type="time" id="horaLlegada" name="horaLlegada" required><br>

        <button id="guardarRuta">Guardar Ruta</button>

    </form>
    <div id="divSalir">
        <button id="btnSalir" onclick="salir()">Cancelar</button>
    </div>
    <script>
        function salir() {
            window.location.href = 'MenuAdmin.php';
        }

        function validarHoras() {//Horas validas en el case de que la hora de salida sea antes que la hora de llegada

            // Obtener los valores de las horas de salida y llegada
            var horaSalida = document.getElementById("horaSalida").value;
            var horaLlegada = document.getElementById("horaLlegada").value;

            // Convertir los valores de las horas en objetos Date
            var fechaSalida = new Date("2000-01-01T" + horaSalida);
            var fechaLlegada = new Date("2000-01-01T" + horaLlegada);

            // Comparar las horas
            if (fechaSalida >= fechaLlegada) {
                alert("La hora de salida debe ser menor que la hora de llegada.");
                return false; // Evitar que se envíe el formulario
            }

            return true; // Permitir que se envíe el formulario si las horas son válidas

        }
    </script>
</body>

</html>