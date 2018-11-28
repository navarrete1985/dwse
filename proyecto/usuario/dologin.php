<?php

use izv\app\App;
use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

require '../classes/autoload.php';

$session = new Session(App::SESSION_NAME);

$correo = Reader::read('correo');
$clave = Reader::read('clave');

if (!isset($correo) || (!isset($clave))) {
    $session->logout();
    header('Location: ../index.php?op=logout&resultado=1');        
    exit();
}

$db = new Database();
$manager = new ManageUsuario($db);
$result = $manager->login($correo, $clave);
$resultado = 0;

if ($result) {
    $session->login($result);
    $resultado = 1;
} else {
    $session->logout();
}
$url = Util::url() . '../index.php?op=login&resultado=' . $resultado;
header('Location: ' . $url);