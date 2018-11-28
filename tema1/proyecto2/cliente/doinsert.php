<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Mail;
use izv\tools\Util;

require '../classes/autoload.php';
require '../classes/vendor/autoload.php';

$db = new Database();
$manager = new ManageUsuario($db);
$usuario = Reader::readObject('izv\data\Usuario');
$clave2 = Reader::read('clave2');
if($usuario->getClave() !== $clave2) {
    header('Location: index.php');
    exit();
}
if($usuario->getAlias() === '') {
    $usuario->setAlias(null);
}
$usuario->setActivo(0);
$usuario->setClave(Util::encriptar($usuario->getClave()));
$resultado = $manager->add($usuario);
if($resultado > 0) {
    $r2 = Mail::sendActivation($usuario);
}
/*echo Util::varDump($db->getConnection()->errorInfo());
echo Util::varDump($db->getSentence()->errorInfo());*/
$db->close();
$url = Util::url() . 'index.php?op=insert&resultado=' . $resultado . '&r2=' . $r2;
header('Location: ' . $url);