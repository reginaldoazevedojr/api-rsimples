<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class OauthUsersServiceFactory
 * @package App\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class OauthUsersServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return OauthUsersService
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var EntityManager $entitym */
        $entitym = $container->get(EntityManager::class);

        return new OauthUsersService($entitym);
    }
}
