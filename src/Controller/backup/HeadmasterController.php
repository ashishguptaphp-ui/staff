<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
/**
 * Headmaster Controller
 *
 */
class HeadmasterController extends AppController
{

    
    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $role = $user->getOriginalData()->role ?? null;
        if ($role !== 'headmaster') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $user_id = $this->request->getSession()->read('Auth.User.id');
       


        $school = $session->read('Auth.School');


        // //

        /*echo "<pre>";
        print_r($school);

        exit;*/
        //17743
        $this->set('school', $school);
    }

    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('headmaster');
        //$this->render('/Headmaster/dashboard');
    }

    public function teachingStaff()
    {

       

        $this->viewBuilder()->setLayout('headmaster');

    }





  }
