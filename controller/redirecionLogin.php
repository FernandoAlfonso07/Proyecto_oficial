<?php
// Incluye el archivo usuario.php que contiene la clase usuarios
include_once ("../model/usuario.php");
// Incluye el archivo validate.php que contiene la clase validate
include_once ('../model/validate.php');

// Inicia la sesión si no está ya iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Verifica si las variables POST 'correo' y 'password' están definidas
if (!isset($_POST['correo']) || !isset($_POST['password'])) {
    header("location: ../view/inicioSesion.php?error=missingFields");
    exit();
}

$inputs = ['correo', 'password'];

// Verifica si los campos 'correo' y 'password' no están vacíos
if (!validate::validateNotEmptyInputs($inputs)) {
    // Redirige a la página de inicio de sesión con un mensaje de error si los campos están vacíos
    header("location: ../view/inicioSesion.php?error=emptyFields");
    exit();
}

// Sanitiza las entradas 'correo' y 'password' para evitar inyecciones de código
$correo = validate::sanitize($_POST['correo']);
$password = validate::sanitize($_POST['password']);

// Obtiene el hash de la contraseña almacenada en la base de datos para el correo proporcionado
$storedPasswordHash = usuarios::getPasswordhash($correo);

// Verifica si el hash de la contraseña coincide con la contraseña proporcionada
if ($storedPasswordHash && password_verify($password, $storedPasswordHash)) {

    // Verifica si las credenciales son correctas (número de coincidencias encontradas)
    $resultado = usuarios::iniciarSesion(0, $correo, $storedPasswordHash);

    // Redirige a la página de inicio de sesión con un mensaje de error si no hay coincidencias
    if ($resultado < 1) {
        // Redirige si no hay coincidencias de correo o contraseña
        header('location: ../view/inicioSesion.php?error=error1');
        exit();
    }

    // Obtiene el ID del usuario basado en el correo y la contraseña hash
    $id_usuario = usuarios::buscarId($correo, $storedPasswordHash);

    // Obtiene el rol del usuario (0 para usuario normal, 1 para administrador)
    $seccionRol = usuarios::iniciarSesion(1, $correo, $storedPasswordHash);

    // Guarda el ID en la sesión y redirige según el rol del usuario
    if ($seccionRol == 2) {
        $_SESSION['id'] = $id_usuario;
        header("location: ../view/controlador.php?seccion=seccion1");
    } elseif ($seccionRol == 1) {
        $_SESSION['id_admin'] = $id_usuario;
        header("location: ../view/administrador/controladorVadmin.php?seccionAd=seccionAd1");
    }
    exit();
} else {

    // Redirige a la página de inicio de sesión con un mensaje de error si las credenciales son inválidas
    header('location: ../view/inicioSesion.php?error=invalidCredentials');
    exit();
}