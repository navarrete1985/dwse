<?php

require '../classes/autoload.php';
require '../classes/vendor/autoload.php';

use izv\tools\Session;

$session = new Session();

$origen = "nacho.pena1985@gmail.com";
$alias = "Curso desarrollo web entorno servidor IZV";
$destino = "nacho_pena@hotmail.com";
$asunto = "Flaman";
$mensaje = "Holiii hippie....esto está to flamah eh?";
$cliente = new Google_Client();
$cliente->setApplicationName('CorreoWeb');
$cliente->setClientId('123796518941-ptgju1jq1a68ll00ek7harhmn8jps1ee.apps.googleusercontent.com');
$cliente->setClientSecret('eACBhPjTM7Vvjg_m3eXodfJO');

$cliente->setAccessToken(file_get_contents('token.conf'));
if ($cliente->getAccessToken()) {
    $service = new Google_Service_Gmail($cliente);
    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->From = $origen;
        $mail->FromName = $alias;
        $mail->AddAddress($destino);
        $mail->AddReplyTo($origen, $alias);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->preSend();
        $mime = $mail->getSentMIMEMessage();
        $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
        $mensaje = new Google_Service_Gmail_Message();
        $mensaje->setRaw($mime);
        $service->users_messages->send('me', $mensaje);
        echo "Correo enviado correctamente";
    } catch (Exception $e) {
        echo ("Error en el envío del correo: " . $e->getMessage());
    }
} else {
    echo "No conectado con gmail";
}