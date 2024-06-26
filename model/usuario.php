<?php
include ("connect.php");
class usuarios extends conexionBD
{

    /**
     * Obtiene información específica de un usuario desde la base de datos.
     *
     * @param int $opc Opción que determina qué información se desea obtener:
     *                 0 - id_usuario
     *                 1 - nombre
     *                 2 - apellidos
     *                 3 - correo
     *                 4 - contraseña
     *                 5 - peso
     *                 6 - altura
     *                 7 - id_genero
     *                 8 - telefono
     *                 9 - pr (¿quizás posición o algún otro campo?)
     *                 10 - fecha_registro o fecha_url_imagen_perfil (según el caso)
     * @param int $id_usuario ID del usuario del cual se desea obtener la información.
     * @return mixed Retorna la información solicitada o vacío si no se encuentra.
     */
    public static function getInformacion($opc, $id_usuario)
    {
        $conexion = conexionBD::getConexion(); // Obtiene la conexión a la base de datos    
        // Consulta SQL para obtener información del usuario
        $sql = "select * from usuarios WHERE id_usuario = $id_usuario ";

        $resultado = $conexion->query($sql); // Ejecuta la consulta
        $salida = ''; // Variable para almacenar la información obtenida

        // Itera sobre los resultados obtenidos
        while ($fila = $resultado->fetch_array()) {

            switch ($opc) {
                case 0: // Trae el id_usuario
                    $salida = $fila[0];
                    break;
                case 1: // Trae el nombre
                    $salida = $fila[1];
                    break;
                case 2: // Trae el Apillidos
                    $salida = $fila[2];
                    break;
                case 3: // Trae el Correo
                    $salida = $fila[3];
                    break;
                case 4: // Trae el Contraseña
                    $salida = $fila[4];
                    break;
                case 5: // Trae el peso
                    $salida = $fila[5];
                    break;
                case 6: // Trae el alura
                    $salida = $fila[6];
                    break;
                case 7: // Trae el id_genero
                    $salida = $fila[7];
                    break;
                case 8: // Trae el telefono
                    $salida = $fila[8];
                    break;
                case 9: // Trae el Pr
                    $salida = $fila[9];
                    break;
                case 10: // Trae el Fecha registro
                    $salida = $fila[10];
                    break;
                case 11: // Trae el Fecha Url_Imagen perfil
                    $salida = $fila[10];
                    break;
            }
        }
        return $salida;
    }


    /**
     * Busca el ID de un usuario en la base de datos basado en su correo y contraseña.
     *
     * @param string $correo Correo electrónico del usuario.
     * @param string $password Contraseña del usuario.
     * @return int Retorna el ID del usuario si se encuentra en la base de datos, o 0 si no se encuentra.
     */
    public static function buscarId($correo, $password)
    {
        $conexion = conexionBD::getConexion(); // Obtiene la conexión a la base de datos

        // Consulta SQL para buscar el ID del usuario basado en correo y contraseña
        $sql = "select id_usuario from usuarios where correo = '$correo' and password = '$password' ";

        $resultado = $conexion->query($sql); // Ejecuta la consulta SQL
        $salida = 0; // Variable para almacenar el ID del usuario encontrado, inicializada en 0

        // Itera sobre los resultados obtenidos
        while ($fila = $resultado->fetch_array()) {
            $salida += $fila[0]; // Suma el valor del ID encontrado
        }
        return $salida; // Retorna el ID del usuario encontrado o 0 si no se encuentra
    }

    /**
     * Inicia sesión de usuario y retorna información específica según la opción proporcionada.
     *
     * @param int $opc Opción que determina qué información se desea obtener:
     *                 0 - Retorna el número de coincidencias encontradas para el correo y contraseña.
     *                 1 - Retorna el ID del rol del usuario si se encuentra en la base de datos.
     * @param string $correo Correo electrónico del usuario.
     * @param string $password Contraseña del usuario.
     * @return mixed Retorna el resultado según la opción (`$opc`) proporcionada:
     *               - Para `$opc` 0: Retorna el número de coincidencias encontradas.
     *               - Para `$opc` 1: Retorna el ID del rol del usuario.
     */
    public static function iniciarSesion($opc, $correo, $password)
    {

        $conexion = conexionBD::getConexion(); // Obtiene la conexión a la base de datos

        // Consulta SQL para contar coincidencias y obtener el ID del rol del usuario
        $sql = "select COUNT(*), id_rol FROM usuarios WHERE correo = '$correo' AND password = '$password' ";

        $resultado = $conexion->query($sql); // Ejecuta la consulta SQL

        $r = 0; // Variable para almacenar el resultado

        // Itera sobre los resultados obtenidos
        while ($fila = $resultado->fetch_array()) {

            switch ($opc) {
                case 0:
                    $r = $fila[0]; // Retorna el número de coincidencias encontradas
                    break;

                case 1:

                    $r = $fila[1];  // Retorna el ID del rol del usuario
                    break;
            }

        }

        return $r; // Retorna el resultado según la opción `$opc` proporcionada
    }



