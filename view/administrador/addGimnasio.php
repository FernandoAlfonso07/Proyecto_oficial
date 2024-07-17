<link rel="stylesheet" href="../css/addGimansio.css">

<div class="container">
    <form action="../../controller/ejercicioAgregado.php" method="get">
        <div class="row">

            <div class="col-md-6 text-center">
                <img src="../img/addGimnasio.png" class="img-fluid" width="80%" alt="Foto">
            </div>
            <div class="col-md-6">

                <div class="row"> <!-- SEGUNDA COLUMNA PARA EL FORMULARIO -->

                    <div class="col-md-12"> <!-- Informacion del gimnasio -->
                        <h1 class="text-center">Información de gimnasio</h1>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombreGimnasio" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Categoria</label>

                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Escoge la categoria</option>
                                    <option class="opcion" value="1">Categoria 1</option>
                                    <option class="opcion" value="2">Categoria 2</option>
                                    <option class="opcion" value="3">Categoria 3</option>
                                </select>
                            </div>

                            <div class="col-md-12">

                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" placeholder="Escribe aqui..." name="Descripcion"
                                    id="floatingTextarea2" style="height: 100px"></textarea>
                            </div>

                            <div class="col-md-12">

                                <label class="form-label">Mision</label>
                                <textarea class="form-control" placeholder="Escribe aqui la vision del gimnasio..."
                                    name="vision" id="floatingTextarea2" style="height: 100px"></textarea>
                            </div>

                            <div class="col-md-12">

                                <label class="form-label">Vision</label>
                                <textarea class="form-control" placeholder="Escribe aqui la misión del gimnasio..."
                                    name="mision" id="floatingTextarea2" style="height: 100px"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Agrega fotos del gimnasio</label>

                                <div class="input-group">
                                    <input type="file" name="fotos del gimnasio " class="form-control"
                                        id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                                        aria-label="Upload">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md1-12"> <!-- Horarios del gimnasio -->

                        <h1 class="text-center">Horarios</h1>

                        <div class="row">

                            <label class="form-label"> <!--Horario de la mañana-->
                                <b> Lunes a Sabado</b>
                            </label>

                            <div class="col-md-12"> En la <b>mañana</b></div>
                            <div class="col-md-1"> De</div>

                            <div class="col-md-3"><input type="time" class="form-control"></div>

                            <div class="col-md-1 text-center">A</div>

                            <div class="col-md-3"><input type="time" class="form-control"></div>

                            <div class="col-md-12"> En la <b>Tarde</b></div> <!--Horario de la tarde-->
                            <div class="col-md-1"> De</div>

                            <div class="col-md-3"><input type="time" class="form-control"></div>

                            <div class="col-md-1 text-center">A</div>

                            <div class="col-md-3"><input type="time" class="form-control"><br></div>



                            <label class="form-label"> <!--Horario de los festivos y sabados-->
                                <b>Sabado y festivos</b>
                            </label>

                            <div class="col-md-12"> En la <b>mañana</b></div> <!--Horario de la mañana-->
                            <div class="col-md-1"> De</div>

                            <div class="col-md-3"><input type="time" class="form-control"></div>

                            <div class="col-md-1 text-center">A</div>

                            <div class="col-md-3"><input type="time" class="form-control"></div>

                            <div class="col-md-12"> En la <b>Tarde</b></div> <!--Horario de la tarde-->
                            <div class="col-md-1"> De</div>

                            <div class="col-md-3"><input type="time" class="form-control"></div>

                            <div class="col-md-1 text-center">A</div>

                            <div class="col-md-3"><input type="time" class="form-control"></div>

                        </div>
                    </div>

                    <div class="col-md-12"> <!--Informacion de contacto del gimnasio-->

                        <h1 class="text-center">Contacto</h1>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">
                                    Telefono
                                </label>
                                <input type="text" name="telefono" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    Correo
                                </label>
                                <input type="text" name="Correo" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">
                                    Direccion
                                </label>
                                <input type="text" name="Direccion" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="col-md-12"> <!-- SERVICIOS DEL GIMNASIO -->

                        <h1 class="text-center">Servicios</h1>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Formas de pago</label>
                                <input type="text" name="formas_de_pago" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Ofertas y promociones</label>
                                <input type="text" name="ofertas_y_promociones" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12"> <!-- INFORMACION DEL GERENTE -->
                        <h1 class="text-center">Datos gerente</h1>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Nombres Completo</label>
                                <input type="text" name="NombreGerente" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Apellidos Completos</label>
                                <input type="text" name="ApellidosGerente" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Correo electronico</label>
                                <input type="text" name="CorreoGerente" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="TelefonoGerente" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="col-md-12 text-center">
                        <button onclick="mensaje()" type="submit" class="btn btn-primary boton">Registrar</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>