<?php
class Ruta
{
    private $nombreRuta;
    private $nombreConductor;
    private $nombreUnidad;
    private $horaSalida;
    private $horaLlegada;

    public function __construct()
    {
        // Constructor vacío
    }

    public function crearRuta($nombreRuta, $nombreConductor, $nombreUnidad, $horaSalida, $horaLlegada)
    {
        include 'conexion_be.php';

        //Lo mismo que en administrador, comprueba que no haya numeros o simbolos, pero pues ya se puso desde html
        //(Se puede eliminar)
        function validarCadena($cadena)
        {
            return preg_match('/^[a-zA-Z\s]+$/', $cadena);
        }

        if (!validarCadena($nombreConductor)) {
            echo '
                    <script>
                        alert("El nombre del conductor solo puede contener letras y espacios");
                        window.location="../crearRuta.php";
                    </script>
                ';
            exit; // Detiene la ejecución si la validación falla
        }

        // Verificar si el conductor está en un viaje 
        $verificarConductorQuery = "SELECT id_ruta FROM ruta WHERE nombre_conductor = '$nombreConductor' AND 
                                ('$horaSalida' BETWEEN horario_salida AND horario_llegada 
                                OR '$horaLlegada' BETWEEN horario_salida AND horario_llegada)";

        $resultadoConductor = mysqli_query($conexion, $verificarConductorQuery);

        // Verificar si la unidad está en un viaje
        $verificarUnidadQuery = "SELECT id_ruta FROM ruta WHERE nombre_unidad = '$nombreUnidad' AND 
                             ('$horaSalida' BETWEEN horario_salida AND horario_llegada 
                             OR '$horaLlegada' BETWEEN horario_salida AND horario_llegada)";

        $resultadoUnidad = mysqli_query($conexion, $verificarUnidadQuery);

        // Verificar que el conductor no tenga una ruta ya asignada, durante el tiempo de la nueva ruta a crear
        $nuevaVerif = "SELECT id_ruta FROM ruta WHERE nombre_conductor = '$nombreConductor' AND 
                                (horario_salida BETWEEN '$horaSalida' AND '$horaLlegada' 
                                OR horario_llegada BETWEEN '$horaSalida' AND '$horaLlegada' )";

        $nuevoresultverif = mysqli_query($conexion, $nuevaVerif);
        // Verificar que la unidad no tenga una ruta ya asignada, durante el tiempo de la nueva ruta a crear
        $nuevaVerif2 = "SELECT id_ruta FROM ruta WHERE nombre_unidad = '$nombreUnidad' AND 
                                (horario_salida BETWEEN '$horaSalida' AND '$horaLlegada' 
                                OR horario_llegada BETWEEN '$horaSalida' AND '$horaLlegada' )";

        $nuevoresultverif2 = mysqli_query($conexion, $nuevaVerif2);
        //Estos 4 if's son en caso de que algun elemento de la ruta tenga otra ruta y haya una interferencia
        if (mysqli_num_rows($nuevoresultverif2) > 0) {
            echo '
                    <script>
                    alert("La unidad tendrá un viaje durante ese horario");
                        window.location="../crearRuta.php";
                    </script>
                ';
        } elseif (mysqli_num_rows($nuevoresultverif) > 0) {
            echo '
                    <script>
                    alert("El conductor tendrá un viaje durante ese horario");
                        window.location="../crearRuta.php";
                    </script>
                ';
        } elseif (mysqli_num_rows($resultadoConductor) > 0) {
            echo '
                    <script>
                        alert("El conductor se encuentra en un viaje durante ese horario");
                        window.location="../crearRuta.php";
                    </script>
                ';
        } elseif (mysqli_num_rows($resultadoUnidad) > 0) {
            echo '
                    <script>
                        alert("La unidad se encuentra en un viaje durante ese horario");
                        window.location="../crearRuta.php";
                    </script>
                ';
        } else {
            // Llamada al procedimiento almacenado InsertarRuta creado por el diseñador
            $insertarRutaQuery = "CALL InsertarRuta('$nombreRuta', '$nombreConductor', '$nombreUnidad', '$horaSalida', '$horaLlegada')";

            $resultado = mysqli_query($conexion, $insertarRutaQuery);

            if ($resultado) {//Jalo al 1000%
                echo '
                    <script>
                        alert("Ruta creada exitosamente");
                        window.location="../MenuAdmin.php";
                    </script>
                ';
            } else {//Pues no jalo (es culpa del diseñador {Broma})
                echo '
                    <script>
                        alert("Error al crear la ruta, por favor intente nuevamente");
                        window.location="../crearRuta.php";
                    </script>
                ';
            }
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    }
    public function modificarRuta($ruta_id, $nuevo_nombre_ruta, $nuevo_nombre_conductor, $nuevo_nombre_unidad, $nueva_hora_salida, $nueva_hora_llegada)
    {
        include 'conexion_be.php';

        // Verificar si el conductor está en un viaje
        $verificarConductorQuery = "SELECT id_ruta FROM ruta WHERE nombre_conductor = '$nuevo_nombre_conductor' AND 
        ('$nueva_hora_salida' BETWEEN horario_salida AND horario_llegada 
        OR '$nueva_hora_llegada' BETWEEN horario_salida AND horario_llegada)";

        $resultadoConductor = mysqli_query($conexion, $verificarConductorQuery);

        // Verificar si la unidad está en un viaje
        $verificarUnidadQuery = "SELECT id_ruta FROM ruta WHERE nombre_unidad = '$nuevo_nombre_unidad' AND 
        ('$nueva_hora_salida' BETWEEN horario_salida AND horario_llegada 
        OR '$nueva_hora_llegada' BETWEEN horario_salida AND horario_llegada)";

        $resultadoUnidad = mysqli_query($conexion, $verificarUnidadQuery);

        // Verificar que el conductor no tenga una ruta ya asignada, durante el tiempo de la nueva ruta a crear
        $nuevaVerif = "SELECT id_ruta FROM ruta WHERE nombre_conductor = '$nuevo_nombre_conductor' AND 
        (horario_salida BETWEEN '$nueva_hora_salida' AND '$nueva_hora_llegada' 
        OR horario_llegada BETWEEN '$nueva_hora_salida' AND '$nueva_hora_llegada' )";

        $nuevoresultverif = mysqli_query($conexion, $nuevaVerif);

        // Verificar que la unidad no tenga una ruta ya asignada, durante el tiempo de la nueva ruta a crear
        $nuevaVerif2 = "SELECT id_ruta FROM ruta WHERE nombre_unidad = '$nuevo_nombre_unidad' AND 
        (horario_salida BETWEEN '$nueva_hora_salida' AND '$nueva_hora_llegada' 
        OR horario_llegada BETWEEN '$nueva_hora_salida' AND '$nueva_hora_llegada' )";

        $nuevoresultverif2 = mysqli_query($conexion, $nuevaVerif2);
        //Estos 4 if's son en caso de que algun elemento de la ruta tenga otra ruta y haya una interferencia
        if (mysqli_num_rows($nuevoresultverif2) > 0) {
            echo '
                <script>
                    alert("La unidad tendrá un viaje durante ese horario");
                    window.location="../ModificarRuta.php";
                </script>
            ';
        } elseif (mysqli_num_rows($nuevoresultverif) > 0) {
            echo '
                <script>
                    alert("El conductor tendrá un viaje durante ese horario");
                    window.location="../ModificarRuta.php";
                </script>
            ';
        } elseif (mysqli_num_rows($resultadoConductor) > 0) {
            echo '
                <script>
                    alert("El conductor se encuentra en un viaje durante ese horario");
                    window.location="../ModificarRuta.php";
                </script>
            ';
        } elseif (mysqli_num_rows($resultadoUnidad) > 0) {
            echo '
                <script>
                    alert("La unidad se encuentra en un viaje durante ese horario");
                    window.location="../ModificarRuta.php";
                </script>
            ';
        } else {
            // Ejecutar la consulta SQL  de update para actualizar los datos de la ruta
            $actualizar_query = "UPDATE ruta 
                                 SET nombre_ruta = '$nuevo_nombre_ruta',
                                     nombre_conductor = '$nuevo_nombre_conductor',
                                     nombre_unidad = '$nuevo_nombre_unidad',
                                     horario_salida = '$nueva_hora_salida',
                                     horario_llegada = '$nueva_hora_llegada'
                                 WHERE id_ruta = $ruta_id";

            if (mysqli_query($conexion, $actualizar_query)) {//Update good
                echo '
                    <script>
                        alert("Ruta modificada exitosamente");
                        window.location="../MenuAdmin.php";
                    </script>
                ';
            } else {//Update no good
                echo "Error al modificar la ruta: " . mysqli_error($conexion);
            }
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    }
    public function eliminarRuta($ruta_id)
    {
        include 'conexion_be.php';

        mysqli_autocommit($conexion, false);

        // Aqui se eliminan los asientos que se generaron en la tabla asientos al crear la ruta xd
        $eliminar_asientos_query = "DELETE FROM asientos WHERE id_ruta = $ruta_id";

        // Query para eliminar el registro de la ruta seleccionada en el html
        $eliminar_ruta_query = "DELETE FROM ruta WHERE id_ruta = $ruta_id";

        if (mysqli_query($conexion, $eliminar_asientos_query) && mysqli_query($conexion, $eliminar_ruta_query)) {
            mysqli_commit($conexion);
            //Jalo al 1000%
            echo '
                <script>
                    alert("Ruta eliminada");
                    window.location="../MenuAdmin.php";
                </script>
            ';
        } else {
            mysqli_rollback($conexion); // Rollback en caso de que algo salga mal

            echo "Error al eliminar la ruta: " . mysqli_error($conexion);
        }

        mysqli_autocommit($conexion, true);

        // Cerrar la conexión
        mysqli_close($conexion);
    }
}
?>