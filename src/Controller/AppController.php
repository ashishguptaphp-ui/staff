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
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Service\EsdlStorageService;
use Cake\Controller\Controller;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization', [
            'skipAuthorization' => true // Optional default skip
        ]);
        //$this->loadComponent('RequestHandler');
        $this->loadComponent('Flash'); // ✅ Important
        // Only enable Security for non-API routes
        $path = $this->request->getPath();
        if (strpos($path, '/services/') === 0 ||
            strpos($path, '/users/login') === 0) {
                //$this->disableFormProtection();
        } else{
        $this->loadComponent('FormProtection'); // optional, good practice

        }
        
    }

    protected function getActiveHeaderImageDataUri(int $userId): string
    {
        $headerFile = $this->fetchTable('HeaderFiles')->find()
            ->select(['storage_path', 'mime_type'])
            ->where([
                'user_id' => $userId,
                'is_active' => true,
                'mime_type IN' => ['image/png', 'image/jpeg'],
            ])
            ->first();

        if (!$headerFile) {
            return '';
        }

        try {
            $imageData = (new EsdlStorageService())->getContents($headerFile->storage_path);
        } catch (\Throwable $exception) {
            return '';
        }

        return 'data:' . $headerFile->mime_type . ';base64,' . base64_encode($imageData);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $controller = $this->request->getParam('controller');
       
       
        $action = $this->request->getParam('action');

        if (
            ($controller === 'Users' && in_array($action, ['login', 'logout'])) ||
            in_array($controller, ['Pages', 'Services','Import'])
        ) {            
            $this->Authorization->skipAuthorization();
            $this->Authentication->addUnauthenticatedActions(['display','updateUdiseDataByEmpId']);

        }
    }

    
}
