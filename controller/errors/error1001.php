<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['intento']) && $_SESSION['intento'] > 5) {
    session_destroy();
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../../view/img/logosinfondo.png">
    <link rel="stylesheet" href="../../view/css/errors/attemptsError.css">
    <title>Demasiados Intentos</title>
</head>

<body>

    <main>
        <section>
            <div class="error-container d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <h1 class="error-code">Error 1001</h1>
                    <p class="error-message">Demasiados intentos</p>
                    <button class="btn-retry" onclick="location.href='../../view/inicioSesion.php'">Reintentar</button>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>