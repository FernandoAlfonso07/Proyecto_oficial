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
$inputs = ['nombre', 'apellido', 'telefono', 'correo', 'personaleRecord', 'peso', 'altura'];

// Verifica que todos los campos en el arreglo no estén vacíos
if (validate::validateNotEmptyInputs($inputs)) {

    // Sanitiza las entradas del formulario
    $nombres = validate::sanitize($_POST['nombre']);
    $apellidos = validate::sanitize($_POST['apellido']);
    $telefono = validate::sanitize($_POST['telefono']);
    $correo = validate::sanitize($_POST['correo']);
    $pr = validate::sanitize($_POST['personaleRecord']);
    $pesoActual = validate::sanitize($_POST['peso']);
    $altura = validate::sanitize($_POST['altura']);
    $sex = isset($_POST['sex']) ? validate::sanitize($_POST['sex']) : null;

    // Verifica si se ha subido una nueva imagen
    if (!empty($_FILES['imagenPerfil']['name'])) {
        $ruta_imagen = validate::media('imagenPerfil', '../view/controlador.php?error=incorrectFormat&seccion=updateDatas', '../view/user img/');
    } else {
        // Si no se ha subido una nueva imagen, usa la imagen actual del perfil
        $ruta_imagen = usuarios::getPerfil(9, $_SESSION['id']) ?: '../view/user img/default_img.PNG';
    }

    // Convierte las variables a tipo float


    // Validación de entradas: todas deben ser números flotantes positivos
    if (
        !filter_var($pr, FILTER_VALIDATE_FLOAT) || $pr <= 0 ||
        !filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || $pesoActual <= 0 ||
        !filter_var($altura, FILTER_VALIDATE_FLOAT) || $altura <= 0
    ) {
        header('Location: ../view/controlador.php?error=notNumber&seccion=updateDatas');
        exit();
    }

    // Validación del teléfono: debe ser un número entero positivo
    if (!filter_var($telefono, FILTER_VALIDATE_INT) || $telefono <= 0) {
        header('Location: ../view/controlador.php?error=invalidPhone&seccion=updateDatas');
        exit();
    }


    // Actualiza los datos del usuario en la base de datos
    $respuesta = usuarios::actualizarDatos($_SESSION['id'], $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $sex, $ruta_imagen);

    // Redirige según el resultado de la actualización
    if ($respuesta > 1) {
        header('Location: ../view/controlador.php?seccion=MiPerfil');
        exit();

    } else {
        header('Location: ../view/controlador.php?success=exito&seccion=MiPerfil');
        exit();
    }

} else {

    // Si alguno de los campos está vacío, redirige con un error
    header('Location: ../view/controlador.php?error=emptyFields&seccion=updateDatas');
    exit();
}