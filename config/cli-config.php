<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$serviceManager = include 'container.php';

/** @var \Doctrine\ORM\EntityManager $entityManager */
$entityManager = $serviceManager->get(\Doctrine\ORM\EntityManager::class);
//$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping(
//    'timestamp', 'string'
//);


return ConsoleRunner::createHelperSet($entityManager);