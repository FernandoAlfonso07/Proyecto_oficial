<?php

if (!isset($_SESSION)) session_start();

$seccion = "seccion1"; //Sección por defecto.

if (isset($_GET['seccion'])) {
  $seccion = $_GET['seccion'];
}

if (isset($_SESSION['correo']))
  echo $_SESSION['correo'];
else {  
  header('location: inicioSesion.php');
}



include ("plantilla.php");
