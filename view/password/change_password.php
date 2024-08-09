<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <link rel="icon" href="./img/logosinfondo.png">
    <link rel="stylesheet" href="../css/recoveryStyles.css">

</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="card-body text-center">
                        <h1 class="mb-4 text-primary">Recuperar la Contraseña</h1>
                        <h3 class="mb-4 text-secondary">
                            Ingresa tu
                            <?php
                            if (isset($_GET['step'])) {
                                echo 'nueva contraseña';
                            } else {
                                echo 'correo electrónico';
                            }
                            ?>
                        </h3>
                        <form
                            action="<?php echo !isset($_GET['step']) ? '../../controller/controller_change_password.php' : '../../controller/updatePassword.php' ?>"
                            method="post">
                            <div class="mb-3">
                                <input type="<?php echo isset($_GET['step']) ? 'password' : 'email'; ?>"
                                    name="<?php echo isset($_GET['step']) ? 'newPassword' : 'email'; ?>"
                                    class="form-control form-control-lg"
                                    placeholder="<?php echo isset($_GET['step']) ? 'Nueva Contraseña' : 'Correo Electrónico'; ?>">
                            </div>

                            <?php
                            if (isset($_GET['step'])) {
                                $id = filter_var($_GET['usuiden'], FILTER_VALIDATE_INT);
                                if ($id !== false) {
                                    echo "<input type='hidden' name='usu' value='" . $id . "'>";
                                } else {
                                    // Manejar el error si el ID no es válido
                                }
                            }
                            ?>

                            <button type="submit" class="btn btn-primary btn-gradient w-100 mb-3">Cambiar</button>
                        </form>
                        <a href="../inicioSesion.php" class="btn btn-secondary w-100">Volver al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>