<?php
!isset($_SESSION) ? session_start() : null;
include_once ("../model/validate.php");
include_once ("../model/usuario.php");
include_once ("../functions/messages.php");
include_once ("../model/gyms.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

$id_user = isset($_GET['usu']) ? $_GET['usu'] : null;
$email = isset($_GET['usu']) ? usuarios::getPerfil(2, $id_user) : null;
$nameGym = isset($_GET['usu']) ? Gyms::getInfoThisGym(0, $_SESSION['thisGym'], 'call') : null;

if (isset($_GET['usu']) && ($email === null || $nameGym === null)) {
    echo "Error: No se pudo obtener el correo electrónico o el nombre del gimnasio.";
    exit();
}

if (!isset($_GET['usu'])) {
    $array = ['email'];

    if (!validate::validateNotEmptyInputs($array)) {
        header('location: ../view/password/change_password.php?error=emptyFild');
        exit();
    }

    $email = isset($_POST['email']) ? validate::sanitize($_POST['email']) : null;

    if ($email == null) {
        header('location: ../view/password/change_password.php?error=error');
        exit();
    }

    $validate = validate::UserExists(1, $email, null, 0);
    $id = validate::UserExists(1, $email, null, 1);
    if ($validate < 1) {
        header('location: ../view/password/change_password.php?error=notmatches');
        exit();
    }
}

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.mailersend.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'MS_Fl1Fni@trial-pr9084zxemjlw63d.mlsender.net';
    $mail->Password = 'ktUM3Dtb0B86LHtl';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinatarios
    $mail->setFrom('MS_Fl1Fni@trial-pr9084zxemjlw63d.mlsender.net', 'WorldFit');
    $mail->addAddress($email);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = isset($_GET['usu']) ? "Inscripcion De Gimnasio" : "Solicitud Cambio de Contraseña";
    $mail->Body = isset($_GET['usu']) ? "Se ha activado tu membresia para el gimnasio $nameGym" : "<a href='http://localhost/wordlfit_php_project/view/password/change_password.php?usuiden=" . $id . "&step=2'>Cambio de contraseña aqui</a>";
    // $mail->AltBody = 'Texto alternativo para clientes que no soportan HTML';

    $mail->send();
    unset($_SESSION['thisGym']);
    if (isset($_GET['usu'])) {
        header("location: ../view/controlador.php?alert=viewemail&seccion=seccion1");
    } else {
        header("location: ../view/inicioSesion.php?alert=viewemail");
    }
    exit(); // Asegura que el script se detenga aquí después de redirigir
} catch (Exception $e) {
    echo "Error al enviar el correo: " . $mail->ErrorInfo;
}