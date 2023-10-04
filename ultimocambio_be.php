<?php
$sql = "SELECT r.id_ruta, r.nombre_ruta, r.nombre_unidad, a.id_asiento
        FROM ruta r
        INNER JOIN asientos a ON r.id_ruta = a.id_ruta
        WHERE a.estado = 'cambio' -- Reemplaza 'cambio' con el valor que estás buscando
        ORDER BY r.id_ruta DESC";
$result = $conexion->query($sql);
?>

