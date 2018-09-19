<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\AuthenticationService;
use App\Service\AuthenticationServiceFactory;
use App\Service\OauthUsersService;
use App\Service\PersonService;
use AppTest\AbstractTestCase;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

/**
 * Class AuthenticationServiceFactoryTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class AuthenticationServiceFactoryTest extends AbstractTestCase
{
    public function testFactory(): void
    {
        $factory = new AuthenticationServiceFactory();

        $userService = $factory($this->container);

        $this->assertInstanceOf(AuthenticationService::class, $userService);
    }
}
