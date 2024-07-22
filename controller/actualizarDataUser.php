<?php

include_once ("../model/usuario.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("location: ../view/inicioSesion.php");

}


// Sanitización de entradas
$nombres = validate::sanitize($_POST['nombre']);
$apellidos = validate::sanitize($_POST['apellido']);
$telefono = validate::sanitize($_POST['telefono']);
$correo = validate::sanitize($_POST['correo']);
$pr = validate::sanitize($_POST['personaleRecord']);
$pesoActual = validate::sanitize($_POST['peso']);
$altura = validate::sanitize($_POST['altura']);

/* ****************************** V A L I D A C I O N E S ***************************** */

// Validación de imagen
$ruta_imagen = validate::image('imagenPerfil', '../view/controlador.php?error=incorrectFormat&seccion=updateDatas', '../view/img/');

// Validaciones de campos
if (empty($nombres) || empty($apellidos) || empty($telefono) || empty($correo) || empty($pr) || empty($pesoActual) || empty($altura)) {
    header('Location: controlador.php?error=incorrect&seccion=updateDatas');
    exit();
}

// Convertir a flotante y validar
$pr = floatval($pr);
$pesoActual = floatval($pesoActual);
$altura = floatval($altura);

if (!filter_var($pr, FILTER_VALIDATE_FLOAT) || !filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || !filter_var($altura, FILTER_VALIDATE_FLOAT)) {
    header('Location: controlador.php?error=notNumber&seccion=updateDatas');
    exit();
}

// Convertir a entero y validar
$telefono = intval($telefono);
if (!filter_var($telefono, FILTER_VALIDATE_INT)) {
    header('Location: controlador.php?error=invalidPhone&seccion=updateDatas');
    exit();
}


/* ****************************** V A L I D A C I O N E S | F I N ***************************** */

$respuesta = usuarios::actualizarDatos($_SESSION['id'], $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen);

if ($respuesta > 1) {
    header('Location: ../view/controlador.php?seccion=MiPerfil');
    exit();

} else {
    // header('Location: ../view/controlador.php?success=exito&seccion=MiPerfil');
    // exit();
}

