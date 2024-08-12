<?php

include_once ('connect.php');

class exercise extends conexionBD
{

    /**
     * Obtiene información sobre un ejercicio específico de la base de datos.
     *
     * Este método consulta la base de datos para obtener información sobre un ejercicio
     * basándose en el identificador del ejercicio y la opción seleccionada.
     *
     * @param int $opc La opción que indica qué columna de la tabla 'ejercicios' se debe recuperar:
     *                 0: ID del ejercicio,
     *                 1: Nombre del ejercicio,
     *                 2: Instrucciones,
     *                 3: Equipo necesario,
     *                 4: Series,
     *                 5: Repeticiones,
     *                 6: Tiempo de descanso,
     *                 7: Otra columna.
     * @param int $exercise El identificador del ejercicio para el cual se desea obtener la información.
     * 
     * @return string La información del ejercicio correspondiente a la opción seleccionada.
     */
    public static function getInformationExercises($opc, $exercise)
    {
        // Obtiene la conexión a la base de datos.
        $conexion = self::getConexion();

        // Prepara la consulta SQL para seleccionar todos los datos del ejercicio específico.
        $sql = "SELECT * FROM ejercicios WHERE id_ejercicio = '$exercise';";

        // Ejecuta la consulta SQL y almacena el resultado.
        $result = $conexion->query($sql);

        // Inicializa una variable para almacenar la salida.
        $salida = "";

        // Itera sobre los resultados de la consulta.
        while ($row = $result->fetch_array()) {

            // Dependiendo del valor de $opc, asigna el valor correspondiente de la fila a $salida.
            $salida = $row[$opc] ?? null;
        }
        // Cierra la conexion a la base de datos.
        $conexion->close();

        // Devuelve la información del ejercicio correspondiente a la opción seleccionada.
        return $salida;
    }
}