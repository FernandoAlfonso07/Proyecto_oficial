<?php
// Incluye el archivo administrador.php que contiene la clase Administrador y sus métodos.
include_once ('../model/administrador.php');

// Incluye el archivo validate.php que contiene la clase Validate para validar y sanitizar los datos.
include_once ('../model/validate.php');

// Se define un array con los nombres de los campos que deben ser validados.
$input = ['nameCategory'];

// Verifica si los campos en el array $input no están vacíos utilizando el método validateNotEmptyInputs de la clase Validate.
if (validate::validateNotEmptyInputs($input)) {

    // Sanitiza el valor del campo 'nameCategory' utilizando el método sanitize de la clase Validate.
    $nameCategory = validate::sanitize($_POST['nameCategory']);

    // Comprueba si se ha pasado el parámetro 'newCategory' en la URL y lo almacena en $typeNewCategory.
    if (isset($_GET['newCategory'])) {
        $typeNewCategory = isset($_GET['newCategory']) ? $_GET['newCategory'] : null;

        // Si el valor de 'newCategory' es "gym", define las variables de la tabla a la que se hará referencia y las rutas de redirección.
        if ($typeNewCategory == "gym") {
            $nameTable = "gym";
            // Redirige a la sección de agregar gimnasio si se crea una nueva categoría de gimnasio
            $redirectTo = "../view/administrador/controladorVadmin.php?seccionAd=addGym";
            $redirectToError = "../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=addGym";

            // Si el valor de 'newCategory' es "routine", define las variables de la tabla a la que se hará referencia y las rutas de redirección.
        } elseif ($typeNewCategory == "routine") {
            $nameTable = "routine";
            // Redirige a la sección de agregar rutina si se crea una nueva categoría de rutina
            $redirectTo = "../view/administrador/controladorVadmin.php?success=success&seccionAd=addRutina";
            $redirectToError = "../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=addRutina";
        } elseif ($typeNewCategory == "method") {
            $nameTable = "method";
            // Redirige a la sección de agregar rutina si se crea una nueva categoría de rutina
            $redirectTo = "../view/administrador/controladorVadmin.php?success=success&seccionAd=addGym";
            $redirectToError = "../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=addGym";
        }

        // Llama al método createCategory de la clase Administrador para crear una nueva categoría en la tabla especificada.
        $response = Administrador::createCategory($nameCategory, $nameTable);

        // Si el método createCategory devuelve un valor mayor que 1, muestra un mensaje de error.
        if ($response > 1) {
            echo 'Error 4101 YA SE AGREGO EL EJERCICIO';

        } else {
            // Si la creación de la categoría es exitosa, redirige a la URL especificada en $redirectTo.
            header('Location: ' . $redirectTo . '');
            exit();

        }
    } else {
        // Si la validación de los campos falla, redirige a la URL especificada en $redirectToError.
        header('Location: ' . $redirectToError . '');
        exit();
    }
}
