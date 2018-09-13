<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\UserService;
use Psr\Container\ContainerInterface;

/**
 * Class UserSessionHandlerFactory
 * @package App\Handler
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class UserSessionHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserSessionHandler
     */
    public function __invoke(ContainerInterface $container) : UserSessionHandler
    {
        /** @var UserService $userSvc */
        $userSvc = $container->get(UserService::class);

        return new UserSessionHandler($userSvc);
    }
}
