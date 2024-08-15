<link rel="stylesheet" href="../css/seccion1.css">
<section>
    <div class="custom-container">
        <div class="custom-input-group">
            <div class="custom-row">
                <button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-exclamation fa-bounce text-danger"></i>
                </button>
                <div class="custom-col">
                    <input type="date" class="custom-date-input" name="dateStart" id="fechaInicio">
                </div>
                <div class="custom-col">
                    <input type="date" class="custom-date-input" name="dateEnd" id="fechaFin">
                </div>
            </div>
        </div>
    </div>
    <div class="custom-chart-container">
        <canvas id="myChart"></canvas>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../js/analytic.js"></script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-exclamation fa-beat"></i>
                    Estadisticas
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Estas estadisticas se activaran cuando los usuarios den like en tus rutinas creadas
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok, Cerrar</button>
            </div>
        </div>
    </div>
</div>