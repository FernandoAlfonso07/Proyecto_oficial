<?php
include("../../model/usuario.php");
include_once("../../functions/alerts.php");
if (isset($_GET['error'])) {
    $errorMessages = [
        'emptyFields' => 'Debes llenar todos los campos',
        'incorrectFormat' => 'Formato incorrecto',
        'notNumber' => 'Los campos deben ser tipo número',
        'invalidPhone' => 'Número de teléfono inválido',
        'invalidEmail' => 'El correo ingresado no es válido'
    ];

    $error = $_GET['error'];
    if (isset($errorMessages[$error])) {
        echo Alerts::error(2, $errorMessages[$error], 'updateDatas');
    }
}
?>
<link rel="stylesheet" href="../css/actualizarDatos.css">
<section>
    <form action="../../controller/actualizarDataUser.php?type=admin" method="POST" enctype="multipart/form-data">
        <div class="container cuerpo2">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="../<?php echo usuarios::getPerfil(9, $_SESSION['id_admin']) ?: '../../view/user img/default_img.PNG'; ?>"
                        class="img-fluid imagen_perfil" width="50%" alt="Imagen Perfil">
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
                                <Label for="nombres">Nombres: </Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="name" id="nombres" value="<?php
                                echo usuarios::getPerfil(0, $_SESSION['id_admin']);
                                ?>" class="form-control">
                                <span id="nombres-error-message" class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label for="apellidos">Apellidos</Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="lastName" id="apellidos" value="<?php
                                echo usuarios::getPerfil(1, $_SESSION['id_admin']);
                                ?>" class="form-control">
                                <span id="apellidos-error-message" class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label for="height">Altura actual:</Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="height" name="height" value="<?php
                                echo usuarios::getPerfil(5, $_SESSION['id_admin']);
                                ?>" class="form-control">
                                <span id="height-error-message" class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label for="peso">Peso Actual:</Label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="peso" name="weight" value="<?php
                                echo usuarios::getPerfil(4, $_SESSION['id_admin']);
                                ?>" class="form-control">
                                <span id="peso-error-message" class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <Label for="sexo">Género:</Label>
                            </div>
                            <div class="col-md-12 my-2">
                                <?php
                                $sexo = usuarios::getPerfil(8, $_SESSION['id_admin']);
                                ?>
                                <select class="form-select" name="sex" id="sexo" aria-label="Default select example">
                                    <option selected disabled>Selecciona... </option>
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
                                <Label for="rol">Rol:</Label>
                            </div>
                            <div class="col-md-12 my-2">
                                <?php
                                $role = usuarios::getPerfil(10, $_SESSION['id_admin']);
                                ?>
                                <select class="form-select" name="roleUser" id="rol"
                                    aria-label="Default select example">
                                    <option selected disabled>Selecciona... </option>
                                    <option value="0" <?php echo ($role == 'Invitado') ? 'selected' : ''; ?>>Invitado
                                    </option>
                                    <option value="1" <?php echo ($role == 'Administrador') ? 'selected' : ''; ?>>
                                        Administrador
                                    </option>
                                    <option value="3" <?php echo ($role == 'Super-Admin') ? 'selected' : ''; ?>>Super
                                        Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h1>
                                Contacto
                            </h1>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 gris">
                                <label for="email">
                                    Correo Electrónico:
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input type="email" id="email" name="mail"
                                    value="<?php echo usuarios::getPerfil(2, $_SESSION['id_admin']); ?>"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 gris">
                                    <label for="telefono">
                                        Teléfono
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" id="telefono" name="phone" value="<?php
                                    echo usuarios::getPerfil(7, $_SESSION['id_admin']);
                                    ?>" class="form-control">
                                    <span id="telefono-error-message" class="error-message"></span>
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
</section>

<script src="js/event.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>