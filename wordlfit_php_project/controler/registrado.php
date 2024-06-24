<?php
include ('../model/usuario.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id']))
    $_SESSION['id'] = "";

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

if ($resultado > 0) {
    header('location: errores/errorRegister.php');

} else {

    $id_usuario = usuarios::buscarId($correoElectronico);

    $_SESSION['id'] = $id_usuario;

    header('location: ../vista/controlador.php?seccion=seccion1');
}

