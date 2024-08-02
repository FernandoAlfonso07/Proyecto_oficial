<?php
include_once ('../../model/exercise.php');
$id_exercise = '';
if (!isset($_SESSION)) {
    session_start();
}

$id_exercise = '';

if (isset($_GET['exerc']) && !empty($_GET['exerc'])) {
    $id_exercise = $_GET['exerc'];
    $_SESSION['exercise'] = $id_exercise;
    echo 'id en GET: ' . $id_exercise;
} elseif (isset($_POST['exerc']) && !empty($_POST['exerc'])) {
    $id_exercise = $_POST['exerc'];
    $_SESSION['exercise'] = $id_exercise;
    echo 'id en POST: ' . $id_exercise;
} else {
    // Si no hay ni GET ni POST, revisa la sesión
    if (isset($_SESSION['exercise']) && !empty($_SESSION['exercise'])) {
        $id_exercise = $_SESSION['exercise'];
        echo 'id en SESSION: ' . $id_exercise;
    } else {
        // Maneja el caso en que no haya ningún id_exercise disponible
        echo 'Error: No se ha proporcionado id_exercise.';
        exit();
    }
}

?>

<form action="../../controller/controller_update_exercise.php" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="../<?php echo exercise::getInformationExercises(8, $_SESSION['exercise']); ?>"
                    class="img-fluid img_exercise" width="95%" alt="Imagen del ejercicio">
                <div class="input-group mb-3 subir">
                    <input type="file" class="form-control" name="imageExercise" id="inputGroupFile04"
                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
                <input type="hidden" value="<?php echo exercise::getInformationExercises(0, $_SESSION['exercise']); ?>"
                    name="exerc">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <input type="hidden" value="<?php echo $_SESSION['exercise'] ?>" name="id_exercise">
                    <div class="col-md-12 my-4">
                        <label for="nameExercises" class="form-label">Nombre del ejercicio</label>
                        <input type="text" name="newName" class="form-control" id="nameExercises"
                            value="<?php echo exercise::getInformationExercises(1, $_SESSION['exercise']) ?>">
                    </div>
                    <div class="col-md-6 my-4">
                        <label for="instructions" class="form-label">Instrucciones</label>
                        <textarea class="form-control" name="newinstructions" id="instructions"
                            rows="3"><?php echo exercise::getInformationExercises(2, $_SESSION['exercise']) ?></textarea>
                    </div>
                    <div class="col-md-6 my-4">
                        <label for="necessaryEquipment" class="form-label">Equipo necesario</label>
                        <textarea class="form-control" name="newEquipment" id="necessaryEquipment"
                            rows="3"><?php echo exercise::getInformationExercises(3, $_SESSION['exercise']) ?></textarea>
                    </div>
                    <div class="col-md-4 my-4">
                        <label for="sets" class="form-label">Series</label>
                        <input type="text" name="newSets" class="form-control" id="sets"
                            value="<?php echo exercise::getInformationExercises(4, $_SESSION['exercise']) ?>">
                    </div>
                    <div class="col-md-4 my-4">
                        <label for="repetitions" class="form-label">Repeticiones</label>
                        <input type="text" name="newRepetions" class="form-control" id="repetitions"
                            value="<?php echo exercise::getInformationExercises(5, $_SESSION['exercise']) ?>">
                    </div>
                    <div class="col-md-4 my-4">
                        <label for="breakTime" class="form-label">Tiempo de descanso</label>
                        <input type="text" name="newBreakTime" class="form-control" id="breakTime"
                            value="<?php echo exercise::getInformationExercises(6, $_SESSION['exercise']) ?>">
                    </div>
                </div>

            </div>

            <div class="col-md-12 text-center py-2">
                <button class="btn btn-primary" type="submit">
                    Actualizar <i class="fa-solid fa-pen ms-2"></i>
                </button>
            </div>
        </div>

    </div>
</form>