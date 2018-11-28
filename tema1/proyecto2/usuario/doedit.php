<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\Manageusuario;
use izv\tools\Reader;
use izv\tools\Util;

require '../classes/autoload.php';

$db = new Database();
$manager = new ManageUsuario($db);
$usuario = Reader::readObject('izv\data\Usuario');

if($usuario->getClave()==='') {
    $resultado = $manager->edit($usuario);
} else {
    $resultado = $manager->editWithPassword($usuario);
}
$db->close();
$url = Util::url() . 'index.php?op=edit&resultado=' . $resultado;
header('Location: ' . $url);