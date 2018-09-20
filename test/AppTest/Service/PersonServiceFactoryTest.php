<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\PersonService;
use App\Service\PersonServiceFactory;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

/**
 * Class PersonServiceFactoryTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class PersonServiceFactoryTest extends TestCase
{
    /**
     * @var ContainerInterface|ObjectProphecy
     */
    private $container;

    public function testFactory(): void
    {
        $factory = new PersonServiceFactory();

        $this->container->get(EntityManager::class)->willReturn(
            $this->prophesize(EntityManager::class)
        );

        $personService = $factory($this->container->reveal());

        $this->assertInstanceOf(PersonService::class, $personService);
    }

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }
}
