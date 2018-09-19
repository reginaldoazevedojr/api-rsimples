<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\UserService;
use App\Service\UserServiceFactory;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

/**
 * Class UserServiceFactoryTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com
 */
class UserServiceFactoryTest extends TestCase
{
    /**
     * @var ContainerInterface|ObjectProphecy
     */
    private $container;

    public function testFactory(): void
    {
        $factory = new UserServiceFactory();

        $this->container->get(EntityManager::class)->willReturn(
            $this->prophesize(EntityManager::class)
        );

        $userService = $factory($this->container->reveal());

        $this->assertInstanceOf(UserService::class, $userService);
    }

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }
}
