<?php
// Verifica si la sesión no está iniciada y, si es así, inicia una nueva sesión.
!isset($_SESSION) ? session_start() : null;

// Incluye el archivo que contiene las funciones de validación.
include_once ("../model/validate.php");

// Obtiene el valor del ID de usuario desde la sesión actual. Si no está definido, se asigna null.
$id_usuario = $_SESSION['id'] ?? null;

// Llama a la función validateCountsDatas() del modelo 'validate' para contar los calendarios asociados al usuario.
// El primer parámetro es 0, el segundo parámetro es el ID del usuario, y el tercer parámetro es "countCalendars".
$count = validate::validateCountsDatas(0, $id_usuario, "countCalendars");

// Si el número de calendarios es mayor o igual a 2, redirige al usuario a la página de planes.
// Luego se termina el script para evitar la ejecución de código adicional.
$countpurchasedplan = validate::validateCountsDatas($_SESSION['id'], "purchase count");
if ($count >= 2) {
    if ($countpurchasedplan >= 1) {
        header("Location: ../view/controlador.php?seccion=createCalender");
        exit();
    } else {
        header("Location: ../view/pages/plans.php");
        exit();
    }
} else {
    header("Location: ../view/controlador.php?seccion=createCalender");
    exit();
}