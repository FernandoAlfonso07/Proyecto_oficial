<?php

include_once ("../model/usuario.php");
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




$nombres = $_GET['nombre'];

$nombres = validate::sanitize($nombres); // Sanitización de la contraseña;

$apellidos = $_GET['apellido'];

$apellidos = validate::sanitize($apellidos); // Sanitización de la contraseña;

$telefono = $_GET['telefono'];

$telefono = validate::sanitize($telefono); // Sanitización de la contraseña;

$correo = $_GET['correo'];

$correo = validate::sanitize($correo); // Sanitización de la contraseña;

$pr = $_GET['personaleRecord'];

$pr = validate::sanitize($pr); // Sanitización de la contraseña;

$pesoActual = $_GET['peso'];

$pesoActual = validate::sanitize($pesoActual); // Sanitización de la contraseña;

$altura = $_GET['altura'];

$altura = validate::sanitize($altura); // Sanitización de la contraseña;

$ruta_imagen = '';

// $password = validate::sanitize($password); // Sanitización de la contraseña;


/*
$directorioDestino = '../view/imgPerfiles/';
$nombreArchivo = '';

if (!empty($_FILES['imagenPerfil']['name'])) {
    $nombreArchivo = basename($_FILES['imagenPerfil']);

    $ruta_completa = $directorioDestino . $nombreArchivo;
    $ruta_imagen = $ruta_completa;

}
*/


$respuesta = usuarios::actualizarDatos($_SESSION['id'], $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen);

if ($respuesta > 1) {

    echo 'Error 1000';

} else {

    header('Location: ../view/controlador.php?seccion=MiPerfil');
    exit();

}

