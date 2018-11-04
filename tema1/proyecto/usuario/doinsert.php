<?php

require '../classes/autoload.php';

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;

$database = new Database();
$manager = new ManageUsuario($database);

$usuario = Reader::readObject('izv\data\Usuario');
$activo = Reader::read('activo');
if(isset($activo)) {
    $usuario->setActivo(1);
}

$resultado = $manager->add($usuario);
$database->close();

$url = 'index.php?op=insertusuario&resultado=' .$resultado;
header('Location: ' . $url);
exit();
