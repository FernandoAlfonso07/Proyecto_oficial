<?php

include_once ("../../model/administrador.php");// Se incluye el archivo con la clase de 'Administrador'

include_once ("../../model/rutinas.php");// Se incluye el archivo con la clase de 'routines'


if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id_rutina'])) {

    $id_rutine = Administrador::getIdrutina();

    $_SESSION['id_rutina'] = $id_rutine;

}

?>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">
                <b>Nombre de Rutina</b>
            </label>

            <h1>
                <?php echo routines::getInformation(1, $_SESSION['id_rutina']) ?>
            </h1>
        </div>
        <div class="col-md-6">
            <form action="../../controler/addEjercicioRutine.php" method="get">
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

            <button type="submit" class="btn btn-danger ml-4 my-5"> Cerrar y guardar <i
                    class="fa-solid fa-circle-xmark ms-2 fs-5"></i> </button>

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