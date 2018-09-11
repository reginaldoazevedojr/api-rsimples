<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
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

    /**
     * @var PersonService
     */
    private $personSvc;

    /**
     * @var EntityManager
     */
    private $entitym;

    /**
     * @var OauthUsersService
     */
    private $oauthUsersSvc;

    /**
     * AuthenticationService constructor.
     * @param Server $server
     * @param PersonService $personSvc
     * @param EntityManager $entitym
     * @param OauthUsersService $oauthUsersSvc
     */
    public function __construct(
        Server $server,
        PersonService $personSvc,
        EntityManager $entitym,
        OauthUsersService $oauthUsersSvc
    ) {
        $this->server = $server;
        $this->personSvc = $personSvc;
        $this->entitym = $entitym;
        $this->oauthUsersSvc = $oauthUsersSvc;
    }

    /**
     * @return mixed
     */
    public function requestToken()
    {
//        $COST = 11;
//
//        $bCrypt = new Bcrypt();
//        $bCrypt->setCost($COST);
//        var_dump($bCrypt->create('12345'));exit;

        $this->server->handleTokenRequest(Request::createFromGlobals());

        return [
            'data' => json_decode($this->server->getResponse()->getResponseBody(), true),
            'status' => $this->server->getResponse()->getStatusCode()
        ];
    }

    /**
     * @param array $userSocial
     * @return array
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function requestSocialToken(array $userSocial)
    {
        $email = $userSocial['email'];
        $provider = $userSocial['provider'];
        $identity = $userSocial['id'];
        $platform = ($provider == 'GOOGLE')? 'googleId' : 'facebookId';

        $this->entitym->getConnection()->beginTransaction();
        $this->entitym->getConnection()->setAutoCommit(false);

        try {
            $person = $this->personSvc->save($userSocial);
            $this->oauthUsersSvc->save(
                ['username' => $email, 'password' => 'S&mS$nh@', 'person' => $person, $platform => $identity]
            );
            $this->entitym->getConnection()->commit();
        } catch (\Exception $error) {
            $this->entitym->getConnection()->rollBack();
            throw new \Exception($error->getMessage(), $error->getCode());
        }

        try {
            $this->server->handleTokenRequest(Request::createFromGlobals());
            return [
                'data' => json_decode($this->server->getResponse()->getResponseBody(), true),
                'status' => $this->server->getResponse()->getStatusCode()
            ];
        } catch (\Exception $error) {
            throw new \Exception('2e2-' . $error->getMessage(), $error->getCode());
        }
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
