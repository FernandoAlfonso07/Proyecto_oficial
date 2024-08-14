<?php

include_once ("connect.php");


class calendarioRutinario extends conexionBD
{

    /**
     * Recupera el valor máximo de 'id_calendario' de la tabla 'calendario_rutinario'.
     *
     * Este método establece una conexión a la base de datos, ejecuta una consulta 
     * para encontrar el valor máximo de 'id_calendario' en la tabla 
     * 'calendario_rutinario' y retorna este valor. Si la tabla está vacía, 
     * retorna 0.
     *
     * @return int El valor máximo de 'id_calendario' de la tabla 'calendario_rutinario'.
     */
    public static function getID()
    {
        // Establece la conexión a la base de datos
        $conexion = self::getConexion();

        // Consulta SQL para obtener el valor máximo de 'id_calendario' de la tabla 'calendario_rutinario'
        $sql = "SELECT MAX(id_calendario) FROM calendario_rutinario ";

        // Ejecuta la consulta y guarda el resultado
        $resultado = $conexion->query($sql);

        // Variable para almacenar el valor máximo de 'id_calendario'
        $r = 0;

        // Itera sobre el resultado de la consulta
        while ($fila = $resultado->fetch_array()) {

            // Asigna el valor obtenido a la variable $r
            $r = $fila[0];
        }

        // Cierra la conexión a la base de datos
        $conexion->close();

        // Retorna el valor máximo de 'id_calendario'
        return $r;
    }

    /**
     * Muestra información del calendario y las rutinas asociadas basadas en las opciones proporcionadas.
     *
     * Este método consulta la base de datos para obtener información de las rutinas
     * de un calendario específico en un día determinado. Dependiendo de la opción
     * proporcionada, puede retornar el conteo total de ejercicios o detalles específicos
     * de los ejercicios.
     *
     * @param int $opc Opción para determinar el tipo de consulta: 0 para contar, 1 para detalles.
     * @param int|null $opcMuestra Opción para determinar qué detalle mostrar cuando $opc es 1.
     * @param int|null $dia El día de la semana (1-7).
     * @param int|null $p Posición para el límite de consulta cuando $opc es 1.
     * @param int|null $id_calendar El ID del calendario.
     * @return mixed El resultado de la consulta, ya sea un conteo o un detalle específico.
     */
    public static function mostrarCalendario($opc, $opcMuestra = null, $dia = null, $p = null, $id_calendar = null)
    {

        // Establece la conexión a la base de datos
        $conexion = self::getConexion();

        // Construye la consulta SQL base
        $sql = "select ";

        // Determina el tipo de consulta según $opc
        if ($opc == 0) {
            $sql .= "count(*) "; // Consulta para contar el total de registros 

        } elseif ($opc == 1) {
            // Consulta para obtener detalles de los ejercicios y rutinas
            $sql .= "t3.nombre,
t6.direccion_media,
t6.nombre,
t6.Instrucctiones,
t6.equipoNecesario,
t6.seires,
t6.repeticiones,
t6.tiempo_descanso ";
        }

        // Continúa con la construcción de la consulta SQL
        $sql .= "FROM relacion_calendario_rutinas t1 
JOIN calendario_rutinario t2 ON t1.id_calendario = t2.id_calendario 
JOIN dias_semana t3 ON t3.id_dia = t1.id_dia 
JOIN rutinas t4 ON t4.id_rutina = t1.id_rutina 
JOIN ejercicio_rutinas t5 ON t5.id_rutina = t4.id_rutina 
JOIN ejercicios t6 ON t6.id_ejercicio = t5.id_ejercicio 
WHERE t1.id_dia = '$dia' AND t2.id_calendario = '$id_calendar' ";

        // Añade un límite a la consulta si $opc es 1
        if ($opc == 0) {
            $sql .= ""; // Sin límite para conteo
        } elseif ($opc == 1) {
            $sql .= "LIMIT $p , 1;"; // Límite para paginación
        }
        // Ejecuta la consulta SQL
        $resultado = $conexion->query($sql);

        // Variable para almacenar el resultado de la consulta
        $rr = "";

        // Itera sobre el resultado de la consulta
        while ($fila = $resultado->fetch_array()) {

            // Si $opc es 0, devuelve el conteo total de registros
            if ($opc == 0) {
                $rr = $fila[0]; // Muestra el conteo total de ejercicios en esa rutina.

            } elseif ($opc == 1) {
                // Si $opc es 1, selecciona el campo específico según $opcMuestra
                $rr = $fila[$opcMuestra] ?? null;
            }
        }
        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Retorna el resultado de la consulta
        return $rr;
    }

