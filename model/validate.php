<?php


class validate
{
    public static function sanitize($param)
    {
        $salida = '';
        $salida = $param;

        $salida = str_replace(" or ", "", $salida);
        $salida = str_replace(" OR ", "", $salida);
        // $salida = str_replace(" ", "", $salida);

        $salida = str_replace("'", "", $salida);
        $salida = str_replace('"', '', $salida);
        $salida = str_replace('<script>', '', $salida);
        $salida = str_replace('alert', '', $salida);
        $salida = str_replace('document', '', $salida);
        $salida = str_replace('eval', '', $salida);
        $salida = str_replace('onerror', '', $salida);
        $salida = str_replace('onload', '', $salida);
        $salida = str_replace('prompt', '', $salida);
        $salida = str_replace('innerHTML', '', $salida);
        $salida = str_replace('onclick', '', $salida);
        $salida = str_replace('like', '', $salida);
        $salida = str_replace('=', '', $salida);
        $salida = str_replace('<', '', $salida);
        $salida = str_replace('>', '', $salida);

        return $salida;
    }

}