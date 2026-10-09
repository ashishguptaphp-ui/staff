<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SessionExpireMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface
    {
        $response = $handler->handle($request);
        $session = $request->getAttribute('session');

        // When session is expired, add header
        if (!$session || !$session->check('Auth.User')) {
            return $response->withHeader('X-Session-Expired', '1');
        }

        return $response;
    }
}
