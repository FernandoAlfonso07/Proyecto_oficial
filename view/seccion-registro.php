<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WorldFit | Sección de Registro</title>
    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./img/logosinfondo.png">
    <link rel="stylesheet" href="css/estilos-registro.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">

            <!-- Columna izquierda -->
            <div class="col-md-6 left-side d-flex flex-column justify-content-center align-items-center">
                <img src="img/LOGO.png" class="img-fluid" width="160px" alt="Logo WorldFit">
                <h2><b>WORLDFIT</b></h2>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6 right-side d-flex justify-content-center align-items-center">
                <div class="form-container">
                    <h2 class="text-light texto_registro">
                        <span class="text-primary"><strong>¡REGÍSTRATE!</strong></span>
                    </h2>
                    <form action="../controller/registrado.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombres" placeholder="Nombres">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="correo" placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pesoA" placeholder="Peso Actual en kg">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="alturaA"
                                placeholder="Altura Actual - ej. 1.70">
                        </div>
                        <div class="form-group">
                            <label for="inputGroupSelect01" class="form-label">
                                <h2>Género</h2>
                            </label>
                            <select class="form-select custom-select" name="genero" id="inputGroupSelect01" required>
                                <option value="" disabled selected>Selecciona tu género</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="termsCheck" required>
                            <label class="form-check-label text-muted" for="termsCheck">
                                Políticas y privacidad <a href="TerminosCondiciones.php"
                                    class="text-primary">Términos</a>
                            </label>
                        </div>
                        <div class="my-4">
                            <div class="g-recaptcha" data-sitekey="6Lc_QR4qAAAAAB9A8NzQmQyEYGYcLstGhwxOnoQA"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                    </form>
                    <p class="text-muted mt-3">Si tienes una cuenta, <a href="inicioSesion.php"
                            class="text-primary">Inicia sesión</a></p>

                    <?php
                    if (isset($_GET['error'])) {
                        $errorMessages = [
                            'invalidEmail' => "El correo ingresado no es <strong>válido</strong>.",
                            'invalidPhone' => "El <strong>telefono</strong> ingresado no es <strong>válido</strong>.",
                            'notNumberP' => "Ingresa datos validos para tu <strong>Peso</strong>.",
                            'notNumberA' => "Ingresa datos validos para tu <strong>Altura</strong>.",
                            'emptyFields' => "Debes completar todos los <strong>campos</strong>.",
                            'invalidPassword' => "La contraseña es muy <strong>Corta</strong> debe de ser de mas 8 caracteres."
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
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/event.js"></script>
</body>

</html>