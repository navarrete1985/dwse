<?php

namespace izv\tools;

use izv\data\Usuario;
use izv\app\Util;
use izv\app\App;

class Mail {

    static function sendActivation(Usuario $usuario) {
        $asunto = 'Correo de activación de la App: DWES IZV';
        $jwt = \Firebase\JWT\JWT::encode($usuario->getCorreo(), App::JWT_KEY);
        $enlace = Util::url() . 'doactivar.php?id='. $usuario->getId() .'&code=' . $jwt;
        $mensaje = "Correo de activación para:  ". $usuario->getNombre();
        $mensaje .= '<br><a href="' . $enlace . '">activar cuenta</a>';
        return self::sendMail($usuario->getCorreo(), $asunto, $mensaje);
    }
    
    static function sendMail($destino, $asunto, $mensaje) {
        
        $cliente = new \Google_Client();
        
        $cliente->setApplicationName(App::APPLICATION_NAME);
        $cliente->setClientId(App::CLIENT_ID);
        $cliente->setClientSecret(App::CLIENT_SECRET);
        
        $cliente->setAccessToken(file_get_contents(App::EMAIL_TOKEN_FILE));
        if ($cliente->getAccessToken()) {
            $service = new \Google_Service_Gmail($cliente);
            try {
                $mail = new \PHPMailer\PHPMailer\PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->From = App::EMAIL_ORIGIN;
                $mail->FromName = App::EMAIL_ALIAS;
                $mail->AddAddress($destino);
                $mail->AddReplyTo(App::EMAIL_ORIGIN, App::EMAIL_ALIAS);
                $mail->Subject = $asunto;
                $mail->IsHTML(true);
                $mail->Body = $mensaje;
                $mail->preSend();
                $mime = $mail->getSentMIMEMessage();
                $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
                $mensaje = new \Google_Service_Gmail_Message();
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