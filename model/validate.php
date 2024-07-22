<?php


class validate
{
    /**
     * Sanitiza una cadena de texto para prevenir inyecciones SQL y ataques XSS (Cross-Site Scripting).
     * 
     * Este método elimina patrones específicos que pueden ser utilizados en inyecciones SQL o ataques XSS,
     * como operadores lógicos, comillas, etiquetas de script y atributos de eventos. La sanitización
     * se realiza reemplazando ciertos caracteres y palabras clave con cadenas vacías.
     * 
     * @param string $param La cadena de texto que se desea sanitizar.
     * 
     * @return string La cadena de texto sanitizada, con los patrones potencialmente peligrosos eliminados.
     */
    public static function sanitize($param)
    {
        $salida = '';
        $salida = $param;

        // Reemplazar operadores lógicos utilizados en inyecciones SQL
        $salida = str_replace(" or ", "", $salida);
        $salida = str_replace(" OR ", "", $salida);

        // Reemplazar comillas y caracteres que pueden ser utilizados para manipular HTML o JavaScript
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

        // Reemplazar caracteres que pueden ser utilizados en inyecciones SQL
        $salida = str_replace('like', '', $salida);
        $salida = str_replace('=', '', $salida);
        $salida = str_replace('<', '', $salida);
        $salida = str_replace('>', '', $salida);

        // Retorna el String Sanitizado
        return $salida;
    }

}

