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
            $r .= "<option value='" . $fila[0] . "'>" . $fila[1] . "</option>";
        }
        return $r;
    }



    public static function showFormuler($nameDay, $id_filterCategory, $id_filterRoutines, $nameId_Routine)
    {
        $salida = '';

        $salida .= '<div class="row my-5">';
        $salida .= '<div class="col-md-8">';

        $salida .= '</div>';
        $salida .= '<div class="col-md-4">';
        $salida .= "<select class='form-select' name='id_filterCategory' id='$id_filterCategory' onChange='hola(event,\"$id_filterRoutines\")'>";
        $salida .= 'aria-label="Default select example">';
        $salida .= '<option selected>Seleccione la categoria</option>';

        // Consulta para obtener las categorias y agregarlas a un SELECT

        $conexion = conexionBD::getConexion();

        $sql = 'SELECT * FROM categorias_rutinas ';

        $result = mysqli_query($conexion, $sql);

        while ($fila = $result->fetch_array()) {

            $salida .= "<option value='" . $fila[0] . "'>" . $fila[1] . "</option>";

        }

        $salida .= ' </select>';
        $salida .= '</div>';
        $salida .= '<div class="col-md-6 my-2">';
        $salida .= "<b>$nameDay</b>";
        $salida .= '</div>';
        $salida .= '<div class="col-md-6 my-2">';
        $salida .= "<select class='form-select' name='$nameId_Routine' id='$id_filterRoutines' aria-label='Default select example'>";
        $salida .= '<option selected>Seleccione una rutina</option>';

        // <!-- Aqui se deben renderizar las rutinas segun el parametro de categoria elegido -->

        $salida .= '</select>';
        $salida .= ' </div>';

        $salida .= ' </div>';

        return $salida;
    }



}