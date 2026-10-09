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


class ClusterController extends AppController
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

       
        if ($role !== 'cluster') {
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


    public function searchByUdise($udise_code = null)
    {
        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');
        $school = $schoolsTable->find()    
                               ->where(['udise_code' => $udise_code])
                               ->first();

        $aidedTypesTable = TableRegistry::getTableLocator()->get('AidedTypes');                   
        $aidedTypesDetails = $aidedTypesTable->find()->order(['name' => 'ASC'])->all();

        $postsTable = TableRegistry::getTableLocator()->get('Posts');                   
        $postDetails = $postsTable->find()->order(['seq_no' => 'ASC'])->all();

        $schoolCategoryTable = TableRegistry::getTableLocator()->get('SchoolCategories');                   
        $schoolCategories = $schoolCategoryTable->find()->order(['code' => 'ASC'])->all();

        


        if (!$school) {
            throw new NotFoundException(__('School not found'));
        }
        $response = [
            'status' => 'success',
            'data' => $school,
            'aidedTypes' => $aidedTypesDetails,
            'posts' => $postDetails,
            'schoolCategories' => $schoolCategories,
            '_serialize' => ['status', 'data'],
        ];
        return $this->response->withType('application/json')->withStringBody(json_encode($response));

    
    }
    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('cluster');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['cluster_code' => $this->username])->all();
       
        $totalSchools = $schools->count();
        // Schools with school_close = 'NO'
        $openSchools = $schools->filter(function ($school) {
            return $school->school_close === 'NO';
        })->count();
        $closeSchools = $totalSchools - $openSchools;

        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');


        
       

        $ng2gCount = $staffTransfersTable->find()
            ->innerJoin(
                ['Schools' => 'schools'],
                'Schools.udise_code = StaffTransfers.udise_number'
            )
            ->where([
                'Schools.cluster_code' => $this->username
            ])
            ->count();

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $query = $staffsTable->find()
                ->select([
                    'current_post_aid_type',
                    'emp_type',
                    'count' => $staffsTable->find()->func()->count('*')
                ])
                ->innerJoin(
                    ['Schools' => 'schools'],
                    ['Schools.udise_code = Staffs.udise_code']
                )
                ->where([
                    'Schools.cluster_code' => $this->username
                ])
                ->group([
                    'current_post_aid_type',
                    'emp_type'
                ]);

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
            ->innerJoin(
                ['Schools' => 'schools'],
                ['Schools.udise_code = Staffs.udise_code']
            )
            ->where([
                'Schools.cluster_code' => $this->username
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

        $this->set('updateStatus', $updateStatus);
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

    public function schools()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('cluster');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['cluster_code' => $this->username])->all();
       
        $totalSchools = $schools->count();
        // Schools with school_close = 'NO'
        $openSchools = $schools->filter(function ($school) {
            return $school->school_close === 'NO';
        })->count();
        $closeSchools = $totalSchools - $openSchools;

        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');


        
       

        $ng2gCount = $staffTransfersTable->find()
            ->innerJoin(
                ['Schools' => 'schools'],
                'Schools.udise_code = StaffTransfers.udise_number'
            )
            ->where([
                'Schools.cluster_code' => $this->username
            ])
            ->count();

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $query = $staffsTable->find()
                ->select([
                    'current_post_aid_type',
                    'emp_type',
                    'count' => $staffsTable->find()->func()->count('*')
                ])
                ->innerJoin(
                    ['Schools' => 'schools'],
                    ['Schools.udise_code = Staffs.udise_code']
                )
                ->where([
                    'Schools.cluster_code' => $this->username
                ])
                ->group([
                    'current_post_aid_type',
                    'emp_type'
                ]);

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
            ->innerJoin(
                ['Schools' => 'schools'],
                ['Schools.udise_code = Staffs.udise_code']
            )
            ->where([
                'Schools.cluster_code' => $this->username
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

        $this->set('updateStatus', $updateStatus);
        $this->set('staffsType', $result);


        //$this->render('/Headmaster/dashboard');
    }
    public function profile()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('school');
        //$this->render('/Headmaster/dashboard');
    }

    public function staffs($udise)
    {
        $this->viewBuilder()->setLayout('cluster');
    
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

                   
        $staffDetails = $staffsTable->find()
                        ->where(['udise_code' => $udise])
                        //->where(['emp_type' => 1])
                        ->all();

        //dd($staffDetails);
        $this->set('staffs', $staffDetails);

        

    }

   

    public function staffProfile($staffId = null)
    {
        $this->viewBuilder()->setLayout('school');

        /*if (!$staffId) {
            $this->Flash->error('Teacher not found.');
            return $this->redirect(['action' => 'teachingStaff']);
        }*/

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

                   
        $staffDetails = $staffsTable->find()       
                                    ->contain(['CasteCategories'])
                                    ->contain(['Posts'])
                                    ->contain(['StaffsTypes'])
                                    ->contain(['Genders'])
                                    ->where(['Staffs.id' => $staffId])
                                    ->first();
                                 

                                            
        /*echo "<pre>";
        print_r($staffDetails);
        exit;*/
        $staffUpdateModeTable = TableRegistry::getTableLocator()->get('StaffUpdateMode');
        $staffAddressesTable = TableRegistry::getTableLocator()->get('StaffAddresses');
        $relationshipsTable = TableRegistry::getTableLocator()->get('Relationships');
        $nominationTypesTable = TableRegistry::getTableLocator()->get('NominationTypes');
        $districtTable = TableRegistry::getTableLocator()->get('LgdDistricts');
        $languagesTable = TableRegistry::getTableLocator()->get('Languages');
        $subjectsTable = TableRegistry::getTableLocator()->get('Subjects');
        $postsTable = TableRegistry::getTableLocator()->get('Posts');
        $staffsDesignationsTable = TableRegistry::getTableLocator()->get('StaffsDesignations');

        
        $appointmentTypesTable = TableRegistry::getTableLocator()->get('AppointmentTypes');
        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $disabilityTypesTable = TableRegistry::getTableLocator()->get('DisabilityTypes');
        $mediumsTable = TableRegistry::getTableLocator()->get('Mediums');


        
        $casteValidAuthorityTable = TableRegistry::getTableLocator()->get('CasteValidAuthority');


                   
        $staffUPDetails = $staffUpdateModeTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();


        $staffDetails->address = $staffAddressesTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();

     
        
 
        $relationships = $relationshipsTable->find()
                        ->all();

        $nominations = $nominationTypesTable->find()
                        ->all();

        $districts = $districtTable->find()
                        ->all();
        $languages = $languagesTable->find()
                        ->all();
        $casteValidAuthority = $casteValidAuthorityTable->find()
                        ->all();

        $subjects = $subjectsTable->find()
                        ->all();
        $appointment_types = $appointmentTypesTable->find()
                        ->all();
        $posts = $postsTable->find()->all();
        
        $staffsDesignations = $staffsDesignationsTable->find()->all();


        $castes = $casteCategoriesTable->find()
                        ->all();

        $horizontalCategories = $horizontalCategoriesTable->find()->where(['active' => 1])
                        ->all();

                      

        $disabilityTypes = $disabilityTypesTable->find()
                        ->all();

                        
                        
        $mediums = $mediumsTable->find()
                        ->all();
                        
                        
        /*echo "<pre>";
       print_r($relationships);  
       exit;*/
      
        /*
        if (!$staff) {
            $this->Flash->error('Teacher record not found.');
            return $this->redirect(['action' => 'teachingStaff']);
        }*/

           
        $this->set('staff', $staffDetails);
        $this->set('updateMode', $staffUPDetails->mode);
        $this->set('relationships', $relationships);
        $this->set('nominations', $nominations);
        $this->set('districts', $districts);
        $this->set('languages', $languages);
        $this->set('subjects', $subjects);
        $this->set('appointment_types', $appointment_types);
        $this->set('posts', $posts);  
        $this->set('staffsDesignations', $staffsDesignations);  

        
        $this->set('castes', $castes); 

        $this->set('horizontalCategories', $horizontalCategories); 
        $this->set('disabilityTypes', $disabilityTypes);
        $this->set('mediums', $mediums);

        

        

        

        
        $this->set('casteValidAuthority', $casteValidAuthority);

        
        
        

    }

    

  }
