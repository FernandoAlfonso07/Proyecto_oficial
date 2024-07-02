<div class="container">
    <form action="../../controler/ejercicioAgregado.php" method="get">
        <div class="row">
            <div class="col-md-6">
                Agrega un ejemplo grafico * <br>
                <div class="input-group">

                    <input type="file" name="archivo" class="form-control" id="inputGroupFile04"
                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        Nombre del ejercicio *
                        <input type="text" name="nombreEjercicio" class="form-control">
                    </div>
                    <div class="col-md-12">
                        Instrucciones *
                        <textarea class="form-control" placeholder="Escribe aqui..." name="instrucciones"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>
                    <div class="col-md-12">
                        Equipo necesario
                        <textarea class="form-control" placeholder="Escribe aqui..." name="equipo"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                Seires
                                <input type="text" name="series" class="form-control">
                            </div>

                            <div class="col-md-6">
                                Repeticiones
                                <input type="text" name="repeticiones" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        Tiempo de descanso
                        <input type="text" name="t_descanso" placeholder="En minutos" class="form-control">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>