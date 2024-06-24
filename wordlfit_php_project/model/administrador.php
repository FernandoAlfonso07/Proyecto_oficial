<?php

include ("connect.php");

class Administrador extends conexionBD
{


    public static function verEjercicios()
    {
        $conexion = conexionBD::getConexion();
        $sql = "select";
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
            $r .= "<td> <i class='fa-solid fa-eye icono moreDetails'></i>   <i class='fa-solid fa-trash icono delete'></i>    <i class='fa-solid fa-pen-to-square icono edit'></i> 
             </td>";
            $r .= '</tr>';
        }

        return $r;
    }

    public static function contadorTotal() // Metodo para un contar el total de ejercicios.
    {
        $conexion = conexionBD::getConexion();

        $sql = "select count(*) FROM ejercicios ";

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

            $sql = "select";
            $sql .= " t1.id_usuario, t1.nombre, t1.apellido, t1.correo, t1.telefono, t2.genero, t1.fecha_registro, t3.rol from usuarios t1";
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

        $sql = "insert INTO ejercicios (nombre, Instrucctiones, equipoNecesario, repeticiones, seires, tiempo_descanso, fecha_registro, direccion_media) ";
        $sql .= "VALUES ('$nombre', '$instruc', '$equiped', '$rep', '$series', '$tiempoDes', now(), '$direccion_media')";
        echo $sql;
        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();

    }
}
