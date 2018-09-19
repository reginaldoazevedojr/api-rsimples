<?php

namespace App\Service;

use App\Exception\NotGenerateOauthException;
use App\Exception\TransactionException;
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
     * @return array
     * @throws NotGenerateOauthException
     */
    public function requestToken()
    {
//        $COST = 11;
//        $bCrypt = new Bcrypt();
//        $bCrypt->setCost($COST);
//        dump($bCrypt->create('12345'));exit;

        try {
            $this->server->handleTokenRequest(Request::createFromGlobals());
            return [
                'data' => json_decode($this->server->getResponse()->getResponseBody(), true),
                'status' => $this->server->getResponse()->getStatusCode()
            ];
        } catch (\Exception $error) {
            throw new NotGenerateOauthException('Error generating Oauth', $error->getCode(), $error->getMessage());
        }
    }

    /**
     * @param array $userSocial
     * @return array
     * @throws NotGenerateOauthException
     * @throws TransactionException
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function requestSocialToken(array $userSocial)
    {
        $email = $userSocial['email'];
        $provider = $userSocial['provider'];
        $identity = $userSocial['id'];
        $platform = ($provider == 'GOOGLE') ? 'googleId' : 'facebookId';

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
            throw new TransactionException('Error in transaction of oauth request', $error->getCode(),
                $error->getMessage());
        }

        try {
            $this->server->handleTokenRequest(Request::createFromGlobals());
            return [
                'data' => json_decode($this->server->getResponse()->getResponseBody(), true),
                'status' => $this->server->getResponse()->getStatusCode()
            ];
        } catch (\Exception $error) {
            throw new NotGenerateOauthException('Error generating Oauth', $error->getCode(), $error->getMessage());
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
