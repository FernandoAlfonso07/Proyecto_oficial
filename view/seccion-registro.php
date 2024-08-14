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
    <link rel="stylesheet" href="css/errors/errorValidations.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <form action="../controller/registrado.php" method="POST" id="registrationForm">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres"
                                required>
                            <span id="nombres-error-message" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                placeholder="Apellidos" required>
                            <span id="apellidos-error-message" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="telefono" class="form-control" name="telefono" placeholder="Teléfono"
                                required>
                            <span id="telefono-error-message" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" name="correo"
                                placeholder="Correo electrónico" required>
                            <span id="email-error-message" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="Contraseña" minlength="8" required>
                            <span id="password-error-message" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" id="peso" class="form-control" name="pesoA"
                                placeholder="Peso Actual en kg" min="1" step="0.1" required>
                            <span id="peso-error-message" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" id="height" class="form-control" name="alturaA"
                                placeholder="Altura Actual - ej. 1.70" required>
                            <span id="height-error-message" class="error-message"></span>
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
                        <button type="submit" id="buttonValidate" class="btn btn-primary btn-block">Registrar</button>
                    </form>
                    <p class="text-muted mt-3">Si tienes una cuenta, <a href="inicioSesion.php"
                            class="text-primary">Inicia sesión</a></p>

                    <!-- Mensajes de error generales -->
                    <div id="error-messages" class="error-message"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/validateData.js"></script>
</body>

</html>