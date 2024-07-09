<?php
// Incluye el archivo que contiene la definición de la clase Administrador.
include ("../model/administrador.php");

// Obtiene los valores de los parámetros enviados a través del método GET.
$nombreR = $_GET['nombreRutina'];
$descripcionR = $_GET['Descripcion'];
$objetivo = $_GET['objetivo'];
$category = $_GET['id_category'];

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