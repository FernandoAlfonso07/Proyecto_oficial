<?php

include_once ('../model/Categories.php');

?>


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

            <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-4">
                    <select class="form-select" name="id_filterCategory" id="id_filterCategor" onchange="hola(event)">
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
                    <select class="form-select" id="options" aria-label="Default select example">
                        <option selected>Seleccione una rutina</option>

                        <!-- Aqui se deben renderizar las rutinas segun el parametro de categoria elegido -->

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2"> </div>

        <div class="col-md-2"> <input type="hidden" name="page" value="2do"> </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success">Agregar</button>
        </div>
    </div>
</form>