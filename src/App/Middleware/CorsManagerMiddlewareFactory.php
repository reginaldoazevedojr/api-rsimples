<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class CorsManagerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : CorsManagerMiddleware
    {
        return new CorsManagerMiddleware();
    }
}
