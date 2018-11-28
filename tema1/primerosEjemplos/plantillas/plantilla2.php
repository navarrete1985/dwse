<?php

require_once("classes/vendor/autoload.php");

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/twig');
$twig = new \Twig_Environment($loader);

echo $twig->render('hereda.twig', ['body' => 'reemplazado 1', 'otrocontenido' => 'reemplazado 2']); //Si pasamos contenido es lo que vamos a reemplazar

// echo $twig->render('hereda.twig'); //En caso de que no pasemos contenido veremos el contenido por defecto de la plantilla

/*
Tenemos:
    - Placeholder....en el que le pasamos un contenido en bruto
    - Bloques que se hacen con herencia
*/