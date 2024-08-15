<?php
// Incluye los archivos necesarios para operaciones de usuario y validaciones
include_once("../model/usuario.php");
include_once("../model/validate.php");

// Verifica si los campos 'newPassword' y 'usu' están presentes y no están vacíos
if (empty($_POST['newPassword']) || empty($_POST['usu'])) {
    // Redirige a la página de inicio de sesión con un mensaje de error si faltan datos
    header('location: ../view/inicioSesion.php?error=missing_data');
    exit(); // Termina la ejecución del script
}

// Define un array con el campo 'newPassword' para validar
$array = ['newPassword'];

// Sanitiza el nuevo valor de la contraseña
$pass = validate::sanitize($_POST['newPassword']);

// Genera un hash de la contraseña utilizando el algoritmo bcrypt
$passwordHashed = password_hash($pass, PASSWORD_DEFAULT);

// Filtra el ID del usuario para asegurarse de que es un entero válido
$id = filter_var($_POST['usu'], FILTER_VALIDATE_INT);

// Verifica si el ID es un entero válido
if ($id === false) {
    // Redirige a la página de inicio de sesión con un mensaje de error si el ID no es válido
    header('location: ../view/inicioSesion.php?error=invalid_id');
    exit(); // Termina la ejecución del script
}

// Verifica que los campos necesarios no estén vacíos utilizando la función de validación
if (!validate::validateNotEmptyInputs($array)) {
    // Redirige a la página de inicio de sesión si los campos no están correctamente validados
    header('location: ../view/inicioSesion.php');
    exit(); // Termina la ejecución del script
}

// Actualiza la contraseña del usuario en la base de datos
$lastUpdate = usuarios::updatePassword($passwordHashed, $id);

// Verifica el resultado de la actualización
if ($lastUpdate > 1) {
    // Redirige a la página de inicio de sesión con un mensaje de éxito si la actualización fue exitosa
    header('location: ../view/inicioSesion.php');
    exit(); // Termina la ejecución del script
} else {
    // Redirige a la página de inicio de sesión con un mensaje de éxito si la actualización fue exitosa
    header('location: ../view/inicioSesion.php?success=updatePassword');
    exit(); // Termina la ejecución del script
}

