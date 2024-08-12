<section>
    <?php

    !isset($_SESSION) ? session_start() : null;

    // Incluir el archivo que contiene la clase Gyms
    include_once ("../model/gyms.php");

    // Obtener el ID del gimnasio desde la URL, si está presente
    $_SESSION['thisGym'] = isset($_GET['gymid']) ? $_GET['gymid'] : null;


    // Incluir el archivo CSS para la página de detalles del gimnasio
    echo '<link rel="stylesheet" href="css/gym/visitGym.css">';

    // Llamar al método showInfoGyms de la clase Gyms para mostrar los detalles del gimnasio
    echo Gyms::showInfoGyms(2, $_SESSION['thisGym']);
    ?>
</section>