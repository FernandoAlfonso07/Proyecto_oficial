<?php

include_once ("../model/administrador.php");

include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

$nombre = $_GET['nombreEjercicio'];
$nombre = validate::sanitize($nombre); // Sanitización de la contraseña;

$instruc = $_GET['instrucciones'];
$instruc = validate::sanitize($instruc); // Sanitización de la contraseña;

$equiped = $_GET['equipo'];
$equiped = validate::sanitize($equiped); // Sanitización de la contraseña;

$rep = $_GET['repeticiones'];
$rep = validate::sanitize($rep); // Sanitización de la contraseña;

$series = $_GET['series'];
$series = validate::sanitize($series); // Sanitización de la contraseña;

$tiempoDes = $_GET['t_descanso'];
$tiempoDes = validate::sanitize($tiempoDes); // Sanitización de la contraseña;

$direccion_media = $_GET['archivo'];



//$resultado = ;

if (Administrador::agregarEjercicio($nombre, $instruc, $equiped, $rep, $series, $tiempoDes, $direccion_media) > 1) {
    echo 'No fue posible el registro';
} else {

    header('location: ../view/administrador/controladorVadmin.php?seccionAd=asociarEjerciciosRutinas');
    exit();
}