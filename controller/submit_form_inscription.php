<?php
// Inicia la sesión si aún no está iniciada
!isset($_SESSION) ? session_start() : null;

// Incluye archivos necesarios para la validación y operaciones relacionadas
include_once("../model/validate.php");
include_once("../model/gyms.php");
include_once("../model/administrador.php");
include_once("../model/usuario.php");
include_once("../model/gym_membership.php");

// Define un array con los nombres de los campos a validar
$fields = [
    'fullName',
    'address',
    'contactEmail',
    'phone',
    'document',
    'medicalInfo',
    'monthlyCost',
];

// Verifica si todos los campos del array están presentes y no están vacíos
if (!validate::validateNotEmptyInputs($fields)) {
    // Redirige a una página de error si hay campos vacíos
    header("Location: ../view/controlador.php?error=emptyFields&seccion=inscription_gym");
    exit(); // Termina la ejecución del script
}

// Asigna y sanitiza los valores de los campos del formulario
foreach ($fields as $field) {
    ${$field} = isset($_POST[$field]) ? validate::sanitize($_POST[$field]) : null;
}

// Valida que el campo de correo electrónico tenga un formato válido
if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
    // Redirige a una página de error si el correo electrónico no es válido
    header("Location: ../view/controlador.php?error=invalidEmail&seccion=inscription_gym");
    exit(); // Termina la ejecución del script
}

// Valida que los campos 'document' y 'monthlyCost' sean enteros
if (!filter_var($document, FILTER_VALIDATE_INT) || !filter_var($monthlyCost, FILTER_VALIDATE_INT)) {
    // Redirige a una página de error si alguno de los campos no es un número entero
    header("Location: ../view/controlador.php?error=notNumber&seccion=inscription_gym");
    exit();
}

// Obtiene el ID del usuario basado en el correo electrónico y teléfono
$id_user = Administrador::getUsuarios(3, 0, $contactEmail, $phone);

// Obtiene el conteo de membresías del gimnasio para el usuario
$count_membership = Gym_membership::showInfor("count", $id_user, 0);

// Obtiene la información detallada del gimnasio actual
$constGym = Gyms::getInfoThisGym(21, $_SESSION['thisGym'], 'detailedInfo');

// Verifica si el usuario ya tiene una membresía    
if ($count_membership >= 1) {

    // Redirige a una página de error si el usuario ya tiene una membresía
    header("Location: ../view/controlador.php?error=have_membership&seccion=inscription_gym");
    exit(); // Termina la ejecución del script
}

// Verifica si el costo mensual ingresado coincide con el costo del gimnasio
if ($monthlyCost !== $constGym) {
    // Redirige a una página de error si el costo mensual no es suficiente
    header("Location: ../view/controlador.php?error=insufficient&seccion=inscription_gym");
    exit(); // Termina la ejecución del script
}

// Intenta inscribir al usuario en el gimnasio
$response = usuarios::inscriptionGym($id_user, $address, $document, $medicalInfo, $_SESSION['thisGym']);

// Verifica el resultado de la inscripción
if ($response > 1) {
    // Redirige a una página de error si ocurrió un problema al inscribir al usuario
    header("Location: ../view/controlador.php?error=errorInscription&seccion=inscription_gym");
    exit(); // Termina la ejecución del script
} else {
    // Redirige a una página de éxito si la inscripción fue exitosa
    header("Location: controller_change_password.php?type=InscriptionGym&usu=" . $_SESSION['id'] . "");
    exit(); // Termina la ejecución del script
}


