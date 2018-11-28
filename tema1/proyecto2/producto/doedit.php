<?php

use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Reader;
use izv\tools\Util;
use izv\app\App;
use izv\tools\Session;

require '../classes/autoload.php';

$session = new Session();
if (!$session->isLogged()) {
    header('Location: ..');
    exit();
}

$db = new Database();
$manager = new ManageProducto($db);
$producto = Reader::readObject('izv\data\Producto');
$resultado = $manager->edit($producto);
$db->close();
$url = Util::url() . 'index.php?op=editproducto&resultado=' . $resultado;
header('Location: ' . $url);