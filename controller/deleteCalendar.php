<?php
!isset($_SESSION) ? session_start() : null;
include_once("../model/administrador.php");
include_once("../model/validate.php");

$_SESSION['calendarID'] = $_GET['cldr'] ?? null;
$_SESSION['calendarID'] = validate::sanitize($_SESSION['calendarID']);

$responseDelete = Administrador::delete_data("calendarUser", $_SESSION['calendarID']);

if ($responseDelete > 1) {
    header("Location: ../view/controlador.php?error=errorUpdateCalendar" . $_SESSION['calendarID'] . "&seccion=misCalendarios");
    exit();
} else {
    unset($_SESSION['calendarID']);
    header("Location: ../view/controlador.php?seccion=misCalendarios");
    exit();
}