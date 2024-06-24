<?php

include ("../../model/administrador.php");

?>
<link rel="stylesheet" href="../../vista/css/ejerciciosMostrar.css">


<div class="container">
    <h1 class="conteo">
        Total de Ejercicios: <?php echo Administrador::contadorTotal() ?>
    </h1>
    <br>
</div>

<div class="container tabla">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col text-center caracteristica 0">id</th>
                <th scope="col text-center caracteristica 1">Nombre</th>
                <!-- <th scope="col text-center caracteristica 2">Instrucciones</th>        Para poner en mas detalles -->
                <!-- <th scope="col text-center caracteristica 3">Equipo necesario</th>     Para poner en mas detalles -->
                <th scope="col text-center caracteristica 4">Series</th>
                <th scope="col text-center caracteristica 5">Repeticiones</th>
                <th scope="col text-center caracteristica 6">Tiempo de descanso</th>
                <th scope="col text-center caracteristica 7">fecha de registro</th>
                <th scope="col text-center caracteristica 8">Rutina asociada</th>
                <!-- <th scope="col text-center caracteristica 9">Id Rutina</th>            Para poner en mas detalles -->
                <th scope="col text-center caracteristica 10">Ejemplo Grafico</th>
                <th scope="col text-center caracteristica iconosss"> </th>
            </tr>
        </thead>
        <tbody>

            <?php if (Administrador::verEjercicios() == '') {
                echo '<td> Agregar ejercicios </td>';
            } else {
                echo Administrador::verEjercicios();
            }
            ?>

        </tbody>
    </table>
</div>