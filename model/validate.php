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
    public static function media($fileInsert, $header, $directory_address) // name input, // direccion controlador, // directorio
    {
        $file = $_FILES[$fileInsert]['tmp_name'];
        $file_name = $_FILES[$fileInsert]['name'];
        $file_format = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Verificar si el formato de la imagen es uno de los permitidos
        if ($file_format != 'jpg' && $file_format != 'jpeg' && $file_format != 'png' && $file_format != 'mp4' && $file_format != 'avi' && $file_format != 'mkv') {
            header('location: ' . $header);
            exit();

        } else {
            $directory = $directory_address;
            $file_Direction = $directory . basename($file_name);

            // Mover la imagen al directorio especificado
            if (move_uploaded_file($file, $file_Direction)) {
                return $file_Direction; // Retornar la ruta de la imagen si se movió con éxito
            } else {
                return 'No se cargó correctamente el archivo';
            }
        }
    }

    /**
     * Valida que los campos de entrada no estén vacíos.
     *
     * Este método recibe un array de nombres de campos y verifica que cada uno de esos campos,
     * que deben ser enviados mediante el método GET, no esté vacío. Si alguno de los campos está vacío,
     * el método retorna `false`. Si todos los campos tienen valores no vacíos, retorna `true`.
     *
     * @param array $inputs Un array que contiene los nombres de los campos que se desean validar.
     *                      Cada valor en el array debe ser el nombre de un campo en el array `$_GET`.
     * 
     * @return bool Retorna `true` si todos los campos especificados tienen valores no vacíos,
     *              y `false` si al menos uno de los campos está vacío.
     *
     * @throws InvalidArgumentException Lanza una excepción si el parámetro `$inputs` no es un array.
     */
    public static function validateNotEmptyInputs($inputs)
    {
        // Iterar sobre cada nombre de campo en el array
        foreach ($inputs as $value) {
            // Verificar si el campo correspondiente en $_GET está vacío
            if (empty($_POST[$value])) {
                return false; // Retorna falso si algún campo está vacío
            }
        }

        // Retorna verdadero si todos los campos tienen valores no vacíos
        return true;
    }


}

