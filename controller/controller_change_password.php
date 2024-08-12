<?php
!isset($_SESSION) ? session_start() : null;
include_once ("../model/validate.php");
include_once ("../model/usuario.php");
include_once ("../model/gyms.php");
include_once ("../model/plans.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';


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
    $messageBody = "<a href='http://localhost/wordlfit_php_project/view/password/change_password.php?usuiden=" . $id . "&step=2'>Cambio de contraseña aqui</a>";
    $redirect = "../view/inicioSesion.php?alert=viewemail";
} else {
    if ($type == "InscriptionGym") {

        $id_user = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $email = usuarios::getPerfil(2, $id_user);
        $nameGym = isset($_SESSION['id']) ? Gyms::getInfoThisGym(0, $_SESSION['thisGym'], 'call') : null;
        $mountGym = isset($_SESSION['id']) ? Gyms::getInfoThisGym(21, $_SESSION['thisGym'], 'detailedInfo') : null;
        $dateInscription = isset($_SESSION['id']) ? Gyms::getInfoThisGym(5, $_SESSION['thisGym'], 'datailedMore') : null;
        $messageSubject = "Registro de Gimnasio";
        $messageBody = "Se ha activado tu membresia para el gimnasio $nameGym por un valor de <b>$mountGym</b>, el dia <b>$dateInscription</b>";
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
    } else {
        header('Location: ../view/error.php?error=invalidTypeNinguna');
        exit();
    }
}

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.mailersend.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'MS_MlgRgY@trial-pr9084zxemjlw63d.mlsender.net';
    $mail->Password = 'oiRIvrxeeuhSQypL';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinatarios
    $mail->setFrom('MS_MlgRgY@trial-pr9084zxemjlw63d.mlsender.net', 'WorldFit');
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