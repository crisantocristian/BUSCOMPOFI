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
    <title>Lista de Rutas - BusComp</title>
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
            margin-right: 15%;  
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            margin: 0 auto;
            align-items: center;
        }

        .title {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: rgba(204, 168, 221, 0.9);
        }

        td {
            background-color: rgba(255, 255, 255, 0.8);
        }

        #titulo {
            margin-left: 40%;
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
    </style>
</head>

<body>
    <div id="titulo">
        <h1 class="title">BUSCOMP</h1>
        <h3>ADMIN</h3>
    </div>
    <div class="container">

        <table>
            <thead>
                <tr>
                    <th>ID Ruta</th>
                    <th>Nombre Ruta</th>
                    <th>Nombre Conductor</th>
                    <th>Nombre Unidad</th>
                    <th>Hora de Salida</th>
                    <th>Hora de Llegada</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'php/verRutas_be.php';
                while ($fila = mysqli_fetch_assoc($resultados)) {
                    echo "<tr>";
                    echo "<td>{$fila['id_ruta']}</td>";
                    echo "<td>{$fila['nombre_ruta']}</td>";
                    echo "<td>{$fila['nombre_conductor']}</td>";
                    echo "<td>{$fila['nombre_unidad']}</td>";
                    echo "<td>{$fila['horario_salida']}</td>";
                    echo "<td>{$fila['horario_llegada']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div id="divSalir">
            <button id="btnSalir" onclick="salir()">Salir</button>
        </div>
    </div>
    <script>
        function salir() {
            window.location.href = 'MenuAdmin.php';
        }
    </script>
</body>

</html>