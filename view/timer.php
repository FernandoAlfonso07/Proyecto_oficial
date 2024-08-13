<?php

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id']) || $_SESSION['id'] == "") {
    header('location: inicioSesion.php');
}

$seconds = isset($_GET['calef']) ? intval($_GET['calef']) : 0;
$id = isset($_GET['calendar']) ? intval($_GET['calendar']) : 0;
$page = isset($_GET['pg']) ? intval($_GET['pg']) : 0;
$usu = isset($_GET['usu']) ? intval($_GET['usu']) : 0;

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>En rutina | Break Timer
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="img/logosinfondo.png">

    <link rel="stylesheet" href="css/timer/styles_timer.css">


</head>

<body>
    <section>
        <div class="content">
            <div class="message">- Descansa un rato 😪 -</div>
            <div id="timer" class="timer" data-seconds="<?php echo $seconds; ?>">
                <h1><?php echo $seconds; ?>s</h1>
            </div>
        </div>
    </section>
    <script>
        const calendarID = <?php echo json_encode($id); ?>;
        const page = <?php echo json_encode($page); ?>;
        const usu = <?php echo json_encode($usu); ?>;
    </script>

    <script src="js/breakTimer.js"></script>
    <script src="https://kit.fontawesome.com/296731592d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>