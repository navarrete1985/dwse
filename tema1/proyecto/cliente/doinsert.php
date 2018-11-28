<?php

require '../classes/autoload.php';

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Mail;

$database = new Database();
$manager = new ManageUsuario($database);

$usuario = Reader::readObject('izv\data\Usuario');
$clave2 = Reader::read('clave2');
if ($usuario->getClave !== $clave2) {
    header('Location: index.php');
    exit();
}
$activo = Reader::read('activo');
if(isset($activo)) {
    $usuario->setActivo(1);
}

$resultado = $manager->add($usuario);
$database->close();

$url = 'index.php?op=insertusuario&resultado=' .$resultado;
header('Location: ' . $url);
exit();
