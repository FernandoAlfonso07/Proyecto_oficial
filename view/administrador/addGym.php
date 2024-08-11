<?php
include_once ('../../model/Categories.php');
include_once ('../../functions/alerts.php');

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyFields') {
        echo Alerts::error(2, 'Debes de llenar todos los campos', 'addGimnasio');
    }

    if ($_GET['error'] == 'incorrectFormat') {
        echo Alerts::error(2, 'Formato incorrecto', 'addGimnasio');
    }
}

?>
<link rel="stylesheet" href="../css/addGimansio.css">

<section>
    <div class="container">
        <form action="../../controller/controller_gym_Registration.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">

                    <div class="row"> <!-- SEGUNDA COLUMNA PARA EL FORMULARIO -->

                        <div class="col-md-12"> <!-- Informacion del gimnasio -->
                            <h1 class="text-center">Información de gimnasio</h1>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nameGym" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Categoría</label>
                                    <select class="form-select" name="category_gym" aria-label="Default select example">
                                        <option selected>Escoge la categoría</option>
                                        <?php echo CycleCreateCalender::getCategories('gyms') ?>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" placeholder="Escribe aquí..." name="description"
                                        id="floatingTextarea2" style="height: 100px"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Misión</label>
                                    <textarea class="form-control" placeholder="Escribe aquí la misión del gimnasio..."
                                        name="mission" id="floatingTextarea2" style="height: 100px"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Visión</label>
                                    <textarea class="form-control" placeholder="Escribe aquí la visión del gimnasio..."
                                        name="vision" id="floatingTextarea2" style="height: 100px"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Agrega fotos del gimnasio</label>
                                    <div class="input-group">
                                        <input type="file" name="img_gym" class="form-control" id="inputGroupFile04"
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md1-12"> <!-- Horarios del gimnasio -->
                            <h1 class="text-center">Horarios</h1>
                            <div class="row">
                                <label class="form-label"> <!--Horario de la mañana-->
                                    <b>Lunes a Viernes</b>
                                </label>
                                <div class="col-md-12">En la <b>mañana</b></div>
                                <div class="col-md-1">De</div>
                                <div class="col-md-3"><input type="time" name="morning_time_weekday_start"
                                        class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time" name="morning_time_weekday_end"
                                        class="form-control"></div>

                                <div class="col-md-12">En la <b>Tarde</b></div> <!--Horario de la tarde-->
                                <div class="col-md-1">De</div>
                                <div class="col-md-3"><input type="time" name="afternoon_time_weekday_start"
                                        class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time" name="afternoon_time_weekday_end"
                                        class="form-control"><br></div>

                                <label class="form-label"> <!--Horario de los festivos y sábados-->
                                    <b>Sábado y festivos</b>
                                </label>
                                <div class="col-md-12">En la <b>mañana</b></div> <!--Horario de la mañana-->
                                <div class="col-md-1">De</div>
                                <div class="col-md-3"><input type="time" name="morning_time_weekend_start"
                                        class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time" name="morning_time_weekend_end"
                                        class="form-control"></div>

                                <div class="col-md-12">En la <b>Tarde</b></div> <!--Horario de la tarde-->
                                <div class="col-md-1">De</div>
                                <div class="col-md-3"><input type="time" name="afternoon_time_weekend_start"
                                        class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time" name="afternoon_time_weekend_end"
                                        class="form-control"></div>
                            </div>
                        </div>

                        <div class="col-md-12"> <!--Información de contacto del gimnasio-->
                            <h1 class="text-center">Contacto</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12"> <!--Servicios del gimnasio-->
                            <h1 class="text-center">Servicios</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Formas de pago</label>
                                    <select class="form-select" name="payment_method"
                                        aria-label="Default select example">
                                        <option selected>Escoge la forma de pago</option>
                                        <?php echo CycleCreateCalender::getCategories('paymentMethods') ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"> <!--Información del gerente-->
                            <h1 class="text-center">Datos gerente</h1>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        <b>¡Recuerda</b>: El correo electrónico y el numero de telefono deben estar
                                        registrados en
                                        el sistema con rol de gerente de gimnasio!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo electrónico</label>
                                    <input type="text" name="managerEmail" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" name="managerPhone" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 my-4 text-center">
                        <button type="submit" class="btn btn-primary boton">Registrar</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</section>