<?php

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

$loader = require_once(__DIR__ . '/vendor/autoload.php');
$loader->add('Models', __DIR__);

$connection = new Connection();

$config = new Configuration();

$config->setDefaultDB('modo');
$config->setHydratorDir(__DIR__ . '/Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');

$config->setMetadataDriverImpl(AnnotationDriver::create(__DIR__ . '/Models'));

AnnotationDriver::registerAnnotationClasses();

$dm = \Doctrine\ODM\MongoDB\DocumentManager::create($connection, $config);

