<?php

require '../classes/autoload.php';
require_once("../classes/vendor/autoload.php");

use izv\data\Usuario;
use izv\tools\Alert;
use izv\tools\Session;
use izv\app\App;

$session = new Session(App::SESSION_NAME);
$user = $session->getLogin();

if ($user->getAdministrador() != 1) {
    header('Location: ../index.php');
    exit();
}

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views/templates');
$twig = new \Twig_Environment($loader);
echo $twig->render('users/insert.html.twig', ['users' => $usuarios, 'user' => $user, 'alert' => $alert ]);