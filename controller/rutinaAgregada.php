<?php
// Incluye el archivo que contiene la definición de la clase Administrador.
include_once ("../model/administrador.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

// Obtiene los valores de los parámetros enviados a través del método GET.

$nombreR = $_POST['nombreRutina'];
$nombreR = validate::sanitize($nombreR); // Sanitización de la contraseña;

$descripcionR = $_POST['Descripcion'];
$descripcionR = validate::sanitize($descripcionR); // Sanitización de la contraseña;

$objetivo = $_POST['objetivo'];
$objetivo = validate::sanitize($objetivo); // Sanitización de la contraseña;

$category = $_POST['id_category'];
$category = validate::sanitize($category); // Sanitización de la contraseña;




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