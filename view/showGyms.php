<?php
// Incluir el archivo gyms.php, que contiene la definición de la clase Gyms
include_once("../model/gyms.php");
?>
<link rel="stylesheet" href="css/showGyms.css">
<section>

    <div class="cuerpo-show-gyms">

        <input class="form-control my-5" type="search" id="toSearch" placeholder="Buscar..." aria-label="Search">

        <div id="container_gymss">
            <?php
            // Llamar al método showInfoGyms de la clase Gyms con el parámetro 1 para mostrar la información de todos los gimnasios
            echo Gyms::showInfoGyms(1)
                ?>
        </div>

    </div>
</section>

<script src="js/search.js"></script>