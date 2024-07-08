<?php

include_once ('../class/cycleCreateCalender.php');

?>

<link rel="stylesheet" href="css/createCalender.css">

<div class="container cuerpo">
    <form action="" class="form-floating">
        <div class="row">

            <div class="col-md-2"> </div>
            <div class="col-md-8 mt-2 mb-2 text-center">
                <label class="form-label">
                    <h2>
                        Dale un nombre a este calendario rutinario
                    </h2>
                </label>
                <input type="text" class="form-control my-2" placeholder="Escribe aqui..." value="">
            </div>
            <div class="col-md-2"> </div>
            <div class="col-md-2"> </div>
            <div class="col-md-8">
                <b> Dale una descripción a este calendario *</b>
                <textarea class="form-control my-2" placeholder="Escribe aqui..."></textarea>
            </div>
            <div class="col-md-2"> </div>

            <div class="col-md-12 text-center my-5">
                <h1>
                    EMPECEMOS CON ESTO
                </h1>
            </div>

            <div class="col-md-2"> </div>
            <div class="col-md-8 mt-2 mb-2 text-center">
                <label class="form-label">
                    <h2>
                        Escoge que día y que rutina deseas hacer.
                    </h2>
                </label>
                <?php echo CycleCreateCalender::showCyle() ?>
            </div>
            <div class="col-md-2"> </div>


            <div class="col-md-12 my-5 text-center">

                <button class="btn btn-primary">
                    Guardar <i class="fa-solid fa-person-skating"></i>
                </button>
            </div>

        </div>
    </form>
</div>