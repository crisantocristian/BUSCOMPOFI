<?php
session_start(); // Inicia la sesión si aún no está iniciada
error_reporting(0);
$varsesion = $_SESSION['activo'];
if ($varsesion == null || $varsesion = '') {
    
    echo 'ACCESO DENEGADO';
    die();
}

session_destroy();
header("Location:../Index.php");
?>