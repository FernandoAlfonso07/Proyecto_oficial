<?php
include ("connect.php");
class MostrarEjercicios extends conexionBD
{

    public static function mostrarDatos()
    {

        $conexion = conexionBD::getConexion();
        $sql = "select ";
        $sql .= "t1.id_ejercicio, t1.nombre, t1.fecha_registro, t1.tiempo_descanso, t3.nombreRutina, t4.direccion  ";
        $sql .= "FROM ejercicios t1
            JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
            JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina
            JOIN media t4 ON t4.id_media = t1.id_media";

        $resultado = $conexion->query($sql);

        $r = '';
        while ($fila = $resultado->fetch_array()) {

            $r .= '<div class="container contenedor_total">';
            $r .= '<div class="row">';
            $r .= '<div class="col-md-3 ejemploG text-center">';
            $r .= '<img src="' . $fila[5] . '" width="100%" alt="Ejemplo del ejercicio">';
            $r .= '</div>';
            $r .= ' <div class="col-md-9">';
            $r .= '<div class="row">';
            $r .= '<div class="col-md-12 contenedor_secundario oscurecer">';
            $r .= '<h1>';
            $r .= 'Nombre del ejercicio: <b> ' . $fila[1] . '</b>';
            $r .= '</h1>';
            $r .= '</div>';
            $r .= '<div class="col-md-12 contenedor_secundario">';
            $r .= '<h2>';
            $r .= 'Ejercicio asociado a la rutina: ' . $fila[4] . '';
            $r .= '</h2>';
            $r .= '</div>';
            $r .= '<div class="col-md-12 contenedor_secundario oscurecer">';
            $r .= '<h3>';
            $r .= 'Tiempo de descanso: ' . $fila[3] . ' min';
            $r .= '</h3>';
            $r .= '</div>';
            $r .= '<div class="col-md-12 contenedor_secundario">';
            $r .= '<div class="row">';
            $r .= '<div class ="col-md-6">';
            $r .= 'fecha de registro: ' . $fila[2] . '';
            $r .= '</div>';
            $r .= '<div class ="col-md-6 text-center">';
            $r .= '<a href="../controler/ReliminarEjercicio.php?id=' . $fila[0] . '"><i class="fa-solid fa-trash iconoE delete"></i></a>';
            $r .= '<i class="fa-solid fa-pencil iconoE edit"></i>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
        }

        return $r;

        //self::$connect->close();
    }


    public static function contadorTotal()
    {
        $conexion = conexionBD::getConexion();
        $sql = "
            select count(*) FROM ejercicios t1 JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
            JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina
            JOIN media t4 ON t4.id_media = t1.id_media ";
        $r = 0;
        $resulado = $conexion->query($sql);

        while ($fila = $resulado->fetch_array()) {

            $r = $fila[0];

        }

        return $r;
    }
}
