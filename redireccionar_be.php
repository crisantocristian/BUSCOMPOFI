<?php
// Verifica si se ha seleccionado una ruta válida
if (isset($_POST['selectedRoute'])) {
    $selectedRoute = $_POST['selectedRoute'];
    session_start(); // Inicia la sesión, como se requeria usando SESSION_START()
    $_SESSION['activo'] = 'activo';
    // Redirige a la página EscogerAsiento.php con el valor de id_ruta como parámetro
    header("Location: ../EscogerAsiento.php?id_ruta=$selectedRoute");
    exit();
} else {
    // Si no se ha seleccionado una ruta válida, puedes manejar el error o redirigir a otra página de error.
    header("Location: error.php");
    exit();
}
?>