<?php


namespace App\Service;

use App\Adapter\PdoAdapter;
use Doctrine\ORM\EntityManager;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\RefreshToken;
use OAuth2\GrantType\UserCredentials;
use Psr\Container\ContainerInterface;

/**
 * Class AuthenticationServiceFactory
 *
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class AuthenticationServiceFactory
{
    /**
     * @param $container
     * @return AuthenticationService
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        $storage = new PdoAdapter($config['oauth'], []);

        $server = new \OAuth2\Server($storage, $config['oauth']['options-oauth']);

        $server->addGrantType(new ClientCredentials($storage));
        $server->addGrantType(new UserCredentials($storage));
        $server->addGrantType(new AuthorizationCode($storage));
        $server->addGrantType(new RefreshToken($storage));

        /** @var PersonService $personSvc */
        $personSvc = $container->get(PersonService::class);

        /** @var EntityManager $entitym */
        $entitym = $container->get(EntityManager::class);

        /** @var OauthUsersService $oauthUsersSvc */
        $oauthUsersSvc = $container->get(OauthUsersService::class);

        return new AuthenticationService($server, $personSvc, $entitym, $oauthUsersSvc);
    }
}
