<?php

/**
 * Clase para la gestión de la conexión a la base de datos.
 * 
 * Esta clase proporciona una conexión a la base de datos MySQL utilizando la extensión `mysqli`.
 * 
 * @property string $localhost El nombre del servidor de base de datos.
 * @property string $root El nombre de usuario para la conexión a la base de datos.
 * @property string $password La contraseña para la conexión a la base de datos.
 * @property string $nameBD El nombre de la base de datos.
 * @property mysqli $connect La conexión a la base de datos.
 */
class conexionBD
{
    /**
     * El nombre del servidor de base de datos.
     * 
     * @var string
     */
    public static $localhost = "localhost";

    /**
     * El nombre de usuario para la conexión a la base de datos.
     * 
     * @var string
     */
    public static $root = "root";

    /**
     * La contraseña para la conexión a la base de datos.
     * 
     * @var string
     */
    public static $password = "";

    /**
     * El nombre de la base de datos.
     * 
     * @var string
     */
    public static $nameBD = "worldfitsbd";

    /**
     * La conexión a la base de datos.
     * 
     * @var mysqli
     */
    public static $connect;

    /**
     * Obtiene una conexión a la base de datos MySQL.
     * 
     * Este método crea una conexión a la base de datos utilizando los parámetros
     * definidos en las propiedades estáticas de la clase.
     * 
     * @return mysqli La conexión a la base de datos.
     */
    public static function getConexion()
    {
        // Crear la conexión a la base de datos
        self::$connect = mysqli_connect(self::$localhost, self::$root, self::$password, self::$nameBD);

        // Retornar la conexión
        return self::$connect;
    }
}
