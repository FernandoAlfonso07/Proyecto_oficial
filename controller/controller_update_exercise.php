<?php
// Incluye el archivo que contiene la clase Administrador para gestionar ejercicios
include_once ("../model/administrador.php");

// Incluye el archivo que contiene la clase validate para la sanitización de datos
include_once ("../model/validate.php");

include_once ('../model/exercise.php');

// Define los nombres de los campos que deben ser validados
$inputsValidate = ['newName', 'newinstructions', 'newEquipment', 'newSets', 'newRepetions', 'newBreakTime'];

// Valida que los campos de entrada no estén vacíos
if (validate::validateNotEmptyInputs($inputsValidate)) {
    // Sanitiza cada campo de entrada para prevenir ataques de inyección y asegurar la integridad de los datos
    $id = validate::sanitize($_POST['exerc']);
    $newName = validate::sanitize($_POST['newName']); // Sanitización del nombre del ejercicio
    $newInstructions = validate::sanitize($_POST['newinstructions']); // Sanitización de las instrucciones
    $newEquipment = validate::sanitize($_POST['newEquipment']); // Sanitización del equipo necesario
    $newRepetions = validate::sanitize($_POST['newRepetions']); // Sanitización de las repeticiones
    $newSets = validate::sanitize($_POST['newSets']); // Sanitización de las series
    $newbreakTime = validate::sanitize($_POST['newBreakTime']); // Sanitización del tiempo de descanso

    $currentImagePath = exercise::getInformationExercises(8, $id);

    // Sanitiza la URL proporcionada en el campo 'archivo_url' desde el formulario
    $pathFile = isset($_POST['archivo_url']) ? validate::sanitize($_POST['archivo_url']) : $currentImagePath;

    // Asigna la ruta del archivo o imagen
    $direccion_media = $pathFile;



    // Validación de repeticiones: debe ser un número entero positivo
    if (!filter_var($newRepetions, FILTER_VALIDATE_INT) || $newRepetions <= 0) {
        echo 'Entro en la validacio de las repticions';
        header("Location: ../view/administrador/controladorVadmin.php?error=notNumber&exerc=$id&seccionAd=updateExercises");
        exit();
    }

    // Validación del tiempo de descanso: debe ser un número entero positivo
    if (!filter_var($newbreakTime, FILTER_VALIDATE_INT) || $newbreakTime <= 0) {
        echo 'Entro en la validacio del tiempo de descanos  ';
        header("Location: ../view/administrador/controladorVadmin.php?error=notNumber&exerc=$id&seccionAd=updateExercises");
        exit();
    }

    // Validación de sets: debe ser un número entero positivo
    if (!filter_var($newSets, FILTER_VALIDATE_INT) || $newSets <= 0) {
        echo 'Entro en la validacio de las seies';
        header("Location: ../view/administrador/controladorVadmin.php?error=notNumber&exerc=$id&seccionAd=updateExercises");
        exit();
    }

    // Llama al método para actualizar el ejercicio y verifica el resultado
    $result = Administrador::updateExercises($id, $newName, $newInstructions, $newEquipment, $newSets, $newRepetions, $newbreakTime, $direccion_media);

    if ($result > 1) {
        // Muestra un mensaje de error si no fue posible registrar el ejercicio
        header("location: ../view/administrador/controladorVadmin.php?error=updateFailed&seccionAd=updateExercises");
        exit();

    } else {
        // Si la actualización es exitosa, redirige a la página de ver ejercicios
        header('location: ../view/administrador/controladorVadmin.php?success=updated&seccionAd=verEjercicios');
        exit(); // Finaliza la ejecución del script para asegurar que no se ejecute código adicional

    }

} else {
    // Redirige a la página de administración con un error si algún campo está vacío
    header("location: ../view/administrador/controladorVadmin.php?error=emptyFields&exerc=$id&seccionAd=updateExercises");
    exit();  // Finaliza la ejecución del script para asegurar que no se ejecute código adicional

}
