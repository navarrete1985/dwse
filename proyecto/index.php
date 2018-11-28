<?php

require 'classes/autoload.php';
require_once("classes/vendor/autoload.php");

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Alert;
use izv\tools\Session;
use izv\app\App;

$session = new Session(App::SESSION_NAME);
$user = $session->getLogin();

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/views/templates');
$twig = new \Twig_Environment($loader);

$db = new Database();
$manager = new ManageUsuario($db);
$usuarios = $manager->getAll();
$db->close();

$alert = Alert::getAlert(Reader::get('op'), Reader::get('resultado'));


echo $twig->render('users/inicio.html.twig', ['users' => $usuarios, 'user' => $user, 'alert' => $alert ]);