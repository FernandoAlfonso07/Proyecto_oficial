<?php
include_once ('../model/usuario.php'); // Se incluye el archivo que contiene la definición de la clase usuarios
class inserts
{
    /**
     * Realiza la inserción de un registro en la tabla de calendarios rutinarios.
     *
     * Este método utiliza el método estático createCalender de la clase usuarios para realizar la inserción.
     *
     * @param int $id_calendar El ID del calendario en el que se va a insertar la rutina.
     * @param int $id_day El número de día asociado en el calendario.
     * @param int $id_routine El ID de la rutina que se va a asociar al calendario y día especificados.
     * @return mixed El resultado de la inserción en la base de datos, según lo retorne createCalender.
     */
    public static function run($id_calendar, $id_day, $id_routine)
    {
        return usuarios::createCalender(1, null, null, null, $id_calendar, $id_day, $id_routine);
    }
}