    /**
     * Obtiene información específica del perfil de un usuario.
     *
     * Este método realiza una consulta a la base de datos para recuperar información
     * detallada del perfil de un usuario según el parámetro opcional especificado.
     *
     * @param int $opc       Opción que indica qué información del perfil se desea obtener:
     *                          - 0: Nombre
     *                          - 1: Apellido
     *                          - 2: Correo electrónico
     *                          - 3: Contraseña (no recomendado devolver por razones de seguridad)
     *                          - 4: Peso actual
     *                          - 5: Altura actual
     *                          - 6: PR (¿Presión arterial?)
     *                          - 7: Teléfono
     *                          - 8: Género
     *                          - 9: Ruta de la imagen de perfil
     * @param int $idUsuario ID del usuario para el cual se desea obtener el perfil.
     * @return string         Devuelve la información solicitada del perfil del usuario como una cadena.
     */
    public static function getPerfil($opc, $idUsuario)
    {
        $conexion = self::getConexion(); // Obtiene la conexión a la base de datos

        // Construye la consulta SQL para obtener la información del perfil del usuario

        $sql = "select t1.nombre, t1.apellido, t1.correo, t1.password, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero, t1.imgPerfil ";
        $sql .= "FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = $idUsuario";

        $resultado = $conexion->query($sql); // Ejecuta la consulta SQL

        $r = ''; // Inicializa la variable $r para almacenar el resultado

        // Procesa cada fila del resultado de la consulta
        while ($fila = $resultado->fetch_array()) {

            switch ($opc) {
                case 0: // Muestra NOMBRE

                    $r .= $fila[0];

                    break;
                case 1: // Muestra APELLIDO

                    $r .= $fila[1];

                    break;
                case 2: // Muestra CORREO

                    $r .= $fila[2];

                    break;
                case 3: // Muestra CONTRASEÑA

                    $r .= $fila[3];

                    break;
                case 4: // Muestra PESO

                    $r .= $fila[4];

                    break;
                case 5: // Muestra ALTURA

                    $r .= $fila[5];

                    break;
                case 6: // Muestra PR

                    $r .= $fila[6];

                    break;
                case 7: // Muestra TELEFONO

                    $r .= $fila[7];

                    break;
                case 8: // Muestra GENERO

                    $r .= $fila[8];

                    break;
                case 9: // Muestra la ruta de la imagen de perfil.

                    $r .= $fila[9];

                    break;
            }
        }
        return $r;   // Devuelve la información del perfil del usuario como una cadena
    }


    /**
     * Elimina la cuenta de usuario de la base de datos.
     *
     * @param int $id ID del usuario cuya cuenta se desea eliminar.
     * @return int Número de filas afectadas por la operación de eliminación.
     */

    public static function eliminarCuenta($id)
    {

        $conexion = self::getConexion();  // Obtiene la conexión a la base de datos

        // Consulta SQL para eliminar la cuenta del usuario con el ID proporcionado
        $sql = "delete from usuarios where id_usuario = $id ";


        $conexion->query($sql); // Ejecuta la consulta SQL para eliminar la cuenta

        $affected_rows = $conexion->affected_rows; // Obtiene el número de filas afectadas por la operación de eliminación

        $conexion->close(); // Cierra la conexión a la base de datos

    }

    /**
     * Registra un nuevo usuario en la base de datos.
     *
     * @param string $nombres Nombres del usuario a registrar.
     * @param string $apellidos Apellidos del usuario a registrar.
     * @param string $telefono Número de teléfono del usuario a registrar.
     * @param string $correoElectronico Correo electrónico del usuario a registrar.
     * @param string $password Contraseña del usuario a registrar.
     * @param float $pesoActual Peso actual del usuario a registrar.
     * @param float $altura Altura actual del usuario a registrar.
     * @param int $genero ID del género del usuario a registrar.
     * @return int Número de filas afectadas por la operación de inserción.
     */

    public static function registrar($nombres, $apellidos, $telefono, $correoElectronico, $password, $pesoActual, $altura, $genero)
    {
        $conexion = self::getConexion();
        // Consulta SQL para insertar un nuevo usuario en la tabla 'usuarios'
        $sql = "insert into usuarios (nombre, apellido, telefono, correo, password, peso_actual, altura_actual, id_genero, fecha_registro, id_rol)";
        $sql .= " values ('$nombres' ,'$apellidos', '$telefono', '$correoElectronico', '$password', $pesoActual ,$altura, $genero, now(), 0) ";

        $conexion->query($sql); // Ejecuta la consulta SQL para insertar el nuevo usuario

        $affected_rows = $conexion->affected_rows; // Obtiene el número de filas afectadas por la operación de inserción

        $conexion->close(); // Cierra la conexión a la base de datos
    }

    /**
     * Actualiza los datos de un usuario en la base de datos.
     *
     * @param int $id ID del usuario cuyos datos se van a actualizar.
     * @param string $nombres Nuevos nombres del usuario.
     * @param string $apellidos Nuevos apellidos del usuario.
     * @param string $telefono Nuevo número de teléfono del usuario.
     * @param string $correo Nuevo correo electrónico del usuario.
     * @param string $pr Nuevo valor para el campo 'pr' del usuario.
     * @param float $pesoActual Nuevo peso actual del usuario.
     * @param float $altura Nueva altura actual del usuario.
     * @param string $ruta_imagen Nueva ruta de la imagen de perfil del usuario.
     * @return int Número de filas afectadas por la operación de actualización.
     */
    public static function actualizarDatos($id, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen)
    {
        $conexion = self::getConexion();  // Obtiene la conexión a la base de datos

        // Consulta SQL para actualizar los datos del usuario en la tabla 'usuarios'

        $sql = "update usuarios ";
        $sql .= "set nombre = '$nombres', ";
        $sql .= "imgPerfil = '$ruta_imagen', ";
        $sql .= "apellido = '$apellidos', ";
        $sql .= "peso_actual = $pesoActual, ";
        $sql .= "altura_actual = $altura, ";
        $sql .= "telefono = '$telefono', ";
        $sql .= "correo = '$correo', ";
        $sql .= "pr = $pr ";
        $sql .= "WHERE id_usuario = '$id' ";

        $conexion->query($sql); // Ejecuta la consulta SQL para actualizar los datos del usuario

        $affected_rows = $conexion->affected_rows; // Obtiene el número de filas afectadas por la operación de actualización

        $conexion->close(); // Cierra la conexión a la base de datos
    }
}
