<?php
session_start(); // Inicia la sesión si aún no está iniciada
error_reporting(0);
$varsesion = $_SESSION['activo'];
if ($varsesion == null || $varsesion == '') {

    echo 'ACCESO DENEGADO';
    session_destroy();
    header("Location:Index.php");
    die();
}

?>


<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusComp - Selector de Asientos</title>
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
            align-items: center;
            padding-top: 5%;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 70%;
            margin: 0 auto;
        }

        .title {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 20px;
            text-align: center;
        }

        .bus-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .seat {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin: 0 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .driver-seat {
            width: 60px;
            height: 60px;
            background-color: #3498db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #2980b9;
            border-radius: 50%;
            margin-right: 20px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .door {
            width: 10px;
            height: 30px;
            background-color: #2980b9;
            margin: 0 5px;
        }

        .selected {
            background-color: #3498db !important;
            color: white !important;
        }

        #admin {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #admin:hover {
            background-color: #2980b9;
        }

        .seat.ocupado {
            background-color: red !important;
            color: white !important;
            cursor: not-allowed !important;
        }

        .occupied {
            background-color: red !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="content">
        <h1 class="title">BusComp - Selector de Asientos</h1>
        <form id="reservationForm" action="TICKET.php" method="get">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
            <br>
            <br>
            <br>
            <button id="confirmButton" class="button" onclick="confirmarAsientos()" type="submit">Confirmar
                Asientos</button>




        </form>
            
            

        <?php

        $host = "localhost"; // Host de la base de datos (puede variar)
        $usuario = "root"; // Nombre de usuario de la base de datos
        $contrasena = ""; // Contraseña de la base de datos
        $base_de_datos = "buscomp"; // Nombre de la base de datos
        
        // Crear la conexión a la base de datos
        $conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

        // Verificar si la conexión fue exitosa
        if (!$conexion) {
            die("La conexión a la base de datos falló: " . mysqli_connect_error());
        }




        // Verifica si se ha pasado el parámetro id_ruta en la URL
        if (isset($_GET['id_ruta'])) {
            $id_ruta = $_GET['id_ruta'];
            echo "<p>RUTA SELECCIONADA: $id_ruta</p>";

            // Consulta para obtener los estados de los asientos en la ruta seleccionada
            $query = "SELECT id_asiento, estado FROM asientos WHERE id_ruta = $id_ruta";
            $result = mysqli_query($conexion, $query);

            if ($result) {
                // Crear un array para almacenar los estados de los asientos
                $asientosOcupados = array();

                // Almacenar los estados en el array
                while ($row = mysqli_fetch_assoc($result)) {
                    $asientosOcupados[$row['id_asiento']] = $row['estado'];
                }

                // Finaliza la consulta
                mysqli_free_result($result);
            } else {
                echo "<p>Error al consultar la base de datos: " . mysqli_error($conexion) . "</p>";
            }
        } else {
            echo "<p>No se ha seleccionado una ruta.</p>";
        }
        ?>

        <div class="bus-container">
            <div class="seat-row">
                <div class="door"></div>
                <div class="seat" data-asiento="1">1</div>
                <div class="seat" data-asiento="2">2</div>
                <div class="seat" data-asiento="3">3</div>
                <div class="seat" data-asiento="4">4</div>

                <div class="door"></div>
            </div>
            <div class="seat-row">
                <div class="door"></div>
                <div class="seat" data-asiento="5">5</div>
                <div class="seat" data-asiento="6">6</div>
                <div class="seat" data-asiento="7">7</div>
                <div class="seat" data-asiento="8">8</div>

                <div class="door"></div>
            </div>
            <div class="seat-row">
                <div class="door"></div>
                <div class="seat" data-asiento="9">9</div>
                <div class="seat" data-asiento="10">10</div>
                <div class="seat" data-asiento="11">11</div>
                <div class="seat" data-asiento="12">12</div>

                <div class="door"></div>
            </div>
            <div class="seat-row">
                <div class="door"></div>
                <div class="seat" data-asiento="13">13</div>
                <div class="seat" data-asiento="14">14</div>
                <div class="seat" data-asiento="15">15</div>
                <div class="seat" data-asiento="16">16</div>

                <div class="door"></div>
            </div>
            <div class="seat-row">
                <div class="door"></div>
                <div class="seat" data-asiento="17">17</div>
                <div class="seat" data-asiento="18">18</div>
                <div class="seat" data-asiento="19">19</div>
                <div class="seat" data-asiento="20">20</div>

                <div class="door"></div>
            </div>
            <div class="seat-row">
                <div class="door"></div>
                <div class="seat" data-asiento="21">21</div>
                <div class="seat" data-asiento="22">22</div>
                <div class="seat" data-asiento="23">23</div>
                <div class="seat" data-asiento="24">24</div>

                <div class="door"></div>
            </div>
        </div>
        <br>
        <br>



    </div>

    <center><button onclick="sesionEnd()">Salir</button></center>
    <script>
        const seats = document.querySelectorAll('.seat');
const asientosOcupados = <?php echo json_encode($asientosOcupados); ?>;
let asientoSeleccionado = null;

seats.forEach(seat => {
    const dataAsiento = seat.getAttribute('data-asiento');
    if (asientosOcupados[dataAsiento] === '1') {
        seat.classList.add('ocupado');
        seat.classList.remove('selected');
        seat.setAttribute('disabled', 'true');
    } else {
        seat.addEventListener('click', () => {
            if (asientosOcupados[dataAsiento] === '0') {
                if (asientoSeleccionado !== null) {
                    // Si ya hay un asiento seleccionado, deselecciónalo
                    const selectedSeat = document.querySelector(`[data-asiento="${asientoSeleccionado}"]`);
                    selectedSeat.classList.remove('selected');
                }
                seat.classList.add('selected');
                asientoSeleccionado = dataAsiento; // Actualiza el asiento seleccionado
            }
        });
    }
});

function confirmarAsientos() {
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;

    if (asientoSeleccionado === null) {
        alert("Por favor, seleccione un asiento.");
        return;
    }

    const idRuta = <?php echo $id_ruta; ?>;
    const data = {
        idRuta: idRuta,
        asientos: [asientoSeleccionado], // Solo envía el asiento seleccionado
        nombre: nombre,
        correo: correo
    };

    fetch('./php/registrar_asientos_be.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Asiento registrado con éxito.");
                window.location.href = "TICKET.php?nombre=" + encodeURIComponent(nombre) + "&correo=" + encodeURIComponent(correo);
            } else {
                alert("Error al registrar el asiento.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Hubo un error en la solicitud.");
        });
}

    function sesionEnd(){
        window.location.href='./php/terminarSesion_be.php';
    }
    </script>
</body>

</html>