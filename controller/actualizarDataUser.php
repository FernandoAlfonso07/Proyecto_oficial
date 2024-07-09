<?php

include ("../model/usuario.php");


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

$apellidos = $_GET['apellido'];

$telefono = $_GET['telefono'];

$correo = $_GET['correo'];

$pr = $_GET['personaleRecord'];

$pesoActual = $_GET['peso'];

$altura = $_GET['altura'];

$ruta_imagen = '';



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

