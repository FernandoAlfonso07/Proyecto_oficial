<?php
include ('installer/config.php');

// Intentar conectar a la base de datos
try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Configurar el manejo de errores PDO para que lance excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si la conexión se realiza correctamente, redirige al controlador
    header("Location: view/index.php");
    exit;
} catch (PDOException $e) {
    // Si hay un error de conexión, redirige al instalador
    header("Location: installer/installer.php");
    exit;
}