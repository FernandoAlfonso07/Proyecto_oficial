<?php

include_once ("../model/administrador.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

$id_relacion = $_GET['idRelacion'];

$id_relacion = validate::sanitize($id_relacion); // Sanitización de la contraseña;


$resultado = Administrador::quitarEjercicio($id_relacion);

if ($resultado > 1) {
    echo 'Error 420';
} else {
    header('location: ../view/administrador/controladorVadmin.php?seccionAd=asociarEjerciciosRutinas');
}