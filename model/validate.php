<?php
include_once("connect.php");

class validate extends conexionBD
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
        if ($file_format != 'jpg' && $file_format != 'jpeg' && $file_format != 'png') {
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


    /**
     * Verifica la existencia de un usuario o gerente en la base de datos.
     *
     * @param string $mail Correo electrónico del usuario (para la opción 1).
     * @param int $opc Opción que determina qué tipo de consulta realizar:
     *                1 para verificar la existencia de un usuario por correo,
     *                2 para verificar la existencia de un gerente por ID.
     * @param int|null $id ID del gerente (opcional, solo para la opción 2).
     * @param int|null $selectRow Fila a seleccionar de los resultados:
     *                            1 para contar coincidencias,
     *                            2 para obtener el ID del usuario,
     *                            3 para obtener el conteo de coincidencias en la tabla `infogyms`.
     * @return mixed El número de coincidencias encontradas o el ID del usuario, según la opción seleccionada.
     */
    public static function UserExists($opc, $mail = null, $id = null, $selectRow = null)
    {

        // Obtener la conexión a la base de datos
        $connect = self::getConexion();

        $sql = "";

        // Construir la consulta SQL según la opción
        if ($opc == 1) {
            // Opción 1: Verificar la existencia de un usuario por correo
            $sql = "SELECT COUNT(*), id_usuario FROM usuarios WHERE correo = '$mail' ";
        } elseif ($opc == 2) {
            // Opción 2: Verificar la existencia de un gerente por ID
            $sql = "SELECT COUNT(*) FROM infogyms WHERE id_gerente = '$id' ";
        }

        // Ejecutar la consulta
        $response = $connect->query($sql);

        $r = "";

        while ($row = $response->fetch_array()) {
            // Determinar qué valor devolver según $selectRow
            $r = $row[$selectRow] ?? null;
        }

        $connect->close();
        return $r;
    }

    /**
     * Busca un valor en una tabla específica basado en los parámetros proporcionados.
     *
     * @param string $opcQuery Opciones de consulta para determinar la tabla y el campo a buscar.
     * @param mixed $data Valor que se utilizará para la búsqueda en el campo específico de la tabla.
     * @return mixed El valor encontrado en la búsqueda o una cadena vacía si no se encuentra nada.
     */
    public static function search($opcQuery, $data)
    {
        // Obtiene la conexión a la base de datos
        $connect = self::getConexion();

        // Inicializa las variables para la consulta
        $sql = "";
        $nameTable = ""; // Nombre de la tabla donde se realizará la búsqueda
        $identifier = ""; // Campo utilizado para identificar la fila a buscar
        $toSearch = ""; // Campo del cual se obtendrá el valor
        $r = "";

        // Determina la tabla, el identificador y el campo a buscar según la opción de consulta
        switch ($opcQuery) {
            case 'searchStatus':
                $nameTable = "infogyms";
                $identifier = "id";
                $toSearch = "status";
                break;
        }

        // Construye la consulta SQL para obtener el valor deseado
        $sql = "SELECT $toSearch FROM $nameTable WHERE $identifier = '$data' ";

        // Ejecuta la consulta SQL
        $response = $connect->query($sql);

        // Procesa los resultados de la consulta
        while ($row = $response->fetch_array()) {
            $r = $row[0];  // Asigna el primer valor de la fila al resultado
        }

        // Cierra la conexión a la base de datos
        $connect->close();

        // Retorna el valor encontrado o una cadena vacía si no se encontró nada
        return $r;

    }

    /**
     * Valida y cuenta el número de registros en una tabla específica basado en una opción de consulta.
     *
     * @param string $opc Tipo de operación a realizar, aunque no se usa directamente en la función.
     * @param int $data_id Identificador del usuario o dato a contar en la tabla.
     * @param string $opcQuery Opción de consulta para determinar qué tabla y campo utilizar. Puede ser 'countCalendars' o 'purchase count'.
     * 
     * @return int El número de registros encontrados en la base de datos que coinciden con el identificador dado.
     */
    public static function validateCountsDatas($data_id, $opcQuery)
    {
        // Obtiene la conexión a la base de datos
        $connect = self::getConexion();

        // Determina la tabla, el identificador y el campo a buscar según la opción de consulta
        switch ($opcQuery) {
            case 'countCalendars':
                $nameTable = "calendario_rutinario";
                $identifier = "id_usuario";
                break;
            case 'purchase count':
                $nameTable = "plan_registration";
                $identifier = "id_usuario";
                break;
            case 'count user exist':
                $nameTable = "usuarios";
                $identifier = "correo";
                break;
        }

        // Construye la consulta SQL para obtener el valor deseado
        $sql = "SELECT COUNT(*) FROM $nameTable WHERE $identifier = '$data_id'";

        // Ejecuta la consulta SQL
        $response = $connect->query($sql);

        // Procesa los resultados de la consulta
        while ($row = $response->fetch_array()) {
            $r = $row[0];  // Asigna el primer valor de la fila al resultado
        }

        // Cierra la conexión a la base de datos
        $connect->close();

        // Retorna el valor encontrado o una cadena vacía si no se encontró nada
        return $r;

    }
}

