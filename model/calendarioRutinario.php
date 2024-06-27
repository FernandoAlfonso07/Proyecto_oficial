<?php

include ('connect.php');


class calendarioRutinario extends conexionBD
{

    public static function mostrarCalendario($opc, $dia = null, $p = null)
    {

        $conexion = conexionBD::getConexion();

        $sql = "select ";

        if ($opc == 0) {
            $sql .= "count(*) ";

        } elseif ($opc == 1) {
            $sql .= " t4.id_dia,
        t4.nombre AS dia,
        t3.id_rutina,
        t3.descripcion,
        t3.nombreRutina AS nombre_rutina,
        t3.fecha_registro,
        t3.objetivo,
        t2.nombre AS nombre_ejercicio,
        t2.tiempo_descanso AS Descanso_min ";
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

                /*
                 $rr = "<div class=\"row\">";
                 $rr .= "<div class=\"col-md-4 text-center parte_gris seccionsss\">";
                 $rr .= "<strong class=\"dia_title\">" . $fila[1] . "</strong> <br>";
                 $rr .= "<strong class=\"title_blue\">" . $fila[8] . "</strong>";
                 $rr .= "</div>";
                 $rr .= "<div class=\"col-md-4\">";
                 $rr .= "<img src=\"cuadricepsLunes.jpeg\" class=\"text-center img-fluid\" width=\"100%\"";
                 $rr .= "alt=\"ejemplo grafico\">";
                 $rr .= "</div>";
                 $rr .= "<div class=\"col-md-4 parte_gris seccionsss\">";
                 $rr .= "<strong>Repeticiones</strong>";
                 $rr .= "<p class=\"title_min_blue\">";
                 $rr .= "4 series de 12 repeticiones";
                 $rr .= "</p>";
                 $rr .= "<strong>RECUERDA:</strong>";
                 $rr .= "<p>";
                 $rr .= "" . $fila[7] . "";
                 $rr .= "<br>";
                 $rr .= "<br>";
                 $rr .= "" . $fila[4] . "";
                 $rr .= "<br>";
                 $rr .= "<br>";
                 $rr .= "Evita balancear el cuerpo hacia adelante o hacia atrás; concéntrate en trabajar los músculos de";
                 $rr .= "manera controlada.";
                 $rr .= "</p>";
                 $rr .= "</div>";
                 $rr .= "</div>";
                */
            }

            $rr = 'Funciona'; // Si muestra

        }
        return $rr;
    }

}