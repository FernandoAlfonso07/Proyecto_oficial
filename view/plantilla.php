<?php
include_once("nombreSeccionH.php");
include_once("../model/usuario.php");
include_once("../model/gym_membership.php");
!isset($_SESSION) ? session_start() : null;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo nombrar(0, $seccion); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="./img/logosinfondo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/estilos_ENCABEZADO_plantilla.css">
    <link rel="stylesheet" href="css/errors/errorValidations.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="grid">
        <header>
            <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark">
                <div class="container">
                    <a class="navbar-brand" href="controlador.php?seccion=seccion1">
                        <img src="img/LOGO.png" alt="logo" width="55px">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ms-auto">

                            <li class="nav-item">
                                <a class="nav-link disabled nombre_admin" href="#" tabindex="-1"
                                    aria-disabled="true">¡Hola!
                                    Bienvenido de nuevo - <b>
                                        <?php
                                        echo usuarios::getInformacion(1, $_SESSION['id']);
                                        ?>
                                    </b></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle separado" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-user icono_usuario"></i> Mi perfil
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item enlace_secundario"
                                            href="controlador.php?seccion=MiPerfil">Información</a>
                                    </li>
                                    <li><a class="dropdown-item enlace_secundario"
                                            href="../controller/logout.php?type=user">
                                            <button class="btn btn-outline-danger boton_cerrar"><i
                                                    class="fa-solid fa-arrow-right-from-bracket icono_usuario"></i>Cerrar
                                                sesión</button>
                                        </a></li>
                                </ul>
                            </li>
                            <!--
                        <a class="nav-link separado" href="#"><i class="fa-solid fa-question icono_usuario"></i>
                            Ayuda</a>

                        <a class="nav-link separado" href="#"><i class="fa-solid fa-exclamation icono_usuario"></i>
                            Reportar problemas</a>
                        -->
                            <?php

                            $count_membership = Gym_membership::showInfor("count", $_SESSION['id'], 0);
                            $_SESSION['id_myGym'] = Gym_membership::showInfor("showDetaild", $_SESSION['id'], 6);

                            if ($count_membership > 0) {
                                ?> <a class="nav-link separado" href="controlador.php?seccion=myGym"><i
                                        class="fa-solid fa-building-wheat ms-3"></i>
                                    Mi Gimnasio</a> <?php
                            } else {
                                null;
                            }
                            ?>

                            <a class="nav-link separado" href="controlador.php?seccion=showGyms"><i
                                    class="fa-regular fa-eye icono_usuario"></i>
                                Ver Gimnasios</a>
                            </a>
                            <a class="nav-link text-center separado " href="controlador.php?seccion=misCalendarios"> <i
                                    class="fa-solid fa-calendar-days icono_usuario"></i>Mis calendarios</a>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>



        <?php
        include($seccion . ".php");
        ?>



        <footer class="footer">
            <div class="container">
                <p>&copy; 2024 WorldFit. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L41ZSW1R62"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-L41ZSW1R62');
    </script>

    <script src="js/event.js"></script>
    <script src="js/validateData.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php unset($_SESSION['intento']) ?>
</body>

</html>