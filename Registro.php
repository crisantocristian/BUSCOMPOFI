<?php
session_start();
$varsesion = $_SESSION['correo'];
if ($varsesion == null || $varsesion == '') {
    session_destroy();
    header("Location:LogRegAdmin.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            margin-right: 5%;
            font-family: 'Arial', sans-serif;
            background-image: url('./Autobus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 5%;

        }

        h1 {
            color: black;
            margin-bottom: 80px;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .registration-form {
            display: flex;
            flex-direction: column;
            gap: 40px;
            width: 500px;

        }

        .input-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .registration-form label {
            flex-basis: 40%;
            text-align: right;
            margin-right: 30px;
            color: white;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .registration-form input {
            flex-basis: 55%;
            /* Ajuste para mantener alineación */
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 2px solid black;
        }

        .registration-form button {
            align-self: center;
            padding: 15px 20px;
            background-color: white;
            color: black;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 1.1rem;

        }

        #divSalir {
            display: flex;
            flex-direction: column;
            gap: 40px;
            width: 500px;
        }

        #btnSalir {
            display: block;
            margin-top: 20px;
            align-self: center;
            padding: 15px 20px;
            background-color: white;
            color: black;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <form action="php/register_be.php" method="POST" class="formulario">
        <center>
            <h1>Registro</h1>
        </center>
        <div class="registration-form">
            <div class="input-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" placeholder="Nombre" name="nombre" pattern="[A-Za-z\s]+" required>
            </div>

            <div class="input-group">
                <label for="surname">Apellidos:</label>
                <input type="text" id="surname" placeholder="Apellidos" name="apellidos" pattern="[A-Za-z\s]+" required
                    >
            </div>

            <div class="input-group">
                <label for="register_email">Correo:</label>
                <input type="email" id="register_email" placeholder="Correo" name="correo" required>
            </div>

            <div class="input-group">
                <label for="register_password">Contraseña:</label>
                <input type="password" id="register_password" placeholder="Contraseña" name="password" required>
            </div>

            <button>Registrarse</button>
        </div>

    </form>
    <div id="divSalir">
        <button id="btnSalir" onclick="salir()">Cancelar</button>
    </div>
    <script>
        function salir() {
            window.location.href = 'MenuAdmin.php';
        }
    </script>
</body>

</html>