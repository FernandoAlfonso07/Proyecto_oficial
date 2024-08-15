<?php
include_once ('../../functions/alerts.php');
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyFields') {
        echo Alerts::error(2, 'Debes de llenar todos los campos', 'addEjercicios');
    }
    if ($_GET['error'] == 'incorrectFormat') {
        echo Alerts::error(2, 'Formato incorrecto', 'addEjercicios');
    }
}

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="../css/agregarEjercicios.css">

<section>
<div class="container">
        <form action="../../controller/ejercicioAgregado.php" method="POST" enctype="multipart/form-data"
            class="form-ejercicio">
            <div class="row">
                <div class="col-md-6">
                    <label for="inputTypeSelector">Agrega un ejemplo gráfico *</label>
                    <div>
                        <select id="inputTypeSelector" class="form-control">
                            <option value="text">Agregar URL</option>
                            <option value="file">Subir Archivo</option>
                        </select>
                        <div id="inputContainer" class="mt-3">
                            <input type="text" name="archivo_url" class="form-control" placeholder="Agrega la URL"
                                id="inputText" style="display: none;">
                            <span id="archivo-url-error-message" class="error-message"></span>

                            <input type="file" name="archivo" class="form-control" id="inputFile"
                                style="display: none;">
                            <span id="archivo-file-error-message" class="error-message"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nombreEjercicio">Nombre del ejercicio *</label>
                            <input type="text" id="nombreEjercicio" name="nombreEjercicio" class="form-control">
                            <span id="nombreEjercicio-error-message" class="error-message"></span>
                        </div>
                        <div class="col-md-12">
                            <label for="instrucciones">Instrucciones *</label>
                            <textarea class="form-control" id="instrucciones" placeholder="Escribe aquí..."
                                name="instrucciones" style="height: 100px"></textarea>
                            <span id="instrucciones-error-message" class="error-message"></span>
                        </div>
                        <div class="col-md-12">
                            <label for="equipo">Equipo necesario</label>
                            <textarea class="form-control" id="equipo" placeholder="Escribe aquí..." name="equipo"
                                style="height: 100px"></textarea>
                            <span id="equipo-error-message" class="error-message"></span>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="series">Series</label>
                                    <input type="text" id="series" name="series" class="form-control">
                                    <span id="series-error-message" class="error-message"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="repeticiones">Repeticiones</label>
                                    <input type="text" id="repeticiones" name="repeticiones" class="form-control">
                                    <span id="repeticiones-error-message" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="t_descanso">Tiempo de descanso</label>
                            <input type="text" id="t_descanso" name="t_descanso" placeholder="En Segundos"
                                class="form-control">
                            <span id="t_descanso-error-message" class="error-message"></span>
                        </div>
                        <div class="col-md-12 text-center mt-4">
                            <button type="submit" id="buttonValidate" class="btn btn-primary btn-agregar">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

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