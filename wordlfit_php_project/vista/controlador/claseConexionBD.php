<?php

class conexionBD
{

    private static $localhost = "localhost";
    private static $usuario = "root";
    private static $contraseña = "";
    private static $nombreBD = "worldfitsBD";

    public static $conexion;

    public static function getConexion()
    {
        self::$conexion = mysqli_connect(self::$localhost, self::$usuario, self::$contraseña, self::$nombreBD);
        return self::$conexion;
    }

}
