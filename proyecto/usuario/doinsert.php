<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;
use izv\app\App;
use izv\tools\Mail;

require '../classes/autoload.php';

$session = new Session(App::SESSION_NAME);
$user = $session->getLogin();
$usuario = Reader::readObject('izv\data\Usuario');

if ($user === null || $user->getAdministrador() != 1) {
    $usuario->setAdministrador(0);
    $usuario->setActivo(0);
}

$db = new Database();
$manager = new ManageUsuario($db);


if($usuario->getAlias() === '') {
    $usuario->setAlias(null);
}

$usuario->setClave(Util::encriptar($usuario->getClave()));
$resultado = $manager->add($usuario);

if($resultado > 0 && $usuario->getActivo() != 1) {
    $usuario->setId($resultado);
    $r2 = Mail::sendActivation($usuario);
}

$db->close();
$url = '../index.php?op=insert&resultado=' . $resultado . '&r2=' . $r2;
header('Location: ' . $url);
