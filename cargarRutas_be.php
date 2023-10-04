<?php
include 'conexion_be.php';

// Realizar una consulta SQL para obtener los nombres de las rutas y su horario de ida y llegada
$consulta = "SELECT id_ruta, nombre_ruta, horario_salida, horario_llegada FROM ruta";
$resultados = mysqli_query($conexion, $consulta);

if (!$resultados) {
    die("Error al consultar la base de datos: " . mysqli_error($conexion));
}

// Crear opciones para el combobox (option)
$options = "";
while ($fila = mysqli_fetch_assoc($resultados)) {
    $ruta_id = $fila['id_ruta'];
    $nombre_ruta = $fila['nombre_ruta'];
    $horario_salida = $fila['horario_salida'];
    $horario_llegada = $fila['horario_llegada'];
    $options .= "<option value='$ruta_id'>$nombre_ruta - Salida: $horario_salida - Llegada: $horario_llegada</option>";
}

// Enviar las opciones como respuesta al html
echo $options;

// Cerrar la conexión
mysqli_close($conexion);
?>
