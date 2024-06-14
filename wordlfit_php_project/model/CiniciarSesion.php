<?php
include ("connect.php");

class iniciarSesion extends conexionBD
{

    public static function iniciarSesion($opc, $correo = null, $contraseña = null)
    {

        $conexion = conexionBD::getConexion();

        $sql = "select t1.id_usuario, count(*) FROM usuarios t1 WHERE correo = '$correo' AND contraseña = '$contraseña'; ";

        $resultado = $conexion->query($sql);

        $r = 0;

        while ($fila = $resultado->fetch_array()) {
            if ($opc == 0) {
                $r = $fila[1];
            } elseif ($opc == 1) {
                $r = $fila[0];
            }
        }

        return $r;
    }
}