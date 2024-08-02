<?php
include_once ("../model/usuario.php");
include_once ("../model/validate.php");

// Define los campos que deben ser validados
$inputsValidate = ['name', 'lastName', 'phone', 'mail', 'password', 'weight', 'height', 'sex', 'roleUser'];

// Verifica que todos los campos requeridos no estén vacíos usando la función validateNotEmptyInputs
if (validate::validateNotEmptyInputs($inputsValidate)) {

    // Sanitiza los datos del formulario para prevenir inyecciones y otros problemas de seguridad
    $name = validate::sanitize($_POST['name']);
    $lastName = validate::sanitize($_POST['lastName']);
    $phone = validate::sanitize($_POST['phone']);
    $mail = validate::sanitize($_POST['mail']);
    $password = validate::sanitize($_POST['password']);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT); // Hashea la contraseña para almacenamiento seguro
    $weight = validate::sanitize($_POST['weight']);
    $height = validate::sanitize($_POST['height']);
    $sex = validate::sanitize($_POST['sex']);
    $roleUser = validate::sanitize($_POST['roleUser']);

    // Validación del teléfono: debe ser un entero positivo
    if (!filter_var($phone, FILTER_VALIDATE_INT) || $phone <= 0) {
        header('location: ../view/administrador/controladorVadmin.php?error=invalidPhone&seccionAd=createUser');
        exit();
    }

    // Validación del peso actual: debe ser un número flotante positivo
    if (!filter_var($weight, FILTER_VALIDATE_FLOAT) || $weight <= 0) {
        header('location: ../view/administrador/controladorVadmin.php?error=invalidWeight&seccionAd=createUser');
        exit();
    }

    // Validación de la altura: debe ser un número flotante positivo
    if (!filter_var($height, FILTER_VALIDATE_FLOAT) || $height <= 0) {
        header('location: ../view/administrador/controladorVadmin.php?error=invalidHeight&seccionAd=createUser');
        exit();
    }

    // Registra al usuario en la base de datos
    $resultado = usuarios::registrar($name, $lastName, $phone, $mail, $passwordHashed, $weight, $height, $sex, $roleUser);

    if ($resultado > 1) {
        echo 'Error'; // Mensaje de error si el registro no es exitoso
    } else {

        // Redirige a la página de visualización de usuarios si el registro es exitoso  
        header('location: ../view/administrador/controladorVadmin.php?seccionAd=verUsuarios');
        exit();
    }
} else {

    // Redirige si hay campos vacíos
    header('location: ../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=createUser');
    exit();
}