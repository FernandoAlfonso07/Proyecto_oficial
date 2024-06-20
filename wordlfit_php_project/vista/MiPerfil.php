<?php
include ("../model/usuario.php");
?>

<link rel="stylesheet" href="css/estilosInformacionU.css">

<div class="container cuerpo">
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="https://fotografias.lasexta.com/clipping/cmsimages02/2019/11/14/66C024AF-E20B-49A5-8BC3-A21DD22B96E6/default.jpg?crop=1300,731,x0,y0&width=1280&height=720&optimize=low"
                class="img-fluid imagen_perfil" width="80%" alt="Imagen Perfil">
            <div class="input-group mb-3 subir">
                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                    aria-label="Upload">
                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Guardar</button>
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
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(0, $id_usuario);

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 gris">
                        <Label>Apellidos</Label>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(1, $id_usuario);

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 gris">
                        <Label>Altura actual:</Label>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(5, $id_usuario);

                            }
                            ?> Cm
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 gris">
                        <Label>Peso Actual:</Label>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(4, $id_usuario);

                            }
                            ?>
                            Kg
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 gris">
                        <Label>Genero:</Label>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(8, $id_usuario);

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 gris">
                        <Label>Pr:</Label>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(6, $id_usuario);

                            }
                            ?> kg
                        </p>
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
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(2, $id_usuario);

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 gris">
                        <label>
                            Telefono
                        </label>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <?php

                            if (!isset($_SESSION))
                                session_start();

                            if (!isset($_SESSION["correo"])) {
                                echo 'error';
                            } else {
                                $_SESSION['correo'];
                                $correoU = $_SESSION['correo'];
                                $id_usuario = usuarios::buscarId($correoU);

                                echo usuarios::getPerfil(7, $id_usuario);

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-warning compartir">Compartir
                        <i class="fa-solid fa-share-nodes icono"></i></button>
                    <button type="button" class="btn btn-danger compartir">Eliminar Cuenta
                        <i class="fa-solid fa-trash-can icono"></i></button>
                    <button type="button" class="btn btn-primary compartir">Editar
                        <i class="fa-solid fa-pencil icono"></i></i></button>
                </div>

            </div>
        </div>
    </div>
</div>