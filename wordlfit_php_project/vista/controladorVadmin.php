<?php

$seccion_admin = "seccionAd1"; //Sección por defecto.

if (isset($_GET['seccionAd'])) {
    $seccion_admin = $_GET['seccionAd'];
}


include ("plantillaAdmin.php");
