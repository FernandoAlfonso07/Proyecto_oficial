<?php


include_once ('../model/administrador.php');



$nameCategory = $_GET['nameCategory'];

$cont = Administrador::createCategory($nameCategory);

if ($cont > 1) {
    echo 'Error 4101 YA SE AGREGO EL EJERCICIO';

} else {

    header('Location:  ../view/administrador/controladorVadmin.php?seccionAd=addRutina');
    exit();

}