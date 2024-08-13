<?php
include_once ("../../model/Categories.php");// Se incluye el archivo con la clase de 'Administrador'
include_once ("../../model/rutinas.php");// Se incluye el archivo con la clase de 'routines'    
include_once ('../../functions/alerts.php');

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyFields') {
        echo Alerts::error(2, 'Debes de llenar todos los campos', 'addEjercicios');
    }

    if ($_GET['error'] == 'incorrectFormat') {
        echo Alerts::error(2, 'Formato incorrecto', 'addEjercicios');
    }

}

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id_rutina'])) {
    $_SESSION['id_rutina'] = '';
}
$id_rutine = 0;
$id_rutine = isset($_GET['dRoutine']) ? $_GET['dRoutine'] : null;
$_SESSION['id_rutina'] = $id_rutine;
?>

<link rel="stylesheet" href="../css/createRoutine.css">

<section>
    <div class="container">
        <form
            action="<?php echo isset($_GET['dRoutine']) ? '../../controller/rutinaAgregada.php?dRoutine=' . $_SESSION['id_rutina'] : '../../controller/rutinaAgregada.php'; ?>"
            method="POST">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="https://media-public.canva.com/9wGcU/MAFOtN9wGcU/1/tl.png" width="70%"
                        alt="Imagen de Add Rutina">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Nombre de la rutina</label>
                            <input type="text" name="nombreRutina" class="form-control"
                                value="<?php echo isset($_GET['dRoutine']) ? routines::getInformation(1, $_SESSION['id_rutina']) : '' ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Descripcion *</label>
                            <textarea class="form-control" placeholder="Escribe aqui..." name="Descripcion"
                                id="floatingTextarea2"
                                style="height: 100px"><?php echo isset($_GET['dRoutine']) ? routines::getInformation(2, $_SESSION['id_rutina']) : '' ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Objetivo *</label>
                            <textarea class="form-control" placeholder="Escribe aqui..." name="objetivo"
                                id="floatingTextarea2"
                                style="height: 100px"><?php echo isset($_GET['dRoutine']) ? routines::getInformation(3, $_SESSION['id_rutina']) : '' ?></textarea>
                        </div>
                        <div class="col-md-12 my-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-select" name="id_category" aria-label="Default select example">
                                        <option selected>Selecciona la categoria</option>
                                        <?php
                                        $issetCategorySelected = isset($_GET['dRoutine']) ? routines::getInformation(5, $_SESSION['id_rutina']) : null;
                                        echo CycleCreateCalender::getCategories('categoryRoutine', $issetCategorySelected);
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Crear Categoria <i
                                            class="fa-solid fa-square-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-4 text-center">
                            <button type="submit"
                                class="btn btn-primary boton"><?php echo isset($_GET['dRoutine']) ? 'Actualizar' : 'Agregar'; ?>
                                Rutina</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Modal para agregar una categoria -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="../../controller/createdCategory.php?newCategory=routine" method="POST">
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
