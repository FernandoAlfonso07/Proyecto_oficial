<?php
if (!isset($_SESSION))
    session_start();

include_once('../../model/Categories.php');
include_once('../../functions/alerts.php');
include_once("../../model/usuario.php");

$_SESSION['id_edit_usu'] = $_GET['edit'] ?? null;
if (isset($_GET['error'])) {
    $errorMessages = [
        'emptyFields' => 'Debes de llenar todos los campos',
        'invalidPhone' => 'No es un número de teléfono válido',
        'invalidWeight' => 'Ingresa un peso válido',
        'invalidHeight' => 'Ingresa una altura válida',
        'invalidEmail' => 'Ingresa un correo electrónico válido',
        'invalidEmailEdit' => 'Ingresa un correo electrónico válido',
        'notNumberEdit' => 'Los datos de Peso y Altura deben ser de tipo numérico',
        'invalidPhoneEdit' => 'No es un número de teléfono válido 📱',
        'emptyFieldsEdit' => 'Debes de llenar todos los campos 💢'
    ];

    $error = $_GET['error'];
    if (isset($errorMessages[$error])) {
        if ($error === 'invalidEmailEdit' || $error === 'notNumberEdit' || $error === 'invalidPhoneEdit' || $error === 'emptyFieldsEdit') {
            echo Alerts::error(3, $errorMessages[$error], "controladorVadmin.php?edit=" . $_SESSION['id_edit_usu'] . "&seccionAd=createUser");
        } else {
            echo Alerts::error(2, $errorMessages[$error], 'createUser');
        }
    }
}
?>
<link rel="stylesheet" href="../css/createUser.css">
<div class="container">
    <form action="<?php echo !isset($_GET['edit']) ?
        "../../controller/controller_createUser.php" :
        "../../controller/actualizarDataUser.php?type=editUser"; ?>" method="POST" class="form-registro" id="userForm">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="https://media-public.canva.com/eFyVc/MAFUTdeFyVc/1/wm_s.png" class="img-fluid" width="70%"
                    alt="Foto">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombres</label>
                        <input type="text" id="nombres" name="name"
                            value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(0, $_SESSION['id_edit_usu']) : null; ?>"
                            class="form-control" required>
                        <span id="nombres-error-message" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="apillidos" class="form-label">Apellidos</label>
                        <input type="text" id="apellidos" name="lastName"
                            value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(1, $_SESSION['id_edit_usu']) : null; ?>"
                            class="form-control" required>
                        <span id="apellidos-error-message" class="error-message"></span>
                    </div>
                    <div class="col-md-12">
                        <label for="mail" class="form-label">Correo</label>
                        <input type="email" id="email" name="mail"
                            value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(2, $_SESSION['id_edit_usu']) : null; ?>"
                            class="form-control" required>
                        <span id="mail-error-message" class="error-message"></span>
                    </div>

                    <?php if (!isset($_GET['edit'])): ?>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <span id="peso-error-message" class="error-message"></span>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-6">
                        <label for="peso" class="form-label">Peso actual</label>
                        <input type="number" id="weight" name="weight" step="0.1" min="30" max="300"
                            value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(4, $_SESSION['id_edit_usu']) : null; ?>"
                            class="form-control" required>
                        <span id="weight-error-message" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="altura" class="form-label">Altura Actual</label>
                        <input type="number" id="height" name="height" step="0.01" min="1.50" max="2.20"
                            value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(5, $_SESSION['id_edit_usu']) : null; ?>"
                            class="form-control" required>
                        <span id="height-error-message" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputGroupSelect01" class="form-label">Género</label>
                            <select class="form-select custom-select" name="sex" id="inputGroupSelect01" required>
                                <option selected disabled>Selecciona...</option>
                                <?php
                                $selectedSex = isset($_GET['edit']) ? usuarios::getPerfil(8, $_SESSION['id_edit_usu']) : null;
                                echo CycleCreateCalender::getCategories('genero', $selectedSex);
                                ?>
                            </select>
                            <span id="sex-error-message" class="error-message"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" id="telefono" name="phone"
                            value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(7, $_SESSION['id_edit_usu']) : null; ?>"
                            class="form-control" required>
                        <span id="phone-error-message" class="error-message"></span>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputGroupSelect02" class="form-label">Rol</label>
                            <select class="form-select custom-select" name="roleUser" id="inputGroupSelect02" required>
                                <option value="" disabled selected>Selecciona el rol</option>
                                <?php
                                $selectedRole = isset($_GET['edit']) ? usuarios::getPerfil(10, $_SESSION['id_edit_usu']) : null;
                                echo CycleCreateCalender::getCategories('roles', $selectedRole);
                                ?>
                            </select>
                            <span id="roleUser-error-message" class="error-message"></span>
                        </div>
                    </div>

                    <div class="col-md-12 my-4 text-center">
                        <button type="submit" class="btn btn-primary boton">
                            <?php echo isset($_GET['edit']) ? "Actualizar" : "Registrar"; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>