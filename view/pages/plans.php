<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Worldfit | Ofertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../img/logosinfondo.png">

    <link rel="stylesheet" href="../css/styles_plans.css">
</head>

<body>
    <div class="container text-center my-5">
        <h1 class="mb-4">Planes de Promoción</h1>
        <p class="text-muted">Elige el plan que mejor se adapte a tus necesidades</p>
        <div class="plans-container">
            <div class="row">
                <!-- Plan para Usuarios -->
                <div class="col-md-6">
                    <div class="plan user-plan">
                        <h2>Plan para Usuarios <i class="fa-solid fa-user"></i></h2>
                        <p class="price">$20,000</p>
                        <ul>
                            <li>
                                <div class="service">Asesoramiento de rutinas</div>
                            </li>
                            <li>
                                <div class="service">Creación de calendarios ilimitados</div>
                            </li>
                            <li>
                                <div class="service">Inscripcion a Gimnasios</div>
                            </li>
                        </ul>
                        <a href="formulerPlan.php?plan=1" class="btn-select">Elegir Plan</a>
                    </div>
                </div>
                <!-- Plan para Gerentes de Gimnasio -->
                <div class="col-md-6">
                    <div class="plan gym-manager-plan">
                        <h2>Plan para Gerentes de Gimnasio <i class="fa-solid fa-building-user"></i></h2>
                        <p class="price">$30,000</p>
                        <ul>
                            <li>
                                <div class="service">Publicación de todos los datos del gimnasio detallada</div>
                            </li>
                            <li>
                                <div class="service">Acceso a que los usuarios se inscriban en su gimnasio</div>
                            </li>
                        </ul>
                        <a href="formulerPlan.php?plan=2" class="btn-select">Elegir Plan</a>
                    </div>
                </div>
            </div>


        </div>

        <a href="<?php echo isset($_SESSION['id']) ? "../controlador.php?seccion=seccion1" : "../inicio-principal.php"; ?>"
            class="my-5">
            <button class="btn btn-secondary">
                Volver
            </button>
        </a>
    </div>
</body>
<script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>