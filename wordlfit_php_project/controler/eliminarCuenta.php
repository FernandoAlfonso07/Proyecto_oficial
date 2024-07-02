<?php

include ("../model/usuario.php");

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id'])) {
    header("location: inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: inicioSesion.php");
    }
}


$id = $_GET['iduser'];

$resultado = usuarios::eliminarCuenta($id);

if ($resultado > 1) {
    echo 'Error 310 | No fue posible el DELETE';
} else {

    if (isset($_SESSION['id']))
        session_destroy();

    header('Location: ../vista/inicioSesion.php');
    exit();

}