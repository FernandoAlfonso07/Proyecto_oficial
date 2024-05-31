<?php
include ("controlador/claseConexionBD.php");
class registrar extends conexionBD
{
    public static function registrarUsuario($nombre, $correoUsuario, $contraseñaUsuario, $pesoActual, $alturaActual, $generoBoolean)
    {
        self::getConexion();
        $sql = "insert into usuarios (nombre, correo, contraseña, peso_actual, altura_actual, id_genero) values ('$nombre','$correoUsuario','$contraseñaUsuario',$pesoActual, $alturaActual, $generoBoolean);";
        self::$conexion->query($sql);

        header("location: controlador.php?seccion=seccion1");

        self::$conexion->close();

    }
}