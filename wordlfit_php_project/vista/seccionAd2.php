<?php

include ("../model/mostrarEjercicios.php");

?>
<link rel="stylesheet" href="./css/ejerciciosMostrar.css">

<div class="container">
    <h1 class="conteo">
        Total de Ejercicios: <?php echo MostrarEjercicios::contadorTotal() ?>
    </h1>
    <br>
</div>

<?php echo MostrarEjercicios::mostrarDatos(); ?>