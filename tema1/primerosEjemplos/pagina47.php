<?php

require '../../classes/vendor/autoload.php';

use \Firebase\JWT\JWT;

$login = 'pepe@pepe.es';

$clave = 'pepe';

$authorization = 'Basic ' . base64_encode($login . ':' . $clave);

echo $authorization . '<br>';

$partes = explode(' ', $authorization);

if(count($partes) === 2) {
    $tipo = $partes[0];
    $valor = $partes[1];

    $original = base64_decode($valor);

    echo $tipo . '<br>';
    echo $original . '<br>';
    
    $pos = strpos($original, ':');
    if($pos > 0) {
        $user = substr($original, 0, $pos);
        $password = substr($original, $pos + 1);
        echo $user . '<br>';
        echo $password . '<br>';
        $claveJWT = 'secreta';
        $codificar = [
            'user' => $user,
            'lifetime' => time() + 3 //En caso de que el tiempo de vida sea menor al tiempo actual....tendríamos que refrescar el token
        ];
        sleep(4);
        $jwt = JWT::encode($codificar, $claveJWT);
        echo json_encode(['token' => $jwt]) . '<br>';
        $authorization = 'Bearer ' . $jwt . '<br>';
        echo $authorization . '<br>';
        try {
            $decodifica = JWT::decode($jwt, $claveJWT, array('HS256'));
            var_dump($decodifica);
            if($decodifica->lifetime > time()) {
                echo '<br>' . $decodifica->user . '<br>';
            }
        } catch (Exception $e) {
            echo 'fallo<br>';
        }
    }
}