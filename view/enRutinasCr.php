<?php
include ('../model/calendarioRutinario.php');

$p = 0;
if (isset($_GET['p'])) {
    $p = $_GET['p'];
}


$dia_semana = date('w');


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>En rutina | <?php echo calendarioRutinario::mostrarCalendario(1, 0, $dia_semana, $p) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="./img/logosinfondo.png">

    <link rel="stylesheet" href="css/enRutinasCr.css">


</head>

<body>


    <div class="container cuerpo contenedorEnRutina">
        <div class="row">
            <div class="col-md-12 text-center contenedor_informacion colorear redondear dia_contenedor">
                <h1 class="dia">
                    <?php echo calendarioRutinario::mostrarCalendario(1, 0, $dia_semana, $p) ?>
                </h1>
            </div>
            <div class="col-md-12 text-center imagenA">
                <img src="img/ <?php echo calendarioRutinario::mostrarCalendario(1, 1, $dia_semana, $p) ?> "
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
<<<<<<< HEAD
                        <?php echo calendarioRutinario::mostrarCalendario(1, 6, $dia_semana, $p) ?>
=======
                        <?php // echo calendarioRutinario::mostrarCalendario(1, 6, $dia_semana, $p);
                        echo calendarioRutinario::mostrarCalendario(0, null, $dia_semana)
                            ?>
>>>>>>> 362a3746bb87c88537df158e1ef052669ec6f207
                    </b> Repeticiones.
                </h2>
            </div>
            <div class="col-md-12 contenedor_informacion text-center">
<<<<<<< HEAD
                <button class="btn btn-warning btn-gradient botones">Descanso <i class="fa-solid fa-pause"></i></button>

                <?php
                echo calendarioRutinario::optionPage($p)
                    ?>
=======
                <a href="">
                    <button class="btn btn-warning btn-gradient botones">Descanso <i
                            class="fa-solid fa-pause"></i></button>
                </a>
                <?php
                echo calendarioRutinario::optionPage($p) // Botonesd de la paginacion.
                    ?>

                <a href="controlador.php?seccion=misCalendarios">
                    <button id="salirButton" class="btn btn-danger">Salir <i
                            class="fa-solid fa-person-shelter"></i></button>
                </a>
>>>>>>> 362a3746bb87c88537df158e1ef052669ec6f207
            </div>
        </div>
    </div>

<<<<<<< HEAD
=======
    <script src="js/salirButton.js"></script>
>>>>>>> 362a3746bb87c88537df158e1ef052669ec6f207

    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>