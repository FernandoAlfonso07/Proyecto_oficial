<?php

include ("../model/administrador.php");


$id_relacion = $_GET['idRelacion'];



$resultado = Administrador::quitarEjercicio($id_relacion);

if ($resultado > 1) {
    echo 'Error 420';
} else {
    header('location: ../vista/administrador/controladorVadmin.php?seccionAd=addRutina');
}