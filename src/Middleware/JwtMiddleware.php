<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Config\JwtConfig;

class JwtMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        
        // Check if this is a Services controller endpoint that requires JWT
        if ($this->requiresJwt($path)) {
            return $this->processWithJwt($request, $handler, $path);
        }
        
        // For all other endpoints, skip JWT check
        return $handler->handle($request);
    }
    
    /**
     * Determine if the current path requires JWT authentication
     */
    private function requiresJwt(string $path): bool
    {
        // Paths that don't require JWT (even under services)
        $publicPaths = [
            '/services/1.0/connect',
            '/services/1.0/refresh',
            '/services/1.0/get-teachers',
            '/services/1.0/dashboard'
        ];
        
        // Check if it's a services controller path
        if (strpos($path, '/services/') === 0) {
            // Check if it's a public path
            foreach ($publicPaths as $publicPath) {
                if (strpos($path, $publicPath) === 0) {
                    return false;
                }
            }
            // All other services paths require JWT
            return true;
        }
        
        // Non-services paths don't require JWT
        return false;
    }
    
    /**
     * Process request with JWT validation
     */
    private function processWithJwt(ServerRequestInterface $request, RequestHandlerInterface $handler, string $path): ResponseInterface
    {

        $authHeader = $request->getHeaderLine('Authorization');
        
        if (empty($authHeader)) {
            return $this->unauthorizedResponse('Missing Authorization header');
        }
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $this->unauthorizedResponse('Invalid Authorization header format');
        }
        
        $token = $matches[1];
        try {
            $payload = JWT::decode($token, new Key(JwtConfig::SECRET_KEY, JwtConfig::ALGORITHM));
            // Check token type
            if (!isset($payload->type) || $payload->type !== 'access') {
                return $this->unauthorizedResponse('Invalid token type');
            }
            // Add user data to request
            $request = $request->withAttribute('user', [
                'id' => $payload->sub,
                'username' => $payload->username,
                'role' => $payload->role ?? 'user'
            ]);
            
            return $handler->handle($request);
            
        } catch (\Exception $e) {
            //echo $e->getMessage();
            //echo 5;
            //exit;
            return $this->unauthorizedResponse('Invalid or expired token: ' . $e->getMessage());
        }
    }
    
    private function unauthorizedResponse(string $message): ResponseInterface
    {
        $response = new Response();
        return $response
            ->withStatus(401)
            ->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'error',
                'message' => $message
            ]));
    }
}
