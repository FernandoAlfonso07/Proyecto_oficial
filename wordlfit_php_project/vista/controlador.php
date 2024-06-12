<?php

$seccion = "seccion1"; //Sección por defecto.

if (isset($_GET['seccion'])) {
  $seccion = $_GET['seccion'];
}

//echo $seccion;

include("plantilla.php");
