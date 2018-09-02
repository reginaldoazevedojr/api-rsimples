<?php

namespace App\Container;

use Doctrine\Common\Cache\ArrayCache;
use Interop\Container\ContainerInterface;

/**
 * Class DoctrineArrayCacheFactory
 * @package App\Container
 */
class DoctrineArrayCacheFactory
{
    /**
     * @param ContainerInterface $container
     * @return ArrayCache
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ArrayCache();
    }
}
