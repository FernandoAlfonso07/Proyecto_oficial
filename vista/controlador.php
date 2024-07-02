<?php

if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['id'])) {
  header("location: inicioSesion.php");

} else {
  if ($_SESSION['id'] == "") {
    header("location: inicioSesion.php");
  }
}



// Identificador de secciones.

$seccion = "seccion1"; //Sección por defecto.

if (isset($_GET['seccion'])) {
  $seccion = $_GET['seccion'];
} else {
  header('location: inicioSesion.php');
}



include ("plantilla.php");
