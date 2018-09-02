<?php

namespace App\Container;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Cache\Cache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Interop\Container\ContainerInterface;

/**
 * Class DoctrineFactory
 * @package App\Container
 * @author Reginaldo Azevedo Junior <reginaldo.junior@mutua.com.br>
 */
class DoctrineFactory
{
    /**
     * @param ContainerInterface $container
     * @return EntityManager
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \Doctrine\ORM\ORMException
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $proxyDir = (isset($config['doctrine']['orm']['proxy_dir'])) ?
            $config['doctrine']['orm']['proxy_dir'] : 'data/cache/EntityProxy';
        $proxyNamespace = (isset($config['doctrine']['orm']['proxy_namespace'])) ?
            $config['doctrine']['orm']['proxy_namespace'] : 'EntityProxy';
        $autoGenerateProxyClasses = (isset($config['doctrine']['orm']['auto_generate_proxy_classes'])) ?
            $config['doctrine']['orm']['auto_generate_proxy_classes'] : false;
        $underscoreNamingStrategy = (isset($config['doctrine']['orm']['underscore_naming_strategy'])) ?
            $config['doctrine']['orm']['underscore_naming_strategy'] : false;

        // Container ORM
        $doctrine = new Configuration();
        $doctrine->setProxyDir($proxyDir);
        $doctrine->setProxyNamespace($proxyNamespace);
        $doctrine->setAutoGenerateProxyClasses($autoGenerateProxyClasses);
        if ($underscoreNamingStrategy) {
            $doctrine->setNamingStrategy(new UnderscoreNamingStrategy());
        }

        // ORM mapping by Annotation
        AnnotationRegistry::registerLoader(function ($className) {
            return class_exists($className);
        });
        $driver = new AnnotationDriver(new AnnotationReader(), $config['doctrine']['annotation']['metadata']);
        $doctrine->setMetadataDriverImpl($driver);


        // Cache
        $cache = $container->get(Cache::class);
        $doctrine->setQueryCacheImpl($cache);
        $doctrine->setResultCacheImpl($cache);
        $doctrine->setMetadataCacheImpl($cache);

        /** @var EntityManager $entitym */
        $entitym = EntityManager::create($config['doctrine']['connection']['orm_default'], $doctrine);

        return $entitym;
    }
}
