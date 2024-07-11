<link rel="stylesheet" href="css/createCalender.css">

<div class="container cuerpo">
    <form action="../controller/createCalender.php" class="form-floating">
        <div class="row">

            <div class="col-md-2"> </div>
            <div class="col-md-8 mt-2 mb-2 text-center">
                <label class="form-label">
                    <h2>
                        Dale un nombre a este calendario rutinario
                    </h2>
                </label>
                <input type="text" class="form-control my-2" name="nameCalendar" placeholder="Escribe aqui..." value="">
            </div>
            <div class="col-md-2"> </div>
            <div class="col-md-2"> </div>
            <div class="col-md-8">
                <b> Dale una descripción a este calendario *</b>
                <textarea class="form-control my-2" name="description" placeholder="Escribe aqui..."></textarea>
            </div>
            <div class="col-md-2"> <input type="hidden" name="page" value="1ro"> </div>
        
            <div class="col-md-12 my-5 text-center">
                <button class="btn btn-primary">
                    Siguiente <i class="fa-solid fa-person-skating"></i>
                </button>
            </div>
        </div>
    </form>
</div>


<script src="js/filterCategories.js"></script>