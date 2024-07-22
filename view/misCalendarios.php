<?php

include_once ('../model/calendarioRutinario.php');

?>

<link rel="stylesheet" href="css/estilos_mis_calendarios.css">

<div class="text-center contenedor_titulo">
    - calendarios personalizados -
</div>

<div class="container text-center crear_calendario_btn">
    <div class="row">
        <div class="col-md-12">
            <a href="controlador.php?seccion=createCalender">
                <i class="fa-regular fa-calendar-plus"></i>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <hr class="linea">
</div>
<div class="container calendario_usuario">
    <div class="row">
        <?php
        echo calendarioRutinario::getCalendarRoutinesUser(1, $_SESSION['id'])
            ?>
    </div>
</div>
<div class="container">
    <hr class="linea">
</div>