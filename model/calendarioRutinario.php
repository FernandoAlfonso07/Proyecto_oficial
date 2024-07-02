<?php

include ('connect.php');


class calendarioRutinario extends conexionBD
{

    public static function mostrarCalendario($opc, $opcMuestra = null, $dia = null, $p = null)
    {

        $conexion = conexionBD::getConexion();

        $sql = "select ";

        if ($opc == 0) {
            $sql .= "count(*) ";

        } elseif ($opc == 1) {
            $sql .= "t4.nombre,
t2.direccion_media,
t2.nombre,
t2.Instrucctiones,
t2.equipoNecesario,
t2.seires,
t2.repeticiones,
t2.tiempo_descanso ";
        }

        $sql .= "FROM dias_semana t4
JOIN relacion_dia_rutina t5 ON t4.id_dia = t5.id_dia
JOIN ejercicio_rutinas t1 ON t5.id_rutina = t1.id_rutina
JOIN ejercicios t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina WHERE t4.id_dia = '$dia' ";

        if ($opc == 0) {
            $sql .= "";
        } elseif ($opc == 1) {
            $sql .= "limit $p ,1;";
        }

        // echo $sql;

        $resultado = $conexion->query($sql);

        $rr = "";

        while ($fila = $resultado->fetch_array()) {

            if ($opc == 0) {
                $rr = $fila[0];

            } elseif ($opc == 1) {

                switch ($opcMuestra) {
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
        return $rr;
    }

    public static function optionPage($p)
    {
        $r = '';
        for ($i = 0; $i < self::mostrarCalendario(0); $i++) {

            $p2 = $p * 1;

            if ($p2 == $i) {

                $r .= '<a href="../vista/enRutinasCr.php?p=' . $i . '"> ';
                $r .= '<button class="btn btn-primary btn-gradient botones activo">' . $i . '</button> </a>';

            } else {

                $r .= '<a href="../vista/enRutinasCr.php?p=' . $i . '"> ';
                $r .= '<button class="btn bg-primary-subtle btn-gradient botones">' . $i . '</button> </a>';

            }

        }
        return $r;

    }


    public static function getDay($opc)
    {

        $conexion = conexionBD::getConexion();

        $sql = "select * from dias_semana ";

        $r = $conexion->query($sql);
        $r = '';
        while ($fila = $r->fetch_array()) {
            if ($opc == 0) {
                $r = $fila[0]; // Esto muestra el id del dia.
            } else {
                $r = $fila[1]; // Esto muestra el Nombre del dia.
            }
        }

    }

}
