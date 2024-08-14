<?php
!isset($_SESSION) ? session_start() : null;
include_once('../../model/Categories.php');
include_once('../../functions/alerts.php');
include_once("../../model/gyms.php");

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyFields') {
        echo Alerts::error(2, 'Debes de llenar todos los campos', 'addGimnasio');
    }

    if ($_GET['error'] == 'incorrectFormat') {
        echo Alerts::error(2, 'Formato incorrecto', 'addGimnasio');
    }
}

$_SESSION['id_gym'] = $_GET['dgym'] ?? null;
?>
<link rel="stylesheet" href="../css/addGimansio.css">

<section>
    <div class="container">
        <form
            action="<?php echo isset($_GET['dgym']) ? "../../controller/updateInfoGym.php" : "../../controller/controller_gym_Registration.php"; ?>"
            method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">

                    <div class="row"> <!-- SEGUNDA COLUMNA PARA EL FORMULARIO -->

                        <div class="col-md-12"> <!-- Informacion del gimnasio -->
                            <h1 class="text-center">Información de gimnasio</h1>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nameGym"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(0, $_SESSION['id_gym'], 'call') : null; ?>"
                                        class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Categoría</label>
                                            <select class="form-select" name="category_gym"
                                                aria-label="Default select example">
                                                <option selected>Escoge la categoría</option>
                                                <?php $selectedCategory = isset($_GET['dgym']) ? Gyms::getInfoThisGym(16, $_SESSION['id_gym'], 'call') : null;
                                                echo CycleCreateCalender::getCategories('gyms', $selectedCategory) ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 my-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Crear Categoria <i
                                                    class="fa-solid fa-square-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" placeholder="Escribe aquí..." name="description"
                                        id="floatingTextarea2"
                                        style="height: 100px"><?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(1, $_SESSION['id_gym'], 'call') : null; ?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Misión</label>
                                    <textarea class="form-control" placeholder="Escribe aquí la misión del gimnasio..."
                                        name="mission" id="floatingTextarea2"
                                        style="height: 100px"><?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(2, $_SESSION['id_gym'], 'call') : null; ?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Visión</label>
                                    <textarea class="form-control" placeholder="Escribe aquí la visión del gimnasio..."
                                        name="vision" id="floatingTextarea2"
                                        style="height: 100px"><?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(3, $_SESSION['id_gym'], 'call') : null; ?></textarea>
                                </div>

                                <?php
                                if (isset($_GET['dgym'])) {
                                    ?>
                                    <img src="../<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(4, $_SESSION['id_gym'], 'call') : null; ?>"
                                        style="width: 40%;" alt="Logo De gimnasio Actual">
                                    <?php
                                }

                                ?>

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
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(5, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="morning_time_weekday_start" class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(6, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="morning_time_weekday_end" class="form-control"></div>

                                <div class="col-md-12">En la <b>Tarde</b></div> <!--Horario de la tarde-->
                                <div class="col-md-1">De</div>
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(7, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="afternoon_time_weekday_start" class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(8, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="afternoon_time_weekday_end" class="form-control"><br></div>

                                <label class="form-label"> <!--Horario de los festivos y sábados-->
                                    <b>Sábado y festivos</b>
                                </label>
                                <div class="col-md-12">En la <b>mañana</b></div> <!--Horario de la mañana-->
                                <div class="col-md-1">De</div>
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(9, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="morning_time_weekend_start" class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(10, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="morning_time_weekend_end" class="form-control"></div>

                                <div class="col-md-12">En la <b>Tarde</b></div> <!--Horario de la tarde-->
                                <div class="col-md-1">De</div>
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(11, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="afternoon_time_weekend_start" class="form-control"></div>
                                <div class="col-md-1 text-center">A</div>
                                <div class="col-md-3"><input type="time"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(12, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="afternoon_time_weekend_end" class="form-control"></div>
                            </div>
                        </div>

                        <div class="col-md-12"> <!--Información de contacto del gimnasio-->
                            <h1 class="text-center">Contacto</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(13, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="phone" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo</label>
                                    <input type="text"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(14, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="email" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Dirección</label>
                                    <input type="text"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(15, $_SESSION['id_gym'], 'call') : null; ?>"
                                        name="address" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12"> <!--Servicios del gimnasio-->
                            <h1 class="text-center">Servicios</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Formas de pago</label>
                                            <select class="form-select" name="payment_method"
                                                aria-label="Default select example">
                                                <option selected>Escoge la forma de pago</option>
                                                <?php
                                                $selectedMethod = isset($_GET['dgym']) ? Gyms::getInfoThisGym(17, $_SESSION['id_gym'], 'call') : null;
                                                echo CycleCreateCalender::getCategories('paymentMethods', $selectedMethod)
                                                    ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6 my-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#methodModal">Crear Metodo de pago <i
                                                    class="fa-solid fa-square-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pago De mensualidad</label>
                                    <input type="text"
                                        value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(21, $_SESSION['id_gym'], 'detailedInfo') : null; ?>"
                                        name="monthly_payment" class="form-control">
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
                                        <input type="text"
                                            value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(20, $_SESSION['id_gym'], 'call') : null; ?>"
                                            name="managerEmail" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Teléfono</label>
                                        <input type="number" min="0" max="11"
                                            value="<?php echo isset($_GET['dgym']) ? Gyms::getInfoThisGym(21, $_SESSION['id_gym'], 'call') : null; ?>"
                                            name="managerPhone" class="form-control">
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

<!-- Modal para agregar una categoria -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="../../controller/createdCategory.php?newCategory=gym" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="nameCategory" class="form-label">Nombre de la categoria</label>
                    <input type="text" class="form-control" name="nameCategory">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar <i
                            class="fa-regular fa-circle-xmark"></i></button>
                    <button type="submit" class="btn btn-primary">Guardar <i
                            class="fa-solid fa-floppy-disk"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal para agregar una categoria -->
<div class="modal fade" id="methodModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="../../controller/createdCategory.php?newCategory=method" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Metodo de Pago</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="nameCategory" class="form-label">Nombre de la categoria</label>
                    <input type="text" class="form-control" name="nameCategory">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar <i
                            class="fa-regular fa-circle-xmark"></i></button>
                    <button type="submit" class="btn btn-primary">Guardar <i
                            class="fa-solid fa-floppy-disk"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>