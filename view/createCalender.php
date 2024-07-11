<?php

include_once ('../model/Categories.php');

?>

<link rel="stylesheet" href="css/createCalender.css">

<div class="container cuerpo">
    <form action="../controller/createCalender.php" class="form-floating">
        <div class="row">

            <div class="col-md-2"> </div>
            <div class="col-md-8 mt-2 mb-2 text-center">
                <label class="form-label">
                    <h2>
                        Dale un nombre a este calendario rutinario
                    </h2>
                </label>
                <input type="text" class="form-control my-2" name="nameCalendar" placeholder="Escribe aqui..." value="">
            </div>
            <div class="col-md-2"> </div>
            <div class="col-md-2"> </div>
            <div class="col-md-8">
                <b> Dale una descripción a este calendario *</b>
                <textarea class="form-control my-2" name="description" placeholder="Escribe aqui..."></textarea>
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

                <div class="row"> <!-- SELECION DE RUTINAS -->
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-4">
                        <select class="form-select" name="filterCategory" id="filterCategory"
                            aria-label="Default select example">
                            <option selected>Seleccione la categoria</option>
                            <?php // echo CycleCreateCalender::getCatgory() 
                            
                            include_once ('../model/connect.php');

                            $conexion = conexionBD::getConexion();
                            $sql = 'SELECT * FROM categorias_rutinas ';

                            $result = mysqli_query($conexion, $sql);
                            while ($fila = $result->fetch_array()) {
                                echo "<option value='" . $fila[0] . "'>" . $fila[1] . "</option>";
                            }

                            ?>

                        </select>
                    </div>
                    <div class="col-md-6 my-2">
                        LUNES
                    </div>
                    <div class="col-md-6 my-2">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Seleccione una rutina</option>

                            <?php



                            ?>

                        </select>
                    </div>
                </div> <!-- FIN SELECION DE RUTINAS -->
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


<script src="js/filterCategories.js"></script>