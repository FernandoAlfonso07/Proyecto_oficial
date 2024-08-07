<?php
include_once ("../model/validate.php");

// Obtener datos de conexión
$host = validate::sanitize($_POST['hostBD']);
$db_name = validate::sanitize($_POST['nameBD']);
$username = validate::sanitize($_POST['userBD']);
$password = validate::sanitize($_POST['passwordBD']);

// Conexión al servidor MySQL
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Error de conexión: " . htmlspecialchars($conn->connect_error));
}

// Crear base de datos
$sql = "CREATE DATABASE IF NOT EXISTS `$db_name`";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos $db_name creada con éxito.<br>";
} else {
    die("Error creando la base de datos: " . htmlspecialchars($conn->error));
}

// Seleccionar base de datos
$conn->select_db($db_name);

// Leer y ejecutar el archivo schemaWorlfit.sql
$dump_file = 'schemaWorlfit.sql';
if (file_exists($dump_file)) {
    $sql = file_get_contents($dump_file);
    if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());

        // Leer y ejecutar el archivo extrasBD.sql
        $functions_file = 'extrasBD.sql';
        if (file_exists($functions_file)) {
            $sql = file_get_contents($functions_file);

            // Reemplazar delimitadores para manejar correctamente los triggers
            $sql = str_replace('DELIMITER ;;', '', $sql);
            $sql = str_replace(';;', ';', $sql);

            if ($conn->multi_query($sql)) {
                do {
                    if ($result = $conn->store_result()) {
                        $result->free();
                    }
                } while ($conn->next_result());
                echo "Funciones y triggers instalados con éxito.<br>";

                // Guardar datos de conexión en config.php
                $config_content = "<?php\n";
                $config_content .= "define('DB_HOST', '$host');\n";
                $config_content .= "define('DB_NAME', '$db_name');\n";
                $config_content .= "define('DB_USER', '$username');\n";
                $config_content .= "define('DB_PASS', '$password');\n";
                file_put_contents('config.php', $config_content);

                // Redirigir al index.php para realizar nueva validacion
                header('Location: ../index.php');
                exit;
            } else {
                die("Error instalando funciones y triggers: " . htmlspecialchars($conn->error));
            }
        } else {
            die("Archivo funciones.sql no encontrado.<br>");
        }
    } else {
        die("Error instalando las tablas: " . htmlspecialchars($conn->error));
    }
} else {
    die("Archivo schemaWorlfit.sql no encontrado.<br>");
}

$conn->close();