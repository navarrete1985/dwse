<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;
use izv\app\App;

require '../classes/autoload.php';

$session = new Session(App::SESSION_NAME);
$user = $session->getLogin();

if ($user->getAdministrador() != 1) {
    header('Location: ../index.php');
    exit();
}

$db = new Database();
$manager = new ManageUsuario($db);

$id = Reader::read('id');
$ids = Reader::readArray('ids');
$resultado = 0;
if($id !== null) {
    if(!is_numeric($id) ||  $id <= 0) {
        header('Location: ../index.php');
        exit();
    }
    $resultado = $manager->remove($id);
} else {
    foreach($ids as $id) {
        $resultado += $manager->remove($id);
    }
}
$db->close();
$url = Util::url() . '../index.php?op=delete&resultado=' . $resultado;
header('Location: ' . $url);