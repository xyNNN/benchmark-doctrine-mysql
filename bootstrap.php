<?php

require_once "vendor/autoload.php";

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\DBAL\DriverManager;

function getEntityManager()
{
    // Doctrine DBAL
    $dbalconfig = new Doctrine\DBAL\Configuration();
    $conn       = DriverManager::getConnection([
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => 'root',
        'dbname'   => 'benchmark',
    ], $dbalconfig);

// Doctrine ORM
    $ormconfig = new Doctrine\ORM\Configuration();
    $cache     = new ArrayCache();
    $ormconfig->setQueryCacheImpl($cache);
    $ormconfig->setProxyDir(__DIR__.'/Entity');
    $ormconfig->setProxyNamespace('EntityProxy');
    $ormconfig->setAutoGenerateProxyClasses(true);

// ORM mapping by Annotation
    Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
        __DIR__.'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
    $driver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
        new Doctrine\Common\Annotations\AnnotationReader(),
        array(__DIR__.'/Entity')
    );
    $ormconfig->setMetadataDriverImpl($driver);
    $ormconfig->setMetadataCacheImpl($cache);

    return Doctrine\ORM\EntityManager::create([
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'benchmark',
    ], $ormconfig);
}