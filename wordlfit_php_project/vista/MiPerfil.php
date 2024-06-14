<?php
include ("../model/datosPerfilUser.php");
?>

<link rel="stylesheet" href="css/estilosInformacionU.css">

<?php

$idPerfil = $_GET['idU'];

echo 'variable de ID:' . $idPerfil . '<br>';

echo DatosPerfilUser::getPerfil($idPerfil);

?>