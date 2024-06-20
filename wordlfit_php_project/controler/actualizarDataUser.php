<?php

include ("../model/usuario.php");

if (!isset($_SESSION))
    session_start();


if (!isset($_SESSION['correo']))
    $_SESSION['correo'] = '';

$id_usuario = usuarios::buscarId($correoU);

$respuesta = usuarios::actualizarDatos($id_usuario, $nombres, $apellidos, $telefono, $pr, $pesoActual, $altura);

if ($respuesta > 0) {
    echo 'Error 1000';
} else {
    header('Location ../vista/controlador?seccion=MiPerfil');
}

