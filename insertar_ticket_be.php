<?php
if (isset($_POST['guardar_ticket'])) {
    // Verifica que los datos estén disponibles
    if (!empty($nombre) && !empty($correo) && !empty($nombre_unidad)) {
        // Establece la conexión a la base de datos (cambia estos valores según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tu_base_de_datos";

        // Crea una conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Prepara la consulta SQL para insertar los datos en la tabla ticket
        $sql = "INSERT INTO ticket (nombre_unidad, correo, nombre_usuario) VALUES ('$nombre_unidad', '$correo', '$nombre')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'><p>Los datos se han insertado correctamente en la tabla ticket.</p></div>";
        } else {
            echo "<div class='alert alert-danger'><p>Error al insertar datos en la tabla ticket: " . $conn->error . "</p></div>";
        }

        // Cierra la conexión
        $conn->close();
    } else {
        echo "<div class='alert alert-danger'><p>No se pueden insertar datos vacíos en la tabla ticket.</p></div>";
    }
}
?>