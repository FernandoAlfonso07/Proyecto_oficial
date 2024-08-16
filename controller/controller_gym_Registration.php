<?php
// Incluir archivos necesarios para la validación y administración
include_once('../model/validate.php');
include_once('../model/administrador.php');


// Definir una lista de campos del formulario que deben ser validados para asegurarse de que no estén vacíos
$validateEmptyinputs = [
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

// Validar que todos los campos obligatorios no estén vacíos
if (!validate::validateNotEmptyInputs($validateEmptyinputs)) {
    // Redirigir al usuario si algún campo está vacío, con un mensaje de error
    header('location: ../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=addGym');
    exit(); // Terminar el script
}

foreach ($validateEmptyinputs as $field) {
    ${$field} = isset($_POST[$field]) ? trim(validate::sanitize($_POST[$field])) : null;
}


// Procesar la imagen del gimnasio: validar el formato y guardar la imagen en el directorio especificado
$direccion_media = validate::media(
    'img_gym',
    '../view/administrador/controladorVadmin.php?error=invalidFormat&seccionAd=addGym',
    '../view/img Gyms/'
);

// Obtener el ID del gerente utilizando su correo electrónico y teléfono
$id_manager = Administrador::getUsuarios(3, 0, $managerEmail, $managerPhone);

// Obtener el rol del usuario basado en el email o teléfono del gerente
$role = Administrador::getUsuarios(3, 7, $managerEmail, $managerPhone);

// Validar si existe más de un gerente con el mismo ID
$count = validate::UserExists(2, null, $id_manager, 0);

// Verificar si el rol no es 'Gerente de gimnasio' y redirigir si no tiene el rol adecuado
if (!isset($role) || $role !== 'Gerente de gimnasio') {
    header('location: ../view/administrador/controladorVadmin.php?error=Unauthorized&seccionAd=addGym');
    exit();
}

// Verificar si existe más de un gerente con el mismo ID y redirigir si es el caso
if (!isset($count) || $count >= 1) {
    header('location: ../view/administrador/controladorVadmin.php?error=gymexists&seccionAd=addGym');
    exit();
}

// Registrar el gimnasio en la base de datos utilizando los datos proporcionados
$response = Administrador::registredGym(
    $nameGym,
    $category_gym,
    $description,
    $mission,
    $vision,
    $direccion_media,
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

// Redirigir al usuario según el resultado de la operación de registro
if ($response > 1) {
    // Si hay un error al registrar el gimnasio, redirigir con un mensaje de error
    header('location: ../view/administrador/controladorVadmin.php?error=errorRegistering&seccionAd=addGym');
    exit(); // Terminar el script
} else {
    // Si el registro es exitoso, redirigir para mostrar la lista de gimnasios
    header('location: ../view/administrador/controladorVadmin.php?succes=createGym&seccionAd=showGyms');
    exit(); // Terminar el script
}