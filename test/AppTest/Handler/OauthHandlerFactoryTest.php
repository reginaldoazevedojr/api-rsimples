<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\OauthHandler;
use App\Handler\OauthHandlerFactory;
use App\Service\AuthenticationService;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class OauthHandlerFactoryTest
 * @package AppTest\Handler
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class OauthHandlerFactoryTest extends TestCase
{
    /**
     * @var ContainerInterface|ObjectProphecy
     */
    private $container;

    public function testFactory(): void
    {
        $factory = new OauthHandlerFactory();

        $this->container->get(AuthenticationService::class)->willReturn(
            $this->prophesize(AuthenticationService::class)
        );

        $oauthHandle = $factory($this->container->reveal());

        $this->assertInstanceOf(OauthHandler::class, $oauthHandle);
    }

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }


}
