<?php

include_once ("../../model/administrador.php");// Se incluye el archivo con la clase de 'Administrador'

include_once ("../../model/rutinas.php");// Se incluye el archivo con la clase de 'routines'


if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id_rutina'])) {
    $_SESSION['id_rutina'] = '';
}
$id_rutine = isset($_GET['rtu']) ? $_GET['rtu'] : Administrador::getIdrutina();

$_SESSION['id_rutina'] = $id_rutine;

?>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">
                <b>Nombre de Rutina</b>
            </label>

            <h1>
                <?php


                echo routines::getInformation(1, $_SESSION['id_rutina']);

                ?>
            </h1>
        </div>
        <div class="col-md-6">
            <form action="../../controller/addEjercicioRutine.php" method="POST">
                <label class="form-label">
                    Agregar ejercicios
                </label>

                <select class="form-select" name="ejercicio_value" aria-label="Default select example">
                    <option selected>Agregar ejercicio</option>

                    <?php echo Administrador::mostrarEjercicios() ?>
                </select>

                <input type="hidden" name="rutinaID" value="<?php echo $_SESSION['id_rutina']; ?>">

                <button type="submit" class="btn btn-warning my-5">Agregar <i class="fa-solid fa-plus ms-2 fs-5"></i>
                </button>

            </form>

            <div class="col-md-12">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Agregar Ejercicio <i class="fa-solid fa-square-plus ms-2 fs-5"></i>
                </button>
            </div>

            <a href="controladorVadmin.php?seccionAd=showRoutines">
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
    <form action="../../controller/add_Exercise_Fast.php" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar ejercicio rapido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            Agrega un ejemplo grafico * <br>
                            <div class="input-group">

                                <input type="file" name="archivo" class="form-control" id="inputGroupFile04"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            </div>
                        </div>
                        <div class="col-md-12">
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar <i
                            class="fa-regular fa-circle-xmark"></i></button>
                    <button onclick="confirmar()" type="submit" class="btn btn-primary">Guardar <i
                            class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>