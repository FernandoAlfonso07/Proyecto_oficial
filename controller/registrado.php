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


$nombres = $_GET['nombres'];
$nombres = validate::sanitize($nombres); // Sanitización de la contraseña;

$apellidos = $_GET['apellidos'];
$apellidos = validate::sanitize($apellidos); // Sanitización de la contraseña;

$telefono = $_GET['telefono'];
$telefono = validate::sanitize($telefono); // Sanitización de la contraseña;

$correoElectronico = $_GET['correo'];
$correoElectronico = validate::sanitize($correoElectronico); // Sanitización de la contraseña;

$password = $_GET['password'];
$password = validate::sanitize($password); // Sanitización de la contraseña;

// intento de encriptacion de contraseña. Si algo borrar esto jjj

/* $hash = password_hash($password, PASSWORD_DEFAULT);

$encripata = $hash;
*/


// -------------------------------------------------------------
$pesoActual = $_GET['pesoA'];
$pesoActual = validate::sanitize($pesoActual); // Sanitización de la contraseña;

$altura = $_GET['alturaA'];
$altura = validate::sanitize($altura); // Sanitización de la contraseña;

$genero = $_GET['genero'];
$genero = validate::sanitize($genero); // Sanitización de la contraseña;

$resultado = usuarios::registrar($nombres, $apellidos, $telefono, $correoElectronico, $password, $pesoActual, $altura, $genero);

if ($resultado > 1) {
    header('location: errors/errorRegister.php');

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

