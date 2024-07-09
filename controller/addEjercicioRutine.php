<?php

include_once ("../model/administrador.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

// Obtener los valores de los parámetros GET
$id_rutina = $_GET['rutinaID'];
$id_rutina = validate::sanitize($id_rutina); // Sanitización de la contraseña;

$id_ejercico = $_GET['ejercicio_value'];
$id_ejercico = validate::sanitize($id_ejercico); // Sanitización de la contraseña;

/**
 * Verificar si la combinación de id_rutina y id_ejercicio ya existe.
 * La función admin::added_Exercises(0, $id_rutina, $id_ejercicio) retorna el 
 * número de veces que la combinación ya está presente en la tabla.
 */
$cont = Administrador::added_Exercises(0, $id_rutina, $id_ejercico);



/**
 * Si la combinación ya existe, mostrar un mensaje de error y un enlace para 
 * reintentar la operación.
 */
if ($cont > 0) {
    echo 'Error 4101 YA SE AGREGO EL EJERCICIO';
    echo '<a href=" ../view/administrador/controladorVadmin.php?seccionAd=addRutina">Reintertar</a>';

} else {

    /**
     * Si la combinación no existe, intentar insertar la nueva combinación.
     * La función Administrador::added_Exercises(1, $id_rutina, $id_ejercicio) inserta 
     * la nueva combinación en la tabla y retorna el número de filas afectadas.
     */
    $resultado = Administrador::added_Exercises(1, $id_rutina, $id_ejercico);

    if ($resultado <= 0) {
        /**
         * Si la inserción no fue exitosa (resultado <= 0), mostrar un mensaje de error.
         */
        echo 'Error 3019 No fue posible asociar el ejercicio';
    } else {
        // Si la inserción fue exitosa, redirigir a la página asociarEjerciciosRutinas.php

        header('Location:  ../view/administrador/controladorVadmin.php?seccionAd=asociarEjerciciosRutinas');
        exit();

    }
}