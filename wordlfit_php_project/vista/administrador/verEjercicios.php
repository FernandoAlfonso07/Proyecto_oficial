<?php

include("../model/mostrarEjercicios.php");

?>
<link rel="stylesheet" href="./css/ejerciciosMostrar.css">

<div class="container">
    <h1 class="conteo">
        Total de Ejercicios: <?php echo MostrarEjercicios::contadorTotal() ?>
    </h1>
    <br>
</div>
<div class="container contenedor_total">
    <div class="row">
        <div class="col-md-3 ejemploG text-center">
            <img src="' . $fila[5] . '" width="100%" alt="Ejemplo del ejercicio">
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 contenedor_secundario oscurecer">
                    <h1>
                        Nombre del ejercicio: <b> ' . $fila[1] . '</b>
                    </h1>
                </div>
                <div class="col-md-12 contenedor_secundario">
                    <h2>
                        Ejercicio asociado a la rutina: ' . $fila[4] . '
                    </h2>
                </div>
                <div class="col-md-12 contenedor_secundario oscurecer">
                    <h3>
                        Tiempo de descanso: ' . $fila[3] . ' min
                    </h3>
                </div>
                <div class="col-md-12 contenedor_secundario">
                    <div class="row">
                        <div class="col-md-6">
                            fecha de registro: ' . $fila[2] . '
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="../controler/ReliminarEjercicio.php?id=' . $fila[0] . '"><i class="fa-solid fa-trash iconoE delete"></i></a>
                            <i class="fa-solid fa-pencil iconoE edit"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo MostrarEjercicios::mostrarDatos(); ?>