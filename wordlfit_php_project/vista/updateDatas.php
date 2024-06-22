<?php
include("../model/usuario.php");
?>

<link rel="stylesheet" href="css/actualizarDatos.css">
<form action="../controler/actualizarDataUser.php">
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-6 text-center">
                <!--<img src="https://fotografias.lasexta.com/clipping/cmsimages02/2019/11/14/66C024AF-E20B-49A5-8BC3-A21DD22B96E6/default.jpg?crop=1300,731,x0,y0&width=1280&height=720&optimize=low" 
                    class="img-fluid imagen_perfil" width="80%" alt="Imagen Perfil"> -->
                <div class="input-group mb-3 subir">
                    <input type="file" class="form-control" name="imagenPerfil" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-12">
                        <h1>
                            Mi Perfil
                        </h1>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <Label>Nombres: </Label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="nombre" value="<?php
                                                                    echo usuarios::getPerfil(0, $_SESSION['id']);
                                                                    ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <Label>Apellidos</Label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="apellido" value="<?php
                                                                        echo usuarios::getPerfil(1, $_SESSION['id']);
                                                                        ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <Label>Altura actual:</Label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="altura" value="<?php
                                                                    echo usuarios::getPerfil(5, $_SESSION['id']);
                                                                    ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <Label>Peso Actual:</Label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="peso" value="<?php
                                                                    echo usuarios::getPerfil(4, $_SESSION['id']);
                                                                    ?>
                            " class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <Label>Genero:</Label>
                        </div>
                        <div class="col-md-12">
                            <p>
                                <?php

                                echo usuarios::getPerfil(8, $_SESSION['id']);

                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <Label>Pr:</Label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="personaleRecord" value="<?php
                                                                                echo usuarios::getPerfil(6, $_SESSION['id']);
                                                                                ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h1>
                            Contacto
                        </h1>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <label>
                                Correo Electronico:
                            </label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="correo" value="<?php

                                                                    echo usuarios::getPerfil(2, $_SESSION['id']);
                                                                    ?>
                            " class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gris">
                            <label>
                                Telefono
                            </label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="telefono" value="<?php
                                                                        echo usuarios::getPerfil(7, $_SESSION['id']);
                                                                        ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-warning compartir">Actualizar
                            <i class="fa-solid fa-rotate icono"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>