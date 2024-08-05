<?php

include_once ("connect.php");

class Administrador extends conexionBD
{

    /**
     * Obtiene y muestra los ejercicios desde la base de datos en formato HTML.
     * 
     * Este método realiza una consulta a la base de datos para obtener la información de los ejercicios,
     * incluyendo detalles como ID, nombre, series, repeticiones, tiempo de descanso, fecha de registro,
     * y la rutina asociada. Genera un HTML para mostrar estos detalles en una tabla.
     * 
     * @return string El HTML generado con los datos de los ejercicios.
     */
    public static function verEjercicios()
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Crear la consulta SQL
        $sql = "SELECT";
        $sql .= " t1.id_ejercicio, t1.nombre, t1.Instrucctiones, t1.equipoNecesario, t1.seires, t1.repeticiones, t1.tiempo_descanso, t1.fecha_registro, t3.nombreRutina, t3.id_rutina, t1.direccion_media";
        $sql .= " FROM ejercicios t1";
        $sql .= " LEFT JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio";
        $sql .= " LEFT JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina ";

        // Ejecutar la consulta
        $resultado = $conexion->query($sql);

        // Inicializar la variable para almacenar el HTML
        $r = '';

        // Procesar los resultados de la consulta
        while ($fila = $resultado->fetch_array()) {
            $r .= '<tr>';
            $r .= "<td>" . $fila[0] . "</td>"; // Muestra el ID del ejercicio
            $r .= "<td>" . $fila[1] . "</td>"; // Muestra el nombre del ejercicio

            // $r .= "<td>" . $fila[2] . "</td>"; // Muestra las instrucciones
            // $r .= "<td>" . $fila[3] . "</td>"; // Muestra el equipo necesario

            $r .= "<td>" . $fila[4] . "</td>"; // Muestra las series
            $r .= "<td>" . $fila[5] . "</td>"; // Muestra las repeticiones
            $r .= "<td>" . $fila[6] . "</td>"; // Muestra el tiempo de descanso
            $r .= "<td>" . $fila[7] . "</td>"; // Muestra la fecha de registro
            $r .= "<td>";

            // Validar si existe una rutina asociada
            ($fila[8] == '') ? $r .= 'Ninguna rutina asociada' : $r .= $fila[8];
            $r .= "</td>"; // Muestra la rutina asociada

            // $r .= "<td>" . $fila[9] . "</td>"; // Muestra el ID de la rutina

            // Muestra el ejemplo gráfico
            $r .= empty($fila[10]) || file_exists($fila[10]) ?
                "<td>No existe un elemento grafico </td>" :
                "<td><img src='../" . $fila[10] . "' class='img img-fluid' width='100px' alt='Elemento grafico de ejercicio'> </td>";

            $r .= "<td> <a href='../../controller/ejercicioEliminado.php?id_ejercicio=" . $fila[0] . "'><i class='fa-solid fa-trash icono delete'></i></a>";
            $r .= "<td> <a href='../administrador/controladorVadmin.php?exerc=" . $fila[0] . "&seccionAd=updateExercises'><i class='fa-solid fa-pen-to-square icono edit'></i></a>";
            $r .= " </td>";
            $r .= '</tr>';
        }
        // Cierra la conexion a la base de datos
        $conexion->close();

