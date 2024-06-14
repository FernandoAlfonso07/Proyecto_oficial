<?php
include ("../model/datosPerfilUser.php");
?>

<link rel="stylesheet" href="css/estilosInformacionU.css">

<?php

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION["correo"])) {
    echo 'error';
} else {
    $_SESSION['correo'];
    $correoU = $_SESSION['correo'];
    echo DatosPerfilUser::getPerfil($correoU);

}


?>