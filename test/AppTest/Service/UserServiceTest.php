<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Entity\OauthUsers;
use App\Service\AuthenticationService;
use App\Service\UserService;
use AppTest\AbstractTestCase;

/**
 * Class UserServiceTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class UserServiceTest extends AbstractTestCase
{

    /**
     * @expectedException \App\Exception\NotGenerateOauthException
     */
    public function testIfGetUserLoggedException()
    {
        /** @var UserService $userSvc */
        $userSvc = $this->container->get(UserService::class);

        $userSvc->getUserLogged();
    }

    public function testIfGenerateToken()
    {
        /** @var AuthenticationService $authSvc */
        $authSvc = $this->container->get(AuthenticationService::class);

        $user = require __DIR__ . '/../../data/user.reginaldo.php';
        $client = require __DIR__ . '/../../data/client.rsimples.php';

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['grant_type'] = 'password';
        $_POST['client_id'] = $client['client_id'];
        $_POST['client_secret'] = $client['client_secret'];
        $_POST['username'] = $user['username'];
        $_POST['password'] = $user['password'];

        $result = $authSvc->requestToken();

        $this->assertEquals(200, $result['status']);

        return $result["data"]["access_token"];
    }

    /**
     * @depends testIfGenerateToken
     */
    public function testIfGetUserLogged($token)
    {
        /** @var UserService $userSvc */
        $userSvc = $this->container->get(UserService::class);

        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer ' . $token;

        $oauth = $userSvc->getUserLogged();

        $this->assertInstanceOf(OauthUsers::class, $oauth);
    }
}
