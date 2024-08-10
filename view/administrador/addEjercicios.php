<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="../css/agregarEjercicios.css">

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
                        <input type="file" name="archivo" class="form-control" id="inputFile" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
                        <textarea class="form-control" id="equipo" placeholder="Escribe aquí..." name="equipo"
                            style="height: 100px"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="series">Series</label>
                                <input type="text" id="series" name="series" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="repeticiones">Repeticiones</label>
                                <input type="text" id="repeticiones" name="repeticiones" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="t_descanso">Tiempo de descanso</label>
                        <input type="text" id="t_descanso" name="t_descanso" placeholder="En Segundos"
                            class="form-control">
                    </div>
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-agregar">Agregar</button>
                    </div>
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