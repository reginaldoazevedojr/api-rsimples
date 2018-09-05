<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\AuthenticationService;
use Psr\Container\ContainerInterface;

class OauthHandlerFactory
{

    public function __invoke(ContainerInterface $container) : OauthHandler
    {
        /** @var AuthenticationService $authSvc */
        $authSvc = $container->get(AuthenticationService::class);

        return new OauthHandler($authSvc);
    }
}
