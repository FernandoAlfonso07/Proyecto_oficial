<?php
!isset($_SESSION) ? session_start() : null;
include_once("../model/gym_membership.php");
include_once("../model/gyms.php");
$count_membership = Gym_membership::showInfor("count", $_SESSION['id'], 0);
if ($count_membership <= 0) {
    header("Location: controlador.php?seccion=seccion1");
    exit();
}

?>
<link rel="stylesheet" href="css/gym/sectionMyGym.css">

<div class="container cuerpo">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1><i class="fas fa-dumbbell"></i>
                <?php echo Gyms::getInfoThisGym(0, $_SESSION['id_myGym'], "call") ?>
            </h1>
        </div>
        <div class="col-md-12 text-center">
            <img src=" <?php echo Gyms::getInfoThisGym(4, $_SESSION['id_myGym'], "call") ?>" alt="Imagen del Gimnasio"
                class="img-fluid gym-image img-60">
        </div>
        <div class="col-md-12 mt-4 text-center">
            <div class="status-info">
                <p><strong>Estado:</strong>
                    <?php
                    $statusGym = Gyms::getInfoThisGym(20, $_SESSION['id_myGym'], "detailedInfo");
                    if ($statusGym == "activo") {
                        echo "<span class='badge badge-success'>";
                        echo $statusGym;
                        echo "</span>";
                    } else {
                        echo "<span class='badge badge-danger'>";
                        echo $statusGym;
                        echo "</span>";
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <table class="table table-bordered table-striped horarios-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Semana - Mañana</td>
                        <td><?php echo Gyms::getInfoThisGym(5, $_SESSION['id_myGym'], "call") ?></td>
                        <td><?php echo Gyms::getInfoThisGym(6, $_SESSION['id_myGym'], "call") ?></td>
                    </tr>
                    <tr>
                        <td>Semana - Tarde</td>
                        <td><?php echo Gyms::getInfoThisGym(7, $_SESSION['id_myGym'], "call") ?></td>
                        <td><?php echo Gyms::getInfoThisGym(8, $_SESSION['id_myGym'], "call") ?></td>
                    </tr>
                    <tr>
                        <td>Fin de Semana - Mañana</td>
                        <td><?php echo Gyms::getInfoThisGym(9, $_SESSION['id_myGym'], "call") ?></td>
                        <td><?php echo Gyms::getInfoThisGym(10, $_SESSION['id_myGym'], "call") ?></td>
                    </tr>
                    <tr>
                        <td>Fin de Semana - Tarde</td>
                        <td><?php echo Gyms::getInfoThisGym(11, $_SESSION['id_myGym'], "call") ?></td>
                        <td><?php echo Gyms::getInfoThisGym(12, $_SESSION['id_myGym'], "call") ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 mt-4">
            <p><strong>Pago por mes:</strong>
                <?php echo Gyms::getInfoThisGym(21, $_SESSION['id_myGym'], "detailedInfo") ?> </p>
        </div>
        <div class="col-md-6 mt-4">
            <div class="contact-info">
                <p><strong>Teléfono:</strong> <?php echo Gyms::getInfoThisGym(13, $_SESSION['id_myGym'], "call") ?></p>
                <p><strong>Correo:</strong> <?php echo Gyms::getInfoThisGym(14, $_SESSION['id_myGym'], "call") ?></p>
            </div>
        </div>
        <div class="col-md-12 mt-4 mb-5 text-right">
            <button class="btn btn-green">
                <i class="fas fa-credit-card"></i> Pagar mensualidad
            </button>
        </div>
    </div>
</div>