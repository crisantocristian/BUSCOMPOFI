<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    $idRuta = $data->idRuta;
    $asientos = $data->asientos;

    // Establecer la conexión a la base de datos (ajusta los detalles de conexión)
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "buscomp";
    $conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

    // Verificar si la conexión fue exitosa
    if (!$conexion) {
        $response = ['success' => false, 'message' => 'Error en la conexión a la base de datos'];
        echo json_encode($response);
        exit;
    }

    // Insertar los asientos seleccionados en la tabla de asientos con el estado 1
    foreach ($asientos as $asiento) {
        $query = "UPDATE asientos SET estado = 1 WHERE id_ruta = $idRuta AND id_asiento = $asiento";
        $result = mysqli_query($conexion, $query);

        if (!$result) {
            $response = ['success' => false, 'message' => 'Error al registrar los asientos'];
            echo json_encode($response);
            exit;
        }
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    $response = ['success' => true, 'message' => 'Asientos registrados con éxito'];
    echo json_encode($response);
} else {
    // Manejar una solicitud incorrecta
    http_response_code(400);
    $response = ['success' => false, 'message' => 'Solicitud incorrecta'];
    echo json_encode($response);
}
?>

