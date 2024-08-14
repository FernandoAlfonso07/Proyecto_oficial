<?php
// Inicia la sesión si no está ya iniciada.
!isset($_SESSION) ? session_start() : null;

// Incluye archivos necesarios para la validación y manejo de datos de gimnasio.
include_once ("../model/usuario.php");
include_once ("../model/plans.php");
include_once ("../model/validate.php");

$fields = [
    'fullName',
    'lastName',
    'documentNumber',
    'email',
    'phone',
    'amount'
];

// Verifica que todos los campos requeridos no estén vacíos.
if (!validate::validateNotEmptyInputs($fields)) {
    header("Location: ../view/pages/formulerPlan.php?error=emptyField&plan=1");
    exit();
}

// Sanitiza los datos de entrada.
foreach ($fields as $field) {
    ${$field} = isset($_POST[$field]) ? trim(validate::sanitize($_POST[$field])) : null;
}

// Valida el formato del documento, cantidad y teléfono.
if (!filter_var($documentNumber, FILTER_VALIDATE_INT) || $documentNumber <= 0) {
    header("Location: ../view/pages/formulerPlan.php?error=notNumerDocument&plan=1");
    exit();
}
if (!filter_var($amount, FILTER_VALIDATE_INT) || $amount <= 0) {
    header("Location: ../view/pages/formulerPlan.php?error=notNumerAmount&plan=1");
    exit();
}
if (!filter_var($phone, FILTER_VALIDATE_INT) || $phone <= 0) {
    header("Location: ../view/pages/formulerPlan.php?error=notNumerPhone&plan=1");
    exit();
}

// Valida el formato del correo electrónico.
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/pages/formulerPlan.php?error=invalidEmail&plan=1");
    exit();
}

// Valida el número de registros del usuario.
$validateCountRegister = validate::validateCountsDatas($_SESSION['id'], "purchase count");
if ($validateCountRegister != 0) {
    header("Location: ../view/pages/formulerPlan.php?error=havePlan&plan=1");
    exit();

}

// Verifica si el correo electrónico y el teléfono están registrados.
$validatedEmail = usuarios::getInformacion(3, $_SESSION['id']);
$validatedPhone = usuarios::getInformacion(8, $_SESSION['id']);
if (!$validatedEmail || !$validatedPhone) {
    header("Location: ../view/pages/formulerPlan.php?error=dontExist&plan=1");
    exit();
}

$response = usuarios::buy_plan($_SESSION['id'], $_SESSION['id_plan']);

if ($response > 1) {
    header("Location: ../view/pages/formulerPlan.php?error=buyPlan&plan=1");
    exit();
} else {
    header("Location: controller_change_password.php?type=purchasedplan&usu=" . $_SESSION['id'] . "");
    exit();
}