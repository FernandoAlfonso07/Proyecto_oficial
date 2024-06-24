<?php

include ("../model/usuario.php");


if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id'])) {
    header("location: inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: inicioSesion.php");
    }
}




$nombres = $_GET['nombre'];

$apellidos = $_GET['apellido'];

$telefono = $_GET['telefono'];

$correo = $_GET['correo'];

$pr = $_GET['personaleRecord'];

$pesoActual = $_GET['peso'];

$altura = $_GET['altura'];



/*
$directorioDestino = '../vista/imgPerfiles/';
$nombreArchivo = '';

if (!empty($_FILES['imagenPerfil']['name'])) {
    $nombreArchivo = basename($_FILES['imagenPerfil']);

    $ruta_completa = $directorioDestino . $nombreArchivo;
    $ruta_imagen = $ruta_completa;

}
*/


$respuesta = usuarios::actualizarDatos($_SESSION['id'], $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen);

if ($respuesta > 0) {

    echo 'Error 1000';

} else {

    $id_usuario = usuarios::buscarId($correo);

    $_SESSION['id'] = $id_usuario;


    header('Location: ../vista/controlador.php?seccion=MiPerfil');
    exit();

}

// PEDIR AYUDA PORQUE DEJO DE FUNCIONAR AL CAMBIAR EL CORREO.. :( 