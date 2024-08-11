<?php

include_once ("../../model/administrador.php");// Se incluye el archivo con la clase de 'Administrador'

include_once ("../../model/rutinas.php");// Se incluye el archivo con la clase de 'routines'

include_once ('../../functions/alerts.php');

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyFields') {
        echo Alerts::error(2, 'Debes de llenar todos los campos', 'asociarEjerciciosRutinas');
    }
    if ($_GET['error'] == 'incorrectFormat') {
        echo Alerts::error(2, 'Formato incorrecto', 'asociarEjerciciosRutinas');
    }
    if ($_GET['error'] == 'addedExercise') {
        echo Alerts::error(2, 'Ya se agrego ese ejercicio', 'asociarEjerciciosRutinas');
    }
}
if (isset($_GET['success'])) {
    if ($_GET['success'] == 'exito') {
        echo Alerts::ok(2, 'Se agrego el ejercicio', 'asociarEjerciciosRutinas');
    }
}
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id_rutina'])) {
    $_SESSION['id_rutina'] = '';
}
$id_rutine = isset($_GET['rtu']) ? $_GET['rtu'] : Administrador::getIdrutina();

$_SESSION['id_rutina'] = $id_rutine;

?>
<link rel="stylesheet" href="../css/routine_exercise.css">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label"><b>Nombre de Rutina</b></label>
            <h1>
                <?php echo routines::getInformation(1, $_SESSION['id_rutina']); ?>
            </h1>
        </div>
        <div class="col-md-6">
            <form action="../../controller/addEjercicioRutine.php" method="POST">
                <label class="form-label">Agregar ejercicios</label>
                <select class="form-select" name="ejercicio_value" aria-label="Default select example">
                    <option selected value="">Agregar ejercicio</option>
                    <?php echo Administrador::mostrarEjercicios() ?>
                </select>
                <input type="hidden" name="rutinaID" value="<?php echo $_SESSION['id_rutina']; ?>">
                <button type="submit" class="btn btn-warning my-5">Agregar <i
                        class="fa-solid fa-plus ms-2 fs-5"></i></button>
            </form>
            <div class="col-md-12">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Agregar Ejercicio <i
                        class="fa-solid fa-square-plus ms-2 fs-5"></i></button>
            </div>
            <a href="controladorVadmin.php?success=addedExercise&seccionAd=showRoutines">
                <button type="submit" class="btn btn-danger ml-4 my-5"> Cerrar y guardar <i
                        class="fa-solid fa-circle-xmark ms-2 fs-5"></i> </button>
            </a>
        </div>
        <div class="col-md-12">
            <h2>EJERCICIOS AGREGADOS</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Ejercicio</th>
                        <th scope="col">Nombre ejercicio</th>
                        <th scope="col"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo Administrador::See_Added_Exercises($_SESSION['id_rutina']); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar una categoria -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="../../controller/add_Exercise_Fast.php" method="POST" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" style="color: white;" id="exampleModalLabel">Agregar ejercicio rapido
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputTypeSelector">Agrega un ejemplo gráfico *</label>
                            <div>
                                <select id="inputTypeSelector" class="form-control">
                                    <option value="text">Agregar URL</option>
                                    <option value="file">Subir Archivo</option>
                                </select>
                                <div id="inputContainer" class="mt-3">
                                    <input type="text" name="archivo_url" class="form-control"
                                        placeholder="Agrega la URL" id="inputText" style="display: none;">
                                    <input type="file" name="archivo" class="form-control" id="inputFile"
                                        style="display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nombreEjercicio">Nombre del ejercicio *</label>
                                    <input type="text" id="nombreEjercicio" name="nombreEjercicio" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="instrucciones">Instrucciones *</label>
                                    <textarea class="form-control" id="instrucciones" placeholder="Escribe aquí..."
                                        name="instrucciones" style="height: 100px"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="equipo">Equipo necesario</label>
                                    <textarea class="form-control" id="equipo" placeholder="Escribe aquí..."
                                        name="equipo" style="height: 100px"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="series">Series</label>
                                            <input type="text" id="series" name="series" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="repeticiones">Repeticiones</label>
                                            <input type="text" id="repeticiones" name="repeticiones"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="t_descanso">Tiempo de descanso</label>
                                    <input type="text" id="t_descanso" name="t_descanso" placeholder="En Segundos"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar <i
                            class="fa-regular fa-circle-xmark"></i></button>
                    <button onclick="confirmar()" type="submit" class="btn btn-primary">Guardar <i
                            class="fa-solid fa-floppy-disk"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#inputTypeSelector').change(function () {
            if ($(this).val() === 'text') {
                $('#inputText').show();
                $('#inputFile').hide();
            } else if ($(this).val() === 'file') {
                $('#inputText').hide();
                $('#inputFile').show();
            }
        }).trigger('change');
    });
</script>