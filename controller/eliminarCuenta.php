<?php

include_once ("../model/usuario.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

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
$id = validate::sanitize($id); // Sanitización de la contraseña;

$resultado = usuarios::eliminarCuenta($id);

if ($resultado > 1) {
    echo 'Error 310 | No fue posible el DELETE';
} else {

    if (isset($_SESSION['id']))
        session_destroy();

    header('Location: ../view/inicioSesion.php');
    exit();

}