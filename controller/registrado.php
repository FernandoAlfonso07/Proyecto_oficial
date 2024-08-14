<?php
include_once('../model/usuario.php');
include_once('../model/validate.php'); // Se incluye la clase que permite sanitizar

session_start();


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

    foreach ($inputs as $field) {
        ${$field} = isset($_POST[$field]) ? validate::sanitize($_POST[$field]) : null;
    }

    $password = strlen($password);

    if ($password < 8) {
        header("Location: ../view/seccion-registro.php?error=invalidPassword");
        exit();
    }

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Validación del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../view/seccion-registro.php?error=invalidEmail');
        exit();
    }

    // Validación del teléfono: debe ser un entero positivo
    if (!filter_var($telefono, FILTER_VALIDATE_INT) || $telefono <= 0) {
        header('Location: ../view/seccion-registro.php?error=invalidPhone');
        exit();
    }

    // Validación del peso actual: debe ser un número flotante positivo
    if (!filter_var($pesoA, FILTER_VALIDATE_FLOAT) || $pesoA <= 0) {
        header('Location: ../view/seccion-registro.php?error=notNumberP');
        exit();
    }

    // Validación de la altura: debe ser un número flotante positivo
    if (!filter_var($alturaA, FILTER_VALIDATE_FLOAT) || $alturaA <= 0) {
        header('Location: ../view/seccion-registro.php?error=notNumberA');
        exit();
    }

    $countUsersExist = validate::validateCountsDatas($correo, "count user exist");
    if ($countUsersExist >= 1) {
        header('location: ../view/seccion-registro.php?error=userExist');
        exit();
    }

    $resultado = usuarios::registrar($nombres, $apellidos, $telefono, $correo, $passwordHashed, $pesoA, $alturaA, $genero);

    if ($resultado > 1) {
        header('location: ../view/seccion-registro.php');
        exit();
    } else {

        $id_usuario = usuarios::buscarId($correo, $passwordHashed);

        if ($id_usuario) {
            $_SESSION['id'] = $id_usuario;
            echo "Se registro correctamente";
           
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
    exit();
}
