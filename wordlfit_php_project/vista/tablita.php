<?PHP
include ("../model/mostrarUsuarios.php");

?>
<link rel="stylesheet" href="css/tablita.css">


<div class="container">

<h1>Total de usuario: <?php echo MostrarUsuarios::getUsuarios(1) ?> </h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Usuario</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Genero</th>
                <th scope="col">Fecha de ingreso</th>
            </tr>
        </thead>
        <tbody>
            <?php echo MostrarUsuarios::getUsuarios(0) ?>
        </tbody>
    </table>
</div>