<?php

namespace izv\tools;

use izv\data\Usuario;
use izv\tools\Session;

require '../classes/vendor/autoload.php';

class Mail {
    
    static function sendActivation(Usuario $usuario) {
        
        
        $session = new Session();
        
        $destino = $usuario->getCorreo();
        $asunto = "Correo de activación";
        $mensaje = "Correo de activación de cuenta";
        
        return self::sendMail($destino, $asunto, $mensaje);
    }
    
    static function sendMail($destino, $asunto, $mensaje) {
        $cliente = new Google_Client();
        $cliente->setApplicationName(App::APPLICATION_NAME);
        $cliente->setClientId(App::CLIENT_ID);
        $cliente->setClientSecret(App::CLIENT_SECRET);
        
        $cliente->setAccessToken(file_get_contents(App::EMAIL_TOKEN_FILE));
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
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }
    
}