        // Devolver el HTML generado
        return $r;
    }

    /**
     * Elimina datos de una tabla específica en la base de datos.
     *
     * @param int $opc Indica la tabla de la que se eliminarán los datos: 
     *                 0 para la tabla 'rutinas',
     *                 1 para la tabla 'ejercicios',
     *                 2 para la tabla 'usuarios'.
     * @param int $id_data El ID del dato que se desea eliminar.
     * 
     * @return int El número de filas afectadas por la eliminación.
     */
    public static function delete_data($opc, $id_data)
    {

        // Inicializar las variables de tabla e identificador
        $table = '';
        $identifier = '';

        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Determinar la tabla y el identificador según el valor de $opc
        switch ($opc) {
            case 0:
                $table = 'rutinas';
                $identifier = 'id_rutina';
                break;
            case 1:
                $table = 'ejercicios';
                $identifier = 'id_ejercicio';
                break;
            case 2:
                $table = 'usuarios';
                $identifier = 'id_usuario';
                break;
            case 3:
                $table = 'ejercicio_rutinas';
                $identifier = 'id_relacion';
                break;
        }

        // Crear la consulta SQL para eliminar el dato
        $sql = "DELETE FROM $table WHERE $identifier = $id_data ";

        echo $sql;

        // Ejecutar la consulta
        $conexion->query($sql);

        // Obtener el número de filas afectadas
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Devolver el número de filas afectadas
        return $affected_rows;
    }

    /**
     * Cuenta el número total de ejercicios registrados en la base de datos.
     *
     * @return int El número total de ejercicios.
     */
    public static function contadorTotal()
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Consulta SQL para contar el número total de ejercicios
        $sql = "SELECT count(*) FROM ejercicios ";


        // Variable para almacenar el resultado inicializado a 0
        $r = 0;

        // Ejecutar la consulta SQL
        $resulado = $conexion->query($sql);

        // Procesar los resultados de la consulta

        while ($fila = $resulado->fetch_array()) {

            $r = $fila[0]; // Almacenar el resultado de la consulta (número total de ejercicios)

        }

        // Cerrar la conexión a la base de datos
        $conexion->close();


        // Retornar el número total de ejercicios
        return $r;
    }

    /**
     * Obtiene usuarios de la base de datos según la opción especificada.
     *
     * @param int $opc La opción para determinar el tipo de consulta a realizar:
     *                 - 0: Obtener todos los usuarios con detalles.
     *                 - 1: Contar el número total de usuarios.
     *                 - 3: Obtener usuarios por correo y teléfono.
     * @param int|null $rowSelected (Opcional) Índice de la columna a seleccionar en la opción 3:
     *                               - 0: id_usuario
     *                               - 1: nombre
     *                               - 2: apellido
     *                               - 3: correo
     *                               - 4: telefono
     *                               - 5: genero
     *                               - 6: fecha_registro
     *                               - 7: rol
     * @param string|null $email (Opcional) Correo electrónico del usuario para la opción 3.
     * @param string|null $phone (Opcional) Teléfono del usuario para la opción 3.
     *
     * @return string|int Una cadena HTML de filas de una tabla si $opc es 0, el número total de usuarios si $opc es 1,
     *                    o un valor específico según $rowSelected si $opc es 3.
     */
    public static function getUsuarios($opc, $rowSelected = null, $email = null, $phone = null)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Ejecutar la consulta según la opción especificada
        if ($opc == 0) {
            // Obtener todos los usuarios con detalles
            $sql = "SELECT";
            $sql .= " t1.id_usuario, t1.nombre, t1.apellido, t1.correo, t1.telefono, t2.genero, t1.fecha_registro, t3.rol FROM usuarios t1";
            $sql .= " JOIN genero t2 ON t1.id_genero = t2.id_genero ";
            $sql .= " JOIN roles t3 ON t1.id_rol = t3.id_rol ";
        } elseif ($opc == 1) {

            // Contar el número total de usuarios
            $sql = "select COUNT(*) FROM usuarios;";
        } else if ($opc == 3) {

            // Obtener usuarios por correo y teléfono
            $sql = "SELECT";
            $sql .= " t1.id_usuario, t1.nombre, t1.apellido, t1.correo, t1.telefono, t2.genero, t1.fecha_registro, t3.rol FROM usuarios t1";
            $sql .= " JOIN genero t2 ON t1.id_genero = t2.id_genero ";
            $sql .= " JOIN roles t3 ON t1.id_rol = t3.id_rol ";
            $sql .= "WHERE t1.correo = '$email' AND t1.telefono = '$phone'";
        }

        // Ejecutar la consulta SQL
        $r = $conexion->query($sql);

        // Variable para almacenar el resultado final
        $rr = "";

        // Procesar los resultados de la consulta
        while ($fila = $r->fetch_array()) {

            // Para la opción 0, crear filas de una tabla HTML
            if ($opc == 0) {
                $rr .= '<tr>';
                $rr .= '<th scope="row">' . $fila[0] . '</th>';
                $rr .= '<td>' . $fila[1] . '</td>';
                $rr .= '<td>' . $fila[2] . '</td>';
                $rr .= '<td>' . $fila[3] . '</td>';
                $rr .= '<td>' . $fila[4] . '</td>';
                $rr .= '<td>' . $fila[5] . '</td>';
                $rr .= '<td>' . $fila[6] . '</td>';
                $rr .= '<td>' . $fila[7] . '</td>';
                $rr .= "<td> <i class='fa-solid fa-eye icono moreDetails'></i> <i class='fa-solid fa-pen-to-square icono edit'></i> </td>";
                $rr .= '</tr>';
            } elseif ($opc == 1) {

                // Para la opción 1, simplemente devolver el número total de usuarios
                $rr .= $fila[0];
            } elseif ($opc == 3) {

                // Para la opción 3, devolver el valor según $rowSelected
                switch ($rowSelected) {
                    case 0:
                        $rr = $fila[0];
                        break;
                    case 1:
                        $rr = $fila[1];
                        break;
                    case 2:
                        $rr = $fila[2];
                        break;
                    case 3:
                        $rr = $fila[3];
                        break;
                    case 4:
                        $rr = $fila[4];
                        break;
                    case 5:
                        $rr = $fila[5];
                        break;
                    case 6:
                        $rr = $fila[6];
                        break;
                    case 7:
                        $rr = $fila[7];
                        break;

                }
            }
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el resultado final (cadena HTML o número total de usuarios)
        return $rr;
    }


    /**
     * Agrega un nuevo ejercicio a la tabla 'ejercicios' en la base de datos.
     *
     * @param string $nombre El nombre del ejercicio a insertar.
     * @param string $instruc Las instrucciones del ejercicio a insertar.
     * @param string $equiped El equipo necesario para el ejercicio a insertar.
     * @param int $rep El número de repeticiones del ejercicio a insertar.
     * @param int $series El número de series del ejercicio a insertar.
     * @param int $tiempoDes El tiempo de descanso del ejercicio a insertar.
     * @param string $direccion_media La dirección multimedia del ejercicio a insertar.
     * @return int El número de filas afectadas por la operación de inserción.
     */
    public static function agregarEjercicio($nombre, $instruc, $equiped, $rep, $series, $tiempoDes, $direccion_media)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Construir la consulta SQL para insertar el nuevo ejercicio
        $sql = "INSERT INTO ejercicios (nombre, Instrucctiones, equipoNecesario, repeticiones, seires, tiempo_descanso, fecha_registro, direccion_media) ";
        $sql .= "VALUES ('$nombre', '$instruc', '$equiped', '$rep', '$series', '$tiempoDes', now(), '$direccion_media')";

        // Ejecutar la consulta SQL
        $conexion->query($sql);

        // Obtener el número de filas afectadas por la operación de inserción
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el número de filas afectadas por la operación de inserción
        return $affected_rows;
    }

    /**
     * Agrega una nueva rutina a la tabla 'rutinas' en la base de datos.
     *
     * @param string $nombreR El nombre de la rutina a insertar.
     * @param string $descripcionR La descripción de la rutina a insertar.
     * @param string $objetivo El objetivo de la rutina a insertar.
     * @return int El número de filas afectadas por la operación de inserción.
     */
    public static function agregarRutina($category, $nombreR, $descripcionR, $objetivo)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Construir la consulta SQL para insertar la nueva rutina
        $sql = "INSERT INTO rutinas (id_categoria, nombreRutina,descripcion,objetivo,fecha_registro ) VALUES ($category, '$nombreR','$descripcionR','$objetivo', now())";

        // Ejecutar la consulta SQL
        $conexion->query($sql);

        // Obtener el número de filas afectadas por la operación de inserción
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el número de filas afectadas por la operación de inserción
        return $affected_rows;
    }

    /**
     * Actualiza una rutina en la base de datos.
     *
     * Este método actualiza una fila en la tabla `rutinas` con los valores proporcionados para el nombre, 
     * la descripción, el objetivo y la categoría de la rutina especificada por su ID.
     *
     * @param int $id_routine El ID de la rutina que se va a actualizar.
     * @param int $category El ID de la categoría a la que pertenece la rutina.
     * @param string $nombreR El nuevo nombre de la rutina.
     * @param string $descripcionR La nueva descripción de la rutina.
     * @param string $objetivo El nuevo objetivo de la rutina.
     *
     * @return int El número de filas afectadas por la consulta SQL. Si la operación es exitosa,
     *             retornará el número de filas actualizadas. Si no se actualiza ninguna fila (por
     *             ejemplo, si el ID de la rutina no existe), retornará 0.
     */
    public static function updateRoutine($id_routine, $category, $nombreR, $descripcionR, $objetivo)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Construir la consulta SQL para actualizar una rutina
        $sql = "UPDATE rutinas ";
        $sql .= "SET nombreRutina = '$nombreR', ";
        $sql .= "descripcion = '$descripcionR', ";
        $sql .= "objetivo = '$objetivo', ";
        $sql .= "id_categoria = '$category' ";
        $sql .= "WHERE id_rutina = '$id_routine';";

        // Ejecutar la consulta SQL
        $conexion->query($sql);

        // Obtener el número de filas afectadas por la operación de actualización
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el número de filas afectadas por la operación de actualización
        return $affected_rows;
    }

    /**
     * Método estático mostrarEjercicios
     *
     * Este método recupera una lista de ejercicios de la base de datos `worldfitsbd` y 
     * genera una cadena de opciones HTML (`<option>`) para cada ejercicio. 
     * Cada opción tiene como valor el `id_ejercicio` y muestra el `nombre` del ejercicio.
     *
     * @return string  Una cadena de opciones HTML (`<option>`) para cada ejercicio en la base de datos.
     */
    public static function mostrarEjercicios()
    {
        // Conexión a la base de datos
        $conexion = self::getConexion();

        // Consulta SQL para obtener id_ejercicio y nombre de todos los ejercicios
        $sql = "SELECT id_ejercicio, nombre FROM ejercicios ";

        // Ejecutar la consulta
        $resultado = $conexion->query($sql);

        // Variable para almacenar las opciones HTML
        $r = '';

        // Recorrer los resultados de la consulta
        while ($fila = $resultado->fetch_array()) {

            // Generar una opción HTML para cada ejercicio
            $r .= '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar la cadena de opciones HTML
        return $r;
    }


    /**
     * Método estático added_Exercises
     *
     * Este método realiza operaciones en la tabla `ejercicio_rutinas` de la base de datos `worldfitsbd`
     * dependiendo del valor de la variable $opc. Si $opc es 0, se cuenta cuántas veces una combinación 
     * de id_rutina y id_ejercicio ya está presente en la tabla. Si $opc es 1, se inserta una nueva 
     * combinación de id_rutina e id_ejercicio en la tabla.
     *
     * @param int $opc       Opción para determinar la operación a realizar:
     *                       - 0: Contar las combinaciones de id_rutina y id_ejercicio.
     *                       - 1: Insertar una nueva combinación de id_rutina y id_ejercicio.
     * @param int $id_rutina ID de la rutina.
     * @param int $id_ejercico ID del ejercicio (Nota: parece que hay un error tipográfico en el nombre de esta variable, debería ser $id_ejercicio).
     * @return int           El resultado de la operación:
     *                       - Si $opc es 0: Número de veces que la combinación id_rutina y id_ejercicio ya existe.
     *                       - Si $opc es 1: Número de filas afectadas por la inserción (debería ser 1 si la inserción es exitosa).
     */
    public static function added_Exercises($opc, $id_rutina, $id_ejercico)
    {
        // Conexión a la base de datos
        $conexion = self::getConexion();

        // Variable para almacenar la consulta SQL
        if ($opc == 0) {

            $sql = "SELECT count(*) FROM ejercicio_rutinas WHERE id_rutina = $id_rutina AND id_ejercicio = $id_ejercico;";
        } elseif ($opc == 1) {

            $sql = "INSERT INTO ejercicio_rutinas (id_rutina, id_ejercicio) VALUES ($id_rutina, $id_ejercico);";
        }

        // Variable para almacenar el resultado
        $r = 0;

        // Ejecución de la consulta según el valor de $opc
        if ($opc == 0) {

            // Ejecutar la consulta de selección
            $resultado = $conexion->query($sql);

            // Obtener el resultado de la consulta
            while ($fila = $resultado->fetch_array()) {

                $r = $fila[0];
            }
        } elseif ($opc == 1) {
            // Ejecutar la inserción
            $conexion->query($sql);

            // Obtener el número de filas afectadas
            $r = $conexion->affected_rows;
        }
        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el resultado de la operación
        return $r;
    }

    /**
     * Obtiene el último ID de la rutina insertada en la tabla 'rutinas'.
     *
     * @return int El último ID de la rutina insertada, o 0 si no se encontraron resultados.
     */
    public static function getIdrutina()
    {
        // Conexión a la base de datos
        $conexion = self::getConexion();

        // Consulta SQL para obtener el último ID insertado en la tabla 'rutinas'
        $sql = "SELECT MAX(id_rutina) FROM rutinas ";
        // Ejecutar la consulta SQL
        $resultado = $conexion->query($sql);

        // Variable para almacenar el resultado
        $r = 0;

        while ($fila = $resultado->fetch_array()) {
            // Obtener el resultado de la consulta
            $r = $fila[0];
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el resultado de la operación
        return $r;
    }

    /**
     * Método estático See_Added_Exercises
     *
     * Este método recupera una lista de ejercicios asociados a una rutina específica 
     * de la base de datos `worldfitsbd` y genera una cadena de filas HTML (`<tr>`) 
     * para cada ejercicio. Cada fila contiene el ID del ejercicio, el nombre del ejercicio 
     * y un enlace para eliminar la asociación.
     *
     * @param int $id_rutina ID de la rutina para la cual se quieren ver los ejercicios asociados.
     * @return string       Una cadena de filas HTML (`<tr>`) para cada ejercicio asociado a la rutina.
     */
    public static function See_Added_Exercises($id_rutina)
    {
        // Conexión a la base de datos
        $conexion = self::getConexion();


        // Construcción de la consulta SQL para obtener los ejercicios asociados a la rutina
        $sql = "SELECT t2.id_relacion, t3.id_rutina, t3.nombreRutina, t1.id_ejercicio, t1.nombre";
        $sql .= " FROM ejercicios t1";
        $sql .= " JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio";
        $sql .= " JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina";
        $sql .= " WHERE t3.id_rutina = $id_rutina";

        // Ejecutar la consulta
        $resultado = $conexion->query($sql);

        // Variable para almacenar las filas HTML
        $r = '';

        // Recorrer los resultados de la consulta
        while ($fila = $resultado->fetch_array()) {

            // Generar una fila HTML para cada ejercicio
            $r .= '<tr>';
            $r .= '<td>' . $fila[3] . '</td>'; // ID del ejercicio
            $r .= '<td>' . $fila[4] . '</td>'; // Nombre del ejercicio
            $r .= '<td>';
            // Enlace para eliminar la asociación del ejercicio con la rutina
            $r .= '<a href="../../controller/ejercicioEliminado.php?idRelacion=' . $fila[0] . '&mtDelete=2&iroutine=' . $id_rutina . '" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"> ';
            $r .= '<i class="fa-solid fa-delete-left fs-5"></i>';
            $r .= '</a> ';
            $r .= '</td>';
            $r .= '</tr>';
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar la cadena de filas HTML
        return $r;
    }

    /**
     * Método estático quitarEjercicio
     *
     * Este método elimina una relación entre un ejercicio y una rutina en la base de datos `worldfitsbd`
     * basado en el ID de la relación (`id_relacion`).
     *
     * @param int $id_relacion ID de la relación que se desea eliminar de la tabla `ejercicio_rutinas`.
     * @return int             El número de filas afectadas por la operación de eliminación.
     */
    public static function quitarEjercicio($id_relacion)
    {
        // Conexión a la base de datos
        $conexion = self::getConexion();

        // Consulta SQL para eliminar la relación entre el ejercicio y la rutina
        $sql = "DELETE FROM ejercicio_rutinas WHERE id_relacion = $id_relacion ";

        // Ejecutar la consulta
        $conexion->query($sql);
        // Obtener el número de filas afectadas por la operación de eliminación
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el número de filas afectadas
        return $affected_rows;
    }

    /**
     * Crea una nueva categoría en la tabla `categorias_rutinas`.
     * 
     * Este método inserta una nueva categoría en la base de datos con el nombre proporcionado.
     * 
     * @param string $nameCategory El nombre de la categoría que se desea agregar.
     * 
     * @return int El número de filas afectadas por la operación de inserción.
     */
    public static function createCategory($nameCategory)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Crear la consulta SQL para insertar la nueva categoría
        $sql = "INSERT INTO categorias_rutinas (categoria) VALUES ('$nameCategory');";

        // Ejecutar la consultaF
        $conexion->query($sql);

        // Obtener el número de filas afectadasf
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retornar el número de filas afectadas
        return $affected_rows;
    }

    /**
     * Muestra las rutinas desde la base de datos.
     * 
     * Este método realiza una consulta a la base de datos para obtener las rutinas y generar
     * el HTML correspondiente para mostrar los resultados en una tabla. La información mostrada
     * depende del valor del parámetro `$opc`.
     * 
     * @param int $opc Indica el tipo de información que se debe recuperar:
     *                 - `0`: Contar el número total de rutinas.
     *                 - `1`: Obtener detalles de las rutinas, incluyendo ID, nombre, objetivo, fecha de registro y categoría asociada.
     * 
     * @return string El HTML generado con los datos de las rutinas. Si `$opc` es `0`, se devuelve el número total de rutinas.
     */
    public static function showRoutines($opc)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Crear la consulta SQL
        $sql = "SELECT ";

        if ($opc == 0) {

            // Contar el número total de rutinas
            $sql .= "count(*) ";
        } else {

            // Obtener detalles de las rutinas
            $sql .= "t1.id_rutina, t1.nombreRutina, t1.objetivo , t1.fecha_registro, t2.categoria ";
        }

        // Completar la consulta SQL
        $sql .= "FROM rutinas t1 JOIN categorias_rutinas t2 ON t1.id_categoria = t2.id_categoria ";

        // Ejecutar la consulta
        $result = $conexion->query($sql);

        // Inicializar la variable para almacenar el HTMLF
        $r = '';

        // Procesar los resultados de la consulta
        while ($fila = $result->fetch_array()) {

            if ($opc == 0) {

                $r = $fila[0];
                // Si `$opc` es `0`, devolver el número total de rutinas
            } else {

                // Si `$opc` no es `0`, generar el HTML con los detalles de las rutinas
                $r .= '<tr>';
                $r .= "<td>" . $fila[0] . "</td>"; // Muestra el ID de la rutina
                $r .= "<td>" . $fila[1] . "</td>"; // Muestra el nombre de la rutina
                $r .= "<td>" . $fila[2] . "</td>"; // Muestra el objetivo de la rutina
                $r .= "<td>" . $fila[3] . "</td>"; // Muestra la fecha de registro
                $r .= "<td>" . $fila[4] . "</td>"; // Muestra la categoría asociada
                $r .= "<td> <i class='fa-solid fa-eye icono moreDetails'></i>   <a href='../../controller/deleteRoutine.php?id_routine=" . $fila[0] . "'><i class='fa-solid fa-trash icono delete'></i></a>    <a href='controladorVadmin.php?dRoutine=" . $fila[0] . "&seccionAd=addRutina'><i class='fa-solid fa-pen-to-square icono edit'></i></a>";
                $r .= " </td>";
                $r .= '</tr>';
            }
        }
        // Cierra la conexion a la base de datos
        $conexion->close();

        // Devolver el resultado
        return $r;
    }

    /**
     * Actualiza los detalles de un ejercicio en la base de datos.
     *
     * @param int $id ID del ejercicio a actualizar.
     * @param string $newName Nuevo nombre del ejercicio.
     * @param string $newInstructions Nuevas instrucciones para el ejercicio.
     * @param string $newEquiped Equipo necesario para realizar el ejercicio.
     * @param int $newSets Número de series del ejercicio.
     * @param int $newRepetions Número de repeticiones del ejercicio.
     * @param int $newbreakTime Tiempo de descanso entre series en segundos.
     * @param string $pathvideo Ruta del video relacionado con el ejercicio.
     *
     * @return int El número de filas afectadas por la consulta.
     */
    public static function updateExercises($id, $newName, $newInstructions, $newEquiped, $newSets, $newRepetions, $newbreakTime, $pathvideo)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Crear la consulta SQL para actualizar los detalles del ejercicio
        $sql = "UPDATE ejercicios SET nombre = '$newName',
        Instrucctiones= '$newInstructions', 
        equipoNecesario = '$newEquiped', 
        repeticiones = $newRepetions, 
        seires = $newSets, 
        tiempo_descanso = $newbreakTime, 
        direccion_media = '$pathvideo', 
        dateLastUpdated = now() 
        WHERE id_ejercicio = $id";

        // Ejecutar la consulta SQL
        $conexion->query($sql);

        // Obtener el número de filas afectadas por la consulta
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Devolver el número de filas afectadas
        return $affected_rows;
    }

    /**
     * Registra un nuevo gimnasio en la base de datos.
     *
     * @param string $name Nombre del gimnasio.
     * @param int $category_gym ID de la categoría del gimnasio.
     * @param string $description Descripción del gimnasio.
     * @param string $mission Misión del gimnasio.
     * @param string $vision Visión del gimnasio.
     * @param string $pathImage Ruta de la imagen del gimnasio.
     * @param string $morning_time_weekday_start Hora de inicio de la mañana durante los días de semana.
     * @param string $morning_time_weekday_end Hora de fin de la mañana durante los días de semana.
     * @param string $afternoon_time_weekday_start Hora de inicio de la tarde durante los días de semana.
     * @param string $afternoon_time_weekday_end Hora de fin de la tarde durante los días de semana.
     * @param string $morning_time_weekend_start Hora de inicio de la mañana durante los fines de semana.
     * @param string $morning_time_weekend_end Hora de fin de la mañana durante los fines de semana.
     * @param string $afternoon_time_weekend_start Hora de inicio de la tarde durante los fines de semana.
     * @param string $afternoon_time_weekend_end Hora de fin de la tarde durante los fines de semana.
     * @param int $phone Número de teléfono del gimnasio.
     * @param string $email Correo electrónico del gimnasio.
     * @param string $address Dirección del gimnasio.
     * @param int $payment_method ID del método de pago aceptado por el gimnasio.
     * @param int $id_manager ID del gerente del gimnasio.
     *
     * @return int El número de filas afectadas por la consulta.
     */
    public static function registredGym(
        $name,
        $category_gym,
        $description,
        $mission,
        $vision,
        $pathImage,
        $morning_time_weekday_start,
        $morning_time_weekday_end,
        $afternoon_time_weekday_start,
        $afternoon_time_weekday_end,
        $morning_time_weekend_start,
        $morning_time_weekend_end,
        $afternoon_time_weekend_start,
        $afternoon_time_weekend_end,
        $phone,
        $email,
        $address,
        $payment_method,
        $id_manager
    ) {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Crear la consulta SQL completa para insertar los datos en la tabla `infoGyms`
        $sql = "INSERT INTO infoGyms (
        name, id_categoria, description, mission, vision, pathImage,
        time_start_morning_DAY, time_end_morning_DAY, time_start_afternoon_DAY, time_end_afternoon_DAY,
        time_start_morning_END, time_end_morning_END, time_start_afternoon_END, time_end_afternoon_END,
        phone, mail, direction, id_pay, id_gerente
    ) VALUES (
        '$name', $category_gym, '$description', '$mission', '$vision', '$pathImage',
        '$morning_time_weekday_start', '$morning_time_weekday_end', '$afternoon_time_weekday_start', '$afternoon_time_weekday_end',
        '$morning_time_weekend_start', '$morning_time_weekend_end', '$afternoon_time_weekend_start', '$afternoon_time_weekend_end',
        $phone, '$email', '$address', $payment_method, $id_manager
    )";

        // Ejecutar la consulta SQL
        $conexion->query($sql);

        // Obtener el número de filas afectadas por la consulta
        $affected_rows = $conexion->affected_rows;

        // Cerrar la conexión a la base de datos
        $conexion->close();
        // Devolver el número de filas afectadas
        return $affected_rows;

    }

}
