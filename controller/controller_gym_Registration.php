<?php
// Incluir archivos necesarios para la validación y administración
include_once ('../model/validate.php');
include_once ('../model/administrador.php');

// Definir una lista de campos del formulario que deben ser validados para asegurarse de que no estén vacíos
$validateEmptyinputs = [
    // 'img_gym',
    'nameGym'/*,
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
'managerName',
'managerLastname',
'managerEmail',
'managerPhone'*/
];

// Validar que todos los campos obligatorios no estén vacíos
if (!validate::validateNotEmptyInputs($validateEmptyinputs)) {
    // Redirigir al usuario si algún campo está vacío, con un mensaje de error
    header('location: ../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=addGym');
    exit(); // Terminar el script
}

// Sanitizar y asignar los valores de los campos del formulario
$name = validate::sanitize($_POST['nameGym']); // Nombre del gimnasio
$category_gym = validate::sanitize($_POST['category_gym']); // Categoría del gimnasio
$description = validate::sanitize($_POST['description']); // Descripción del gimnasio
$mission = validate::sanitize($_POST['mission']); // Misión del gimnasio
$vision = validate::sanitize($_POST['vision']); // Visión del gimnasio

// Procesar la imagen del gimnasio: validar el formato y guardar la imagen en el directorio especificado
$direccion_media = validate::media(
    'img_gym',
    '../view/administrador/controladorVadmin.php?error=invalidFormat&seccionAd=addGym',
    '../view/img Gyms/'
);

// Horarios de entre semana
$morning_time_weekday_start = validate::sanitize($_POST['morning_time_weekday_start']); // Horario de inicio de la mañana entre semana
$morning_time_weekday_end = validate::sanitize($_POST['morning_time_weekday_end']); // Horario de fin de la mañana entre semana
$afternoon_time_weekday_start = validate::sanitize($_POST['afternoon_time_weekday_start']); // Horario de inicio de la tarde entre semana
$afternoon_time_weekday_end = validate::sanitize($_POST['afternoon_time_weekday_end']); // Horario de fin de la tarde entre semana

// Horarios de fines de semana
$morning_time_weekend_start = validate::sanitize($_POST['morning_time_weekend_start']); // Horario de inicio de la mañana fines de semana
$morning_time_weekend_end = validate::sanitize($_POST['morning_time_weekend_end']); // Horario de fin de la mañana fines de semana
$afternoon_time_weekend_start = validate::sanitize($_POST['afternoon_time_weekend_start']); // Horario de inicio de la tarde fines de semana
$afternoon_time_weekend_end = validate::sanitize($_POST['afternoon_time_weekend_end']); // Horario de fin de la tarde fines de semana

// Información de contacto del gimnasio
$phone = validate::sanitize($_POST['phone']); // Teléfono del gimnasio
$email = validate::sanitize($_POST['email']); // Correo electrónico del gimnasio
$address = validate::sanitize($_POST['address']); // Dirección del gimnasio
$payment_method = validate::sanitize($_POST['payment_method']); // Método de pago del gimnasio

// Información de contacto del gerente
$managerEmail = validate::sanitize($_POST['managerEmail']); // Correo electrónico del gerente
$managerPhone = validate::sanitize($_POST['managerPhone']); // Teléfono del gerente

// Obtener el ID del gerente utilizando su correo electrónico y teléfono
$id_manager = Administrador::getUsuarios(3, 0, $managerEmail, $managerPhone);

// Obtener el rol del usuario basado en el email o teléfono del gerente
$role = Administrador::getUsuarios(3, 7, $managerEmail, $managerPhone);

// Validar si existe más de un gerente con el mismo ID
$count = validate::UserExists(2, null, $id_manager, 3);

// Verificar si el rol no es 'Gerente de gimnasio' y redirigir si no tiene el rol adecuado
if (!isset($role) || $role !== 'Gerente de gimnasio') {
    header('location: ../view/administrador/controladorVadmin.php?error=Unauthorized&seccionAd=addGym');
    exit();
}

// Verificar si existe más de un gerente con el mismo ID y redirigir si es el caso
if (!isset($count) || $count > 1) {
    header('location: ../view/administrador/controladorVadmin.php?error=gymexists&seccionAd=addGym');
    exit();
}

// Registrar el gimnasio en la base de datos utilizando los datos proporcionados
$response = Administrador::registredGym(
    $name,
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
    $id_manager
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