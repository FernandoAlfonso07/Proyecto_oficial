<?php
session_start();
// Verifica qué tipo de sesión se debe cerrar
if (isset($_GET['type'])) {
    $type = $_GET['type'];

    if ($type == 'admin' && isset($_SESSION['id_admin'])) {
        unset($_SESSION['id_admin']);
        unset($_SESSION['intento']);  // Elimina la sesión intento
    }

    if ($type == 'user' && isset($_SESSION['id'])) {
        unset($_SESSION['id']);
        unset($_SESSION['intento']);  // Elimina la sesión intento
    }
}

// Redirige al inicio de sesión
header('Location: ../view/inicioSesion.php');
exit();