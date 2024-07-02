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


    public static function getPerfil($opc, $idUsuario)
    {
        $conexion = self::getConexion();

        $sql = "select t1.nombre, t1.apellido, t1.correo, t1.password, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero, t1.imgPerfil ";
        $sql .= "FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = $idUsuario";
        $resultado = $conexion->query($sql);
        $r = '';
        while ($fila = $resultado->fetch_array()) {


            switch ($opc) {
                case 0: // Muestra NOMBRE

                    $r .= $fila[0];
                    //$r = self::getInformacion(1, $idUsuario); Opción a implementar.

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
        return $r;
    }

    public static function eliminarCuenta($id)
    {

        $conexion = self::getConexion();

        $sql = "delete from usuarios where id_usuario = $id ";


        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();

    }

    public static function registrar($nombres, $apellidos, $telefono, $correoElectronico, $password, $pesoActual, $altura, $genero)
    {
        $conexion = self::getConexion();

        $sql = "insert into usuarios (nombre, apellido, telefono, correo, password, peso_actual, altura_actual, id_genero, fecha_registro, id_rol)";
        $sql .= " values ('$nombres' ,'$apellidos', '$telefono', '$correoElectronico', '$password', $pesoActual ,$altura, $genero, now(), 0) ";
        echo $sql;
        $resultado = $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();
    }


    public static function actualizarDatos($id, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen)
    {
        $conexion = self::getConexion();

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

        echo 'Variable de session' . $id;

        // echo $sql;

        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();
    }
}
