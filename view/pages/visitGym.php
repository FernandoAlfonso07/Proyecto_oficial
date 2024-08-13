<div class="container mt-5 container_gyms">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h1><?php echo htmlspecialchars($nameGym); ?></h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="<?php echo htmlspecialchars($pathImage); ?>" class="img-fluid gym-logo"
                        alt="Logo del gimnasio smarthAlpha">
                </div>
                <div class="col-md-8">
                    <h3 class="text-primary">Descripción</h3>
                    <p><?php echo htmlspecialchars($descriptionGym); ?></p>

                    <h3 class="text-primary">Misión</h3>
                    <p><?php echo htmlspecialchars($missionGym); ?></p>

                    <h3 class="text-primary">Visión</h3>
                    <p><?php echo htmlspecialchars($visionGym); ?></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3 class="text-primary">Horarios</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Entre Semana</th>
                                <th>Fin de Semana</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Mañana: <?php echo htmlspecialchars($timeStartMorningDay); ?> -
                                    <?php echo htmlspecialchars($timeEndMorningDay); ?><br>
                                    Tarde: <?php echo htmlspecialchars($timeStartAfternoonDay); ?> -
                                    <?php echo htmlspecialchars($timeEndAfternoonDay); ?>
                                </td>
                                <td>
                                    Mañana: <?php echo htmlspecialchars($timeStartMorningEnd); ?> -
                                    <?php echo htmlspecialchars($timeEndMorningEnd); ?><br>
                                    Tarde: <?php echo htmlspecialchars($timeStartAfternoonEnd); ?> -
                                    <?php echo htmlspecialchars($timeEndAfternoonEnd); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="text-primary">Contacto</h3>
                    <p>Teléfono: <?php echo htmlspecialchars($phone); ?> | Email: <?php echo htmlspecialchars($mail); ?>
                    </p>
                    <p>Dirección: <?php echo htmlspecialchars($direction); ?></p>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="category-info mb-3">
                <p class="text-primary">Categoría: <strong><?php echo htmlspecialchars($categoria); ?></strong></p>
                <p class="text-primary">Método de Pago: <?php echo htmlspecialchars($method); ?></p>
            </div>
            <div class="manager-info mb-3">
                <p class="text-primary">Gerente: <?php echo htmlspecialchars($nombre . ' ' . $apellido); ?> | Email:
                    <?php echo htmlspecialchars($correo); ?> | Teléfono: <?php echo htmlspecialchars($telefono); ?>
                </p>
            </div>
            <a href="controlador.php?seccion=inscription_gym" class="btn btn-register">Inscribirse</a>
        </div>
    </div>
</div>