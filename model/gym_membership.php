<?php
include_once ("connect.php");

/**
 * Este método ejecuta una consulta en la base de datos para obtener información relacionada con las inscripciones
 * de un usuario específico, ya sea el conteo total o los detalles completos, y devuelve un valor de columna específico.
 *
 * @param string $selectedSql El tipo de consulta a realizar. Puede ser "count" para contar el número de inscripciones
 *                            o "showDetaild" para mostrar los detalles completos de las inscripciones.
 * @param int $id_user El ID del usuario cuyas inscripciones se desean consultar.
 * @param string|int $opc El nombre de la columna de la cual se desea obtener el valor. Se usa cuando el tipo de consulta
 *                        es "showDetaild".
 *
 * @return mixed Devuelve el valor de la columna especificada en $opc si se encuentra, o null si no se encuentra.
 *               Si se utiliza la opción "count", devuelve el conteo total de inscripciones.
 */
class Gym_membership extends conexionBD
{
    public static function showInfor($selectedSql, $id_user, $opc)
    {
        // Establece la conexión con la base de datos
        $connect = self::getConexion();

        // Inicializa la variable $sql como una cadena vacía
        $sql = "";

        // Verifica el tipo de consulta solicitado
        if ($selectedSql == "count") {

            // Si el tipo de consulta es "count", se construye una consulta SQL que cuenta el número de inscripciones del usuario
            $sql = "SELECT COUNT(*) FROM registration_inscriptions WHERE id_user = '$id_user' ";
        } elseif ($selectedSql == "showDetaild") {

            // Si el tipo de consulta es "showDetaild", se construye una consulta SQL que selecciona todos los detalles de las inscripciones del usuario
            $sql = "SELECT * FROM registration_inscriptions WHERE id_user = '$id_user' ";

        }

        // Ejecuta la consulta y almacena la respuesta.
        $response = $connect->query($sql);

        // Inicializa una variable para almacenar el resultado de la consulta.
        $r = "";

        // Itera sobre las filas obtenidas de la consulta.
        while ($row = $response->fetch_array()) {

            // Asigna el valor de la columna especificada en $opc a la variable $r. Si la columna no existe, $r será null
            $r = $row[$opc] ?? null;
        }
        // Cierra la conexión con la base de datos.
        $connect->close();

        // Devuelve el valor obtenido para la columna especificada, o null si no se encontró la columna.
        return $r;
    }
}