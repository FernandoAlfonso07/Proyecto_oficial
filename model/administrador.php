<?php

include_once ("connect.php");

class Administrador extends conexionBD
{


    public static function verEjercicios()
    {
        $conexion = self::getConexion();

        $sql = "SELECT";
        $sql .= " t1.id_ejercicio, t1.nombre, t1.Instrucctiones, t1.equipoNecesario, t1.seires, t1.repeticiones, t1.tiempo_descanso, t1.fecha_registro, t3.nombreRutina, t3.id_rutina, t1.direccion_media";
        $sql .= " FROM ejercicios t1";
        $sql .= " LEFT JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio";
        $sql .= " LEFT JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina ";

        $resultado = $conexion->query($sql);

        $r = '';
        while ($fila = $resultado->fetch_array()) {
            $r .= '<tr>';
            $r .= "<td>" . $fila[0] . "</td>"; // Esto muestra el ID
            $r .= "<td>" . $fila[1] . "</td>"; // Esto muestra el NOMBRE

            // $r .= "<td>" . $fila[2] . "</td>"; // Esto muestra el INSTRUCCIONES
            // $r .= "<td>" . $fila[3] . "</td>"; // Esto muestra el EQUIPO REQUERIDO PARA EL EJERCICIO

            $r .= "<td>" . $fila[4] . "</td>"; // Esto muestra el SEIRES
            $r .= "<td>" . $fila[5] . "</td>"; // Esto muestra el REPETICIONES
            $r .= "<td>" . $fila[6] . "</td>"; // Esto muestra el TIEMPO DE DESCANSO
            $r .= "<td>" . $fila[7] . "</td>"; // Esto muestra el FECHA DE REGISTRO
            $r .= "<td>";

            ($fila[8] == '') ? $r .= 'Ninguna rutina asociada' : $r .= $fila[8]; // Descición para validar que existe una rutina asociada

            $r .= "</td>";// Muestra la RUTINA ASOCIADA

            // $r .= "<td>" . $fila[9] . "</td>"; // Esto muestra el ID DE LA RUTINA

            $r .= "<td>" . $fila[10] . "</td>"; // Esto muestra el EJEMPLO GRAFICO
            $r .= "<td> <i class='fa-solid fa-eye icono moreDetails'></i>   <a href='../../controler/ejercicioEliminado.php?id_ejercicio=" . $fila[0] . "'><i class='fa-solid fa-trash icono delete'></i></a>    <i class='fa-solid fa-pen-to-square icono edit'></i> 
             </td>";
            $r .= '</tr>';
        }

        return $r;
    }


    public static function borrarEjercicio($id_ejercicio)
    {


        $conexion = self::getConexion();

        $sql = "DELETE FROM ejercicios WHERE id_ejercicio = $id_ejercicio ";


        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();

        return $affected_rows;

    }

    public static function contadorTotal() // Metodo para un contar el total de ejercicios.
    {
        $conexion = self::getConexion();

        $sql = "SELECT count(*) FROM ejercicios ";

        $r = 0;

        $resulado = $conexion->query($sql);

        while ($fila = $resulado->fetch_array()) {

            $r = $fila[0];

        }

        return $r;
    }

    public static function getUsuarios($opc)
    {
        $conexion = self::getConexion();

        if ($opc == 0) {

            $sql = "SELECT";
            $sql .= " t1.id_usuario, t1.nombre, t1.apellido, t1.correo, t1.telefono, t2.genero, t1.fecha_registro, t3.rol FROM usuarios t1";
            $sql .= " JOIN genero t2 ON t1.id_genero = t2.id_genero ";
            $sql .= " JOIN roles t3 ON t1.id_rol = t3.id_rol ";

        } elseif ($opc == 1) {
            $sql = "select COUNT(*) FROM usuarios;";
        }

        $r = $conexion->query($sql);
        $rr = "";

        while ($fila = $r->fetch_array()) {
            // Version 3 para implementar
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
                $rr .= "<td> <i class='fa-solid fa-eye icono moreDetails'></i>   <i class='fa-solid fa-trash icono delete'></i>    <i class='fa-solid fa-pen-to-square icono edit'></i> </td>";
                $rr .= '</tr>';
            } elseif ($opc == 1) {
                $rr .= $fila[0];
            }


        }
        return $rr;
    }



    public static function agregarEjercicio($nombre, $instruc, $equiped, $rep, $series, $tiempoDes, $direccion_media)
    {
        $conexion = self::getConexion();

        $sql = "INSERT INTO ejercicios (nombre, Instrucctiones, equipoNecesario, repeticiones, seires, tiempo_descanso, fecha_registro, direccion_media) ";
        $sql .= "VALUES ('$nombre', '$instruc', '$equiped', '$rep', '$series', '$tiempoDes', now(), '$direccion_media')";
        echo $sql;

        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        return $affected_rows;

    }


    public static function agregarRutina($nombreR, $descripcionR, $objetivo)
    {
        $conexion = self::getConexion();
        $sql = "INSERT INTO rutinas (nombreRutina,descripcion,objetivo,fecha_registro ) VALUES ('$nombreR','$descripcionR','$objetivo', now())";

        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

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


    public static function getIdrutina()
    {
        // Conexión a la base de datos
        $conexion = self::getConexion();

        $sql = "SELECT LAST_INSERT_ID() ";

        $resultado = $conexion->query($sql);
        $r = 0;
        while ($fila = $resultado->fetch_array()) {
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
     * @return string        Una cadena de filas HTML (`<tr>`) para cada ejercicio asociado a la rutina.
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
            $r .= '<a href="../../controler/quitarEjercicio.php?idRelacion=' . $fila[0] . '" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"> ';
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
}
