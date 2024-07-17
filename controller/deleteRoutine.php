<?php


include_once ("../model/administrador.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

$id_routine = $_GET['id_routine'];
$id_routine = validate::sanitize($id_routine); // Sanitización de la contraseña;

$resultado = Administrador::delete_data(0, $id_routine);

if ($resultado > 1) {
    echo 'Error 310 | No fue posible el DELETE';
} else {

    header('Location: ../view/administrador/controladorVadmin.php?seccionAd=showRoutines');
    exit();
}