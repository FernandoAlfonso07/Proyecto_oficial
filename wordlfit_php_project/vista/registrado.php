<?php
include ("claseRegistro.php");
$nombre = $_GET['nombreU'];
$correoUsuario = $_GET['correoU'];
$contraseñaUsuario = $_GET['contraseñaU'];
$pesoActual = $_GET['pesoActualU'];
$alturaActual = $_GET['alturaActualU'];
$generoBoolean = $_GET['generoU'];

registrar::registrarUsuario($nombre, $correoUsuario, $contraseñaUsuario, $pesoActual, $alturaActual, $generoBoolean);