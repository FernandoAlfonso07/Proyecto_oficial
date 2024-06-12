<?php

include ("../model/CiniciarSesion.php");

$correo = $_GET['correo'];
$contraseña = $_GET['contraseña'];

if (iniciarSesion::iniciarSesion($correo, $contraseña) >= 1) {
    header("location: ../vista/controlador.php?seccion=seccion1");
} else {
    header("location: ../vista/inicio-principal.php");
}