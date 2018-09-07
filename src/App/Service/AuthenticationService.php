<?php

namespace App\Service;

use OAuth2\Request;
use OAuth2\Response;
use OAuth2\Server;
use Zend\Crypt\Password\Bcrypt;

/**
 * Class AuthorizationService
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class AuthenticationService
{
    /**
     * @var Server
     */
    private $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * @return mixed
     */
    public function requestToken()
    {
        $COST = 11;

        $bCrypt = new Bcrypt();
        $bCrypt->setCost($COST);
        var_dump($bCrypt->create('12345'));exit;

        $this->server->handleTokenRequest(Request::createFromGlobals());

        return [
            'data' => json_decode($this->server->getResponse()->getResponseBody(), true),
            'status' => $this->server->getResponse()->getStatusCode()
        ];
    }

    /**
     * @return array
     */
    public function revokeToken()
    {
        $this->server->handleRevokeRequest(Request::createFromGlobals());

        return [
            'data' => json_decode($this->server->getResponse()->getResponseBody()),
            'status' => $this->server->getResponse()->getStatusCode()
        ];
    }

    /**
     * @return bool
     */
    public function verifyToken()
    {
        return $this->server->verifyResourceRequest(Request::createFromGlobals());
    }
}
