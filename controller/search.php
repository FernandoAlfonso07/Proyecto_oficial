<?php
include_once("../model/connect.php");
include_once("../model/validate.php");
include_once("../model/gyms.php");

$connect = conexionBD::getConexion();
$salida = "";

// Verifica si se ha enviado 'param1' por POST
if (isset($_POST['param1'])) {
    $q = validate::sanitize($_POST['param1']);
    
    // Llama al procedimiento almacenado con la variable de búsqueda
    $query = "CALL SearchGyms('$q')";
    
    // Ejecuta la consulta
    $resultado = $connect->query($query);
    
    // Verifica si hay resultados
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $salida .= '<div class="show-gyms-container">
                    <div class="show-gyms-content">
                        <div class="show-gyms-header">
                            <h1>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</h1>
                            <p>' . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . '</p>
                        </div>
                        <div class="show-gyms-info">
                            <div class="info-section">
                                <h3>MISION</h3>
                                <p>' . htmlspecialchars($row['mission'], ENT_QUOTES, 'UTF-8') . '</p>
                            </div>
                            <div class="info-section">
                                <h3>VISION</h3>
                                <p>' . htmlspecialchars($row['vision'], ENT_QUOTES, 'UTF-8') . '</p>
                            </div>
                        </div>
                        <div class="show-gyms-footer">
                            <a href="controlador.php?gymid=' . $row['id'] . '&seccion=infoThisGym">
                                <button type="button">Ver Más</button>
                            </a>
                        </div>
                    </div>
                    <div class="show-gyms-image">
                        <img src="' . htmlspecialchars($row['pathImage'], ENT_QUOTES, 'UTF-8') . '" alt="Imagen del Gimnasio ' . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . '">
                    </div>
                </div>';
        }
    } else {
        $salida = "No se encontraron registros con valor " . htmlspecialchars($q, ENT_QUOTES, 'UTF-8');
    }
    
    // Libera el conjunto de resultados
    $resultado->free();
}

// Cierra la conexión
$connect->close();

// Imprime la salida
echo $salida;