<?php

include_once ("connect.php");

class Interactions extends conexionBD
{
    /**
     * Valida la interacción de un usuario con una rutina específica.
     *
     * @param int $id_user El ID del usuario para validar la interacción.
     * @param int $id_routine El ID de la rutina para validar la interacción.
     * @param int|null $opc Opcional. El tipo de resultado a devolver: 
     *                      1 para contar las interacciones, 
     *                      cualquier otro valor para obtener el tipo de interacción.
     * @return int|string El conteo de interacciones (si `$opc` es 1) o el tipo de interacción (si `$opc` no es 1).
     */
    public static function validate_interaction($id_user, $id_routine, $opc = null)
    {
        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para obtener el conteo de interacciones y el tipo de interacción.
        $sql = "SELECT COUNT(*), type FROM interactions WHERE id_usuario = '$id_user' AND id_rutina = '$id_routine' ";

        $response = $connect->query($sql); // Ejecuta la consulta SQL.
        $result = 0; // Inicializa una variable para almacenar el resultado.

        while ($row = $response->fetch_array()) {
            // Si `$opc` es 1, almacena el conteo de interacciones. 
            // De lo contrario, almacena el tipo de interacción.
            $result = $opc == 1 ? $row[0] : $row[1];
        }
        $connect->close(); // Cierra la conexión a la base de datos.
        return $result; // Devuelve el conteo de interacciones o el tipo de interacción.
    }
}