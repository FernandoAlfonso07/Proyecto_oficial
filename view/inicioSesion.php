<?php
include_once ("../functions/alerts.php");
if (!isset($_SESSION))
    session_start();

$correo = $_GET['correo'] ?? '';
$contraseña = $_GET['contraseña'] ?? '';

if (!isset($_SESSION['intento'])) {
    $_SESSION['intento'] = 0;

} else {
    $_SESSION['intento']++;
    if ($_SESSION['intento'] > 5) {
        header('location: ../controller/errors/error1001.php');
        exit();
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WORLDFIT | Iniciar Sesion </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos_inicio_sesion.css">
    <link rel="icon" href="./img/logosinfondo.png">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


    <div class="container contenedor_formulario">
        <form action="../controller/redirecionLogin.php" method="POST">
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
                                <input type="email" id="correo" name="correo" placeholder=" Correo Electronico"
                                    required>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="input-wrapper">
                                <input type="Password" id="contraseña" name="password" placeholder="Contraseña"
                                    required>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 contenedor_imagen">
                    <img src="img/LOGO.png" class="img-thumbnail" alt="logo" width="220em">
                </div>

                <div class="col-md-12 mt-4 position-relative">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="g-recaptcha" data-sitekey="6Lc_QR4qAAAAAB9A8NzQmQyEYGYcLstGhwxOnoQA"></div>
                    </div>
                </div>
                <div class="col-md-12 my-5">

                    <center>

                        <button type="submit" class="btn btn-outline-primary boton_ir">
                            <i class="fa-solid fa-person-walking-arrow-right"></i>
                        </button>

                    </center>
                    <h4 class="texto_extra">
                        <a href="password/change_password.php">Olvide mi contraseña</a> <br> <br>
                        ¿No tienes una cuenta?, <a href="seccion-registro.php">¡Registrate ahora!</a>
                    </h4>

                    <?php
                    if (isset($_GET['error'])) {
                        $errorMessages = [
                            'invalidEmail' => "El correo ingresado no es <strong>válido</strong>.",
                            'invalidCredentials' => "Credenciales <strong>Incorrectas</strong>.",
                            'emptyFields' => "Debes completar <strong>todos</strong> los campos."
                        ];

                        $error = $_GET['error'];

                        if (isset($errorMessages[$error])) {
                            echo "<div class='alert alert-danger' role='alert'>
                                    {$errorMessages[$error]}
                                </div>";
                        }
                    }
                    ?>

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