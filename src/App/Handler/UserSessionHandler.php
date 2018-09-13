<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class UserSessionHandler
 * @package App\Handler
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class UserSessionHandler implements RequestHandlerInterface
{
    /**
     * @var UserService
     */
    private $userSvc;

    /**
     * UserSessionHandler constructor.
     * @param UserService $userSvc
     */
    public function __construct(UserService $userSvc)
    {
        $this->userSvc = $userSvc;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            $oauthUser = $this->userSvc->getUserLogged();
            return new JsonResponse($oauthUser->toArray());
        } catch (\Exception $error) {
            return new JsonResponse([$error->getMessage()]);
        }
    }
}
