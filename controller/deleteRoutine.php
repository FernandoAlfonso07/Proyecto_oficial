<?php


include ("../model/administrador.php");

$id_routine = $_GET['id_routine'];

$resultado = Administrador::delete_data(0, $id_routine);

if ($resultado > 1) {
    echo 'Error 310 | No fue posible el DELETE';
} else {

    header('Location: ../view/administrador/controladorVadmin.php?seccionAd=showRoutines');
    exit();
}