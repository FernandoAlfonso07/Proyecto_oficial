<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./IMG_index/logosinfondo.png">
    <link rel="stylesheet" href="css/estilos-registro.css">


</head>

<body>

    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-6 left-side d-flex flex-column justify-content-center align-items-center">
                <img src="IMG_index/LOGO.png" class="img-fluid" width="160px" alt="">
                <h2>
                    <b>
                        WORLDFIT
                    </b>
                </h2>
            </div>
            <div class="col-md-6 right-side d-flex justify-content-center align-items-center">
                <div class="form-container">
                    <h2 class="text-light texto_registro"> <span
                            class="text-primary"><strong>¡REGÍSTRATE!</strong></span></h2>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Correo electronico" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Peso Actual en kg" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Altura Actual - ej. 170" required>
                        </div>
                        <div class="form-group">
                            <label for="inputGroupSelect01" class="form-label">
                                <h2>Género</h2>
                            </label>
                            <select class="form-select custom-select" id="inputGroupSelect01" required>
                                <option value="" disabled selected>Selecciona tu género</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                        </div>


                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="termsCheck" required>
                            <label class="form-check-label text-muted" for="termsCheck">
                                Politicas y privacidad <a href="#" class="text-primary">Terminos </a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                    </form>
                    <p class="text-muted mt-3">Si tienes una cuenta, <a href="inicioSesion.php"
                            class="text-primary">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>