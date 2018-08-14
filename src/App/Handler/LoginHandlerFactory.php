<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container) : LoginHandler
    {
        return new LoginHandler();
    }
}
