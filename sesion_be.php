<?
session_start(); // Inicia la sesión, como se requeria usando SESSION_START()
$_SESSION['activo'] = 'activo';
header("Location:../Escogerasiento.php");
?>