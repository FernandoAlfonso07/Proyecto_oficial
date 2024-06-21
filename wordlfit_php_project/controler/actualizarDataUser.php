<?php

include ("../model/usuario.php");


if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION["correo"])) {
    echo 'error';
} else {
    $_SESSION['correo'];
    $correoU = $_SESSION['correo'];
    $id_usuario = usuarios::buscarId($correoU);
}

$id_usuario = usuarios::buscarId($correoU);

$nombres = $_GET['nombre'];
$apellidos = $_GET['apellido'];
$telefono = $_GET['telefono'];
$correo = $_GET['correo'];
$pr = $_GET['personaleRecord'];
$pesoActual = $_GET['peso'];
$altura = $_GET['altura'];

$directorioDestino = '../vista/imgPerfiles/';
$nombreArchivo = '';

if (!empty($_FILES['imagenPerfil']['name'])) {
    $nombreArchivo = basename($_FILES['imagenPerfil']);

    $ruta_completa = $directorioDestino . $nombreArchivo;
    $ruta_imagen = $ruta_completa;

}

$respuesta = usuarios::actualizarDatos($id_usuario, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen);

if ($respuesta > 0) {
    echo 'Error 1000';
} else {
    if (!isset($_SESSION["correo"])) {
        echo 'error';
    } else {
        $_SESSION['correo'];
        $correoU = $_SESSION['correo'];
        $id_usuario = usuarios::buscarId($correoU);
    }
    header('Location: ../vista/controlador.php?seccion=MiPerfil');
}

