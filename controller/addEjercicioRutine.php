<?php
// Incluye el archivo que define la clase Administrador, proporcionando acceso a métodos relacionados con la administración.
include_once ("../model/administrador.php");

// Incluye el archivo que define la clase `validate`, que proporciona métodos para sanitizar entradas.
include_once ('../model/validate.php');

// Obtiene y sanitiza el valor del parámetro 'rutinaID' recibido por POST. 
// La sanitización previene la entrada de datos maliciosos.
$id_rutina = validate::sanitize($_POST['rutinaID']);

// Obtiene y sanitiza el valor del parámetro 'ejercicio_value' recibido por POST.
// La sanitización previene la entrada de datos maliciosos.
$id_ejercico = validate::sanitize($_POST['ejercicio_value']);

/**
 * Verifica si la combinación de id_rutina y id_ejercicio ya existe en la base de datos.
 * La función `Administrador::added_Exercises(0, $id_rutina, $id_ejercico)` consulta 
 * la base de datos y retorna el número de veces que esta combinación ya está presente.
 */
$cont = Administrador::added_Exercises(0, $id_rutina, $id_ejercico);

/**
 * Si la combinación ya existe (es decir, $cont > 0), redirige al usuario a la página 
 * de administración con un mensaje de error y un enlace para reintentar la operación.
 */
if ($cont > 0) {
    header('Location:  ../view/administrador/controladorVadmin.php?error=addedExercise&seccionAd=asociarEjerciciosRutinas');
    exit(); // Termina la ejecución del script después de la redirección.

} else {

    /**
     * Si la combinación no existe, intenta insertar la nueva combinación en la base de datos.
     * La función `Administrador::added_Exercises(1, $id_rutina, $id_ejercico)` inserta 
     * la combinación y retorna el número de filas afectadas por la operación.
     */
    $resultado = Administrador::added_Exercises(1, $id_rutina, $id_ejercico);

    // Verifica si la inserción fue exitosa. Si $resultado es menor o igual a 0, la inserción falló.
    if ($resultado <= 0) {
        // Muestra un mensaje de error si la inserción no fue exitosa.
        echo 'Error 3019 No fue posible asociar el ejercicio';
    } else {
        // Si la inserción fue exitosa, redirige al usuario a la página de administración con un mensaje de éxito.
        header('Location:  ../view/administrador/controladorVadmin.php?success=success&seccionAd=asociarEjerciciosRutinas');
        exit(); // Termina la ejecución del script después de la redirección.
    }
}