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
                case 0: // Trae el id_usuario
                    $salida = $fila[0];
                    break;
                case 1: // Trae el nombre
                    $salida = $fila[1];
                    break;
                case 2: // Trae el Apillidos
                    $salida = $fila[2];
                    break;
                case 3: // Trae el Correo
                    $salida = $fila[3];
                    break;
                case 4: // Trae el Contraseña
                    $salida = $fila[4];
                    break;
                case 5: // Trae el peso
                    $salida = $fila[5];
                    break;
                case 6: // Trae el alura
                    $salida = $fila[6];
                    break;
                case 7: // Trae el id_genero
                    $salida = $fila[7];
                    break;
                case 8: // Trae el telefono
                    $salida = $fila[8];
                    break;
                case 9: // Trae el Pr
                    $salida = $fila[9];
                    break;
                case 10: // Trae el Fecha registro
                    $salida = $fila[10];
                    break;
                case 11: // Trae el Fecha Url_Imagen perfil
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

    public static function iniciarSesion($opc, $correo, $password)
    {

        $conexion = conexionBD::getConexion();

        $sql = "SELECT COUNT(*), id_rol FROM usuarios WHERE correo = '$correo' AND password = '$password' ";

        echo $sql;
        $resultado = $conexion->query($sql);

        $r = 0;

        while ($fila = $resultado->fetch_array()) {

            switch ($opc) {
                case 0:
                    $r = $fila[0];
                    break;

                case 1:

                    $r = $fila[1];
                    break;
            }

        }

        return $r;
    }


    public static function getPerfil($opc, $idUsuario)
    {
        $conexion = self::getConexion();

        $sql = "select t1.nombre, t1.apellido, t1.correo, t1.password, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero, t1.imgPerfil ";
        $sql .= "FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = $idUsuario";
        $resultado = $conexion->query($sql);
        $r = '';
        while ($fila = $resultado->fetch_array()) {


            switch ($opc) {
                case 0: // Muestra NOMBRE

                    $r .= $fila[0];
                    //$r = self::getInformacion(1, $idUsuario); Opción a implementar.

                    break;
                case 1: // Muestra APELLIDO

                    $r .= $fila[1];

                    break;
                case 2: // Muestra CORREO

                    $r .= $fila[2];

                    break;
                case 3: // Muestra CONTRASEÑA

                    $r .= $fila[3];

                    break;
                case 4: // Muestra PESO

                    $r .= $fila[4];

                    break;
                case 5: // Muestra ALTURA

                    $r .= $fila[5];

                    break;
                case 6: // Muestra PR

                    $r .= $fila[6];

                    break;
                case 7: // Muestra TELEFONO

                    $r .= $fila[7];

                    break;
                case 8: // Muestra GENERO

                    $r .= $fila[8];

                    break;
                case 9: // Muestra la ruta de la imagen de perfil.

                    $r .= $fila[9];

                    break;
            }
        }
        return $r;
    }


    public static function registrar($nombres, $apellidos, $telefono, $correoElectronico, $password, $pesoActual, $altura, $genero)
    {
        $conexion = self::getConexion();

        $sql = "insert into usuarios (nombre, apellido, telefono, correo, password, peso_actual, altura_actual, id_genero, fecha_registro, id_rol)";
        $sql .= " values ('$nombres' ,'$apellidos', '$telefono', '$correoElectronico', '$password', $pesoActual ,$altura, $genero, now(), 0) ";
        echo $sql;
        $resultado = $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();
    }


    public static function actualizarDatos($id, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $ruta_imagen)
    {
        $conexion = self::getConexion();

        $sql = "update usuarios ";
        $sql .= "set nombre = '$nombres', ";
        $sql .= "imgPerfil = '$ruta_imagen', ";
        $sql .= "apellido = '$apellidos', ";
        $sql .= "peso_actual = $pesoActual, ";
        $sql .= "altura_actual = $altura, ";
        $sql .= "telefono = '$telefono', ";
        $sql .= "correo = '$correo', ";
        $sql .= "pr = $pr ";
        $sql .= "WHERE id_usuario = '$id' ";
        echo $sql;
        $conexion->query($sql);

        $affected_rows = $conexion->affected_rows;

        $conexion->close();
    }
}
