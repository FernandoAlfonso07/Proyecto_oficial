<?php
include("../model/usuario.php");
?>

<link rel="stylesheet" href="css/estilosinformacionU.css">

<div class="container cuerpo">
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="
            <?php ?>" class="img-fluid imagen_perfil" width="80%" alt="Imagen Perfil">
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
                            echo usuarios::getPerfil(0, $_SESSION['id']);
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

                            echo usuarios::getPerfil(1, $_SESSION['id']);

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
                            echo usuarios::getPerfil(5, $_SESSION['id']);
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
                            echo usuarios::getPerfil(4, $_SESSION['id']);
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
                        <p>
                            <?php

                            $prResultado = usuarios::getPerfil(6, $_SESSION['id']);
                            echo ($prResultado == '') ? 'Actualiza tu primer Personal Record' : $prResultado . ' Kg';
                            ?>
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
                            echo usuarios::getPerfil(2, $_SESSION['id']);
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
                            echo usuarios::getPerfil(7, $_SESSION['id']);
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-warning compartir">Compartir
                        <i class="fa-solid fa-share-nodes icono"></i></button>
                    <button type="button" class="btn btn-danger compartir">Eliminar Cuenta
                        <i class="fa-solid fa-trash-can icono"></i></button>
                    <a href="controlador.php?seccion=updateDatas">
                        <button type="button" class="btn btn-primary compartir">Editar
                            <i class="fa-solid fa-pencil icono"></i></i></button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>