<?php

include_once ('../model/connect.php');

if (isset($_GET['entrenamientos'])) {

    $entrenamiento = $_GET['entrenamientos'];

    $conexion = conexionBD::getConexion();

    $sql = "SELECT id_rutina, nombreRutina FROM rutinas WHERE id_categoria = '$entrenamiento' ";
    $result = $conexion->query($sql);

    if ($entrenamiento == '') {
        echo 'No hay una rutina con esa categoria';
    } else {
        while ($fila = $result->fetch_array()) {

            echo "<option value='" . $fila[0] . "'>" . $fila[1] . "</option>";

        }
    }

}
