<?php
//De hecho no se necesita hacer referencia a la conexion porque aqui solo se manda los datos por la funcion xd
include 'Ruta.php';

//Asignacion desde variable
$ruta_id = $_POST['ruta'];

//Instancia
$ruta = new Ruta();
//Uso de metodo eliminarRuta con dato pasado desde variable
$ruta->eliminarRuta($ruta_id);

?>