<?php
if(!empty($_POST["registro"]))
    if (empty($_POST["nombre"]) or empty($_POST["email"]) or empty($_POST["password"])){
        echo 'Uno de los campos esta vacio';
    }

?>