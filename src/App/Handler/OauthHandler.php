<?php

declare(strict_types=1);

namespace App\Handler;

use App\Exception\AbstractException;
use App\Exception\NotGenerateOauthException;
use App\Service\AuthenticationService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class OauthHandler
 * @package App\Handler
 */
class OauthHandler implements RequestHandlerInterface
{
    /**
     * @var AuthenticationService
     */
    private $authSvc;

    /**
     * OauthHandler constructor.
     * @param AuthenticationService $authSvc
     */
    public function __construct(AuthenticationService $authSvc)
    {
        $this->authSvc = $authSvc;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            $result = $this->authSvc->requestToken();
            return new JsonResponse($result['data'], $result['status']);
        } catch (NotGenerateOauthException $error) {
            return new JsonResponse($error->errorArray());
        }
    }
}
