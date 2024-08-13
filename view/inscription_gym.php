<?php
!isset($_SESSION) ? session_start() : null;
include_once ("../model/gyms.php");
?>
<link rel="stylesheet" href="css/inscription.css">
<div class="container all">
    <section class="form-section">
        <h2>Inscripción al Gimnasio</h2>

        <!-- Información del Gimnasio -->
        <div class="form-group">
            <h3>Nombre del Gimnasio</h3>
            <p><?php echo Gyms::getInfoThisGym(0, $_SESSION['thisGym'], "call") ?></p>
            <h3>Información de Contacto</h3>
            <p>Correo Electrónico: <?php echo Gyms::getInfoThisGym(14, $_SESSION['thisGym'], "call") ?></p>
            <p>Teléfono: <?php echo Gyms::getInfoThisGym(13, $_SESSION['thisGym'], "call") ?></p>
        </div>

        <!-- Información del Inscrito -->
        <form action="../controller/submit_form_inscription.php" method="post">
            <div class="form-group">
                <label for="fullName">Nombres y Apellidos Completos</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="contactEmail">Correo Electrónico</label>
                <input type="email" class="form-control" id="contactEmail" name="contactEmail" required>
            </div>

            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="idNumber">Número de Identificación</label>
                <input type="text" class="form-control" id="idNumber" name="document" required>
            </div>

            <div class="form-group">
                <label for="medicalInfo">Información Médica (¿Tienes alguna enfermedad?)</label>
                <textarea class="form-control" id="medicalInfo" name="medicalInfo" rows="3" required>Ninguna</textarea>
            </div>

            <!-- Costo de Mensualidad -->
            <div class="form-group">
                <label for="monthlyCost" class="large-text">Costo de Mensualidad -
                    <?php echo Gyms::getInfoThisGym(21, $_SESSION['thisGym'], 'detailedInfo'); ?></label>
                <input type="text" class="form-control" id="monthlyCost" name="monthlyCost" placeholder="Monta a Pagar"
                    required>
            </div>

            <!-- Botón de Enviar -->
            <button type="submit" class="btn-submit my-5">Inscribirse</button>
        </form>
    </section>
</div>