<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;

require '../classes/autoload.php';

$db = new Database();
$manager = new ManageUsuario($db);
$usuario = Reader::readObject('izv\data\Usuario');
if($usuario->getAlias() === '') {
    $usuario->setAlias(null);
}
$usuario->setClave(Util::encriptar($usuario->getClave()));
$resultado = $manager->add($usuario);
/*echo Util::varDump($db->getConnection()->errorInfo());
echo Util::varDump($db->getSentence()->errorInfo());*/
$db->close();
$url = Util::url() . 'index.php?op=insert&resultado=' . $resultado;
header('Location: ' . $url);