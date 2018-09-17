<?php

declare(strict_types=1);

namespace AppTest;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Class AbstractTestCase
 * @package AppTest
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class AbstractTestCase extends TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Application
     */
    protected $app;

    /**
     * SetUp Abstract
     */
    protected function setUp(): void
    {
        $this->container = require __DIR__ . '/../../config/container.php';

        /** @var Application $app */
        $this->app = $this->container->get(Application::class);

        $factory = $this->container->get(MiddlewareFactory::class);

        (require __DIR__ . '/../../config/routes.php')($this->app, $factory, $this->container);
        (require __DIR__ . '/../../config/pipeline.php')($this->app, $factory, $this->container);
    }

}
