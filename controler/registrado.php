<?php
include ('../model/usuario.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../vista/inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: ../vista/inicioSesion.php");
    }
}


$nombres = $_GET['nombres'];

$apellidos = $_GET['apellidos'];

$telefono = $_GET['telefono'];

$correoElectronico = $_GET['correo'];

$password = $_GET['password'];

// intento de encriptacion de contraseña. Si algo borrar esto jjj

/* $hash = password_hash($password, PASSWORD_DEFAULT);

$encripata = $hash;
*/


// -------------------------------------------------------------
$pesoActual = $_GET['pesoA'];

$altura = $_GET['alturaA'];

$genero = $_GET['genero'];


$resultado = usuarios::registrar($nombres, $apellidos, $telefono, $correoElectronico, $password, $pesoActual, $altura, $genero);

if ($resultado > 1) {
    header('location: errores/errorRegister.php');

} else {


    $id_usuario = usuarios::buscarId($correoElectronico, $password);

    if ($id_usuario) {
        $_SESSION['id'] = $id_usuario;

        // Redirige al usuario a la sección principal
        header('location: ../vista/controlador.php?seccion=seccion1');
        exit();
    } else {
        // Maneja el error si no se encuentra el ID del usuario
        header('location: errores/errorRegister.php');
        exit();
    }
}

