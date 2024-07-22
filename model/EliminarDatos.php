<?php

include_once ("connect.php");

/**
 * Clase para la eliminación de datos en la base de datos.
 * 
 * Esta clase extiende `conexionBD` y proporciona un método para eliminar registros de
 * diferentes tablas en la base de datos basándose en un identificador específico.
 * 
 * @property int $opc Opcional. Determina la tabla de la cual se eliminarán los datos.
 * @property int $id_tabla El identificador del registro que se desea eliminar.
 */
class EliminarDatos extends conexionBD
{

    /**
     * Opcional. Determina la tabla de la cual se eliminarán los datos.
     * 
     * @var int
     */
    public static $opc;

    /**
     * El identificador del registro que se desea eliminar.
     * 
     * @var int
     */
    public static $id_tabla;


    /**
     * Elimina un registro de la base de datos basado en el identificador proporcionado.
     * 
     * Este método elimina un registro de una tabla específica según el valor de `$opc`
     * y el identificador proporcionado en `$id_tabla`. La conexión a la base de datos es
     * gestionada por la clase base `conexionBD`.
     * 
     * @param int $opc Determina la tabla de la cual se eliminarán los datos.
     *                 - `1` para la tabla `ejercicio_rutinas`
     *                 - `2` para la tabla `ejercicios`
     * @param int $id_tabla El identificador del registro que se desea eliminar.
     * 
     * @return void
     */
    public static function eliminarDatos($opc, $id_tabla)
    {

        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Determinar la tabla y el campo basado en el valor de $opc
        if ($opc == 1) {
            $nombreTabla = 'ejercicio_rutinas';
            $nombreCampo = 'id_ejercicio';
        }
        if ($opc == 2) {
            $nombreTabla = 'ejercicios';
            $nombreCampo = 'id_ejercicio';
        }

        // Crear la consulta SQL para eliminar el registro
        $sql = "delete from $nombreTabla where $nombreCampo = $id_tabla; ";

        // Ejecutar la consulta
        $conexion->query($sql);

        // Obtener el número de filas afectadas
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

    }


    /**
     * Elimina registros de dos tablas diferentes basándose en el identificador proporcionado.
     * 
     * Este método utiliza la clase `EliminarDatos` para eliminar un registro de las tablas
     * `ejercicio_rutinas` y `ejercicios`, ambos asociados con el identificador dado.
     * 
     * @param int $id_tabla El identificador del registro que se desea eliminar de ambas tablas.
     * 
     * @return int El número de registros eliminados exitosamente. Retorna `2` si los registros
     *              fueron eliminados de ambas tablas, `1` si se eliminó de una sola tabla, o `0`
     *              si no se eliminó ningún registro.
     */
    public static function borrarAmbos($id_tabla)
    {
        // Contador de registros eliminados
        $conteo = 0;

        // Intentar eliminar de la primera tabla (ejercicio_rutinas)
        if (EliminarDatos::eliminarDatos(1, $id_tabla)) {
            $conteo++;
        }
        // Intentar eliminar de la segunda tabla (ejercicios)
        if (EliminarDatos::eliminarDatos(2, $id_tabla)) {
            $conteo++;
        }

        // Retornar el número de registros eliminados
        return $conteo;
    }

}