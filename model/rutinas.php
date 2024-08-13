<?php
include_once ("connect.php");


class routines extends conexionBD
{
    /**
     * Recupera información de la tabla 'rutinas' según el valor de $opc.}
     * 
     * @param int $opc Tipo de información a recuperar:
     *                 0 - ID de la rutina
     *                 1 - Nombre de la rutina
     *                 2 - Descripción de la rutina
     *                 3 - Objetivo de la rutina
     *                 4 - Fecha de registro de la rutina
     * @param int $id_routine ID de la rutina (aunque actualmente no se usa en la consulta)
     * @return mixed La información solicitada según el valor de $opc.
     */
    public static function getInformation($opc, $id_routine)
    {
        // Conexión a la base de datos
        $conexion = self::getConexion();


        // Consulta SQL para recuperar todas las columnas de la tabla 'rutinas' para un ID específico
        $sql = "SELECT * FROM rutinas WHERE id_rutina = $id_routine ";

        // Ejecutar la consulta
        $resultado = $conexion->query($sql);

        // Variable para almacenar el resultado
        $r = '';

        // Recorrer los resultados de la consulta
        while ($fila = $resultado->fetch_array()) {
            // Seleccionar la información según el valor de $opc
            $r = $fila[$opc] ?? null;
        }
        $conexion->close();
        // Retornar el resultado
        return $r;
    }


}