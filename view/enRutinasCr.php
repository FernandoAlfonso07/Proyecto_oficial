<?php
include ('../model/calendarioRutinario.php');
date_default_timezone_set('America/Bogota');
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id']) || $_SESSION['id'] == "") {
    header('location: inicioSesion.php');
    exit();
}
$p = 0;
$id_calendar = 0;
$dia_semana = 0;
$usu = 0;

$p = $_GET['p'] ?? 0;
$id_calendar = $_GET['calendar'] ?? 0;
$usu = $_GET['usu'] ?? null;

$dia_semana = date('w');

$id_routine = calendarioRutinario::getIdRoutine($id_calendar, $dia_semana);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>En rutina | <?php echo calendarioRutinario::mostrarCalendario(1, 0, $dia_semana, $p, $id_calendar) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" href="./img/logosinfondo.png">
    <link rel="stylesheet" href="css/enRutinasCr.css">


</head>

<body>

    <div class="container cuerpo contenedorEnRutina">
        <div class="row">
            <div class="col-md-12 text-center contenedor_informacion colorear redondear dia_contenedor">
                <h1 class="dia">
                    <?php echo calendarioRutinario::mostrarCalendario(1, 0, $dia_semana, $p, $id_calendar) ?>
                </h1>
            </div>
            <div class="col-md-12 text-center imagenA">
                <iframe
                    src="https://www.youtube.com/embed/<?php echo calendarioRutinario::mostrarCalendario(1, 1, $dia_semana, $p, $id_calendar) ?>"
                    width="100%" height="auto" frameborder="0" allowfullscreen>
                </iframe>
            </div>
            <div class="col-md-12 colorear text-center nombreEjercicio redondear">
                <h1>
                    <b><?php echo calendarioRutinario::mostrarCalendario(1, 2, $dia_semana, $p, $id_calendar) ?></b>
                </h1>
            </div>
            <div class="col-md-12 contenedor_informacion ">
                <h2>
                    Instrucciones:
                </h2>
                <p>
                    <?php echo calendarioRutinario::mostrarCalendario(1, 3, $dia_semana, $p, $id_calendar) ?>
                </p>
            </div>
            <div class="col-md-12  contenedor_informacion colorear redondear">
                <h2>
                    Equipo necesario
                </h2>
                <p>
                    <?php echo calendarioRutinario::mostrarCalendario(1, 4, $dia_semana, $p, $id_calendar) ?>
                </p>
            </div>
            <div class="col-md-12 text-center rep contenedor_informacion colorear">
                <h2>
                    Haz <b class="numero">
                        <p><?php echo calendarioRutinario::mostrarCalendario(1, 5, $dia_semana, $p, $id_calendar) ?>
                    </b>Series de
                    <b class="numero">
                        <?php
                        echo calendarioRutinario::mostrarCalendario(1, 6, $dia_semana, $p, $id_calendar);
                        ?>
                    </b> Repeticiones.
                </h2>
            </div>
            <div class="col-md-12 contenedor_informacion text-center">
                <a
                    href="timer.php?usu=<?php echo $usu ?>&calendar=<?php echo $id_calendar; ?>&calef=<?php echo calendarioRutinario::mostrarCalendario(1, 7, $dia_semana, $p, $id_calendar); ?>&pg=<?php echo $p; ?>">
                    <button class="btn btn-warning btn-gradient botones">Descanso <i class="fa-solid fa-pause"></i>
                    </button>
                </a>
                <?php
                echo calendarioRutinario::optionPage($p, $dia_semana, $id_calendar, $usu)
                    ?>
                <a href="controlador.php?seccion=misCalendarios">
                    <button id="salirButton" class="btn btn-danger">Salir <i
                            class="fa-solid fa-person-shelter"></i></button>
                </a>

                <button class="btn buttonLike" id="interaction" data-id-routine="<?php echo $id_routine; ?>"
                    data-id-usu="<?php echo $usu; ?>">
                    <i class="fa-solid fa-heart like"></i>
                </button>

            </div>
        </div>
    </div>

    <script src="js/salirButton.js"></script>
    <script src="js/interactions.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>