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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Reserva</title>
    <!-- Agrega aquí la referencia a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Ticket de Reserva</h1>


        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">
                Generando PDF...
            </div>
        </div>

        <?php
        // Recupera los valores de nombre y correo de la URL
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
        $correo = isset($_GET['correo']) ? $_GET['correo'] : '';

        // Verifica si se recibieron los datos y si no están vacíos
        if (!empty($nombre) && !empty($correo)) {
            echo "<div class='alert alert-success'><p>Nombre: $nombre</p>";
            echo "<p>Correo: $correo</p></div>";
            // Aquí puedes agregar más detalles del ticket o información adicional que desees mostrar
        } else {
            echo "<div class='alert alert-danger'><p>No se recibieron los datos de nombre y correo, o están vacíos.</p></div>";
        }
        ?>

        <h2 class="mt-4">Información de Asiento</h2>
        <?php
        // Establece la conexión a la base de datos (cambia estos valores según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "buscomp";

        // Crea una conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para obtener el último asiento modificado
        $sql = "SELECT id_asiento, id_ruta FROM asientos ORDER BY fecha_modificacion DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Obtiene el registro
            $row = $result->fetch_assoc();
            $id_asiento = $row["id_asiento"];
            $id_ruta = $row["id_ruta"];

            // Consulta SQL para obtener información de la tabla ruta
            $sql = "SELECT nombre_ruta, nombre_unidad FROM ruta WHERE id_ruta = $id_ruta";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Obtiene la información de la tabla ruta
                $row = $result->fetch_assoc();
                $nombre_ruta = $row["nombre_ruta"];
                $nombre_unidad = $row["nombre_unidad"];

                // Imprime la información
                echo "<p>ID Asiento: $id_asiento</p>";
                echo "<p>ID Ruta: $id_ruta</p>";
                echo "<p>Nombre Ruta: $nombre_ruta</p>";
                echo "<p>Nombre Unidad: $nombre_unidad</p>";
            } else {
                echo "<div class='alert alert-warning'><p>No se encontraron registros en la tabla ruta.</p></div>";
            }
        } else {
            echo "<div class='alert alert-warning'><p>No se encontraron registros en la tabla asientos.</p></div>";
        }

        // Cierra la conexión
        $conn->close();
        ?>
    </div>
    <center>
            <button onclick="generarPDF()">Generar PDF</button>
            <button onclick="sesionEnd()" type="submit" name="guardar_ticket">Salir</button>
        </center>

    <!-- Agrega aquí la referencia a Bootstrap JS y cualquier otro script que necesites -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function generarPDF() {
                // Oculta el botón de generación de PDF
                document.querySelector('button').style.display = 'none';

                // Muestra la barra de progreso
                var progressBar = document.querySelector('.progress-bar');
                progressBar.style.width = '0%';
                progressBar.textContent = 'Generando PDF...';

                // Simula la generación del PDF durante 5 segundos (puedes ajustar este tiempo)
                var progreso = 0;
                var interval = setInterval(function () {
                    progreso += 5; // Aumenta el progreso en un 5% cada segundo
                    progressBar.style.width = progreso + '%';
                    progressBar.textContent = 'Generando PDF... ' + progreso + '%';
                    if (progreso >= 100) {
                        clearInterval(interval); // Detiene la simulación
                        setTimeout(function () {
                            window.print(); // Abre el diálogo de impresión del navegador
                        }, 1000); // Espera 1 segundo antes de imprimir
                    }
                }, 1000);
            }

            function sesionEnd() {
                window.location.href = './php/terminarSesion_be.php';
            }
    </script>
</body>

</html>