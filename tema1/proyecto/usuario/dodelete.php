<?php

require '../classes/autoload.php';

use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;

$database = new Database();
$manager = new ManageUsuario($database);

$id = Reader::read('id');
$ids = Reader::readArray('ids');
if ($id !== null) {
    if (!is_numeric($id) || $id <= 0) {
        header('Location: index.php');
        exit();
    }
    $resultado = $manager->remove($id);
}else {
    foreach($ids as $id) {
        $resultado += $manager->remove($id);
    }
}

$database->close();

$url = 'index.php?op=deleteusuario&resultado=' . $resultado;
header('Location: ' . $url);
exit();
