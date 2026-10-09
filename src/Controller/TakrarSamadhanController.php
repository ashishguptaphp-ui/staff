<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;
use Cake\Utility\Security;

class TakrarSamadhanController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('FormProtection');
        $this->loadComponent('Flash');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['new']);
        
    }
    

    public function new()
    {
        $complaint = $this->TakrarSamadhan->newEmptyEntity();

        // Generate CAPTCHA on GET
        if ($this->request->is('get')) {
            $this->_generateCaptcha();
        }

        if ($this->request->is('post')) {

            // CAPTCHA VALIDATION
            $userCaptcha = $this->request->getData('captcha');
            $sessionCaptcha = $this->request->getSession()->read('captcha_answer');

            if ((int)$userCaptcha !== (int)$sessionCaptcha) {
                $this->Flash->error('Invalid CAPTCHA. Try again.');
                $this->_generateCaptcha();
                $this->set(compact('complaint'));
                return;
            }

            $data = $this->request->getData();

            // Add system metadata
            $data['ticket_id'] = 'TS-' . time() . '-' . rand(100,999);
            $data['ip_address'] = $this->request->clientIp();
            $data['user_agent'] = $this->request->getHeaderLine('User-Agent');

            

            $file = $this->request->getData('attachment');

            if ($file && $file->getError() === UPLOAD_ERR_OK) {

                $filename = time() . '_' . $file->getClientFilename();

                $uploadPath = WWW_ROOT . 'uploads' . DS . 'complaints' . DS;

                // create folder if not exists
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0775, true);
                }

                // move file
                $file->moveTo($uploadPath . $filename);

                // save only filename in DB
                $data['attachment'] = $filename;

            } else {
                $data['attachment'] = null;
            }

            $complaint = $this->TakrarSamadhan->patchEntity($complaint, $data);

            if ($this->TakrarSamadhan->save($complaint)) {
                $this->Flash->success('Complaint submitted successfully!');                
                return $this->redirect(['action' => 'new']);
            }
             $this->_generateCaptcha();
            $this->Flash->error('Please correct errors below.');
        }

        $this->set(compact('complaint'));
    }

    /**
     * Generate innovative CAPTCHA (math + obfuscation)
     */
    private function _generateCaptcha()
    {
        $a = rand(1, 9);
        $b = rand(1, 9);

        $operators = ['+', '-', '*'];
        $op = $operators[array_rand($operators)];

        switch ($op) {
            case '+': $answer = $a + $b; break;
            case '-': $answer = $a - $b; break;
            case '*': $answer = $a * $b; break;
        }

        $this->request->getSession()->write('captcha_answer', $answer);

        // Store structured question (NOT shuffled)
        $this->set(compact('a', 'b', 'op'));
        
    }
}