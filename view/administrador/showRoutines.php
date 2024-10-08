<?php
include ("../../model/administrador.php");
include_once ('../../functions/alerts.php');

if (isset($_GET['success'])) {
    if ($_GET['success'] == 'ok') {
        echo Alerts::ok(2, 'Rutina agregada', 'showRoutines');
    } elseif ($_GET['success'] == 'ok_delete') {
        echo Alerts::ok(2, 'Rutina eliminada', 'showRoutines');
    } elseif ($_GET['success'] == 'addedExercise') {
        echo Alerts::ok(2, 'Rutina Agregada correctamente', 'showRoutines');
    }
} else {
    null;
}
?>

<link rel="stylesheet" href="../css/stylesRoutines.css">
<section>
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
</section>