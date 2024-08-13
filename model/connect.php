<?php

class conexionBD
{
    /**
     * Conexión a la base de datos.
     *
     * @var mysqli|null
     */
    public static $connect;

    /**
     * Obtiene una conexión a la base de datos usando los parámetros definidos en el archivo de configuración.
     *
     * Este método incluye el archivo de configuración que define las constantes necesarias para
     * conectar con la base de datos, luego establece la conexión y la almacena en la propiedad
     * estática `$connect`. Si la conexión falla, se detiene la ejecución del script y muestra un
     * mensaje de error. Si la conexión es exitosa, se retorna el objeto de conexión `mysqli`.
     *
     * @return mysqli La conexión a la base de datos.
     * @throws Exception Si ocurre un error durante la conexión a la base de datos, se detiene la
     *     ejecución del script con un mensaje de error.
     */
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
