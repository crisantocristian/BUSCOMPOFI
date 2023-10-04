<?php
//Includes
include 'conexion_be.php';
include 'Ruta.php';

//Varables siendo inicializadas con valores pasados por post
$nombreRuta = $_POST['nombreRuta'];
$nombreConductor = $_POST['nombreConductor'];
$nombreUnidad = $_POST['nombreUnidad'];
$horaSalida = $_POST['horaSalida'];
$horaLlegada = $_POST['horaLlegada'];


//Instancia
$ruta = new Ruta();
//Uso de metodo crearRuta de la instancia xd
$ruta->crearRuta($nombreRuta, $nombreConductor, $nombreUnidad, $horaSalida, $horaLlegada);
?>
