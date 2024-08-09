<?php
include_once ("../model/validate.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

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

$validate = validate::UserExists($email, 1);
$id = validate::UserExists($email, 2);
if ($validate < 1) {
    header('location: ../view/password/change_password.php?error=notmatches');
    exit();
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
    $mail->Subject = "Solicitud Cambio de Contraseña";
    $mail->Body = $mail->Body = "<a href='http://localhost/wordlfit_php_project/view/password/change_password.php?usuiden=" . $id . "&step=2'>Cambio de contraseña aqui</a>";
    // $mail->AltBody = 'Texto alternativo para clientes que no soportan HTML';

    $mail->send();
    header("location: ../view/inicioSesion.php?alert=viewemail");
    exit(); // Asegura que el script se detenga aquí después de redirigir
} catch (Exception $e) {
    echo "Error al enviar el correo: " . $mail->ErrorInfo;
}