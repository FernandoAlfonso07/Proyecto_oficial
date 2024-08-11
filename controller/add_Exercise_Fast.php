<?php
// Incluye el archivo que contiene la clase Administrador para gestionar ejercicios
include_once ("../model/administrador.php");

// Incluye el archivo que contiene la clase validate para la sanitización de datos
include_once ('../model/validate.php');

// Define los nombres de los campos que deben ser validados
$inputsValidate = ['nombreEjercicio', 'instrucciones', 'equipo', 'repeticiones', 'series', 't_descanso'];

// Valida que los campos de entrada no estén vacíos
if (validate::validateNotEmptyInputs($inputsValidate)) {
    // Sanitiza cada campo de entrada para prevenir ataques de inyección y asegurar la integridad de los datos
    $nombre = validate::sanitize($_POST['nombreEjercicio']); // Sanitización del nombre del ejercicio
    $instruc = validate::sanitize($_POST['instrucciones']); // Sanitización de las instrucciones
    $equiped = validate::sanitize($_POST['equipo']); // Sanitización del equipo necesario
    $rep = validate::sanitize($_POST['repeticiones']); // Sanitización de las repeticiones
    $series = validate::sanitize($_POST['series']); // Sanitización de las series
    $tiempoDes = validate::sanitize($_POST['t_descanso']); // Sanitización del tiempo de descanso

    // Maneja la carga de archivos (si corresponde) y obtiene la ruta del archivo cargado
    if (isset($_POST['archivo'])) {
        // Maneja la carga de archivos
        echo "Antes de media()";
        $pathFile = validate::media(
            'archivo',
            '../view/administrador/controladorVadmin.php?error=incorrectFormat&seccionAd=asociarEjerciciosRutinas',
            '../view/media Exercises/'
        );
        echo "Después de media()";
        echo "Ruta del archivo: $pathFile";
    } else {
        // Sanitiza la URL proporcionada
        $pathFile = validate::sanitize($_POST['archivo_url']);
    }

    // Maneja la carga de archivos (si corresponde) y obtiene la ruta del archivo cargado
    $direccion_media = $pathFile;

    // Llama al método para agregar el ejercicio y verifica el resultado
    if (Administrador::agregarEjercicio($nombre, $instruc, $equiped, $rep, $series, $tiempoDes, $direccion_media) > 1) {
        // Muestra un mensaje de error si no fue posible registrar el ejercicio
        echo 'No fue posible el registro';

    } else {
        // Redirige a la página de ver ejercicios si el registro fue exitoso
        header('location: ../view/administrador/controladorVadmin.php?success=exito&seccionAd=asociarEjerciciosRutinas');
        exit(); // Finaliza la ejecución del script para asegurar que no se ejecute código adicional
    }

} else {
    // Redirige a la página de administración con un error si algún campo está vacío
    header('location: ../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=asociarEjerciciosRutinas');
    exit();  // Finaliza la ejecución del script para asegurar que no se ejecute código adicional
}
