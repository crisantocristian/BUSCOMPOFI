<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
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



        .login-form {
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

        .login-form label {
            flex-basis: 40%;
            text-align: right;
            margin-right: 30px;
            color: white;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .login-form input {
            flex-basis: 55%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 2px solid black;
        }

        .login-form button {
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

        h1 {
            color: black;
            margin-bottom: 80px;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            letter-spacing: 2px;
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
    <form action="php/login_be.php" method="POST" class="formulario">
        <center>
            <h1>Inicio de Sesión</h1>
        </center>
        <div class="login-form">
            <div class="input-group">
                <label for="email">Correo:</label>
                <input type="email" id="email" name="correo" required>
            </div>

            <div class="input-group">
                <label for="password" name>Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button>Ingresar</button>
        </div>

    </form>
    <div id="divSalir">
        <button id="btnSalir" onclick="salir()">Cancelar</button>
    </div>
    <script>
        function salir() {
            window.location.href = 'LogRegAdmin.php';
        }
        /////////////////////////////////////////
        /////////                       /////////
        /////////     CODIGO BASURA     /////////
        /////////                       /////////
        /////////////////////////////////////////
        class Administrador {//Intento de clases en JS convinado con PHP
            constructor(correo, password) {
                this.correo = correo;
                this.password = password;
            }

            inicioSesion() {
                // Realizar una solicitud AJAX para enviar los datos al servidor PHP
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'php/login_be.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Obtener los datos del formulario HTML
                const correo = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                // Construir los datos a enviar
                const data = `correo=${correo}&password=${password}`;

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const respuesta = xhr.responseText;
                        if (respuesta === '1') {
                            // Inicio de sesión exitoso, redirige al panel de administrador
                            window.location.href = 'Index.php';
                        } else {
                            // Inicio de sesión fallido, muestra un mensaje de error
                            alert('Credenciales incorrectas. Por favor, inténtelo de nuevo.');
                        }
                    }
                };

                xhr.send(data);
            }
        }


        function iniciarSesionAdministrador() {
            const admin = new Administrador();
            admin.inicioSesion();
        }



    </script>



</body>

</html>