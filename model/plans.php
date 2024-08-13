<?php
include_once ("connect.php");

class Plans extends conexionBD
{

    /**
     * Obtiene información de un plan específico.
     *
     * @param string $opc El nombre del campo que se desea recuperar del plan. Debe coincidir con uno de los nombres de columna en la tabla `plans`.
     * @param int $id_plan El identificador del plan del cual se desea obtener la información.
     * @return mixed El valor del campo especificado en el plan, o `null` si el campo no se encuentra o el plan no existe.
     */

    public static function showInfoPlan($opc, $id_plan)
    {
        // Conectar a la base de datos
        $connect = self::getConexion();

        // Consulta SQL para obtener la información del pla
        $sql = "SELECT * FROM plans WHERE id = '$id_plan' ";

        // Ejecutar la consulta
        $response = $connect->query($sql);

        // Inicializar variable para almacenar el resultado
        $r = "";

        // Recorrer los resultados de la consulta
        while ($row = $response->fetch_array()) {

            // Obtener el valor del campo especificado
            $r = $row[$opc] ?? null;
        }

        // Cerrar la conexión
        $connect->close();

        // Retornar el valor obtenido
        return $r;
    }

}