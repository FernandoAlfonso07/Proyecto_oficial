<?php
include ('../model/calendarioRutinario.php');

$p = 0;
if (isset($_GET['p'])) {
    $p = $_GET['p'];
}


$dia_semana = date('w');

//echo calendarioRutinario::mostrarCalendario(1, $dia_semana, 1);

?>

<link rel="stylesheet" href="css/enRutinasCr.css">

<div class="container cuerpo contenedorEnRutina">
    <div class="row">
        <div class="col-md-12 text-center contenedor_informacion colorear redondear dia_contenedor">
            <h1 class="dia">
                <?php echo calendarioRutinario::mostrarCalendario(1, 0, $dia_semana, $p) ?>
            </h1>
        </div>
        <div class="col-md-12 text-center imagenA">
            <img src="IMG_index/ <?php echo calendarioRutinario::mostrarCalendario(1, 1, $dia_semana, $p) ?> "
                width="100%" alt="imagen ejercicios">
        </div>
        <div class="col-md-12 colorear text-center nombreEjercicio redondear">
            <h1>
                <b><?php echo calendarioRutinario::mostrarCalendario(1, 2, $dia_semana, $p) ?></b>
            </h1>
        </div>
        <div class="col-md-12 contenedor_informacion ">
            <h2>
                Instrucciones:
            </h2>
            <p>
                <?php echo calendarioRutinario::mostrarCalendario(1, 3, $dia_semana, $p) ?>
            </p>
        </div>
        <div class="col-md-12  contenedor_informacion colorear redondear">
            <h2>
                Equipo necesario
            </h2>
            <p>
                <?php echo calendarioRutinario::mostrarCalendario(1, 4, $dia_semana, $p) ?>
            </p>
        </div>
        <div class="col-md-12 text-center rep contenedor_informacion colorear">
            <h2>
                Haz <b class="numero">
                    <p><?php echo calendarioRutinario::mostrarCalendario(1, 5, $dia_semana, $p) ?>
                </b>Series de
                <b class="numero">
                    <?php echo calendarioRutinario::mostrarCalendario(1, 6, $dia_semana, $p) ?>
                </b> Repeticiones.
            </h2>
        </div>
        <div class="col-md-12 contenedor_informacion ">
            <button class="btn btn-warning btn-gradient botones">Descanso <i class="fa-solid fa-pause"></i></button>

            <?php
            echo calendarioRutinario::optionPage($p)
                ?>
        </div>
    </div>
</div>