<?php

class conexionBD
{

    public static $localhost = "localhost";
    public static $root = "root";
    public static $password = "";
    public static $nameBD = "worldfitsbd";

    public static $connect;

    public static function getConexion()
    {
        self::$connect = mysqli_connect(self::$localhost, self::$root, self::$password, self::$nameBD);
        return self::$connect;
    }
}
