<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\AuthenticationService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class OauthSocialHandler implements RequestHandlerInterface
{
    /**
     * @var AuthenticationService
     */
    private $authSvc;

        /**
         * Oa   uthSocialHandler constructor.
     * @param AuthenticationService $authSvc
     */
    public function __construct(AuthenticationService $authSvc)
    {
        $this->authSvc = $authSvc;
    }


    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $json = $request->getBody()->getContents();

        $data = json_decode($json, true);

        /** @var array $socialUser */
        $socialUser = $data['socialUser'];

        $result = $this->authSvc->requestSocialToken($socialUser);

        return new JsonResponse($result['data'], $result['status']);
    }
}
