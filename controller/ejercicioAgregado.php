<?php


include ("../model/administrador.php");

$nombre = $_GET['nombreEjercicio'];
$instruc = $_GET['instrucciones'];
$equiped = $_GET['equipo'];
$rep = $_GET['repeticiones'];
$series = $_GET['series'];
$tiempoDes = $_GET['t_descanso'];
$direccion_media = $_GET['archivo'];


//$resultado = ;

if (Administrador::agregarEjercicio($nombre, $instruc, $equiped, $rep, $series, $tiempoDes, $direccion_media) > 1) {
    echo 'No fue posible el registro';
} else {

    header('location: ../view/administrador/controladorVadmin.php?seccionAd=verEjercicios');
    exit();
}