<?php
echo $seccion_admin . '<br>';
include ("nombreSeccionH.php");
echo $seccion_admin;


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo nombrar(1, null, $seccion_admin); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="./IMG_index/logosinfondo.png">
    <link rel="stylesheet" href="css/estilos-plantillaAdmin.css">
</head>

<body>

    <header>
        <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="controlador.php?seccion=seccion1">
                    <img src="IMG_index/LOGO.png" alt="logo" width="55px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav nav justify-content-center">

                        <li class="nav-item">
                            <a class="nav-link disabled nombre_admin" href="#" tabindex="-1" aria-disabled="true">¡Hola!
                                - User, estas en la seccion de administrador</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle enlace_principal" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user icono"></i> Mi perfil
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item enlace_secundario" href="#"><i
                                            class="fa-solid fa-cube icono"></i> Información</a></li>
                                <li><a class="dropdown-item enlace_secundario" href="#"><i
                                            class="fa-solid fa-gear icono"></i>Editar</a></li>
                                <li><a class="dropdown-item enlace_secundario" href="#">
                                        <button class="btn btn-outline-danger boton_cerrar"><i
                                                class="fa-solid fa-arrow-right-from-bracket icono"></i>Cerrar
                                            sesión</button>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle enlace_principal" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Ejercicios <i class="fa-solid fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item enlace_secundario"
                                        href="controladorVadmin.php?seccionAd=seccionAd2"><i
                                            class="fa-solid fa-eye icono"></i> Ver Ejercicios</a></li>
                                <li><a class="dropdown-item enlace_secundario" href="#"><i
                                            class="fa-regular fa-pen-to-square icono"></i> Agregar ejercicio</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle enlace_principal" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Rutinas <i class="fa-solid fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item enlace_secundario" href="#"><i
                                            class="fa-solid fa-eye icono"></i> Ver Rutinas</a></li>
                                <li><a class="dropdown-item enlace_secundario" href="#"><i
                                            class="fa-regular fa-pen-to-square icono"></i> Agregar Rutinas</a></li>

                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle enlace_principal" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Gimnasios <i class="fa-solid fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item enlace_secundario" href="#"><i
                                            class="fa-solid fa-eye icono"></i> Ver Gimnasios</a></li>
                                <li><a class="dropdown-item enlace_secundario" href="#"><i
                                            class="fa-regular fa-pen-to-square icono"></i> Agregar Gimnasios</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <div class="cuerpo">
        <?php

        include ($seccion_admin . ".php");

        ?>
    </div>



    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>