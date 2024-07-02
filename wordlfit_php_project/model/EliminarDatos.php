<?php

include ("connect.php");


class EliminarDatos
{

    public static $opc;
    public static $id_tabla;


    public static function eliminarDatos($opc, $id_tabla)
    {

        $conexion = conexionBD::getConexion();


        if ($opc == 1) {
            $nombreTabla = 'ejercicio_rutinas';
            $nombreCampo = 'id_ejercicio';
        }
        if ($opc == 2) {
            $nombreTabla = 'ejercicios';
            $nombreCampo = 'id_ejercicio';
        }

        $sql = "delete from $nombreTabla where $nombreCampo = $id_tabla; ";

        $resultado = $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();

    }


    public static function borrarAmbos($id_tabla)
    {

        $conteo = 0;

        if (EliminarDatos::eliminarDatos(1, $id_tabla)) {
            $conteo++;
        }
        if (EliminarDatos::eliminarDatos(2, $id_tabla)) {
            $conteo++;
        }

        return $conteo;
    }

}