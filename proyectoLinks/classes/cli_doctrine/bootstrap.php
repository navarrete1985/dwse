<?php

require_once '../../../classes/vendor/autoload.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array('./src');
$isDevMode = true;
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'link',
    'password' => 'link',
    'dbname'   => 'link'
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create ($dbParams, $config); //gestor