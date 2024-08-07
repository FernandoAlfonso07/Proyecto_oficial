<?php

include ("../../model/administrador.php");

?>
<link rel="stylesheet" href="../../view/css/ejerciciosMostrar.css">


<div class="container">
    <h1 class="conteo">
        Total de Ejercicios: <?php echo Administrador::contadorTotal() ?>
    </h1>
    <br>
</div>

<div class="container tabla">
    <?php if (Administrador::verEjercicios() == '') {
        ?>
        <a href="controladorVadmin.php?seccionAd=addEjercicios">
            <h1 class="text-center alert"> NO HAY EJERCICIOS AGREGAR AQUI <i class="fa-solid fa-square-plus ml-5"></i></h1>
        </a>
    <?php } else {
        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col text-center caracteristica 0">id</th>
                    <th scope="col text-center caracteristica 1">Nombre</th>
                    <th scope="col text-center caracteristica 4">Series</th>
                    <th scope="col text-center caracteristica 5">Repeticiones</th>
                    <th scope="col text-center caracteristica 6">Tiempo de descanso</th>
                    <th scope="col text-center caracteristica 7">fecha de registro</th>
                    <th scope="col text-center caracteristica 8">Rutina asociada</th>
                    <th scope="col text-center caracteristica 10">Ejemplo Grafico</th>
                    <th scope="col text-center caracteristica iconosss"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo Administrador::verEjercicios();
                ?>
            </tbody>
        </table> <?php
    }
    ?>

</div>

<form action="administrador/controladorVadmin.php?exercise=1&seccionAd=updateExercises" method="post">
    <input type="hidden" name="id_exercise">
</form>