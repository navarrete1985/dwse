<?php

require '../classes/autoload.php';
require_once("../classes/vendor/autoload.php");

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Alert;
use izv\tools\Session;
use izv\app\App;

$session = new Session(App::SESSION_NAME);
$user = $session->getLogin();
$usuario = null;

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views/templates');
$twig = new \Twig_Environment($loader);

$id = Reader::read('id');

if(!isset($id)) {
    $usuario = $user;
}else if (isset($user) && $user->getAdministrador() == 1) {
    $db = new Database();
    $manager = new ManageUsuario($db);
    $usuario = $manager->get($id);
    $db->close();    
}

if($usuario === null) {
    header('Location: ../index.php');
    exit();
}

$alert = Alert::getAlert(Reader::get('op'), Reader::get('resultado'));


echo $twig->render('users/edit.html.twig', ['user' => $user, 'edit' => $usuario, 'alert' => $alert ]);
?>