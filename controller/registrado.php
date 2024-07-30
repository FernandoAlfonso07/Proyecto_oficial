<?php
include_once ('../model/usuario.php');
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../view/inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: ../view/inicioSesion.php");
    }
}


$nombres = validate::sanitize($_POST['nombres']); // Sanitización de la contraseña;

$apellidos = validate::sanitize($_POST['apellidos']); // Sanitización de la contraseña;

$telefono = validate::sanitize($_POST['telefono']); // Sanitización de la contraseña;

$correoElectronico = validate::sanitize($_POST['correo']); // Sanitización de la contraseña;

$password = validate::sanitize($_POST['password']); // Sanitización de la contraseña;

// intento de encriptacion de contraseña. Si algo borrar esto jjj

/* $hash = password_hash($password, PASSWORD_DEFAULT);

$encripata = $hash;
*/


// -------------------------------------------------------------
$pesoActual = validate::sanitize($_POST['pesoA']); // Sanitización de la contraseña;

$altura = validate::sanitize($_POST['alturaA']); // Sanitización de la contraseña;

$genero = validate::sanitize($_POST['genero']); // Sanitización de la contraseña;

$resultado = usuarios::registrar($nombres, $apellidos, $telefono, $correoElectronico, $password, $pesoActual, $altura, $genero);

if ($resultado > 1) {
    header('location: ../view/seccion-registro.php');

} else {


    $id_usuario = usuarios::buscarId($correoElectronico, $password);

    if ($id_usuario) {
        $_SESSION['id'] = $id_usuario;

        // Redirige al usuario a la sección principal
        header('location: ../view/controlador.php?seccion=seccion1');
        exit();
    } else {
        // Maneja el error si no se encuentra el ID del usuario
        header('location: errors/errorRegister.php');
        exit();
    }
}

