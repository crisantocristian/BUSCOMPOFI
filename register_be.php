<?php
//Importaciones de: Conexion y clase administrador
include ('administrador.php');
include 'conexion_be.php';

//Instancia
$admin = new Administrador();
//Uso de la instancia para el metodo registro
$admin->registro($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['password']);//Datos directos por post

?>
