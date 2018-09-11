<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class PersonServiceFactory
 * @package App\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class PersonServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return PersonService
     */
    public function __invoke(ContainerInterface $container)
    {
        $entitym = $container->get(EntityManager::class);

        return new PersonService($entitym);
    }
}
