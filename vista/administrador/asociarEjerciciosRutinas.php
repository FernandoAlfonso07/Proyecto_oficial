<?php

include ("administrador.php");


if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id_rutina'])) {
    $_SESSION['id_rutina'] = 1;
} else {
    $_SESSION['id_rutina'];
}

?>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">
                <b>Nombre de Rutina</b>
            </label>

            <h1>
                Nombre de la Rutina
            </h1>
        </div>
        <div class="col-md-6">
            <form action="addEjercicioRutine.php" method="get">
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