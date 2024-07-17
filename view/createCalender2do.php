<?php

include_once ('../model/Categories.php');

?>

<link rel="stylesheet" href="css/addRoutinePrt2.css">

<form action="../controller/createCalender.php" class="my-5" method="get">
    <div class="row">
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



            <!-- function -->
            <?php

            echo CycleCreateCalender::showFormuler('LUNES', 'filter_Category_Monday', 'filter_Routines_Monday', 'Routine_Of_Monday');

            echo CycleCreateCalender::showFormuler('MARTES', 'filter_Category_Tuesday', 'filter_Routines_Tuesday', 'Routine_Of_Tuesday');

            echo CycleCreateCalender::showFormuler('MIERCOLES', 'filter_Category_Wednesday', 'filter_Routines_Wednesday', 'Routine_Of_Wednesday');

            echo CycleCreateCalender::showFormuler('JUEVES', 'filter_Category_Thursday', 'filter_Routines_Thursday', 'Routine_Of_Thursday');

            echo CycleCreateCalender::showFormuler('VIERNES', 'filter_Category_Friday', 'filter_Routines_Friday', 'Routine_Of_Friday');

            echo CycleCreateCalender::showFormuler('SABADO', 'filter_Category_Saturday', 'filter_Routines_Saturday', 'Routine_Of_Saturday');


            ?>
        </div>
        <div class="col-md-2"> </div>

        <div class="col-md-2"> <input type="hidden" name="page" value="2do"> </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success">Agregar</button>
        </div>
    </div>
</form>