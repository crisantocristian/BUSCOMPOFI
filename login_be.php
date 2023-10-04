<?php
//Importaciones de: Conexion y clase administrador
include ('administrador.php');
include 'conexion_be.php';

//Instancia
$admin = new Administrador();
//Uso del metodo (function) inicioSesion, pasando directamente los datos desde que se pasan por post
$admin->inicioSesion($_POST['correo'], $_POST['password']);
?>
