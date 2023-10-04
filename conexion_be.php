<?php
    $conexion = mysqli_connect("localhost", "root", "", "buscomp", 3306); 
    // nameConex = msqli_connect("localhost,"username","password","nombreBD",puerto)

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }//Tipo el trycatch por si no jala la conexion

?>