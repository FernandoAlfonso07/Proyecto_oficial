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

            /* Version 2 para implementar
                        if ($opc == 0) {
                            $rr .= $fila[0]. '<br>';

                        } elseif ($opc == 1) {
                            $rr .= $fila[1].  '<br>';

                        } elseif ($opc == 2) {
                            $rr .= $fila[2]. '<br>';

                        } elseif ($opc == 3) {
                            $rr .= $fila[3]. '<br>';

                        } elseif ($opc == 4) {
                            $rr .= $fila[4]. '<br>';

                        } elseif ($opc == 5) {
                            $rr .= $fila[5]. '<br>';

                        } elseif ($opc == 6) {
                            $rr .= $fila[6]. '<br>';}
                            */




            /* Version 1 para implementar
            $rr .= '<div class="col-md-1"> <b>ID usuario </b>';
            $rr .= '<div class="row">';
            $rr .= '<div class="col-md-12">' . $fila[0] . ' </div>';
            $rr .= '</div>';
            $rr .= '</div>';
            $rr .= '<div class="col-md-2"> Nombre';
            $rr .= '<div class="row">';
            $rr .= '<div class="col-md-12"> ' . $fila[1] . ' </div>';
            $rr .= '</div>';
            $rr .= '</div>';
            $rr .= '<div class="col-md-2"> Apellidos';
            $rr .= '<div class="row">';
            $rr .= '<div class="col-md-12"> ' . $fila[2] . '</div>';
            $rr .= '</div>';
            $rr .= '</div>';
            $rr .= '<div class="col-md-2"> Correo';
            $rr .= '<div class="row">';
            $rr .= '<div class="col-md-12"> ' . $fila[3] . ' </div>';
            $rr .= '</div>';
            $rr .= '</div>';
            $rr .= '</div>';
            $rr .= '<div class="col-md-2"> Telefono';
            $rr .= '<div class="row">';
            $rr .= '<div class="col-md-12"> ' . $fila[4] . ' </div>';
            $rr .= '</div>';
            $rr .= '</div>';
            $rr .= '<div class="col-md-1"> Genero';
            $rr .= '<div class="row">';
            $rr .= '<div class="col-md-12"> ' . $fila[5] . ' </div>';
            $rr .= '</div>';
            $rr .= '</div>';
            $rr .= '<div class="col-md-2"> Fecha de registro';
            $rr .= '<div class="row">';
            $rr .= '<div class="col-md-12"> ' . $fila[6] . ' </div>';
            $rr .= '</div>';
            $rr .= '</div>';
            */

        }
        return $rr;
    }
}






