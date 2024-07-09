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



$correo = $_GET['correo'];

$password = $_GET['password'];

$password = validate::sanitize($password); // Sanitización de la contraseña;


$resultado = usuarios::iniciarSesion(0, $correo, $password);

$seccionRol = usuarios::iniciarSesion(1, $correo, $password);


if ($resultado < 1) {

    header('location: ../view/inicioSesion.php');

    exit();
    // echo "OCURRIO UN ERROR";
} else {

    if ($seccionRol == 0) {

        $id_usuario = usuarios::buscarId($correo, $password);

        $_SESSION['id'] = $id_usuario;

        header("location: ../view/controlador.php?seccion=seccion1");

        exit();

    } elseif ($seccionRol == 1) {

        $id_usuario = usuarios::buscarId($correo, $password);

        $_SESSION['id'] = $id_usuario;

        header("location: ../view/administrador/controladorVadmin.php?seccionAd=seccionAd1");

        exit();

    }

}
