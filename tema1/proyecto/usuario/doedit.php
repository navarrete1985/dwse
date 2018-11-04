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
$activo = isset($activo) ? 1 : 0;
$usuario->setActivo($activo);

$resultado = $manager->edit($usuario);
$database->close();

$url = 'index.php?op=editusuario&resultado=' . $resultado;
header('Location: ' . $url);
exit();
