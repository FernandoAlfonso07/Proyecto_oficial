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
            switch ($opc) {
                case 0:
                    $r = $fila[0]; // Trae el ID de la rutina
                    break;
                case 1:
                    $r = $fila[1]; // Trae el nombre de la rutina
                    break;
                case 2:
                    $r = $fila[2]; // Trae la descripción de la rutina
                    break;
                case 3:
                    $r = $fila[3]; // Trae el objetivo de la rutina
                    break;
                case 4:
                    $r = $fila[4]; // Trae la fecha de registro de la rutina
                    break;
            }

        }

        // Retornar el resultado
        return $r;
    }
}