<?php


include_once ("../model/administrador.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

$id_ejercicio = $_GET['id_ejercicio'];
$id_ejercicio = validate::sanitize($id_ejercicio); // Sanitización de la contraseña;

$resultado = Administrador::delete_data(1, $id_ejercicio);

if ($resultado > 1) {
    echo 'Error 310 | No fue posible el DELETE';
} else {

    header('Location: ../view/administrador/controladorVadmin.php?seccionAd=verEjercicios');
    exit();
}

