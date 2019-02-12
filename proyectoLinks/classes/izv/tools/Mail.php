<?php

namespace izv\tools;

use izv\data\Usuario;
use izv\tools\Util;
use izv\app\App;
use \Firebase\JWT\JWT;

require __DIR__ . '/../../../../classes/vendor/autoload.php';

class Mail {

    static function sendActivation(Usuario $usuario) {
        $asunto = 'Correo de activación de la App Links';
        $jwt = JWT::encode($usuario->getCorreo(), App::JWT_KEY);
        $mensaje = self::getEmailBody($usuario->getNombre(), $usuario->getId(), $jwt);
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
    
    private static function getEmailBody($userName, $userId, $userCode) {
        $imgPath = App::BASE . 'templates/img/';
        $link = App::BASE . 'login/activate?id='. $userId .'&code=' . $userCode;
        return '<body style="margin: 0; padding: 0;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">	
                		<tr>
                			<td style="padding: 10px 0 30px 0;">
                				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                					<tr>
                						<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                							<img src="'. $imgPath . 'imgMail.jpg" alt="Imagen Empresa" width="300" height="230" style="display: block;" />
                						</td>
                					</tr>
                					<tr>
                						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                							<table border="0" cellpadding="0" cellspacing="0" width="100%">
                								<tr>
                									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                										<b>Bienvenido a la App Links ' . $userName . '!</b>
                									</td>
                								</tr>
                								<tr>
                									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                										Guarda tus links de las páginas que más te gusten, y ten todo siempre organizado para que no te cueste encontrar lo que realmente estás buscando, con la facilidad de que al tratarse de un servicio en la nuve, te lo vas a poder llevar a donde quieras cuando quieras!
                									</td>
                								</tr>
                								<tr>
                									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                										Para Activar la cuenta sólamente tienes que hacer click en el siguiente enlace <a style="color:#70BBD9" href="' . $link . '">activa tu cuenta</a>
                									</td>
                								</tr>
                							</table>
                						</td>
                					</tr>
                					<tr>
                						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                							<table border="0" cellpadding="0" cellspacing="0" width="100%">
                								<tr>
                									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
                										&reg; Links App 2019<br/>
                										<a href="#" style="color: #ffffff;"><font color="#ffffff">Suscríbete</font></a> a nuestras newsletter
                									</td>
                									<td align="right" width="25%">
                										<table border="0" cellpadding="0" cellspacing="0">
                											<tr>
                												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                													<a href="http://www.twitter.com/" style="color: #ffffff;">
                														<img src="'. $imgPath . 'twitter.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                													</a>
                												</td>
                												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                													<a href="http://www.twitter.com/" style="color: #ffffff;">
                														<img src="'. $imgPath . 'facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                													</a>
                												</td>
                											</tr>
                										</table>
                									</td>
                								</tr>
                							</table>
                						</td>
                					</tr>
                				</table>
                			</td>
                		</tr>
                	</table>
        	    </body>';
    }
}