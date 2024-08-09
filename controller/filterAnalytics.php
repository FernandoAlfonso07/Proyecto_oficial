<?php
include_once ("../model/administrador.php");

// Obtener datos del POST
$dateStart = isset($_POST['dateStart']) ? $_POST['dateStart'] : null;
$dateEnd = isset($_POST['dateEnd']) ? $_POST['dateEnd'] : null;

// Verificar que se han proporcionado fechas
if ($dateStart && $dateEnd) {
    // Llamar al método viewAnalytics del modelo
    $response = Administrador::viewAnalytics($dateStart, $dateEnd, 'like');

    // Establecer el encabezado de la respuesta a JSON
    header('Content-Type: application/json');

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
} else {
    // Enviar un mensaje de error si las fechas no están proporcionadas
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Fechas no proporcionadas']);
}