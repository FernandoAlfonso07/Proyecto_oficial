<?php
include_once ("../model/usuario.php"); // Se incluye el modelo de usuario

include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

include_once ('../model/calendarioRutinario.php'); // Se incluye el modelo de calendario rutinario

include_once ('../functions/insertsCalendar.php'); // Se incluyen las funciones para insertar en el calendario


if (!isset($_SESSION))
    session_start(); // Inicia la sesión si no está iniciada

// Verifica si el usuario está autenticado, de lo contrario redirige al inicio de sesión
if (!isset($_SESSION['id'])) {
    header("location: ../view/inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: ../view/inicioSesion.php");
    }
}


$page = $_GET['page']; // Obtiene el parámetro 'page' desde la URL

// Proceso basado en el valor de 'page'
if ($page == '1ro') {

    // Proceso para la primera parte de la creación del calendario
    $name = $_GET['nameCalendar']; // Obtiene el nombre del calendario desde la URL
    $name = validate::sanitize($name); // Sanitiza el nombre del calendario utilizando una clase validate

    $description = $_GET['description']; // Obtiene la descripción del calendario desde la URL
    $description = validate::sanitize($description); // Sanitiza la descripción del calendario

    // Llama al método estático 'createCalender' del modelo de usuario para crear el calendario
    $result = usuarios::createCalender(0, $_SESSION['id'], $name, $description, null, null, null);
    if ($result > 1) {
        echo 'No se creo correctamente el Calendario Rutinario code error';
    } else {

        // Redirige al usuario a la siguiente parte del proceso
        header('location: ../view/controlador.php?seccion=createCalender2do');
        exit();
    }

} elseif ($page == '2do') {

    // Proceso para la segunda parte de la creación del calendario
    if (!isset($_SESSION))
        session_start();  // Inicia la sesión si no está iniciada (esto ya se hizo arriba)

    if (!isset($_SESSION['id_calendar'])) {

        // Si no existe la variable de sesión 'id_calendar', la obtiene del modelo de calendario rutinario
        $id = calendarioRutinario::getID();
        $_SESSION['id_calendar'] = $id;

        echo 'Variable NACIDA: ' . $_SESSION['id_calendar'] . '<br>';

    } else {

        $id = calendarioRutinario::getID();
        $_SESSION['id_calendar'] = $id;

        echo 'Variable EXISTIENDO: ' . $_SESSION['id_calendar'] . '<br>';
    }

    $arrayNameRoutine = [ // Arreglo que mapea nombres de rutinas a números de días

        'Routine_Of_Monday' => 1,
        'Routine_Of_Tuesday' => 2,
        'Routine_Of_Wednesday' => 3,
        'Routine_Of_Thursday' => 4,
        'Routine_Of_Friday' => 5,
        'Routine_Of_Saturday' => 6

    ];

    // Recorre el arreglo y realiza acciones para cada nombre de rutina
    foreach ($arrayNameRoutine as $routineParam => $dayNumber) { // Obtiene el ID de la rutina desde la URL
        $id_routine = $_GET[$routineParam];

        // Inserta el ID del calendario, el número de día y el ID de la rutina en la tabla correspondiente
        $result = inserts::run($_SESSION['id_calendar'], $dayNumber, $id_routine);

        if ($result > 1) {
            echo "Ocurrio un error en el registro de la rutina del día $dayNumber";
            exit();
        } else {

            // Si la inserción fue exitosa, redirige al usuario a la página de sus calendarios
            echo 'Todo insertado exitosamente ';
            header('location: ../view/controlador.php?seccion=misCalendarios');
            exit();
        }
    }

}



