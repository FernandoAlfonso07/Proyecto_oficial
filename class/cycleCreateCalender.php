<?php

include_once ('../../model/connect.php');

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

    public static function showCyle()
    {

        $conexion = self::getConexion();

        $r = '';
        for ($i = 1; $i <= 6; $i++) {

            $sql = "select nombre FROM dias_semana WHERE id_dia = $i";

            $result = $conexion->query($sql);

            while ($fila = $result->fetch_array()) {

                $r .= '<div class="row">';
                $r .= '<div class="col-md-6">';
                $r .= $fila[0];
                $r .= '</div>';
                $r .= '<div class="col-md-6">';
                $r .= '<select class="form-select my-2" aria-label="Default select example">';
                $r .= '<option selected>Selecciona la categoria</option>';
                $r .= self::getCatgory();
                $r .= '</select>';
                $r .= '</div>';
                $r .= '</div>';

            }
        }
        return $r;
    }
}

