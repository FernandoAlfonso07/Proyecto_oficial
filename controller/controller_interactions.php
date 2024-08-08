<?php
include_once ("../model/usuario.php");  // Incluye la clase `usuarios`.
include_once ("../model/interactions.php"); // Incluye la clase `Interactions`.

if (!isset($_POST['accion']) || !isset($_POST['id_routine']) || !isset($_POST['id_usu'])) {
    // Verifica que los parámetros necesarios estén en la solicitud.
    echo "Solicitud Denegada";
    exit(); // Termina el script si falta algún parámetro.
}

$user = $_POST['id_usu']; // Asigna el ID de usuario.
$routine = $_POST['id_routine']; // Asigna el ID de rutina.

// Obtiene el conteo de "likes" para el usuario y rutina.
$countInteractions = Interactions::validate_interaction($user, $routine, 1);

// Obtiene el tipo de interacción actual.
$typeInteraction = Interactions::validate_interaction($user, $routine, 2);

if ($_POST['accion'] == 'like') {
    // Validar la interacción existente

    if ($countInteractions == 0) {
        // Si no hay interacción, insertar un nuevo "like"
        $insert = usuarios::giveLike('like', $user, $routine);

        if ($insert <= 0) {
            echo "Ocurrió un error al intentar dar like";
        } else {
            // Respuesta al cliente: "like" insertado correctamente
            echo "<i class='fa-solid fa-heart like text-danger'></i>";
        }
    } else {
        // Si hay interacción, actualizar el estado del "like" a "dislike"
        if ($typeInteraction == 'like') {
            $update = usuarios::updateInteractions('dislike', $user, $routine);

            if ($update <= 0) {
                echo "No se pudo actualizar el estado";
            } else {
                // Respuesta al cliente: "like" actualizado a "dislike"
                echo "<i class='fa-solid fa-heart like'></i>";
            }
        } elseif ($typeInteraction == 'dislike') {
            // Si hay interacción, actualizar el estado del "like" a "dislike"
            $update = usuarios::updateInteractions('like', $user, $routine);

            if ($update <= 0) {
                echo "No se pudo actualizar el estado";
            } else {
                // Respuesta al cliente: "dislike" actualizado a "like"
                echo "<i class='fa-solid fa-heart like text-danger'></i>";
            }
        }
    }
} else {
    echo "Solicitud Denegada";
}