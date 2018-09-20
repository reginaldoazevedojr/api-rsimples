<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\OauthUsersService;
use App\Service\OauthUsersServiceFactory;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

/**
 * Class OauthUsersServiceFactoryTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class OauthUsersServiceFactoryTest extends TestCase
{
    /**
     * @var ContainerInterface|ObjectProphecy
     */
    private $container;

    public function testFactory(): void
    {
        $factory = new OauthUsersServiceFactory();

        $this->container->get(EntityManager::class)->willReturn(
            $this->prophesize(EntityManager::class)
        );

        $personService = $factory($this->container->reveal());

        $this->assertInstanceOf(OauthUsersService::class, $personService);
    }

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }
}
