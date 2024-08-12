<?php
!isset($_SESSION) ? session_start() : null;
include_once ("../../model/plans.php");

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("Location: ../inicioSesion.php");
    exit();
}

$_SESSION['id_plan'] = $_GET['plan'] ?? null;

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WorldFit | Comprar <?php echo isset($_GET['plan']) ? Plans::showInfoPlan(1, $_SESSION['id_plan']) : null; ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="./img/logosinfondo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/formulerPlans.css">
</head>

<body>

    <div class="container mt-2">
        <div class="text-center mb-4">
            <img src="../img/LOGO.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
            <h1 class="mt-3"> <?php echo isset($_GET['plan']) ? Plans::showInfoPlan(1, $_SESSION['id_plan']) : null; ?>
                - $
                <b>
                    <?php echo isset($_GET['plan']) ? Plans::showInfoPlan(2, $_SESSION['id_plan']) : null; ?>
                    Mensualmente
                </b>
            </h1>
        </div>

        <form action="../../controller/process_purchase.php" method="post">
            <div class="mb-3">
                <label for="fullName" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Apellidos Completos</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>

            <div class="mb-3">
                <label for="documentNumber" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" id="documentNumber" name="documentNumber" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Valor a Pagar</label>
                <input type="text" class="form-control" id="amount" name="amount"
                    value="<?php echo isset($_GET['plan']) ? Plans::showInfoPlan(2, $_SESSION['id_plan']) : '0'; ?>"
                    required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Comprar</button>
            </div>
        </form>
        <a href="../controlador.php?seccion=misCalendarios">
            <button class="btn btn-secondary">Volver</button>
        </a>
    </div>


    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>