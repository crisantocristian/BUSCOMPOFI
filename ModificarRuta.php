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
    <title>Modificar Ruta - BusComp</title>
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

        

        h3 {
            font-size: 1.5rem;
            color: black;
            /* Cambia el color del subtítulo si es necesario */
            margin-bottom: 20px;
        }

        form {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
            width: 40%;
            align-items: center;
        }

        label {
            font-size: 1.2rem;
            color: black;
            display:block;
        }

        input[type="text"]{
            
            width: 95.5%;
            padding: 10px;
            font-size: 1.2rem;
            margin-bottom: 10px;
            border: 1px solid #000;
            border-radius: 5px;
            margin-right: 300px;
        }
        input[type="time"] {
            width: auto;
            padding: 10px;
            font-size: 1.2rem;
            margin-bottom: 10px;
            border: 1px solid #000;
            border-radius: 5px;
            
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 1rem;
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
            margin: 10px 0;
            display: block;
        }

        button:hover {
            background-color: rgba(20, 20, 128, .5);
            border: 2px solid blue;
            color: white;
        }

        #divSalir {
            margin-left: 16%;
            display: flex;
            align-items: right;
            margin-top: 5px;
            /* Reduce el margen superior si es necesario */
        }

        #btnSalir {
            background-color: white;
            color: black;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
        }

        #btnSalir:hover {
            background-color: rgba(20, 20, 128, .5);
            border: 2px solid blue;
            color: white;
        }
        #titulo {
            margin-left: 15%;
            display: flex;
        }
    </style>
</head>

<body>
    <div id="titulo">
        <h1 class="title">BUSCOMP</h1>
        <h4>ADMIN</h4>
    </div>
    
    <form onsubmit="return validarHoras();" action="php/modificarRuta_be.php" method="POST">
        <label for="ruta">Selecciona una Ruta:</label>
        <select name="ruta" id="ruta">
            <?php
            include 'php/cargarRutas_be.php';
            ?>
        </select>

        <label for="nombreRuta">Nuevo Nombre de la Ruta:</label>
        <input type="text" id="nombreRuta" name="nombreRuta" placeholder="Ingrese el nuevo nombre de la ruta" required>

        <label for="nombreConductor">Nuevo Nombre del Conductor:</label>
        <input type="text" id="nombreConductor" name="nombreConductor"
            placeholder="Ingrese el nuevo nombre del conductor" required>

        <label for="nombreUnidad">Nuevo Nombre de la Unidad:</label>
        <input type="text" id="nombreUnidad" name="nombreUnidad" placeholder="Ingrese el nuevo nombre de la unidad"
            required>

        <label id="Hora" for="horaSalida">Nueva Hora de Salida:</label>
        <input type="time" id="horaSalida" name="horaSalida" required>

        <label id="Hora" for="horaLlegada">Nueva Hora de Llegada:</label>
        <input type="time" id="horaLlegada" name="horaLlegada" required>

        <center><button type="submit">Modificar Ruta</button></center>
    </form>
    <div id="divSalir">
        <button id="btnSalir" onclick="salir()">Cancelar</button>
    </div>

    <script>
        function salir() {
            window.location.href = 'MenuAdmin.php';
        }
        function validarHoras() {
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