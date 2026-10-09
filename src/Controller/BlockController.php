<?php

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Http\Client;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use DateTime;
use stdClass;
use Cake\Routing\Router;

//App\Controller\stdClass


class BlockController extends AppController
{
    private $user_id;
    private $username;
    private $UD;
    
    public function initialize(): void
    {
        parent::initialize();
        //$this->loadComponent('RequestHandler');

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->FormProtection->setConfig('unlockedActions', 
        [
            'updateUdiseDataByEmpId',
            'updateShalarthData',
            'updateUdiseData',
            'updateSanchData',
            'fetchSanchDetails'
        ]);

        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
        $sessionUser = $this->request->getSession()->read('Auth.User');
       
        if (!$sessionUser) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $role = $user->getOriginalData()->role ?? null;

       
        if ($role !== 'block') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->user_id = $this->request->getSession()->read('Auth.User.id');
        $this->username = $this->request->getSession()->read('Auth.User.username');
     

        $user = $this->request->getSession()->read('Auth.User');
        /*echo "<pre>";
        print_r( $user);
        exit;*/
        $this->set('user', $user);
       
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }


    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('cluster');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        //$schools = $schoolsTable->find()->where(['cluster_code' => $this->username])->all();

        $schools = $schoolsTable->find()
            ->matching('Clusters', function ($q) {
                return $q->where(['Clusters.block_code' => $this->username]);
            })
            ->all();
       
        $totalSchools = $schools->count();
        // Schools with school_close = 'NO'
        $openSchools = $schools->filter(function ($school) {
            return $school->school_close === 'NO';
        })->count();
        $closeSchools = $totalSchools - $openSchools;

        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');


        
       

        /*$ng2gCount = $staffTransfersTable->find()
            ->innerJoin(
                ['Schools' => 'schools'],
                'Schools.udise_code = StaffTransfers.udise_number'
            )
            ->matching('Clusters', function ($q) {
                return $q->where(['Clusters.block_code' => $this->username]);
            })
            ->count();*/


            $blockCode = $this->username;

            $ng2gCount = $staffTransfersTable->find()
                ->matching('Schools.Clusters', function ($q) use ($blockCode) {
                    return $q->where(['Clusters.block_code' => $blockCode]);
                })
                ->count();

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $blockCode = $this->username;

        $query = $staffsTable->find()
            ->select([
                'current_post_aid_type',
                'emp_type',
                'count' => $staffsTable->find()->func()->count('*')
            ])
            ->join([
                'Schools' => [
                    'table' => 'schools',
                    'type' => 'INNER',
                    'conditions' => 'Schools.udise_code = Staffs.udise_code'
                ],
                'Clusters' => [
                    'table' => 'clusters',
                    'type' => 'INNER',
                    'conditions' => 'Clusters.code = Schools.cluster_code'
                ]
            ])
            ->where([
                'Clusters.block_code' => $blockCode
            ])
            ->group([
                'current_post_aid_type',
                'emp_type'
            ]);
           /* echo "<pre>";
            print_r($query);
            exit;
            */
        $result = [];

        foreach ($query as $row) {
            $adType = 'self';
            if('100%_AIDED' == $row->current_post_aid_type){
                $adType = 'full';
            }else if('PARTIALLY AIDED' == $row->current_post_aid_type){
                $adType = 'part';
            }
            $result[$adType][$row->emp_type] = $row->count;
        }


        
        //pending','in_progress','completed
        //$updateStatus = array('p' => array('t'=>0,'n'=>0,'s'=>0),'i' => array('t'=>0,'n'=>0,'s'=>0),'c' => array('t'=>0,'n'=>0,'s'=>0));

        $onboard = $staffsTable->find()
            ->select([                
                'staff_update_status','emp_type',
                'count' => $staffsTable->find()->func()->count('*')
            ])
            ->join([
                'Schools' => [
                    'table' => 'schools',
                    'type' => 'INNER',
                    'conditions' => 'Schools.udise_code = Staffs.udise_code'
                ],
                'Clusters' => [
                    'table' => 'clusters',
                    'type' => 'INNER',
                    'conditions' => 'Clusters.code = Schools.cluster_code'
                ]
            ])
            ->where([
                'Clusters.block_code' => $blockCode
            ])            
            ->group(['staff_update_status','emp_type']);

            

        
        foreach ($onboard as $row) {
            $updateStatus[$row->staff_update_status][$row->emp_type] =  $row->count;           
        }
        
        
       // pending
       //  $sanchPostSanctionWorkingTable = TableRegistry::getTableLocator()->get('SanchPostSanctionWorking');

       /* echo "<pre>";
        print_r($updateStatus);
        exit;*/
        $this->set('cluster_code', $this->username);
        $this->set('schools', $schools);
        $this->set('totalSchools', $totalSchools);
        $this->set('openSchools', $openSchools);
        $this->set('closeSchools', $closeSchools);
         $this->set('ng2gCount', $ng2gCount);

       // $this->set('updateStatus', $updateStatus);
        $this->set('staffsType', $result);


        //$this->render('/Headmaster/dashboard');
    }

    public function ngtogTransfer()
    {
        $this->viewBuilder()->setLayout('cluster');
    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');


        
       

        $ng2g = $staffTransfersTable->find()
            ->innerJoin(
                ['Schools' => 'schools'],
                'Schools.udise_code = StaffTransfers.udise_number'
            )
            ->where([
                'Schools.cluster_code' => $this->username
            ])
            ->all();


       
                    
        $this->set('ng2g', $ng2g);

        

    }


  }
