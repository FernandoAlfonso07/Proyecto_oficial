<?php
include_once("../../model/administrador.php");
?>
<link rel="stylesheet" href="../css/gym/showGyms.css">
<section>
    <div class="container">
        <h1 class="conteo">
            Total de gimnasios: <?php echo Administrador::showListGyms(2); ?>
        </h1>
        <br>
    </div>

    <div class="container-fluid tabla">
        <?php if (Administrador::showListGyms(1) == '') { ?>
            <a href="controladorVadmin.php?seccionAd=addGym">
                <h1 class="text-center alert"> NO HAY GIMNASIOS REGISTRADOS
                    <i class="fa-solid fa-square-plus ml-5"></i>
                </h1>
            </a>
        <?php } else { ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center caracteristica">ID</th>
                        <th scope="col" class="text-center caracteristica">Nombre</th>
                        <th scope="col" class="text-center caracteristica">Teléfono</th>
                        <th scope="col" class="text-center caracteristica">Correo</th>
                        <th scope="col" class="text-center caracteristica">Categoría</th>
                        <th scope="col" class="text-center caracteristica">Nombre Gerente</th>
                        <th scope="col" class="text-center caracteristica">Correo Gerente</th>
                        <th scope="col" class="text-center caracteristica">Teléfono Gerente</th>
                        <th scope="col" class="text-center caracteristica">Imagen</th>
                        <th scope="col" class="text-center caracteristica iconosss">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    

                    <?php echo Administrador::showListGyms(1); ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</section>

<script src="../js/status.js"></script>