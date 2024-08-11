<?php
include_once ('../model/usuario.php');
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../view/inicioSesion.php");

} else {
    if ($_SESSION['id'] == "") {
        header("location: ../view/inicioSesion.php");
    }
}
$inputs = ['nombres', 'apellidos', 'telefono', 'correo', 'password', 'pesoA', 'alturaA', 'genero'];

if (validate::validateNotEmptyInputs($inputs)) {

    // Obtener la dirección IP del usuario y el valor del captcha de la solicitud POST
    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6Lc_QR4qAAAAAIVH1FiRj7iUMcRbON3V901P2dby"; // Clave secreta de reCAPTCHA

    // Verificar el captcha con la API de Google reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remoteip=$ip");
    $atributos = json_decode($response, true);

    // Si la verificación del captcha falla, redirigir con un mensaje de error
    if (!$atributos['success']) {
        header('location: ../view/seccion-registro.php?error=notValidateCaptcha');
        exit();
    }

    $nombres = validate::sanitize($_POST['nombres']); // Sanitización de la contraseña;

    $apellidos = validate::sanitize($_POST['apellidos']); // Sanitización de la contraseña;

    $telefono = validate::sanitize($_POST['telefono']); // Sanitización de la contraseña;

    $correoElectronico = validate::sanitize($_POST['correo']); // Sanitización de la contraseña;

    $password = validate::sanitize($_POST['password']); // Sanitización de la contraseña;

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $pesoActual = validate::sanitize($_POST['pesoA']); // Sanitización de la contraseña;

    $altura = validate::sanitize($_POST['alturaA']); // Sanitización de la contraseña;

    $genero = validate::sanitize($_POST['genero']); // Sanitización de la contraseña;


    // Validación del correo electrónico
    if (!filter_var($correoElectronico, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../view/seccion-registro.php?error=invalidEmail');
        exit();
    }

    // Validación del teléfono: debe ser un entero positivo
    if (!filter_var($telefono, FILTER_VALIDATE_INT) || $telefono <= 0) {
        header('Location: ../view/seccion-registro.php?error=invalidPhone');
        exit();
    }

    // Validación del peso actual: debe ser un número flotante positivo
    if (!filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || $pesoActual <= 0) {
        header('Location: ../view/seccion-registro.php?error=notNumberP');
        exit();
    }

    // Validación de la altura: debe ser un número flotante positivo
    if (!filter_var($altura, FILTER_VALIDATE_FLOAT) || $altura <= 0) {
        header('Location: ../view/seccion-registro.php?error=notNumberA');
        exit();
    }


    $resultado = usuarios::registrar($nombres, $apellidos, $telefono, $correoElectronico, $passwordHashed, $pesoActual, $altura, $genero);

    if ($resultado > 1) {
        header('location: ../view/seccion-registro.php');

    } else {


        $id_usuario = usuarios::buscarId($correoElectronico, $passwordHashed);

        if ($id_usuario) {
            $_SESSION['id'] = $id_usuario;

            // Redirige al usuario a la sección principal
            header('location: ../view/controlador.php?seccion=seccion1');
            exit();

        } else {
            // Maneja el error si no se encuentra el ID del usuario
            header('location: errors/errorRegister.php');
            exit();

        }
    }
} else {
    header('location: ../view/seccion-registro.php?error=emptyFields');
}
