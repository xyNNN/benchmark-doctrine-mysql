<?php

// bootstrap.php
use Doctrine\ORM\EntityManagerInterface;
use Entity\Benchmark;

require_once __DIR__."/bootstrap.php";

/** @var EntityManagerInterface $entityManager */
$entityManager = getEntityManager();

for ($j = 0; $j < 10; $j++) {
    $qb = $entityManager->getRepository(Benchmark::class)->createQueryBuilder('b');
    $qb->delete();

    $startTime = microtime(true);
    for ($i = 0; $i < 10000; $i++) {
        $benchmark = new Benchmark('Peter '.$i);
        $entityManager->persist($benchmark);
    }

    $entityManager->flush();

    echo "insert ".((microtime(true) - $startTime) * 1000)."\n";

    $entityManager->clear();
    $startTime = microtime(true);

    $repository = $entityManager->getRepository(Benchmark::class);
    foreach ($repository->findAll() as $item) {

    }

    echo "fetch ".((microtime(true) - $startTime) * 1000)."\n";
}
