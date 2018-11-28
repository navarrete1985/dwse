<?php

require_once("classes/vendor/autoload.php");

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/twig');
$twig = new \Twig_Environment($loader);

$lista = array();
$item = array('href' => 'http://example.com', 'caption' => 'enlace 1');
$lista[] = $item;
$item = array('href' => 'http://abc.es', 'caption' => 'el maligno');
$lista[] = $item;
$item = array('href' => 'http://publico.es', 'caption' => 'otro');
$lista[] = $item;

echo $twig->render('_bootstrap_landing.html', ['lista' => $lista]);