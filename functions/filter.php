<?php
// Incluir el archivo de conexión a la base de datos
include_once ('../model/connect.php');

// Verificar si el parámetro 'entrenamientos' está presente en la URL
if (isset($_GET['entrenamientos'])) {

    // Obtener el valor del parámetro 'entrenamientos' de la URL
    $entrenamiento = $_GET['entrenamientos'];

    // Obtener una instancia de la conexión a la base de dat
    $conexion = conexionBD::getConexion();

    // Preparar la consulta SQL para seleccionar las rutinas con la categoría especificada
    $sql = "SELECT id_rutina, nombreRutina FROM rutinas WHERE id_categoria = '$entrenamiento' ";
    $result = $conexion->query($sql);

    // Verificar si el parámetro 'entrenamiento' está vacío
    if ($entrenamiento == '') {
        echo 'No hay una rutina con esa categoria';
    } else {
        // Imprimir un mensaje si no hay una rutina con la categoría especificada
        while ($fila = $result->fetch_array()) {
            echo "<option value='" . $fila[0] . "'>" . $fila[1] . "</option>";
        }
    }
}
