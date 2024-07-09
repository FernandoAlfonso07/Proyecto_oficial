<?php

include ("../../model/administrador.php");

?>

<link rel="stylesheet" href="../css/stylesRoutines.css">

<div class="container">
    <h1 class="conteo">
        Total de Rutinas: <?php echo Administrador::showRoutines(0); ?>
    </h1>
    <br>
</div>

<div class="container tabla">
    <?php if (Administrador::showRoutines(1) == '') {
        ?>
        <a href="controladorVadmin.php?seccionAd=addRutina">
            <h1 class="text-center alert"> NO HAY RUTINAS AGREGAR AQUI <i class="fa-solid fa-square-plus ml-5"></i></h1>
        </a>
    <?php } else {

        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col text-center caracteristica 0">id</th>
                    <th scope="col text-center caracteristica 1">Nombre</th>
                    <th scope="col text-center caracteristica 2">Objetivo</th>
                    <th scope="col text-center caracteristica 3">Fecha de registro</th>
                    <th scope="col text-center caracteristica 4">Categoria</th>
                    <th scope="col text-center caracteristica iconosss"> </th>
                </tr>
            </thead>
            <tbody>
                <?php echo Administrador::showRoutines(1); ?>
            </tbody>
        </table> <?php

    }
    ?>
</div>