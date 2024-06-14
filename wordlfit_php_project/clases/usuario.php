<?php

class Usuario
{


    public static $nombre;
    public static $correo;
    public static $contraseña;
    public static $fecbaRegistro;


    public static function getPersonalDatas($nombre, $correo, $contraseña, $fecbaRegistro)
    {

        $salida = '';

        self::$nombre;
        self::$correo;
        self::$contraseña;
        self::$fecbaRegistro;

        return $salida;
    }

}

$fernando = new Usuario();
echo $fernando::getPersonalDatas('Fernando', 'alfonso07amaya@gmail.com','fernandoQuinteres23','14/06/2024');