    /**
     * Genera una serie de enlaces HTML para la paginación basada en el calendario.
     *
     * Este método toma un número de página, un día y un ID de calendario, luego 
     * genera una serie de enlaces HTML con botones para la paginación. Si la página 
     * actual coincide con el índice, el botón se marcará como activo.
     *
     * @param int $p El número de página actual.
     * @param int $day El día para filtrar el calendario.
     * @param int $id_calendar El ID del calendario para generar las opciones de página.
     * @return string Una cadena de enlaces HTML con botones para la paginación.
     */
    public static function optionPage($p, $day, $id_calendar, $id_usu)
    {
        // Variable para almacenar el HTML generado
        $r = '';
        // Obtiene el total de páginas/calendarios
        $total = self::mostrarCalendario(0, null, $day, null, $id_calendar);

        // Itera sobre el total de páginas/calendarios
        for ($i = 0; $i < $total; $i++) {
            // Multiplica la página actual por 1 (conversion a tipo int)
            $p2 = $p * 1;

            // Verifica si la página actual coincide con el índice
            if ($p2 == $i) {

                // Si coincide, añade un enlace con un botón marcado como activo
                $r .= '<a href="../view/enRutinasCr.php?usu=' . $id_usu . '&calendar=' . $id_calendar . '&p=' . $i . '"> ';
                $r .= '<button class="btn btn-primary btn-gradient botones activo">' . $i . '</button> </a>';

            } else {

                // Si no coincide, añade un enlace con un botón normal
                $r .= '<a href="../view/enRutinasCr.php?usu=' . $id_usu . '&calendar=' . $id_calendar . '&p=' . $i . '"> ';
                $r .= '<button class="btn bg-primary-subtle btn-gradient botones">' . $i . '</button> </a>';

            }
        }

        // Retorna la cadena de enlaces HTML generada
        return $r;

    }

    /**
     * Obtiene el ID de la rutina asociada a un calendario y un día específicos.
     *
     * @param int $id_calendar El ID del calendario para buscar la rutina.
     * @param int $id_dia El ID del día para buscar la rutina.
     * @return string El ID de la rutina asociada, o una cadena vacía si no se encuentra ninguna.
     */
    public static function getIdRoutine($id_calendar, $id_dia)
    {

        $connect = self::getConexion(); // Obtiene una conexión a la base de datos.

        // Prepara la consulta SQL para obtener el ID de la rutina asociado al calendario y al día especificados.
        $sql = "SELECT t2.id_rutina FROM relacion_calendario_rutinas t1 
                JOIN rutinas t2 ON t1.id_rutina = t2.id_rutina 
                JOIN calendario_rutinario t3 ON t3.id_calendario = t1.id_calendario 
                JOIN dias_semana t4 ON t4.id_dia = t1.id_dia
                WHERE t3.id_calendario = '$id_calendar' AND t4.id_dia = '$id_dia' ";

        // Ejecuta la consulta SQL.
        $response = $connect->query($sql);

        // Inicializa una variable para almacenar el resultado.
        $exit = '';

        while ($row = $response->fetch_array()) {
            $exit = $row[0]; // Asigna el ID de la rutina a la variable `$exit`.
        }

        // Cierra la conexión a la base de datos.
        $connect->close();

        // Devuelve el ID de la rutina encontrado o una cadena vacía si no se encontró ninguna.
        return $exit;
    }


    /**
     * Obtiene las rutinas del calendario de un usuario y las muestra en formato HTML.
     *
     * @param int $opc Indica el tipo de consulta: 0 para contar las rutinas, 1 para obtener detalles de las rutinas.
     * @param int $id_user El ID del usuario cuyas rutinas se desean obtener.
     * 
     * @return string El resultado de la consulta: un número si $opc es 0, o HTML con los detalles de las rutinas si $opc es 1.
     */
    public static function getCalendarRoutinesUser($opc, $id_user)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Iniciar la consulta SQL
        $sql = "SELECT ";

        // Modificar la consulta según el valor de $opc
        if ($opc == 0) {
            $sql .= "COUNT(*) ";
        } elseif ($opc == 1) {
            $sql .= "t1.id_calendario, t1.nombre_personalizado, t1.descripcion, t1.fecha_registro ";
        }

        // Completar la consulta SQL
        $sql .= "FROM calendario_rutinario t1 JOIN usuarios t2 ON t1.id_usuario = t2.id_usuario WHERE t2.id_usuario = '$id_user' ";

        // Ejecutar la consulta
        $result = $conexion->query($sql);
        $r = '';

        // Procesar los resultados de la consulta
        while ($row = $result->fetch_array()) {

            if ($opc == 0) {
                $r = $row[0]; // Devolver el número de rutinas
            } elseif ($opc == 1) {
                // Generar HTML con los detalles de las rutinas
                $r .= '<div class="container calendario_usuario">';
                $r .= '    <div class="row">';
                $r .= '        <div class="col-md-12 seccion_de_cada_calendario">';
                $r .= '            <a href="enRutinasCr.php?usu=' . $id_user . '&calendar=' . $row[0] . '&p=0">';
                $r .= '                <div class="row">';
                $r .= '                    <div class="col-md-6">';
                $r .= '                        <h1>' . $row[1] . '</h1>';
                $r .= '                        <p>' . $row[3] . '</p>';
                $r .= '                        <h4><b>descripcion</b></h4>';
                $r .= '                        <p>' . $row[2] . '</p>';
                $r .= '                    </div>';
                $r .= '                    <div class="col-md-6 text-center position-relative">';
                $r .= '                        <i class="fa-regular fa-calendar icono_calendario"></i>';
                $r .= '                    </div>';
                $r .= '                </div>';
                $r .= '            </a>';
                $r .= '        </div>';
                $r .= '    </div>';
                $r .= '</div>';
            }
        }
        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Devolver el resultado
        return $r;


    }
}