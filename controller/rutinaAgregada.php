<?php
// Incluye el archivo que contiene la definición de la clase Administrador.
include_once("../model/administrador.php");
// Incluye el archivo que contiene la clase para validación y sanitización de entradas
include_once('../model/validate.php');

// Define los nombres de los campos de entrada a validar.
$inputsValidate = ['nombreRutina', 'Descripcion', 'objetivo', 'id_category'];

// Valida que los campos de entrada no estén vacíos.
if (validate::validateNotEmptyInputs($inputsValidate)) {

    // Sanitiza las entradas recibidas a través del método POST.
    $nombreR = validate::sanitize($_POST['nombreRutina']);  // Sanitización del nombre de la rutina.
    $descripcionR = validate::sanitize($_POST['Descripcion']);  // Sanitización de la descripción.
    $objetivo = validate::sanitize($_POST['objetivo']);  // Sanitización del objetivo.
    $category = validate::sanitize($_POST['id_category']); // Sanitización de la categoría.

    // Llama al método agregarRutina de la clase Administrador para agregar una nueva rutina.
    $respuesta = Administrador::agregarRutina($category, $nombreR, $descripcionR, $objetivo);

    // Verifica la respuesta de la operación.
    if ($respuesta > 1) {
        // Si la respuesta es mayor a 1, indica que hubo un error en el registro.
        echo 'No fue posible el registro error 1001021';
    } else {
        // Si la respuesta es 1 o menor, redirige al controlador del administrador en la sección especificada.
        header('location: ../view/administrador/controladorVadmin.php?seccionAd=asociarEjerciciosRutinas');
        exit();
    }
} else {
    // Si los campos están vacíos, redirige al controlador del administrador con un mensaje de error.
    header('location: ../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=asociarEjerciciosRutinas');
    exit();
}
