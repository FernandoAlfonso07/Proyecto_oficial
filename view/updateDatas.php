<?php
include_once ('../functions/alerts.php');
if (isset($_GET['error'])) {
    $errorMessages = [
        'emptyFields' => 'Datos Actualizados',
        'incorrectFormat' => 'Formato incorrecto',
        'notNumber' => 'Los campos deben ser tipo número',
        'invalidPhone' => 'Número de teléfono inválido',
        'invalidEmail' => 'El correo ingresado no es válido'
    ];

    $error = $_GET['error'];
    if (isset($errorMessages[$error])) {
        echo Alerts::error(1, $errorMessages[$error], 'updateDatas');
    }
}
?>

<link rel="stylesheet" href="css/actualizarDatos.css">

<main>
    <form action="../controller/actualizarDataUser.php?type=user" method="POST" enctype="multipart/form-data">
        <div class="container cuerpo">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="<?php echo usuarios::getPerfil(9, $_SESSION['id']) ?>" class="img-fluid imagen_perfil"
                        width="50%" alt="Imagen Perfil">
                    <div class="input-group mb-3 subir">
                        <input type="file" class="form-control" name="imagenPerfil" id="inputGroupFile04"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>
                                Mi Perfil
                            </h1>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label>Nombres: </Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="name" value="<?php
                                echo usuarios::getPerfil(0, $_SESSION['id']);
                                ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label>Apellidos</Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="lastName" value="<?php
                                echo usuarios::getPerfil(1, $_SESSION['id']);
                                ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label>Altura actual:</Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="height" value="<?php
                                echo usuarios::getPerfil(5, $_SESSION['id']);
                                ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label>Peso Actual:</Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="weight" value="<?php
                                echo usuarios::getPerfil(4, $_SESSION['id']);
                                ?>
                            " class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label>Genero:</Label>
                            </div>
                            <div class="col-md-12 my-2">
                                <?php
                                $sexo = usuarios::getPerfil(8, $_SESSION['id']);
                                ?>
                                <select class="form-select" name="sex" aria-label="Default select example">
                                    <option selected disabled>Seleciona... </option>
                                    <option value="2" <?php echo ($sexo == 'Femenino') ? 'selected' : ''; ?>>Femenino
                                    </option>
                                    <option value="1" <?php echo ($sexo == 'Masculino') ? 'selected' : ''; ?>>Masculino
                                    </option>
                                    <option value="3" <?php echo ($sexo == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label>Pr:</Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="personaleRecord" value="<?php
                                echo usuarios::getPerfil(6, $_SESSION['id']);
                                ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h1>
                                Contacto
                            </h1>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <label>
                                    Correo Electronico:
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input type="email" name="mail"
                                    value="<?php echo usuarios::getPerfil(2, $_SESSION['id']); ?>" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <label>
                                    Telefono
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="phone" value="<?php
                                echo usuarios::getPerfil(7, $_SESSION['id']);
                                ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-warning compartir">Actualizar
                                <i class="fa-solid fa-rotate icono"></i></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<script src="js/event.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>