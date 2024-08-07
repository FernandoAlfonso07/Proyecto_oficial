<?php
// Incluye los archivos necesarios para usar las clases 'usuario' y 'validate'
include_once ("../model/usuario.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

// Inicia la sesión si no ha sido iniciada previamente
if (!isset($_SESSION))
    session_start();

// Verifica si el usuario ha iniciado sesión, de lo contrario redirige a la página de inicio de sesión
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("location: ../view/inicioSesion.php");
}

// Define un arreglo con los nombres de los campos que se van a validar
$inputs = isset($_GET['typeData']) ?
    ['nombre', 'apellido', 'telefono', 'correo', 'sex', 'peso', 'altura', 'role'] :
    ['nombre', 'apellido', 'telefono', 'correo', 'sex', 'peso', 'altura'];

// Verifica que todos los campos en el arreglo no estén vacíos
if (validate::validateNotEmptyInputs($inputs)) {

    // Sanitiza las entradas del formulario
    $nombres = validate::sanitize($_POST['nombre']);
    $apellidos = validate::sanitize($_POST['apellido']);
    $telefono = validate::sanitize($_POST['telefono']);
    $correo = validate::sanitize($_POST['correo']);
    $pr = isset($_POST['personaleRecord']) ? validate::sanitize($_POST['personaleRecord']) : 0;
    $pesoActual = validate::sanitize($_POST['peso']);
    $altura = validate::sanitize($_POST['altura']);
    $sex = isset($_POST['sex']) ? validate::sanitize($_POST['sex']) : null;
    $rol = isset($_POST['role']) ? validate::sanitize($_POS['role']) : null;

    // Imagen de perfil
    $currentImagePath = usuarios::getPerfil(9, $_SESSION['id']);
    $defaultImagePath = '../view/user img/default_img.PNG';

    // Verifica si se ha subido una nueva imagen
    if (!empty($_FILES['imagenPerfil']['name'])) {
        $ruta_imagen = isset($_GET['typeData']) ?
            validate::media('imagenPerfil', '../view/administrador/controladorVadmin.php?error=incorrectFormat&seccionAd=updateDatas', '../view/user img/') :
            validate::media('imagenPerfil', '../view/controlador.php?error=incorrectFormat&seccion=updateDatas', '../view/user img/');

        if ($currentImagePath && $currentImagePath !== $defaultImagePath) {
            unlink($currentImagePath);
        }
    } else {
        $ruta_imagen = $currentImagePath;
    }
    // Validación de entradas: todas deben ser números flotantes positivos
    if (!isset($_GET['typeData'])) {
        if (
            !filter_var($pr, FILTER_VALIDATE_FLOAT) || $pr <= 0 ||
            !filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || $pesoActual <= 0 ||
            !filter_var($altura, FILTER_VALIDATE_FLOAT) || $altura <= 0
        ) {
            header('Location: ../view/controlador.php?error=notNumber&seccion=updateDatas');
            exit(); // Detiene la ejecución después de redirigir
        }
    } else {
        if (
            !filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || $pesoActual <= 0 ||
            !filter_var($altura, FILTER_VALIDATE_FLOAT) || $altura <= 0
        ) {
            header('Location: ../view/administrador/controladorVadmin.php?error=notNumber&seccionAd=updateDatas');
            exit(); // Detiene la ejecución después de redirigir
        }
    }

    // Validación del teléfono: debe ser un número entero positivo
    if (!filter_var($telefono, FILTER_VALIDATE_INT) || $telefono <= 0) {

        if (!isset($_GET['typeData'])) {
            header('Location: ../view/controlador.php?error=invalidPhone&seccion=updateDatas');

        } else {
            header('Location: ../view/administrador/controladorVadmin.php?error=invalidPhone&seccionAd=updateDatas');
        }
        exit(); // Detiene la ejecución después de redirigir
    }


    // Actualiza los datos del usuario en la base de datos
    $respuesta = !isset($_GET['typeDdata']) ? usuarios::actualizarDatos($_SESSION['id'], $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $sex, $ruta_imagen) :
        usuarios::actualizarDatos($_SESSION['id'], $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $sex, $ruta_imagen, $rol);

    // Redirige según el resultado de la actualización
    if ($respuesta > 1) {
        header('Location: ../view/controlador.php?seccion=MiPerfil');
        exit();

    } else {
        header('Location: ' . (isset($_GET['typeData']) ?
            '../view/administrador/controladorVadmin.php?success=exito&seccionAd=MiPerfil' :
            '../view/controlador.php?success=exito&seccion=MiPerfil'));
    }

} else {

    // Si alguno de los campos está vacío, redirige con un error
    header('Location: ' . (isset($_GET['typeData']) ?
        '../view/administrador/controladorVadmin.php?error=emptyFields&seccion=updateDatas' :
        '../view/controlador.php?error=emptyFields&seccion=updateDatas'));

    exit(); // Detiene la ejecución después de redirigir

}