<?php
include ("connect.php");
class usuarios extends conexionBD
{


    public static function getInformacion($opc, $id_usuario)
    {
        $conexion = conexionBD::getConexion();

        $sql = "select * from usuarios WHERE id_usuario = $id_usuario ";

        $resultado = $conexion->query($sql);
        $salida = '';
        while ($fila = $resultado->fetch_array()) {

            switch ($opc) {
                case 0:
                    $salida = $fila[0];
                    break;
                case 1:
                    $salida = $fila[1];
                    break;
                case 2:
                    $salida = $fila[2];
                    break;
                case 3:
                    $salida = $fila[3];
                    break;
                case 4:
                    $salida = $fila[4];
                    break;
                case 5:
                    $salida = $fila[5];
                    break;
                case 6:
                    $salida = $fila[6];
                    break;
                case 7:
                    $salida = $fila[7];
                    break;
                case 8:
                    $salida = $fila[8];
                    break;
                case 9:
                    $salida = $fila[9];
                    break;
                case 10:
                    $salida = $fila[10];
                    break;
            }

        }
        return $salida;

    }



    public static function buscarId($correo)
    {
        $conexion = conexionBD::getConexion();

        $sql = "select id_usuario from usuarios where correo = '$correo' ";

        $resultado = $conexion->query($sql);
        $salida = 0;
        while ($fila = $resultado->fetch_array()) {
            $salida += $fila[0];
        }
        return $salida;

    }

    public static function iniciarSesion($opc, $correo = null, $contraseña = null)
    {

        $conexion = conexionBD::getConexion();

        $sql = "select t1.id_usuario, count(*) FROM usuarios t1 WHERE correo = '$correo' AND contraseña = '$contraseña'; ";

        $resultado = $conexion->query($sql);

        $r = 0;

        while ($fila = $resultado->fetch_array()) {
            if ($opc == 0) {
                $r = $fila[1];
            } elseif ($opc == 1) {
                $r = $fila[0];
            }
        }

        return $r;
    }


    public static function getPerfil($opc, $idUsuario)
    {
        $conexion = self::getConexion();

        $sql = "select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero ";
        $sql .= "FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = $idUsuario";

        $resultado = $conexion->query($sql);

        while ($fila = $resultado->fetch_array()) {
            $r = '';

            switch ($opc) {
                case 0:

                    $r .= $fila[0];

                    break;
                case 1:

                    $r .= $fila[1];

                    break;
                case 5:

                    $r .= $fila[5];

                    break;
                case 4:

                    $r .= $fila[4];

                    break;
                case 8:

                    $r .= $fila[8];

                    break;
                case 6:

                    $r .= $fila[6];

                    break;
                case 2:

                    $r .= $fila[2];

                    break;
                case 7:

                    $r .= $fila[7];

                    break;
            }


        }

        return $r;
    }


    public static function registrar($nombres, $apellidos, $telefono, $correoElectronico, $contraseña, $pesoActual, $altura, $genero)
    {
        $conexion = self::getConexion();

        $sql = "insert into usuarios (nombre, apellido, telefono, correo, contraseña, peso_actual, altura_actual, id_genero, fecha_registro)";
        $sql .= "values ('$nombres' ,'$apellidos', $telefono, '$correoElectronico', '$contraseña', $pesoActual ,$altura, $genero, now())";
        $resultado = $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();

    }


    public static function actualizarDatos($id, $nombres, $apellidos, $telefono, $pr, $pesoActual, $altura)
    {
        $conexion = self::getConexion();

        $sql = "update usuarios";
        $sql .= "set nombre = '$nombres',";
        $sql .= "apellido = '$apellidos',";
        $sql .= "peso_actual = $pesoActual,";
        $sql .= "altura_actual = $altura,";
        $sql .= "telefono = $telefono,";
        $sql .= "pr = $pr";
        $sql .= "WHERE id_usuario = '$id' ";

        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();

    }

}