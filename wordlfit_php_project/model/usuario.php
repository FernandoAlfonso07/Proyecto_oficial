<?php
include ("connect.php");
class usuarios extends conexionBD
{
    public static function getNombre($correoU)
    {
        $conexion = self::getConexion();

        $sql = "select nombre from usuarios WHERE correo = '$correoU'";
        $resultado = $conexion->query($sql);
        $r = '';
        while ($fila = $resultado->fetch_array()) {
            $r = $fila[0];
        }
        return $r;
    }

}