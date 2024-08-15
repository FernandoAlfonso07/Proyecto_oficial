<?php
// Inicia la sesión si aún no está iniciada.
!isset($_SESSION) ? session_start() : null;

// Incluye los archivos necesarios para manejar usuarios y validación.
include_once("../model/usuario.php");
include_once("../model/validate.php");

// Define los campos que se requieren en el formulario.
$fields = ['nameCalendar', 'description'];

// Verifica que los campos no estén vacíos; si algún campo está vacío, redirige a una página de error.
if (!validate::validateNotEmptyInputs($fields)) {
    header("Location: ../view/controlador.php?error=emptyFields&seccion=createCalender");
    exit();
}

// Asigna y limpia los valores de los campos enviados por POST.
foreach ($fields as $field) {
    ${$field} = isset($_POST[$field]) ? validate::sanitize($_POST[$field]) : null;
}

// Actualiza el calendario en la base de datos usando los valores y el ID del calendario de la sesión.
$response = usuarios::updateCalendar($nameCalendar, $description, $_SESSION['calendarID']);

// Redirige según el resultado de la actualización: muestra un error si la respuesta es mayor que 1 o limpia el ID de la sesión y redirige a la lista de calendarios.
if ($response > 1) {
    header("Location: ../view/controlador.php?error=updateCalendar" . $_SESSION['calendarID'] . "&seccion=createCalender");
    exit();
} else {
    unset($_SESSION['calendarID']); // Elimina la variable utilizada.
    header("Location: ../view/controlador.php?seccion=misCalendarios");
    exit();
}
