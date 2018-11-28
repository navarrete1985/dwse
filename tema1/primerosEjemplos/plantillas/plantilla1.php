<?php

require_once("classes/vendor/autoload.php");

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/twig');
$twig = new \Twig_Environment($loader);

// echo $twig->render('base.html', array('placeholder' => 'twig',
//                                       'subtitlo' => 'Otro'));

echo $twig->render('base.html', ['placeholder' => 'twig',
                                      'subtitlo' => 'Otro']);