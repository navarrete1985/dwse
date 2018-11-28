<?php

use izv\data\Producto;
use izv\app\App;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;

require '../classes/autoload.php';

$session = new Session();
if (!$session->isLogged()) {
    header('Location: ..');
    exit();
}

$db = new Database();
$manager = new ManageProducto($db);

$id = Reader::read('id');
$ids = Reader::readArray('ids');
$resultado = 0;
if($id !== null) {
    if(!is_numeric($id) ||  $id <= 0) {
        header('Location: index.php');
        exit();
    }
    $resultado = $manager->remove($id);
} else {
    $error = false;
    foreach($ids as $id) {
        $resultado += $manager->remove($id);
    }
}
$db->close();
$url = Util::url() . 'index.php?op=deleteproducto&resultado=' . $resultado;
header('Location: ' . $url);