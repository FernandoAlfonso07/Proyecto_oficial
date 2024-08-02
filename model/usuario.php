<?php
include_once ("connect.php");

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
        $conexion = self::getConexion(); // Obtiene la conexión a la base de datos    
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
                case 11: // Rol
                    $salida = $fila[11];
                    break;
                case 12: // img perfil
                    $salida = $fila[12];
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
        $conexion = self::getConexion(); // Obtiene la conexión a la base de datos

        // Consulta SQL para buscar el ID del usuario basado en correo y contraseña
        $sql = "SELECT id_usuario FROM usuarios WHERE correo = '$correo' AND password = '$password'";
        $resultado = $conexion->query($sql);

        $salida = 0;

        // Verifica si la consulta SQL devolvió algún resultado
        if ($resultado) {

            // Obtiene la primera fila del resultado de la consulta
            if ($fila = $resultado->fetch_array()) {

                // Almacena el ID del usuario en la variable $salida
                $salida = $fila[0];
            }
        }
        // Cierra la conexion a la base de datos
        $conexion->close();

        // Retorna el ID del usuario encontrado o 0 si no se encuentra
        return $salida;
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

        $conexion = self::getConexion(); // Obtiene la conexión a la base de datos

        // Consulta SQL para contar coincidencias y obtener el ID del rol del usuario
        $sql = "SELECT COUNT(*), id_rol FROM usuarios WHERE correo = '$correo' AND password = '$password'";
        $resultado = $conexion->query($sql);

        $r = 0;

        // Verifica si la consulta SQL devolvió algún resultado
        if ($resultado) {

            // Obtiene la primera fila del resultado de la consulta
            if ($fila = $resultado->fetch_array()) {

                // Determina qué valor retornar basado en el parámetro $opc
                switch ($opc) {
                    case 0:
                        $r = $fila[0]; // Número de coincidencias encontradas
                        break;
                    case 1:
                        $r = $fila[1]; // ID del rol del usuario
                        break;
                }
            }
        }

        // Cierra la conexion a la base de datos
        $conexion->close();

        // Retorna el resultado según la opción proporcionada
        return $r;
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

        $sql = "select t1.nombre, t1.apellido, t1.correo, t1.password, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero, t1.imgPerfil, t3.rol ";
        $sql .= "FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero JOIN roles t3 ON t1.id_rol = t3.id_rol WHERE id_usuario = $idUsuario";

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
                case 10: // Muestra el rol.

                    $r .= $fila[10];

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

        $conexion = self::getConexion(); // Obtiene la conexión a la base de datos

        // Consulta SQL para eliminar la cuenta del usuario con el ID proporcionado
        $sql = "delete from usuarios where id_usuario = $id ";


        $conexion->query($sql); // Ejecuta la consulta SQL para eliminar la cuenta

        $affected_rows = $conexion->affected_rows; // Obtiene el número de filas afectadas por la operación de eliminación

        $conexion->close(); // Cierra la conexión a la base de datos

        // retorna el numero de filas afectada.
        return $affected_rows;
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

    public static function registrar($nombres, $apellidos, $telefono, $correoElectronico, $password, $pesoActual, $altura, $genero, $rol = null)
    {
        $conexion = self::getConexion();
        // Consulta SQL para insertar un nuevo usuario en la tabla 'usuarios'
        $sql = "insert into usuarios (nombre, apellido, telefono, correo, password, peso_actual, altura_actual, id_genero, fecha_registro, id_rol, imgPerfil)";
        $sql .= " values ('$nombres' ,'$apellidos', '$telefono', '$correoElectronico', '$password', $pesoActual ,$altura, $genero, now(), " . ($rol ?? 2) . ", '../view/user img/default_img.PNG') ";

        $conexion->query($sql); // Ejecuta la consulta SQL para insertar el nuevo usuario

        $affected_rows = $conexion->affected_rows; // Obtiene el número de filas afectadas por la operación de inserción

        $conexion->close(); // Cierra la conexión a la base de datos

        return $affected_rows;
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
    public static function actualizarDatos($id, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $sex, $ruta_imagen = null, $rol = null)
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
        $sql .= "pr = $pr, ";
        $sql .= "id_genero = $sex ";
        $sql .= "WHERE id_usuario = '$id' ";

        $conexion->query($sql); // Ejecuta la consulta SQL para actualizar los datos del usuario

        $affected_rows = $conexion->affected_rows; // Obtiene el número de filas afectadas por la operación de actualización

        $conexion->close(); // Cierra la conexión a la base de datos

        // Retorna el número de filas afectadas
        return $affected_rows;
    }

    /**
     * Crea registros en la base de datos para calendarios y su relación con rutinas.
     * 
     * Dependiendo del valor del parámetro `$opc`, este método realiza una de las siguientes acciones:
     * - Si `$opc` es `0`, inserta un nuevo calendario en la tabla `calendario_rutinario`.
     * - Si `$opc` es `1`, inserta una relación entre un calendario y una rutina en la tabla `relacion_calendario_rutinas`.
     * 
     * @param int $opc Determina el tipo de inserción:
     *                 - `0` para insertar un nuevo calendario.
     *                 - `1` para insertar una relación entre calendario y rutina.
     * @param int|null $id_user (Opcional) El identificador del usuario asociado con el calendario. Requerido si `$opc` es `0`.
     * @param string|null $name (Opcional) El nombre personalizado del calendario. Requerido si `$opc` es `0`.
     * @param string|null $description (Opcional) La descripción del calendario. Requerido si `$opc` es `0`.
     * @param int|null $id_calendar (Opcional) El identificador del calendario asociado con la rutina. Requerido si `$opc` es `1`.
     * @param int|null $id_day (Opcional) El identificador del día en el calendario. Requerido si `$opc` es `1`.
     * @param int|null $id_routine (Opcional) El identificador de la rutina asociada con el calendario. Requerido si `$opc` es `1`.
     * 
     * @return int El número de filas afectadas por la operación de inserción.
     */
    public static function createCalender($opc, $id_user = null, $name = null, $description = null, $id_calendar = null, $id_day = null, $id_routine = null)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Construir la consulta SQL según el valor de $opc
        if ($opc == 0) {

            // Insertar un nuevo calendario en la tabla calendario_rutinario
            $sql = "INSERT INTO calendario_rutinario (id_usuario, nombre_personalizado, descripcion, fecha_registro) ";
            $sql .= "VALUES ('$id_user', '$name', '$description', now()) ";
        } else {

            // Insertar una relación entre calendario y rutina en la tabla relacion_calendario_rutinas
            $sql = "INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) ";
            $sql .= "VALUES ('$id_calendar', '$id_day', '$id_routine');";
        }

        // Ejecutar la consulta
        $conexion->query($sql);

        // Obtener el número de filas afectadas
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el número de filas afectadas
        return $affected_rows;
    }


    /**
     * Obtiene el hash de la contraseña almacenada en la base de datos para un correo dado.
     *
     * @param string $mail Correo electrónico del usuario.
     * @return string Retorna el hash de la contraseña si se encuentra en la base de datos, o una cadena vacía si no se encuentra.
     */
    public static function getPasswordhash($mail)
    {

        // Obtiene la conexión a la base de datos
        $conexion = self::getConexion();

        // Consulta SQL para obtener el hash de la contraseña del usuario basado en el correo
        $sql = "SELECT password FROM usuarios WHERE correo = '$mail'";
        $resultado = $conexion->query($sql);

        $password = '';

        // Verifica si la consulta SQL devolvió algún resultado
        if ($resultado) {

            // Obtiene la primera fila del resultado de la consulta
            if ($fila = $resultado->fetch_array()) {
                $password = $fila[0];
            }
        }

        // Cierra la conexión a la base de datos
        $conexion->close();

        // Retorna el hash de la contraseña o una cadena vacía si no se encuentra
        return $password;
    }
}
