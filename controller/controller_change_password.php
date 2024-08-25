<?php
!isset($_SESSION) ? session_start() : null;
include_once("../model/validate.php");
include_once("../model/usuario.php");
include_once("../model/gyms.php");
include_once("../model/plans.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

// Obtener la ruta del directorio actual (controller)
$currentDir = __DIR__;

// Obtener la ruta del directorio principal (proyecto)
$rootDir = dirname($currentDir, 1);

// Obtener el nombre de la carpeta principal
$projectName = basename($rootDir);

echo $projectName;

$type = isset($_GET['type']) ? $_GET['type'] : null;

if ($type == null) {
    $array = ['email'];
    if (!validate::validateNotEmptyInputs($array)) {
        header('location: ../view/password/change_password.php?error=emptyFild');
        exit();
    }

    $email = isset($_POST['email']) ? validate::sanitize($_POST['email']) : null;

    $validate = validate::UserExists(1, $email, null, 0); // Validar existe usuario
    $id = validate::UserExists(1, $email, null, 1); // Mostrar id del usuario
    if ($validate < 1) {
        header('location: ../view/password/change_password.php?error=notmatches');
        exit();
    }

    $messageSubject = "Solicitud Cambio de Contraseña";
    $messageBody = "<a href='http://localhost/" . $projectName . "/view/password/change_password.php?usuiden=" . $id . "&step=2'>Cambio de contraseña aqui</a>";
    $redirect = "../view/inicioSesion.php?alert=viewemail";
} else {
    if ($type == "InscriptionGym") {

        $id_user = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $email = usuarios::getPerfil(2, $id_user);
        $nameGym = isset($_SESSION['id']) ? Gyms::getInfoThisGym(0, $_SESSION['thisGym'], 'call') : null;
        $mountGym = isset($_SESSION['id']) ? Gyms::getInfoThisGym(21, $_SESSION['thisGym'], 'detailedInfo') : null;
        $dateInscription = isset($_SESSION['id']) ? Gyms::getInfoThisGym(5, $_SESSION['thisGym'], 'datailedMore') : null;
        $messageSubject = "Registro de Gimnasio";
        $messageBody = "
        <div style='width: 100%; max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; font-family: Arial, sans-serif; color: #333;'>
        <div style='text-align: center; border-bottom: 2px solid #00A1FF; padding-bottom: 10px; margin-bottom: 20px;'>
            <h1 style='margin: 0; color: #00A1FF; font-size: 1.5rem;'>Activación de Membresía</h1>
        </div>
        <div style='font-size: 1rem; line-height: 1.6;'>
            <p>Se ha activado tu membresía para el gimnasio <b>$nameGym</b> por un valor de <b>$mountGym</b>, el día <b>$dateInscription</b>.</p>
        </div>
        <div style='text-align: center; margin-top: 30px; font-size: 0.9rem; color: #777;'>
            <p>Gracias por tu confianza. ¡Disfruta de tus entrenamientos!</p>
        </div>
        </div>";
        $redirect = "../view/controlador.php?seccion=seccion1";

        if (!$email || !$nameGym) {
            header('Location: ../view/error.php?error=invalidDataRegistrarGimnasio');
            exit();
        }

    } elseif ($type == "purchasedplan") {
        $id_user = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $email = usuarios::getPerfil(2, $id_user);
        $namePlan = isset($_SESSION['id']) ? Plans::showInfoPlan(1, $_SESSION['id_plan']) : null;
        $messageSubject = "Compra de Membresia de Worlfit";
        $messageBody = "Se ha activado tu membresia por la compra del $namePlan";
        $redirect = "../view/controlador.php?seccion=seccion1";

        if (!$email || !$namePlan) {
            header('Location: ../view/error.php?error=invalidDataComprarPlan');
            exit();
        }
    } elseif ($type == "registered") {
        $id_user = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $email = usuarios::getPerfil(2, $id_user);
        $nameUser = usuarios::getPerfil(0, $id_user);
        $messageSubject = "Cuenta Registrada En WorldFit";
        $messageBody = "
        <div style='max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif; text-align: center;'>
            <div style='font-size: 24px; color: #007BFF; margin-bottom: 10px;'>¡Hola $nameUser!</div>
            <div style='font-size: 16px; color: #333;'>
                Muchas gracias por ser parte de esa gran familia. Esperamos ayudarte en todas tus metas.
            </div>
            <div style='margin-top: 20px; font-size: 14px; color: #666;'>
                Atentamente,<br>
                El equipo de WorldFit
            </div>
        </div>";
        $redirect = "../view/controlador.php?seccion=seccion1";

        if (!$email) {
            header('Location: ../view/error.php?error=invalidDataComprarPlan');
            exit();
        }
    } else {
        header('Location: ../view/error.php?error=invalidTypeNinguna');
        exit();
    }
}

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'worldfitsite1@gmail.com';
    $mail->Password = 'mrjtgmqchtehusiw';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinatarios
    $mail->setFrom('worldfitsite1@gmail.com', 'WorldFit');
    $mail->addAddress($email);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = $messageSubject;
    $mail->Body = $messageBody;
    // $mail->AltBody = 'Texto alternativo para clientes que no soportan HTML';

    $mail->send();
    unset($_SESSION['thisGym']);
    unset($_SESSION['id_plan']);

    header("location: " . $redirect . "");
    exit(); // Asegura que el script se detenga aquí después de redirigir
} catch (Exception $e) {
    echo "Error al enviar el correo: " . $mail->ErrorInfo;
}