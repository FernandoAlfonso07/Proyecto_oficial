<?php

include_once ("connect.php");

class CycleCreateCalender extends conexionBD
{

    public static function getCatgory()
    {
        $conexion = self::getConexion();

        $sql = "select * FROM categorias_rutinas ";

        $result = $conexion->query($sql);

        $r = '';
        while ($fila = $result->fetch_array()) {

            $r .= "<option value=" . $fila[0] . ">" . $fila[1] . "</option>";

        }
        return $r;
    }

}