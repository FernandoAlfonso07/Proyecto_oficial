<?php
!isset($_SESSION) ? session_start() : null;
include_once ("../model/administrador.php");
include_once ("../model/validate.php");
include_once ("../model/gyms.php");

$fields = [
    'nameGym',
    'category_gym',
    'description',
    'mission',
    'vision',
    'morning_time_weekday_start',
    'morning_time_weekday_end',
    'afternoon_time_weekday_start',
    'afternoon_time_weekday_end',
    'morning_time_weekend_start',
    'morning_time_weekend_end',
    'afternoon_time_weekend_start',
    'afternoon_time_weekend_end',
    'phone',
    'email',
    'address',
    'payment_method',
    'managerEmail',
    'managerPhone',
    'monthly_payment'
];


if (!validate::validateNotEmptyInputs($fields)) {
    header("Location: ../view/administrador/controladorVadmin.php?error=emptyFields&dgym=" . $_SESSION['id_gym'] . "&seccionAd=addGym");
    exit();
}

// Asignar y sanitizar los valores de $_POST
foreach ($fields as $field) {
    ${$field} = isset($_POST[$field]) ? validate::sanitize($_POST[$field]) : null;
}

if (!filter_var($category_gym, FILTER_VALIDATE_INT) || !filter_var($payment_method, FILTER_VALIDATE_INT)) {
    // Redirige o maneja el error si alguno de los valores no es un entero válido
    header("location: ../view/administrador/controladorVadmin.php?error=invalidInteger&dgym=" . $_SESSION['id_gym'] . "&seccionAd=addGym");
    exit();
}

$currentImagePath = Gyms::getInfoThisGym(4, $_SESSION['id_gym'], 'call');

if (!empty($_FILES['img_gym']['name'])) {
    $ruta_imagen = validate::media(
        'img_gym',
        "../view/administrador/controladorVadmin.php?error=incorrectFormat&dgym=" . $_SESSION['id_gym'] . "&seccionAd=addGym",
        '../view/img Gyms/'
    );

    if ($currentImagePath) {
        unlink($currentImagePath);
    }
} else {
    $ruta_imagen = $currentImagePath;
}

if (!filter_var($managerEmail, FILTER_VALIDATE_EMAIL)) {
    header("location: ../view/administrador/controladorVadmin.php?error=invalidEmail&dgym=" . $_SESSION['id_gym'] . "&seccionAd=addGym");
    exit();
}

// Obtener el ID del nuevo gerente utilizando su correo electrónico y teléfono
$newManager = Administrador::getUsuarios(3, 0, $managerEmail, $managerPhone);

// Obtener el ID del gerente actual del gimnasio
$currentManager = Gyms::getInfoThisGym(19, $_SESSION['id_gym'], 'detailedInfo');

// Obtener el rol del usuario basado en el email o teléfono del gerente
$role = Administrador::getUsuarios(3, 7, $managerEmail, $managerPhone);

// Verificar si el ID del nuevo gerente es diferente al ID del gerente actual
if ($newManager !== $currentManager) {
    // Validar si existe más de un gerente con el mismo ID del nuevo gerente
    $count = validate::UserExists(2, null, $newManager, 0);
    if (!isset($count) || $count > 1) {
        // Si hay conflicto (más de un gerente con el mismo ID), redirigir con un error
        header("location: ../view/administrador/controladorVadmin.php?error=gymexists&dgym=" . $_SESSION['id_gym'] . "&seccionAd=addGym");
        exit();
    }
    // Si no hay conflicto, asignar el nuevo ID de gerente
    $id_manager = $newManager;
} else {
    // Si el nuevo gerente es el mismo que el actual, dejar el ID como está
    $id_manager = $currentManager;
}

// Verificar si el rol no es 'Gerente de gimnasio' y redirigir si no tiene el rol adecuado
if (!isset($role) || $role !== 'Gerente de gimnasio') {
    header("location: ../view/administrador/controladorVadmin.php?error=Unauthorized&dgym=" . $_SESSION['id_gym'] . "&seccionAd=addGym");
    exit();
}

echo 'Id gerente ahora ' . $id_manager . '<br>'; // A USAR ----------------------------------

$response = Administrador::updateGymInfo(
    $_SESSION['id_gym'],
    $nameGym,
    $category_gym,
    $description,
    $mission,
    $vision,
    $ruta_imagen,
    $morning_time_weekday_start,
    $morning_time_weekday_end,
    $afternoon_time_weekday_start,
    $afternoon_time_weekday_end,
    $morning_time_weekend_start,
    $morning_time_weekend_end,
    $afternoon_time_weekend_start,
    $afternoon_time_weekend_end,
    $phone,
    $email,
    $address,
    $payment_method,
    $id_manager,
    $monthly_payment
);

if ($response > 1) {
    header("location: ../view/administrador/controladorVadmin.php?error=errorUpdate&dgym=" . $_SESSION['id_gym'] . "&seccionAd=addGym");
    exit();
} else {
    unset($_SESSION['id_gym']);
    header("location: ../view/administrador/controladorVadmin.php?success=updatedExito&seccionAd=showGyms");
    exit();
}