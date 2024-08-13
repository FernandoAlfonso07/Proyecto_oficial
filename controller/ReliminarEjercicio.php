<?php

include ("../model/EliminarDatos.php");

$id_tabla = 0;

if (isset($_GET['id'])) {
    $id_tabla = $_GET['id'];
}

$id_tabla = $_GET['id'];

$r = EliminarDatos::borrarAmbos($id_tabla);

if ($r < 1) {
    header('location: ../view/controladorVadmin.php?seccionAd=seccionAd2');
} else {
    header('location: ../view/index.php');
}


// No se ha usado NUNCA.