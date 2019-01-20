<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Bootstrap {
    private $entityManager;

    function __construct() {
        $paths = array('');
        $isDevMode = false;
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'simple',
            'password' => 'simple',
            'dbname'   => 'simple'
        );
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $this->entityManager = EntityManager::create ($dbParams, $config);
    }
    
    function getEntityManager() {
        return $this->entityManager;
    }
}