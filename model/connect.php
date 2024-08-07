<?php

class conexionBD
{
    public static $connect;

    public static function getConexion()
    {
        // Incluir el archivo de configuración
        include_once (__DIR__ . '/../installer/config.php');
        // Crear la conexión a la base de datos
        self::$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificar la conexión
        if (self::$connect === false) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Retornar la conexión
        return self::$connect;
    }
}
