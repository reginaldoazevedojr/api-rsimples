<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

/**
 * Class VersionHandlerFactory
 * @package App\Handler
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class VersionHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return VersionHandler
     */
    public function __invoke(ContainerInterface $container) : VersionHandler
    {
        return new VersionHandler();
    }
}
