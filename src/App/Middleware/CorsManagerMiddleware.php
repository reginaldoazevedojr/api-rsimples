<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class CorsManagerMiddleware
 * @package App\Middleware
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class CorsManagerMiddleware implements MiddlewareInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: OPTIONS, GET, HEAD, POST, PUT, DELETE");
        header("Access-Control-Max-Age: 0");

        if ($request->getMethod() == 'OPTIONS') {
            return new JsonResponse(['options' => true]);
        }

        return $handler->handle($request);
    }
}
