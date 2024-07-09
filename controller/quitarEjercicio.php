<?php

include ("../model/administrador.php");


$id_relacion = $_GET['idRelacion'];



$resultado = Administrador::quitarEjercicio($id_relacion);

if ($resultado > 1) {
    echo 'Error 420';
} else {
    header('location: ../view/administrador/controladorVadmin.php?seccionAd=asociarEjerciciosRutinas');
}