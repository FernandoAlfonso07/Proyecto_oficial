<?php
include_once ("../model/usuario.php");

include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

include_once ('../model/calendarioRutinario.php');


if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../view/inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: ../view/inicioSesion.php");
    }
}


$page = $_GET['page'];

if ($page == '1ro') {

    $name = $_GET['nameCalendar'];
    $name = validate::sanitize($name); // Sanitización del nombre del calendario.

    $description = $_GET['description'];
    $description = validate::sanitize($description); // Sanitización de la descripcion


    $result = usuarios::createCalender(0, $_SESSION['id'], $name, $description, null, null, null);
    if ($result > 1) {
        echo 'No se creo correctamente el Calendario Rutinario code error';
    } else {

        header('location: ../view/controlador.php?seccion=createCalender2do');
        exit();
    }

} elseif ($page == '2do') {

    if (!isset($_SESSION))
        session_start();

    if (!isset($_SESSION['id_calendar'])) {
        $id = calendarioRutinario::getID();
        $_SESSION['id_calendar'] = $id;
    }

    $result2 = usuarios::createCalender(1, null, null, null, $_SESSION['id_calendar'], $id_day, $id_routine);

    if ($result2 > 1) {
        echo 'Algo ocurrio mal';
    } else {
        header('location: ../view/controlador.php?seccion=seccion1');
        exit();
    }


}



