<?php


include ("../model/administrador.php");

$id_ejercicio = $_GET['id_ejercicio'];

$resultado = Administrador::delete_data(1, $id_ejercicio);

if ($resultado > 1) {
    echo 'Error 310 | No fue posible el DELETE';
} else {

    header('Location: ../view/administrador/controladorVadmin.php?seccionAd=verEjercicios');
    exit();
}

