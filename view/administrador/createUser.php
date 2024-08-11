<?php
if (!isset($_SESSION))
    session_start();

include_once ('../../model/Categories.php');
include_once ('../../functions/alerts.php');
include_once ("../../model/usuario.php");

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
<section>
    <div class="container">
        <form action="<?php echo !isset($_GET['edit']) ?
            "../../controller/controller_createUser.php" :
            "../../controller/actualizarDataUser.php?type=editUser"; ?>" method="POST" class="form-registro">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="https://media-public.canva.com/eFyVc/MAFUTdeFyVc/1/wm_s.png" class="img-fluid" width="70%"
                        alt="Foto">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombres</label>
                            <input type="text" id="name" name="name"
                                value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(0, $_SESSION['id_edit_usu']) : null; ?>"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Apellidos</label>
                            <input type="text" id="lastName" name="lastName"
                                value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(1, $_SESSION['id_edit_usu']) : null; ?>"
                                class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="mail" class="form-label">Correo</label>
                            <input type="email" id="mail" name="mail"
                                value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(2, $_SESSION['id_edit_usu']) : null; ?>"
                                class="form-control" required>
                        </div>

                        <?php
                        if (isset($_GET['edit'])) {
                            echo null;
                        } else {
                            ?>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div> <?php
                        }
                        ?>

                        <div class="col-md-6">
                            <label for="weight" class="form-label">Peso actual</label>
                            <input type="text" id="weight" name="weight"
                                value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(4, $_SESSION['id_edit_usu']) : null; ?>"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="height" class="form-label">Altura Actual</label>
                            <input type="text" id="height" name="height"
                                value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(5, $_SESSION['id_edit_usu']) : null; ?>"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputGroupSelect01" class="form-label">Género</label>

                                <?php
                                if (isset($_GET['edit'])) {
                                    $sexo = usuarios::getPerfil(8, $_SESSION['id_edit_usu']);
                                    ?>
                                    <select class="form-select custom-select" name="sex" id="inputGroupSelect01" required>
                                        <option selected disabled>Selecciona...</option>
                                        <option value="2" <?php echo ($sexo == 'Femenino') ? 'selected' : ''; ?>>Femenino
                                        </option>
                                        <option value="1" <?php echo ($sexo == 'Masculino') ? 'selected' : ''; ?>>Masculino
                                        </option>
                                        <option value="3" <?php echo ($sexo == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                    </select>
                                    <?php
                                } else {
                                    ?>
                                    <select class="form-select custom-select" name="sex" id="inputGroupSelect01" required>
                                        <option selected disabled>Selecciona...</option>
                                        <option value="2">Femenino</option>
                                        <option value="1">Masculino</option>
                                        <option value="3">Otro</option>
                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" id="phone" name="phone"
                                value="<?php echo isset($_GET['edit']) ? usuarios::getPerfil(7, $_SESSION['id_edit_usu']) : null; ?>"
                                class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputGroupSelect02" class="form-label">Rol</label>
                                <select class="form-select custom-select" name="roleUser" id="inputGroupSelect02"
                                    required>
                                    <option value="" disabled selected>Selecciona el rol</option>

                                    <?php
                                    if (isset($_GET['edit'])) {
                                        $role = usuarios::getPerfil(10, $_SESSION['id_edit_usu']);
                                        ?>
                                        <option value="2" <?php echo ($role == 'Invitado') ? 'selected' : ''; ?>>Invitado
                                        </option>
                                        <option value="1" <?php echo ($role == 'Administrador') ? 'selected' : ''; ?>>
                                            Administrador</option>
                                        <option value="3" <?php echo ($role == 'Super-Admin') ? 'selected' : ''; ?>>
                                            Super-Admin</option>
                                        <option value="4" <?php echo ($role == 'Gerente de gimnasio') ? 'selected' : ''; ?>>
                                            Gerente de gimnasio</option>
                                        <?php
                                    } else {
                                        echo CycleCreateCalender::getCategories('roles');
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 my-4 text-center">
                            <button type="submit"
                                class="btn btn-primary boton"><?php echo isset($_GET['edit']) ? "Actualizar" : "Registrar"; ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>