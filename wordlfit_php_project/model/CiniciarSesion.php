<?php
include ("connect.php");

class iniciarSesion extends conexionBD
{

    public static function iniciarSesion($correo, $contraseña)
    {

        $conexion = conexionBD::getConexion();

        $sql = "select count(*) FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña' ";

        $resultado = $conexion->query($sql);

        $r = 0;

        while ($fila = $resultado->fetch_array()) {
            $r = $fila[0];
        }

        return $r;
    }
}