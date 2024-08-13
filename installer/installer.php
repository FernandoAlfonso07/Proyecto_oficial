<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instalador de WorlFIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/css/styles Installer/installer.css">
    <link rel="icon" href="../view/img/logosinfondo.png">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center text-primary">INSTALADOR DE LA BASE DE DATOS</h1>
        <form action="installing.php" method="post">
            <div class="row g-3 mt-4">

                <div class="col-md-3 form-floating">
                    <input type="text" class="form-control" name="hostBD" id="floatingHost" value="127.0.0.1"
                        placeholder="Host">
                    <label for="floatingHost">Host</label>
                </div>
                <div class="col-md-3 form-floating">
                    <input type="text" class="form-control" name="nameBD" id="floatingDBName" value="worldfitsbd"
                        placeholder="Nombre de la base de datos">
                    <label for="floatingDBName">Nombre de la base de datos</label>
                </div>
                <div class="col-md-3 form-floating">
                    <input type="text" class="form-control" name="userBD" id="floatingUser" value="root"
                        placeholder="Usuario">
                    <label for="floatingUser">Usuario</label>
                </div>
                <div class="col-md-3 form-floating">
                    <input type="password" class="form-control" name="passwordBD" id="floatingPassword" value=""
                        placeholder="Contraseña">
                    <label for="floatingPassword">Contraseña</label>
                </div>

            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Instalar</button>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</body>

</html>