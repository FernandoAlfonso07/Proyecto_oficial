<?PHP
include ("../../model/administrador.php");

?>
<link rel="stylesheet" href="../../vista/css/ejerciciosMostrar.css">



<div class="container">
    <h1 class="conteo">
        Total de Usuarios: <?php echo Administrador::getUsuarios(1) ?>
    </h1>
    <br>
</div>

<div class="container tabla">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col text-center caracteristica 0">ID Usuario</th>
                <th scope="col text-center caracteristica 1">Nombres</th>
                <!-- <th scope="col text-center caracteristica 2">Instrucciones</th>        Para poner en mas detalles -->
                <!-- <th scope="col text-center caracteristica 3">Equipo necesario</th>     Para poner en mas detalles -->
                <th scope="col text-center caracteristica 2">Apellidos</th>
                <th scope="col text-center caracteristica 3">Correo</th>
                <th scope="col text-center caracteristica 4">Telefono</th>
                <th scope="col text-center caracteristica 5">Genero</th>
                <th scope="col text-center caracteristica 6">Fecha de ingreso</th>
                <!-- <th scope="col text-center caracteristica 9">Id Rutina</th>            Para poner en mas detalles -->
                <th scope="col text-center caracteristica 7">Rol</th>
                <th scope="col text-center caracteristica iconosss"> </th>
            </tr>
        </thead>
        <tbody>

            <?php echo Administrador::getUsuarios(0) ?>

        </tbody>
    </table>
</div>