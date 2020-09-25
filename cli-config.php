<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';

/** @var EntityManagerInterface $entityManager */
$entityManager = getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
