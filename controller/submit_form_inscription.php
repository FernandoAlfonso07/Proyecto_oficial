<?php
!isset($_SESSION) ? session_start() : null;
include_once ("../model/validate.php");
include_once ("../model/gyms.php");
include_once ("../model/administrador.php");
include_once ("../model/usuario.php");
include_once ("../model/gym_membership.php");

$fields = [
    'fullName',
    'address',
    'contactEmail',
    'phone',
    'document',
    'medicalInfo',
    'monthlyCost',
];

if (!validate::validateNotEmptyInputs($fields)) {
    header("Location: ../view/controlador.php?error=emptyFields&seccion=inscription_gym");
    exit();
}

// Asignar y sanitizar los valores de $_POST
foreach ($fields as $field) {
    ${$field} = isset($_POST[$field]) ? validate::sanitize($_POST[$field]) : null;
}

if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/controlador.php?error=invalidEmail&seccion=inscription_gym");
    exit();
}

if (!filter_var($document, FILTER_VALIDATE_INT) || !filter_var($monthlyCost, FILTER_VALIDATE_INT)) {
    header("Location: ../view/controlador.php?error=notNumber&seccion=inscription_gym");
    exit();
}

$id_user = Administrador::getUsuarios(3, 0, $contactEmail, $phone);
$count_membership = Gym_membership::showInfor("count", $id_user, 0);
$constGym = Gyms::getInfoThisGym(21, $_SESSION['thisGym'], 'detailedInfo');

if ($count_membership >= 1) {
    header("Location: ../view/controlador.php?error=have_membership&seccion=inscription_gym");
    exit();
}

if ($monthlyCost !== $constGym) {
    header("Location: ../view/controlador.php?error=insufficient&seccion=inscription_gym");
    exit();
}


$response = usuarios::inscriptionGym($id_user, $address, $document, $medicalInfo, $_SESSION['thisGym']);

if ($response > 1) {
    header("Location: ../view/controlador.php?error=errorInscription&seccion=inscription_gym");
    exit();
} else {
    header("Location: controller_change_password.php?usu=" . $_SESSION['id'] . "");
    exit();
    // unset($_SESSION['thisGym']);
    // header("Location: ../view/controlador.php?success=inscriptionSuccess&seccion=seccion1");
    // exit();
}


