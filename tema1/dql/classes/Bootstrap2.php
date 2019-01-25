<?php

use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;
    /*Doctrine\ORM\Mapping\Driver\AnnotationDriver
    Doctrine\Common\Annotations\AnnotationReader
    Doctrine\Common\Annotations\AnnotationRegistry*/

class Bootstrap2 {
    private $entityManager;

    function __construct() {
        $paths = array('./cli_doctrine/src/');
        $isDevMode = true;
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'proyecto',
            'password' => 'proyecto',
            'dbname'   => 'proyecto',
            'charset'  => 'utf8'
        );
        
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $this->entityManager = EntityManager::create($dbParams, $config);
        
        /*$config = Setup::createConfiguration($isDevMode);
        $driver = new AnnotationDriver(new AnnotationReader(), $paths);

        AnnotationRegistry::registerLoader('class_exists');
        $config->setMetadataDriverImpl($driver);

        $this->entityManager = EntityManager::create($dbParams, $config);*/
        //https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/advanced-configuration.html
        /*$applicationMode = "development";
        if ($applicationMode === "development") {
            $cache = new \Doctrine\Common\Cache\ArrayCache();
        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache();
        }
        $config = new Configuration();
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver('./classes/cli_doctrine/src/izv/data/');
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir('/path/to/myproject/lib/MyProject/Proxies');
        $config->setProxyNamespace('MyProject\Proxies');
        if ($applicationMode == "development") {
            $config->setAutoGenerateProxyClasses(true);
        } else {
            $config->setAutoGenerateProxyClasses(false);
        }
        $this->entityManager = EntityManager::create($dbParams, $config);*/
    }
    
    function getEntityManager() {
        return $this->entityManager;
    }
}