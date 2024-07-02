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



$correo = $_GET['correo'];
$password = $_GET['password'];

$resultado = usuarios::iniciarSesion(0, $correo, $password);

$seccionRol = usuarios::iniciarSesion(1, $correo, $password);

if ($resultado < 1) {


    header('location: ../vista/inicioSesion.php');

    exit();


    // echo "OCURRIO UN ERROR";
} else {



    if ($seccionRol == 0) {

        $id_usuario = usuarios::buscarId($correo, $password);

        $_SESSION['id'] = $id_usuario;

        header("location: ../vista/controlador.php?seccion=seccion1");

        exit();
    } elseif ($seccionRol == 1) {

        $id_usuario = usuarios::buscarId($correo, $password);

        $_SESSION['id'] = $id_usuario;

        header("location: ../vista/administrador/controladorVadmin.php?seccionAd=seccionAd1");

        exit();

    }


}
