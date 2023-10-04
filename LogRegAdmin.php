
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusComp</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('./Autobus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            padding-left: 5%;
            width: 50%;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0);
            padding: 20px;
            border-radius: 5px;


        }

        .title {
            font-size: 4rem;
            color: black;
            margin-bottom: 20px;
        }

        .button {
            background-color: white;
            color: black;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0;
            text-align: center;
            width: auto;
            display: block;


        }

        #iniciarSesion,
        #registrarse {
            width: 100%;
            height: 100px;

        }

        #iniciarSesion:hover,
        #registrarse:hover {
            background-color: rgba(20, 20, 128, .5);
            border: 2px solid blue;
            color: white;

        }

        #salir:hover {
            background-color: rgba(128, 20, 20, .8);
            border: 2px solid red;
            color: white;
        }

        @media (max-width: 768px) {
            body {
                width: 100%;
            }

            .content {
                padding: 10px;
            }

            .title {
                font-size: 3rem;
            }

            .button {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div>
        <h1 class="title">BUSCOMP</h1>
        <br>
        <div class="content">
            <button class="button" id="iniciarSesion">Iniciar Sesión</button>
            <button class="button" id="salir" onclick="salir()">Salir</button>
        </div>
    </div>

















    <script>
        function salir() {
            window.location.href = 'Index.php';
        }


        var botonIniciarSesion = document.getElementById('iniciarSesion');

        botonIniciarSesion.addEventListener('click', function () {
            window.location.href = './Login.php';
        });
    </script>
</body>

</html>