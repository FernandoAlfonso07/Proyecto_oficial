<?php
include_once ("../model/usuario.php");

include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../view/inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: ../view/inicioSesion.php");
    }
}


$name = $_GET['nameCalendar'];
$name = validate::sanitize($name); // Sanitización de la contraseña;

$description = $_GET['description'];
$description = validate::sanitize($description); // Sanitización de la contraseña;

$id_category = $_GET['id_category'];
$id_category = validate::sanitize($id_category); // Sanitización de la contraseña;



$resultado = usuarios::createCalender($opc, $_SESSION['id'], $name, $description, $id_category);

if ($resultado > 1) {
    echo 'No se creo correctamente el Calendario Rutinario';
} else {

    header('location: ../view/controlador.php?seccion=seccion1');
    exit();
}