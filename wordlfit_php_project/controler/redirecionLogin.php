<?php

include ("../model/CiniciarSesion.php");

if (!isset($_SESSION))
    session_start();


if (isset($_SESSION['correo']))
    $_SESSION['correo'] = '';

$correo = $_GET['correo'];
$contraseña = $_GET['contraseña'];

if (iniciarSesion::iniciarSesion($correo, $contraseña) >= 1) {
    $_SESSION['correo'] = $correo;
    header("location: ../vista/controlador.php?seccion=seccion1");
} else {
    header("location: ../vista/inicio-principal.php");
}