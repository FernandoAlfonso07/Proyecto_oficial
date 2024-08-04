<?php
// Incluye el archivo 'administrador.php' que contiene la clase Administrador con métodos relacionados con la administración de datos.
include_once ("../model/administrador.php");

// Incluye el archivo 'validate.php' que proporciona la clase validate para sanitizar datos de entrada. 
include_once ('../model/validate.php');

// Sanitiza la entrada para el parámetro 'idRelacion' o 'id_ejercicio'. Se usa sanitize para evitar problemas de seguridad.
$id_data = isset($_GET['idRelacion']) ? validate::sanitize($_GET['idRelacion']) : validate::sanitize($_GET['id_ejercicio']);

// Verifica si el parámetro 'iroutine' está presente en la URL. Si está presente, se asigna a $id_ejercicio; de lo contrario, se asigna null.
$id_ejercicio = isset($_GET['iroutine']) ? $_GET['iroutine'] : null;

// Determina qué tipo de eliminación se debe realizar según si el parámetro 'mtDelete' está presente en la URL.
// Llama a 'delete_data' de la clase Administrador con el tipo de eliminación y el id_data como argumentos.
$resultado = isset($_GET['mtDelete']) ? Administrador::delete_data(3, $id_data) : Administrador::delete_data(1, $id_data);

// Verifica el resultado de la operación de eliminación.
// Si el resultado es mayor a 1, se considera que hubo un error y se muestra un mensaje de error.
if ($resultado > 1) {
    echo 'Error 310 | No fue posible el DELETE';
} else {

    // Si 'mtDelete' no está presente, redirige al usuario a la página de ver ejercicios.
    if (!isset($_GET['mtDelete'])) {
        header('Location: ../view/administrador/controladorVadmin.php?seccionAd=verEjercicios');
        exit();

    } else {
        // Si 'mtDelete' está presente, redirige al usuario a la página de asociar ejercicios con rutinas.
        // Se pasa el id_ejercicio como parámetro en la URL.
        header('Location: ../view/administrador/controladorVadmin.php?rtu=' . $id_ejercicio . '&seccionAd=asociarEjerciciosRutinas');
        exit();

    }
}