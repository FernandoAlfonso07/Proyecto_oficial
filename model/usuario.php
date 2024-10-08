<?php
include_once("connect.php");

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

            $salida = $fila[$opc] ?? null;
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
                $r = $fila[$opc] ?? null;
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
     *                          - 6: PR (Personal Record)
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
        $sql .= "FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero JOIN roles t3 ON t1.id_rol = t3.id_rol WHERE id_usuario = '$idUsuario' ";
        $resultado = $conexion->query($sql); // Ejecuta la consulta SQL

        $r = ''; // Inicializa la variable $r para almacenar el resultado

        // Procesa cada fila del resultado de la consulta
        while ($fila = $resultado->fetch_array()) {

            $r = $fila[$opc] ?? null;
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
     * @param string|null $sex Nuevo valor para el campo de género del usuario.
     * @param string|null $ruta_imagen Nueva ruta de la imagen de perfil del usuario.
     * @param string|null $rol Nuevo valor para el campo 'rol' del usuario.
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
        if (isset($rol)) {
            $sql .= ", id_rol = '$rol'";
        }
        $sql .= " WHERE id_usuario = '$id' ";

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

    /**
     * Obtiene un valor específico del índice de registro del usuario.
     *
     * @param int $id_user El ID del usuario.
     * @param int $opc La opción que determina qué valor devolver (0, 1, 2 o 3).
     *                 0 - Devuelve el valor del primer campo.
     *                 1 - Devuelve el valor del segundo campo.
     *                 2 - Devuelve el valor del tercer campo.
     *                 3 - Devuelve el valor del cuarto campo.
     * @return mixed El valor correspondiente del índice de registro del usuario según la opción seleccionada.
     */
    public static function get_user_registration_indexes($id_user, $opc)
    {
        // Establece la conexión a la base de datos 
        $conexion = self::getConexion();

        // Consulta SQL para obtener todos los campos de la tabla user_registration_indexes para el usuario especificado
        $sql = "SELECT * FROM user_registration_indexes WHERE id_usuario = '$id_user'";
        $result = $conexion->query($sql);

        // Inicializa la variable de salida
        $salida = "";

        // Recorre los resultados de la consulta
        while ($row = $result->fetch_array()) {
            // Selecciona el campo apropiado basado en el valor de $opc
            $salida = $row[$opc] ?? null;

        }
        // Cierra la conexión a la base de datos
        $conexion->close();

        // Devuelve el valor seleccionado del índice de registro del usuario
        return $salida;
    }

    /**
     * Inserta una nueva interacción en la base de datos.
     *
     * @param string $type El tipo de interacción (por ejemplo, 'like' o 'dislike').
     * @param int $id_user El ID del usuario que realiza la interacción.
     * @param int $id_routine El ID de la rutina a la que se aplica la interacción.
     * @return int El número de filas afectadas por la consulta (0 si hubo un error o la inserción no se realizó).
     */
    public static function giveLike($type, $id_user, $id_routine)
    {
        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para insertar una nueva interacción en la tabla `interactions`.
        $sql = "INSERT INTO interactions (type, id_usuario, id_rutina) VALUES ('$type', $id_user, $id_routine) ";

        $connect->query($sql); // Ejecuta la consulta SQL.

        $affected_rows = $connect->affected_rows; // Obtiene el número de filas afectadas por la consulta.

        $connect->close(); // Cierra la conexión a la base de datos.

        return $affected_rows; // Devuelve el número de filas afectadas.
    }

    /**
     * Actualiza una interacción existente en la base de datos.
     *
     * @param string $type El nuevo tipo de interacción (por ejemplo, 'like' o 'dislike').
     * @param int $id_user El ID del usuario cuya interacción se va a actualizar.
     * @param int $id_routine El ID de la rutina cuya interacción se va a actualizar.
     * @return int El número de filas afectadas por la consulta (0 si no se actualizó ninguna fila o hubo un error).
     */
    public static function updateInteractions($type, $id_user, $id_routine)
    {
        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para actualizar el tipo de interacción en la tabla `interactions`.
        $sql = "UPDATE interactions SET type = '$type' WHERE id_usuario = '$id_user' AND id_rutina = '$id_routine' ";

        // Ejecuta la consulta SQL.
        $connect->query($sql);

        // Obtiene el número de filas afectadas por la consulta.
        $affected_rows = $connect->affected_rows;

        // Cierra la conexión a la base de datos.
        $connect->close();

        // Devuelve el número de filas afectadas.
        return $affected_rows;
    }

    /**
     * Actualiza la contraseña de un usuario en la base de datos.
     *
     * @param string $newPassword La nueva contraseña que se establecerá para el usuario.
     * @param int $id El ID del usuario cuya contraseña se va a actualizar.
     * @return int El número de filas afectadas por la consulta.
     */
    public static function updatePassword($newPassword, $id)
    {
        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para actualizar el campo de la contraseña en la tabla `usuario`.
        $sql = "UPDATE usuarios SET password = '$newPassword' WHERE id_usuario = '$id' ";

        // Ejecuta la consulta SQL.
        $connect->query($sql);

        // Obtiene el número de filas afectadas por la consulta.
        $affected_rows = $connect->affected_rows;

        // Cierra la conexión a la base de datos.
        $connect->close();

        // Devuelve el número de filas afectadas.
        return $affected_rows;
    }

    /**
     * Este método registra una nueva inscripción de un usuario en un gimnasio en la base de datos, incluyendo detalles
     * como la dirección, el documento, información adicional, y la fecha de inscripción.
     *
     * @param int $id_user El ID del usuario que se va a inscribir en el gimnasio.
     * @param string $address_user La dirección del usuario.
     * @param int $document_user El número de documento del usuario.
     * @param string $information_extra Información adicional sobre la inscripción.
     * @param int $id_gym El ID del gimnasio donde se va a inscribir el usuario.
     *
     * @return int Devuelve el número de filas afectadas por la inserción en la base de datos. 
     *             Si es mayor que 0, la inserción fue exitosa.
     */
    public static function inscriptionGym(
        $id_user,
        $address_user,
        $document_user,
        $information_extra,
        $id_gym
    ) {
        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para insertar los datos de inscripción en la tabla `registration_inscriptions`.
        $sql = "INSERT INTO registration_inscriptions (id_user, address_user, document_user, information_extra, date_inscription, id_gym) 
        VALUES ('$id_user','$address_user','$document_user','$information_extra',now(), '$id_gym') ";

        // Ejecuta la consulta SQL.
        $connect->query($sql);

        // Obtiene el número de filas afectadas por la consulta.
        $affected_rows = $connect->affected_rows;

        // Cierra la conexión a la base de datos.
        $connect->close();

        // Devuelve el número de filas afectadas.
        return $affected_rows;
    }

    /**
     * Registra la compra de un plan por un usuario.
     *
     * @param int $id_user Identificador del usuario que compra el plan.
     * @param int $id_plan Identificador del plan que se compra.
     * 
     * @return int El número de filas afectadas por la consulta de inserción.
     */
    public static function buy_plan($id_user, $id_plan)
    {
        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para insertar los datos de inscripción en la tabla `registration_inscriptions`.
        $sql = "INSERT INTO plan_registration (id_usuario, id_plan) VALUES('$id_user','$id_plan') ";

        // Ejecuta la consulta SQL.
        $connect->query($sql);

        // Obtiene el número de filas afectadas por la consulta.
        $affected_rows = $connect->affected_rows;

        // Cierra la conexión a la base de datos.
        $connect->close();

        // Devuelve el número de filas afectadas.
        return $affected_rows;
    }

    /**
     * Actualiza la información de un calendario en la base de datos.
     *
     * @param string $customName El nombre personalizado del calendario.
     * @param string $description La descripción del calendario.
     * @param int $idCalendar El ID del calendario a actualizar.
     *
     * @return int El número de filas afectadas por la consulta SQL.
     */
    public static function updateCalendar($customName, $description, $idCalendar)
    {
        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para actualizar los datos del calendario en la tabla `calendario_rutinario`.
        $sql = "UPDATE calendario_rutinario SET nombre_personalizado = '$customName', descripcion = '$description' WHERE id_calendario = '$idCalendar' ";

        // Ejecuta la consulta SQL.
        $connect->query($sql);

        // Obtiene el número de filas afectadas por la consulta.
        $affected_rows = $connect->affected_rows;

        // Cierra la conexión a la base de datos.
        $connect->close();

        // Devuelve el número de filas afectadas.
        return $affected_rows;

    }
}