<?php
include 'Ruta.php';


//Ingreso a variables de datos pasados por post (metodo largo, de esta forma se almacena y no se pasa directo con post)
$ruta_id = $_POST['ruta'];
$nuevo_nombre_ruta = $_POST['nombreRuta'];
$nuevo_nombre_conductor = $_POST['nombreConductor'];
$nuevo_nombre_unidad = $_POST['nombreUnidad'];
$nueva_hora_salida = $_POST['horaSalida'];
$nueva_hora_llegada = $_POST['horaLlegada'];
//Instancia
$ruta = new Ruta();
//Uso de metodo (function) con las variables
$ruta->modificarRuta($ruta_id, $nuevo_nombre_ruta, $nuevo_nombre_conductor, $nuevo_nombre_unidad, $nueva_hora_salida, $nueva_hora_llegada);
?>