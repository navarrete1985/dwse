<?php

use izv\app\App;
use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;

$sesion = new Session(App::SESSION_NAME);
if(!$sesion->isLogged()) {
    header('Location: ..');
    exit();
}

require '../classes/autoload.php';

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
    $db->getConnection()->beginTransaction();
    $error = false;
    foreach($ids as $id) {
        $resultadoParcial = $manager->remove($id);
        if($resultadoParcial === 0) {
            $error = true;
        } else {
            $resultado += $resultadoParcial;
        }
    }
    if($error) {
        $db->getConnection()->rollback();
    } else {
        $db->getConnection()->commit();
    }
}
$db->close();
$url = Util::url() . 'index.php?op=deleteproducto&resultado=' . $resultado;
header('Location: ' . $url);