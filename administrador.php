<?php
class Administrador
{
    private $nombre;
    private $apellidos;
    private $correo;
    private $password;

    public function __construct()
    {
        // Constructor vacío
    }

    public function registro($nombre, $apellidos, $correo, $password)
    {
        // Función para validar nombre y apellidos
        function validarNombreApellido($cadena)
        {
            //Se supone que esto verifica que la cadena que se le pasa tenga solo ese patron o esos caracteres
            //Pero aun asi ya lo hace el html
            return preg_match('/^[a-zA-Z\s]+$/', $cadena);
        }

        // Se llama para validar (se puede eliminar)
        //Aqui el nombre
        if (!validarNombreApellido($nombre)) {
            echo '
                <script>
                    alert("El nombre solo puede contener letras y espacios");
                    window.location="../Registro.php";
                </script>
            ';
            exit; // Detiene la ejecución si la validación falla
        }
        // Se llama para validar (se puede eliminar)
        //Aqui el apellido
        if (!validarNombreApellido($apellidos)) {
            echo '
                <script>
                    alert("El apellido solo puede contener letras y espacios");
                    window.location="../Registro.php";
                </script>
            ';
            exit; // Detiene la ejecución si la validación falla
        }

        include 'conexion_be.php'; // Import para la conexion a la BD

        // Verificar si el correo ya existe en la base de datos
        $verificar_query = "SELECT COUNT(*) as count FROM administrador WHERE correo_administrador = '$correo'";
        $verificar_resultado = mysqli_query($conexion, $verificar_query);

        if ($verificar_resultado) {
            $fila = mysqli_fetch_assoc($verificar_resultado);
            $count = $fila['count'];

            if ($count == 0) {
                $insert_query = "CALL InsertarAdministrador('$nombre', '$correo', '$password')"; //Funcion creada por el diseñador (Aldo)
                $ejecutar = mysqli_query($conexion, $insert_query);

                echo '
                    <script>
                        alert("Registro con éxito");
                        window.location="../MenuAdmin.php";
                    </script>
                ';
                if ($ejecutar) { //Si da error la conexion o no se hizo bien el query
                    echo '
                        <script>
                            alert("Error en el registro, valide sus datos");
                            window.location="../Registro.php";
                        </script>
                    ';
                } else { //Posible error
                    echo '
                        <script>
                            alert("Error en el registro, valide sus datos.");
                            window.location="../Registro.php";
                        </script>
                    ';
                }
            } else { //Si ya hay un correo registrado
                echo '
                    <script>
                        alert("El correo ya está registrado");
                        window.location="../Registro.php";
                    </script>
                ';
            }
        } else {
            echo '
                <script>
                    alert("Error en el registro, valide sus datos");
                    window.location="../Registro.php";
                </script>
            ';
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    }
    public function inicioSesion($correo, $password)
    {
        include 'conexion_be.php';

        $logeo_query = "CALL logeo('$correo', '$password')"; //Funcion logeo creada por el diseñador
        $logeo_resultado = mysqli_query($conexion, $logeo_query);

        if ($logeo_resultado) {
            $fila = mysqli_fetch_assoc($logeo_resultado);
            $resultado = $fila['resultado'];

            if ($resultado == 1) {
                session_start(); // Inicia la sesión, como se requeria usando SESSION_START()
                $_SESSION['correo'] = $correo;
                // Inicio de sesión exitoso, redirige al menu del admin
                header('Location: ../MenuAdmin.php');
                exit();
            } else {
                // Inicio de sesión fallido, muestra un mensaje de error y redirige a la interfaz de inicio de sesión
                echo '
                    <script>
                        alert("Credenciales incorrectas");
                        window.location="../Login.php";
                    </script>
                ';
            }
        } else {
            // Error en la consulta, muestra un mensaje de error y redirige a la interfaz de inicio de sesión
            echo '
                <script>
                    alert("Error en el inicio de sesión, por favor intente nuevamente");
                    window.location="../LogRegAdmin.php";
                </script>
            ';
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    }
}
?>