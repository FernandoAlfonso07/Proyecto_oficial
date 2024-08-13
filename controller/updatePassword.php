<?php
include_once ("../model/usuario.php");
include_once ("../model/validate.php");



// Validación inicial para verificar la existencia de los campos necesarios
if (empty($_POST['newPassword']) || empty($_POST['usu'])) {
    header('location: ../view/inicioSesion.php?error=missing_data');
    exit();
}

$array = ['newPassword'];
$pass = validate::sanitize($_POST['newPassword']);
$passwordHashed = password_hash($pass, PASSWORD_DEFAULT);
$id = filter_var($_POST['usu'], FILTER_VALIDATE_INT);

// Validar que el ID es un entero válido
if ($id === false) {
    header('location: ../view/inicioSesion.php?error=invalid_id');
    exit();
}

if (!validate::validateNotEmptyInputs($array)) {
    header('location: ../view/inicioSesion.php');
    exit();
}

$lastUpdate = usuarios::updatePassword($passwordHashed, $id);

if ($lastUpdate > 1) {
    header('location: ../view/inicioSesion.php');
    exit();
} else {
    header('location: ../view/inicioSesion.php?success=updatePassword');
    exit();
}

