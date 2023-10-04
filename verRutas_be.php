<?php
include 'conexion_be.php';

// Realizar la consulta SQL para obtener los datos de la tabla "ruta"
$consulta = "SELECT * FROM ruta";
$resultados = mysqli_query($conexion, $consulta);

if (!$resultados) {
    die("Error al consultar la base de datos: " . mysqli_error($conexion));
}
?>