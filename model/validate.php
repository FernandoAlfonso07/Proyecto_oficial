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

    /**
     * Valida y maneja la carga de archivos de imagen en el servidor.
     *
     * Este método verifica el formato de la imagen cargada, mueve la imagen al directorio especificado
     * y devuelve la ruta de la imagen cargada o redirige al usuario si el formato de la imagen no es permitido.
     *
     * @param string $imageInsert Nombre del campo del formulario `input` de tipo `file` utilizado para la carga de la imagen.
     * @param string $header URL a la que se redirigirá al usuario si el formato de la imagen no es permitido.
     * @param string $directory_address Ruta del directorio en el servidor donde se almacenará la imagen cargada.
     *                                  Debe incluir la barra diagonal final para concatenar el nombre de la imagen.
     * 
     * @return string Ruta de la imagen cargada en el servidor si el archivo se mueve correctamente, 
     *                o un mensaje de error si no se logra cargar la imagen.
     */
    public static function image($imageInsert, $header, $directory_address) // name input, // direccion controlador, // directorio
    {
        $image = $_FILES[$imageInsert]['tmp_name'];
        $name_image = $_FILES[$imageInsert]['name'];
        $image_format = strtolower(pathinfo($name_image, PATHINFO_EXTENSION));

        // Verificar si el formato de la imagen es uno de los permitidos
        if ($image_format != 'jpg' && $image_format != 'jpeg' && $image_format != 'png') {
            header('location: ' . $header);

        } else {
            $directory = $directory_address;
            $image_Direction = $directory . basename($name_image);

            // Mover la imagen al directorio especificado
            if (move_uploaded_file($image, $image_Direction)) {
                return $image_Direction; // Retornar la ruta de la imagen si se movió con éxito
            } else {
                return 'No se cargó correctamente la imagen';
            }
        }
    }

}

