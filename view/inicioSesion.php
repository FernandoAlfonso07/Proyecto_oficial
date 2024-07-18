<?php
$correo = '';
if (isset($_GET['correo'])) {
    $correo = $_GET['correo'];
}
$contraseña = '';
if (isset($_GET['contraseña'])) {
    $contraseña = $_GET['contraseña'];
}

// ------------------------ Intentos ------------------

if (!isset($_SESSION))
    session_start();


if (!isset($_SESSION['intento'])) {

    $_SESSION['intento'] = 0;

} else {


    $_SESSION['intento']++;
    if ($_SESSION['intento'] > 5) {

        session_destroy();
        header('location: ../controller/errors/error1001.php');
    } else {
        '';
    }

}


if (isset($_GET['error'])) {
    // echo 'Detecto la variable';
    ?>

    <script>
        window.onload = function () {
            error();
        };
    </script>

    <?php

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WORLDFIT | HOME </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos_inicio_sesion.css">
    <link rel="icon" href="./img/logosinfondo.png">
</head>

<body>


    <div class="container contenedor_formulario">
        <form action="../controller/redirecionLogin.php">
            <div class="row">
                <div class="col-md-12">
                    <div class="contenedor_bienvenidos">
                        <h2><strong>¡Hola de nuevo!</strong></h2>
                        <h5>
                            <p> INICIA SESIÓN </p>
                        </h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="espacios_formulario">
                        <div class="col-md-12">

                            <div class="input-wrapper">
                                <input type="text" id="correo" name="correo" placeholder=" Correo Electronico">

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="input-wrapper">
                                <input type="Password" id="contraseña" name="password" placeholder="Contraseña">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 contenedor_imagen">
                    <img src="img/LOGO.png" class="img-thumbnail" alt="logo" width="220em">
                </div>

                <div class="col-md-12">

                    <center>

                        <button type="submit" class="btn btn-outline-primary boton_ir">
                            <i class="fa-solid fa-person-walking-arrow-right"></i>
                        </button>

                    </center>
                    <h4 class="texto_extra">
                        <a href="#">Olvide mi contraseña</a> <br> <br>
                        ¿No tienes una cuenta?, <a href="seccion-registro.php">¡Registrate ahora!</a>
                    </h4>
                </div>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="js/event.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>