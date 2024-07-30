<?php

include_once ('../model/administrador.php');
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

$input = ['nameCategory'];

if (validate::validateNotEmptyInputs($input)) {
    $nameCategory = validate::sanitize($_POST['nameCategory']);

    $cont = Administrador::createCategory($nameCategory);

    if ($cont > 1) {
        echo 'Error 4101 YA SE AGREGO EL EJERCICIO';

    } else {

        header('Location:  ../view/administrador/controladorVadmin.php?success=success&seccionAd=addRutina');
        exit();

    }
} else {
    header('../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=addRutina');
    exit();
}

