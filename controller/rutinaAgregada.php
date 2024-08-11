<?php
// Incluye el archivo que contiene la definición de la clase Administrador.
include_once ("../model/administrador.php");

// Incluye el archivo que contiene la clase para validación y sanitización de entradas.
include_once ('../model/validate.php');

// Obtiene el valor de 'dRoutine' de la URL y lo asigna a $id_routine, o establece $id_routine como null si no está presente.
$id_routine = isset($_GET['dRoutine']) ? $_GET['dRoutine'] : null;

// Define un array con los nombres de los campos de entrada que deben ser validados.
$inputsValidate = ['nombreRutina', 'Descripcion', 'objetivo', 'id_category'];

// Valida que los campos de entrada definidos en $inputsValidate no estén vacíos.
if (validate::validateNotEmptyInputs($inputsValidate)) {


    $nombreR = validate::sanitize($_POST['nombreRutina']);// Sanitiza la entrada para el nombre de la rutina.
    $descripcionR = validate::sanitize($_POST['Descripcion']);// Sanitiza la entrada para la descripción de la rutina.
    $objetivo = validate::sanitize($_POST['objetivo']);// Sanitiza la entrada para el objetivo de la rutina.
    $category = validate::sanitize($_POST['id_category']);// Sanitiza la entrada para la categoría de la rutina.

    // Si 'dRoutine' está presente en la URL, actualiza la rutina existente.
    if (isset($_GET['dRoutine'])) {
        $respuesta = Administrador::updateRoutine($id_routine, $category, $nombreR, $descripcionR, $objetivo);

    } else {
        // Si 'dRoutine' no está presente, agrega una nueva rutina.
        $respuesta = Administrador::agregarRutina($category, $nombreR, $descripcionR, $objetivo);
    }
    // Verifica la respuesta de la operación.
    if ($respuesta > 1) {
        // Si la respuesta es mayor a 1, muestra un mensaje de error indicando que el registro falló.
        echo 'No fue posible el registro error 1001021';

    } else {
        // Si la respuesta es 1 o menor, redirige al controlador del administrador en la sección especificada.
        if (!isset($_GET['dRoutine'])) {
            header('location: ../view/administrador/controladorVadmin.php?success=add&seccionAd=asociarEjerciciosRutinas');
            exit();

        } else {
            header('location: ../view/administrador/controladorVadmin.php?success=updated&rtu=' . $id_routine . '&seccionAd=asociarEjerciciosRutinas');
            exit();
        }
    }
} else {
    // Si algún campo está vacío, redirige al controlador del administrador con un mensaje de error.
    header('location: ../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=addRutina');
    exit();
}