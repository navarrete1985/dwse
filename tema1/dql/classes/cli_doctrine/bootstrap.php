<?php

require_once '../vendor/autoload.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array('./src'); //Especificamos donde van a estar las clases pojo (entidades) Se suele elegir como ruta src
$isDevMode = false;//Para ver más o menos errores, en caso de true da más errores pero es menos eficiente
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'simple',
    'password' => 'simple',
    'dbname'   => 'simple',
    'charset'  => 'utf8'
);
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create ($dbParams, $config); //Objeto gertor de la base de datos