<?php

include ("../model/usuario.php");

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id']))
    $_SESSION['id'] = "";

$correo = $_GET['correo'];
$password = $_GET['password'];


if (usuarios::iniciarSesion(0, $correo, $password) >= 1) {

    $id_usuario = usuarios::buscarId($correo);

    $_SESSION['id'] = $id_usuario;

    header("location: ../vista/controlador.php?seccion=seccion1");
} else {
    header("location: errores/errorRegister.php");
}
