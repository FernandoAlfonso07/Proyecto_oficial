<?php

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['intento'])) {
    $_SESSION['intento'] = 0;
} else {

    session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        Error 1001
    </h1>
    <p>
        DEMASIADOS INTENTOS
    </p>

    <a href="../../view/inicioSesion.php">Reintentar</a>
</body>

</html>