<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusComp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-KyZXEAg3QhqLMpG8r+OvGXtWOnyBMv1o7Qf+UKvD5Hr9CQk6b/qR+AMz2zn+jFsvpiOh3nhCUO+LNT3MTKK/bAA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('./Autobus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 5%;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            width: 70%;
            margin: 0 auto;
        }

        .title {
            font-size: 4rem;
            color: white;
            margin-bottom: 40px;
        }

        .button,
        .continue-btn {
            background-color: white;
            color: black;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0;
        }

        .routes {
            display: none;
            background-color: rgba(255, 255, 255, 1);
            padding: 20px;
            border-radius: 5px;
        }

        .routes select {
            background-color: white;
            color: black;
            padding: 10px;
            font-size: 1.1rem;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid black;
        }

        .seat {
            width: 50px;
            height: 50px;
            display: inline-block;
            border: 1px solid #ddd;
            margin: 5px;
            cursor: pointer;
        }

        .seat.selected {
            background-color: rgb(246, 248, 245);
            color: white;
        }

        .seat-selection h2 {
            color: white;
        }

        #admin {
            position: absolute;
            top: 10px;
            right: 10px;
            background-image: url('iconAdmin.png');
            color: black;
            padding: 15px;
            font-size: 1.2rem;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            font-size: 2rem;
            width: auto;
            height: auto;
        }

        #admin:hover {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
    <div class="content">
        <h1 class="title">BusComp</h1>
        <button class="button" onclick="toggleRoutes()">Rutas</button>

        <div class="routes" id="routeSelector">
            <form method="POST" action="./php/redireccionar_be.php">
                <select id="routeOptions" name="selectedRoute">
                    <?php
                    include 'php/cargarRutas_be.php';
                    // Itera a través de las rutas y crea opciones para el select
                    foreach ($rutas as $ruta) {
                        echo "<option value='" . $ruta['id_ruta'] . "'>" . $ruta['nombre_ruta'] . "</option>";
                    }

                    
                    ?>
                </select>
                <button type="submit" class="continue-btn" onclick="sesionStart()">Continuar</button>
            </form>
        </div>



    </div>

    <button id="admin" onclick="btnAdmin()">💳</button>
    <script>
        function sesionStart() {
            window.location.href = './php/sesion_be.php';
        }
        function btnAdmin() {
            window.location.href = 'LogRegAdmin.php';
        }

        function toggleRoutes() {
            const routeSelector = document.getElementById('routeSelector');
            if (routeSelector.style.display === 'none') {
                routeSelector.style.display = 'block';
            } else {
                routeSelector.style.display = 'none';
            }
        }

        function showSeatSelection() {
            document.getElementById('seatSelection').style.display = 'block';
        }

        function selectSeat(element) {
            element.classList.toggle('selected');
        }
        function captureAndRedirect() {
            // Captura el valor seleccionado en el elemento 'select'
            const selectedRoute = document.getElementById('routeOptions').value;

            // Redirige a otra página y pasa el valor como parámetro en la URL
            window.location.href = 'EscogerAsiento.php?ruta=' + selectedRoute;
        }

    </script>
</body>

</html>