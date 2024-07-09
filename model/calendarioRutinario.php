<?php

include_once ("connect.php");


class calendarioRutinario extends conexionBD
{

    /**
     * Este metodo tiene la funcionalidad principal del proyecto, debido a que muestra las rutinas que ofrece el sitema para el usuario.
     * 
     * @param $opc = sirve para escoger la opcion por donde vaya el flujo de codigo sql y su respuesta.
     * @param $opcMuestra = Con este parametro se escoge el resultado que se quiera mostrar.
     * @param $dia = Con este parametro se trae el dia para que muestre las rutinas asociadas a ese dia.
     * @param $p = Con este parametro se identifica la pagina en la que esta la cual da lugar al Limit del SQL
     */
    public static function mostrarCalendario($opc, $opcMuestra = null, $dia = null, $p = null)
    {

        $conexion = self::getConexion();

        $sql = "select ";

        if ($opc == 0) {
            $sql .= "count(*) ";

        } elseif ($opc == 1) {
            $sql .= "t2.nombre,
t5.direccion_media,
t5.nombre,
t5.Instrucctiones,
t5.equipoNecesario,
t5.seires,
t5.repeticiones,
t5.tiempo_descanso ";
        }

        $sql .= "FROM calendario_rutinario t1 
JOIN dias_semana t2 ON t1.id_dia = t2.id_dia
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina
JOIN ejercicio_rutinas t4 ON t4.id_rutina = t3.id_rutina
JOIN ejercicios t5 ON t4.id_ejercicio = t5.id_ejercicio
WHERE t1.id_dia = '$dia' ";

        if ($opc == 0) {
            $sql .= "";
        } elseif ($opc == 1) {
            $sql .= "LIMIT $p , 1;";
        }

        // echo $sql;

        $resultado = $conexion->query($sql);

        $rr = "";

        while ($fila = $resultado->fetch_array()) {

            if ($opc == 0) {
                $rr = $fila[0]; // Muestra el conteo total de ejercicios en esa rutina.

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

                $r .= '<a href="../view/enRutinasCr.php?p=' . $i . '"> ';
                $r .= '<button class="btn btn-primary btn-gradient botones activo">' . $i . '</button> </a>';

            } else {

                $r .= '<a href="../view/enRutinasCr.php?p=' . $i . '"> ';
                $r .= '<button class="btn bg-primary-subtle btn-gradient botones">' . $i . '</button> </a>';

            }

        }
        return $r;

    }

}
