<?php
include ('../model/calendarioRutinario.php');

$dia_semana = date('w');

echo calendarioRutinario::mostrarCalendario(1, $dia_semana, 1);

?>

<link rel="stylesheet" href="css/enRutinasCr.css">

<div class="container cuerpo">
    <div class="row">
        <div class="col-md-12 ">
            Texto 1
        </div>
        <div class="col-md-12 ">
            Texto 2
        </div>
        <div class="col-md-12">
            Texto 3
        </div>
    </div>
</div>