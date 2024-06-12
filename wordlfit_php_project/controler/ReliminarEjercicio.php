<?php

include ("../model/EliminarDatos.php");

$id_tabla = 0;

if (isset($_GET['id'])) {
    $id_tabla = $_GET['id'];
}

$id_tabla = $_GET['id'];

$r = EliminarDatos::borrarAmbos($id_tabla);
echo 'variable r: ' . $r;

if ($r < 1) {
    header('location: ../vista/controladorVadmin.php?seccionAd=seccionAd2');
} else {
    header('location: ../vista/index.php');
}
