<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\AuthenticationService;
use Psr\Container\ContainerInterface;

class OauthSocialHandlerFactory
{
    public function __invoke(ContainerInterface $container) : OauthSocialHandler
    {
        /** @var AuthenticationService $authSvc */
        $authSvc = $container->get(AuthenticationService::class);

        return new OauthSocialHandler($authSvc);
    }
}
