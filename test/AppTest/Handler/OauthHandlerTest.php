<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\OauthHandler;
use App\Service\AuthenticationService;
use AppTest\AbstractTestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class OauthHandlerTest
 * @package AppTest\Handler
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class OauthHandlerTest extends AbstractTestCase
{
    /**
     * Test Method and Path route
     */
    public function testCanSendRoute()
    {
        $this->assertEmpty([]);

        $routes = $this->app->getRoutes();

        foreach ($routes as $route) {
            if ($route->getName() == 'api.oauth') {
                $this->assertContains('POST', $route->getAllowedMethods());
                $this->assertEquals('/api/oauth', $route->getPath());
            }
        }
    }

    public function testReturnJsonResponse()
    {
        $authSvc = $this->container->get(AuthenticationService::class);
        $oauthHandle = new OauthHandler($authSvc);

        $response = $oauthHandle->handle($this->prophesize(ServerRequestInterface::class)->reveal());

        $this->assertInstanceOf(JsonResponse::class, $response);
    }


}
