<?php

include ("../model/usuario.php");

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id']))
    $_SESSION['id'] = "";

$correo = $_GET['correo'];
$password = $_GET['password'];

$resultado = usuarios::iniciarSesion(0, $correo, $password);
echo 'Opc 0 ' . $resultado;
$seccionRol = usuarios::iniciarSesion(1, $correo, $password);
echo 'Opc 1 ' . $seccionRol;
if ($resultado > 1) {
    //header("location: errores/errorRegister.php");
    //exit();

} else {

    if ($seccionRol == 0) {

        $id_usuario = usuarios::buscarId($correo);

        $_SESSION['id'] = $id_usuario;

        header("location: ../vista/controlador.php?seccion=seccion1");
        exit();
    } elseif ($seccionRol == 1) {

        $id_usuario = usuarios::buscarId($correo);

        $_SESSION['id'] = $id_usuario;

        header("location: ../vista/administrador/controladorVadmin.php?seccionAd=seccionAd1");

        exit();
    }
}
