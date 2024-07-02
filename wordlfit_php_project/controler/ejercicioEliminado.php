<?php


include ("../model/administrador.php");

$id_ejercicio = $_GET['id_ejercicio'];

$resultado = Administrador::borrarEjercicio($id_ejercicio);

if ($resultado > 0) {
    echo 'Error 310 | No fue posible el DELETE';
} else {



    header('Location: ../vista/administrador/controladorVadmin.php?seccionAd=verEjercicios');
    exit();
}

