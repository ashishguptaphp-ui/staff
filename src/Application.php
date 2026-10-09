<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Cake\Datasource\ConnectionManager;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Authentication\Authenticator\FormAuthenticator;
use Authentication\Authenticator\SessionAuthenticator;
use Authentication\Identifier\IdentifierInterface;
use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Middleware\RequestAuthorizationMiddleware;
use Authorization\Middleware\AuthorizationRequiredMiddleware;
use Authorization\Exception\ForbiddenException;
use Cake\Routing\Router;
use Authorization\Policy\OrmResolver;
use App\Middleware\JwtMiddleware; 
use App\Middleware\SecurityHeadersMiddleware;
use Cake\Http\Middleware\CspMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 *
 * @extends \Cake\Http\BaseApplication<\App\Application>
 */
class Application extends BaseApplication implements
    AuthenticationServiceProviderInterface,
    AuthorizationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI !== 'cli') {
            // The bake plugin requires fallback table classes to work properly
            FactoryLocator::add('Table', (new TableLocator())->allowFallbackClass(false));
        }

        //$this->addPlugin('Authentication');
       // $this->addPlugin('Authorization'); 
       //$this->Authorization->authorize($this->request, 'access');
       
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */

    /*public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $csrf = new CsrfProtectionMiddleware([
            'httponly' => true,
            'secure' => true,
            'samesite' => 'Lax',
        ]);

        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new RoutingMiddleware($this))

            // ✅ AUTHENTICATION WITH SKIP LOGIC
            ->add(new AuthenticationMiddleware($this, [
                'unauthenticatedHandler' => [
                    'className' => 'Authentication.Redirect',
                    'url' => '/users/login',
                    'queryParam' => 'redirect',
                ],
                'skipCheck' => function (ServerRequestInterface $request) {
                    $path = $request->getUri()->getPath();

                    return (
                        str_starts_with($path, '/services/') ||
                        $path === '/users/login' ||
                        str_starts_with($path, '/api/')
                    );
                },
            ]))

            ->add(new \App\Middleware\SessionExpireMiddleware())

            ->add(new AuthorizationMiddleware($this, [
                'requireAuthorizationCheck' => false,
                'unauthorizedHandler' => [
                    'className' => 'Authorization.Redirect',
                    'url' => '/users/login',
                    'queryParam' => 'redirect',
                ],
            ]));

        // ✅ CSRF SKIP FOR API/SERVICES
        $csrf->skipCheckCallback(function ($request) {
            $path = $request->getUri()->getPath();

            return (
                str_starts_with($path, '/services/') ||
                $path === '/users/login' ||
                str_starts_with($path, '/api/')
            );
        });

        $middlewareQueue->add($csrf);

        // ✅ JWT only for API (OPTIONAL but recommended)
        $middlewareQueue->add(new JwtMiddleware([
            'skip' => function (ServerRequestInterface $request) {
                return !str_starts_with($request->getUri()->getPath(), '/api/');
            }
        ]));

        return $middlewareQueue;
    }*/

    
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {

        
        $csrf = new CsrfProtectionMiddleware([
            'httponly' => true,
        ]);




  
        $middlewareQueue
            ->add(function ($request, $handler) {
                  
                if (str_starts_with($request->getPath(), '/api') && 
                    $request->getPath() !== '/api/login') {

                    $token = $request->getHeaderLine('Authorization');
                    /*echo "dd-".$token;
                    echo $request->getPath();
                    exit;*/
                    if (!$token) {
                        return new \Cake\Http\Response([
                            'status' => 401,
                            'body' => json_encode(['success' => false, 'message' => 'Token missing'])
                        ]);
                    }
                }

                return $handler->handle($request);
            })
            ->add(new BodyParserMiddleware())
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new RoutingMiddleware($this))
            ->add(new SecurityHeadersMiddleware())
            ->add(new AuthenticationMiddleware($this)) 
            ->add(new \App\Middleware\SessionExpireMiddleware())
            ->add(new AuthorizationMiddleware($this, [
                'requireAuthorizationCheck' => false, 
                'unauthorizedHandler' => [
                    'className' => 'Authorization.Redirect',
                    'url' => '/users/login',
                    'queryParam' => 'redirect',
                ],
            ]));

	    // Skip CSRF for API routes
        $csrf->skipCheckCallback(function ($request) {

            $path = $request->getUri()->getPath();
            
            // Skip CSRF for these paths
            $skipPaths = [
                '/services/',
                '/users/login',
                '/api/',
            ];
            
            foreach ($skipPaths as $skipPath) {
                if (strpos($path, $skipPath) === 0) {
                    return true;
                }
            }
            
            return false;
        });
        
        $middlewareQueue->add($csrf);
        
        // Add JWT middleware (configured to only check specific paths)
        $middlewareQueue->add(new JwtMiddleware());

        return $middlewareQueue;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/5/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
	    $service = new AuthenticationService();

	    // Session Authenticator
	    $service->loadAuthenticator('Authentication.Session');

	    // Form Authenticator with embedded identifier
	    $service->loadAuthenticator('Authentication.Form', [
		    'fields' => [
			    'username' => 'username',
			    'password' => 'password',
		    ],
		    'loginUrl' => '/users/login',
		    'identifier' => [
			    'Authentication.Password' => [
				    'fields' => [
					    'username' => 'username',
					    'password' => 'password',
				    ]
			    ]
		    ]
	    ]);

	    return $service;
    }

    /*public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface {
        $service = new AuthenticationService();

        // Load identifiers
        $service->loadIdentifier('Authentication.Password', [
            'fields' => ['username' => 'username', 'password' => 'password']
        ]);

        // Load authenticators, session first
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => ['username' => 'username', 'password' => 'password'],
            'loginUrl' => '/users/login'
        ]);

        return $service;
    }*/

    /**
     * Returns an AuthorizationServiceInterface instance used by AuthorizationMiddleware.
     *
     * This method implements AuthorizationServiceProviderInterface.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request
     * @return \Authorization\AuthorizationServiceInterface
     */
    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $resolver = new OrmResolver();

        return new AuthorizationService($resolver);
    }
    
}
