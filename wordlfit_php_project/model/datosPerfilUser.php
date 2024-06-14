<?php

include ("connect.php");

class DatosPerfilUser extends conexionBD
{

    public static function getPerfil($idPerfil)
    {
        $conexion = self::getConexion();

        $sql = "select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero ";
        $sql .= "FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = $idPerfil";

        $resultado = $conexion->query($sql);

        while ($fila = $resultado->fetch_array()) {
            $r = '';
            $r .= '<div class="container cuerpo">';
            $r .= '<div class="row">';
            $r .= '<div class="col-md-6 text-center">';
            $r .= '<img src="https://fotografias.lasexta.com/clipping/cmsimages02/2019/11/14/66C024AF-E20B-49A5-8BC3-A21DD22B96E6/default.jpg?crop=1300,731,x0,y0&width=1280&height=720&optimize=low"';
            $r .= 'class="img-fluid imagen_perfil" width="80%" alt="Imagen Perfil">';
            $r .= '<div class="input-group mb-3 subir">';
            $r .= '<input type="file" class="form-control" id="inputGroupFile02">';
            $r .= '<label class="input-group-text" for="inputGroupFile02">Subir</label>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="row">';
            $r .= '<div class="col-md-12">';
            $r .= '<h1>';
            $r .= 'Mi Perfil';
            $r .= '</h1>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<Label>Nombres: </Label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p>' . $fila[0] . '</p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<Label>Apellidos</Label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p>' . $fila[1] . '</p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<Label>Altura actual:</Label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p>' . $fila[5] . ' Cm </p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<Label>Peso Actual:</Label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p> ' . $fila[4] . ' Kg </p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<Label>Genero:</Label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p> ' . $fila[8] . ' </p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<Label>Pr:</Label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p> ' . $fila[6] . ' kg';
            $r .= '</p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<h1>';
            $r .= 'Contacto';
            $r .= '</h1>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<label>';
            $r .= 'Correo Electronico:';
            $r .= '</label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p> ' . $fila[2] . ' </p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-6">';
            $r .= '<div class="col-md-12 gris">';
            $r .= '<label>';
            $r .= 'Telefono';
            $r .= '</label>';
            $r .= '</div>';
            $r .= '<div class="col-md-12">';
            $r .= '<p> ' . $fila[7] . ' </p>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '<div class="col-md-12 text-center">';
            $r .= '<button type="button" class="btn btn-warning compartir">Compartir';
            $r .= '<i class="fa-solid fa-share-nodes icono"></i></button>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
            $r .= '</div>';
        }
    }



}