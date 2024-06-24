<?php

include ("../model/usuario.php");


if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION["id"]))
    $_SESSION['id'] = "";



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

$id_usuario = usuarios::buscarId($correo); //  Borrar de aqui para solucionar algo

//$respuesta = usuarios::actualizarDatos($id_usuario, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen);

if (usuarios::actualizarDatos($id_usuario, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen) > 0) {
    echo 'Error 1000';
} else {

    $id_usuario = usuarios::buscarId($correo);

    $_SESSION['id'] = $id_usuario;

    header('Location: ../vista/controlador.php?seccion=MiPerfil');
    exit();
}

// PEDIR AYUDA PORQUE DEJO DE FUNCIONAR AL CAMBIAR EL CORREO.. :( 