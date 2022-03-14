<?php
// bootstrap.php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Vitive\projectManagement\infrastructure\persistence\doctrine\type\EmailAddressType;
use Vitive\projectManagement\infrastructure\persistence\doctrine\type\MemberIdType;
use Vitive\projectManagement\infrastructure\persistence\doctrine\type\ProjectIdType;
use Vitive\projectManagement\infrastructure\persistence\doctrine\type\UserIdType;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
// or if you prefer yaml or XML
$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/src/projectManagement/infrastructure/persistence/doctrine/mapping"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

Type::addType('projectId', ProjectIdType::class);
Type::addType('userId', UserIdType::class);
Type::addType('email', EmailAddressType::class);
Type::addType('memberId', MemberIdType::class);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

return $entityManager;