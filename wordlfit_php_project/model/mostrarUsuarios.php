<?php
include ("connect.php");


class MostrarUsuarios extends conexionBD
{
    public static function getUsuarios($opc)
    {
        $conexion = self::getConexion();
        if ($opc == 0) {
            $sql = "select t1.id_usuario, t1.nombre, t1.apellido, t1.correo, t1.telefono, t2.genero, t1.fecha_registro from usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero";
        } elseif ($opc == 1) {
            $sql = "select count(*) from usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero";
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
                $rr .= '</tr>';
            } elseif ($opc == 1) {
                $rr .= $fila[0];
            }


        }
        return $rr;
    }
}






