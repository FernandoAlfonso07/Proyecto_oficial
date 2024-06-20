<?php
include ('../model/usuario.php');

$nombres = $_GET['nombres'];
$apellidos = $_GET['apellidos'];
$telefono = $_GET['telefono'];
$correoElectronico = $_GET['correo'];
$contraseña = $_GET['contraseña'];
$pesoActual = $_GET['pesoA'];
$altura = $_GET['alturaA'];
$genero = $_GET['genero'];

$resultado = usuarios::registrar($nombres, $apellidos, $telefono, $correoElectronico, $contraseña, $pesoActual, $altura, $genero);

if ($resultado > 0) {
    header('location: errores/errorRegister.php');

} else {

    if (!isset($_SESSION))
        session_start();

    $_SESSION['correo'] = $correoElectronico;

    header('location: ../vista/controlador.php?seccion=seccion1');
}

