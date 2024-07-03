<div class="container">
    <form action="../../controler/rutinaAgregada.php" method="get">
        <div class="row">

            <div class="col-md-6">
                <img src="#" alt="Imagen de Add Rutina">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Nombre de la rutina</label>

                        <input type="text" name="nombreRutina" class="form-control">
                    </div>
                    <div class="col-md-12">
                        Descripcion *
                        <textarea class="form-control" placeholder="Escribe aqui..." name="Descripcion"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>

                    <div class="col-md-12">
                        Objetivo *
                        <textarea class="form-control" placeholder="Escribe aqui..." name="objetivo"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>

                    <br>
                    <div class="col-md-12 my-4 text-center">
                        <button type="submit" class="btn btn-primary boton">Agregar Rutina</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>