<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Entity\OauthUsers;
use App\Service\AuthenticationService;
use App\Service\UserService;
use AppTest\AbstractTestCase;

/**
 * Class AuthenticationServiceTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class AuthenticationServiceTest extends AbstractTestCase
{

    public function testIfGenerateToken(): string
    {
        /** @var AuthenticationService $authSvc */
        $authSvc = $this->container->get(AuthenticationService::class);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['grant_type'] = 'password';
        $_POST['client_id'] = 'rsimples';
        $_POST['client_secret'] = 'rsimples';
        $_POST['username'] = 'reginaldoazevedojr@gmail.com';
        $_POST['password'] = '12345';

        $result = $authSvc->requestToken();

        $this->assertEquals(200, $result['status']);

        return $result["data"]["access_token"];
    }
}
