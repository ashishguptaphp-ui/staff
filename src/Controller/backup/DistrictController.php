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
use Cake\Core\Configure;
use Laminas\Diactoros\UploadedFile;
use App\Service\EsdlStorageService;

//App\Controller\stdClass


class DistrictController extends AppController
{
    private $user_id;
    private $username;
    private $UD;
    private $did;
    private $dcode;
    private $statuses;

    private $Jurisdiction;
    
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
            'processIndividualApprovalOrder','ng2gApproveTransfer','ng2gRejectTransfer','users','editUser'
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

       
        if ($role !== 'district') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->user_id = $this->request->getSession()->read('Auth.User.id');
        $this->username = $this->request->getSession()->read('Auth.User.username');
     

        $user = $this->request->getSession()->read('Auth.User');
        $district = $this->request->getSession()->read('Auth.District');
        
        $this->did =  $district->id;
        $this->dcode =  $district->code;
        $this->Jurisdiction =  $district->Jurisdiction;

         $this->statuses = [
                        'eo_primary_desk_pending',
                        'eo_secondary_desk_pending'
                    ];

                    

        /*echo "<pre>";
        print_r( $district);
        exit;*/
        $this->set('user', $user);
        $this->set('district', $district);
       
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }

    public function users()
    {
         $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('district');
        $userspre = substr($this->username, 0, 8);
        $userLists = [
                        $userspre.'CLR',
                        $userspre.'SUP',
                    ];


        $usersTable = TableRegistry::getTableLocator()->get('Users');

        $users = $usersTable
                        ->find()
                        ->select(['id', 'username', 'full_name', 'mobile', 'email'])
                        ->where(['username IN' => $userLists])->all();

         
        $this->set('users', $users);

     
    }

    public function editUser()
    {
        
        $this->request->allowMethod(['post', 'put']);

        $usersTable = TableRegistry::getTableLocator()->get('Users');

        $userId = $this->request->getData('user_id');
        $mobile = $this->request->getData('mobile');
        $email  = $this->request->getData('email');

        $responseData = ['status' => 'error', 'message' => 'An unknown error occurred.'];

        if (empty($userId)) {
            $responseData = ['status' => 'error', 'message' => 'Missing User ID target.'];
        } else {
            try {
                // 3. Find the specific user profile
                $user = $usersTable->get($userId);

                // 4. Safely patch only the explicit allowed properties
                $user = $usersTable->patchEntity($user, [
                    'mobile' => $mobile,
                    'email' => $email
                ]);

                // 5. Save the updated entity data to MySQL
                if ($usersTable->save($user)) {
                    $responseData = [
                        'status' => 'success',
                        'message' => 'User records updated successfully!',
                        'data' => [
                            'id' => $user->id,
                            'mobile' => $user->mobile,
                            'email' => $user->email
                        ]
                    ];
                } else {
                    // Collect model validation rule errors if save fails
                    $responseData = [
                        'status' => 'error',
                        'message' => 'Validation processing failed.',
                        'errors' => $user->getErrors() 
                    ];
                }

            } catch (RecordNotFoundException $e) {
                $responseData = ['status' => 'error', 'message' => 'User record does not exist in database.'];
            }
        }

        // 6. Output clean JSON stream directly back to jQuery
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($responseData));
    }

    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('district');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        //$schools = $schoolsTable->find()->where(['cluster_code' => $this->username])->all();

        $schools = $schoolsTable->find()
                ->join([
                    'Clusters' => [
                        'table' => 'clusters',
                        'type' => 'INNER',
                        'conditions' => 'Clusters.code = Schools.cluster_code'
                    ],
                    'Blocks' => [
                        'table' => 'blocks',
                        'type' => 'INNER',
                        'conditions' => 'Blocks.code = Clusters.block_code::int'
                    ]
                ])
                ->where([
                    'Blocks.district_code' => (int) $this->dcode
                ])
                ->all();

        /*echo "<pre>";
        print_r($schools);
        exit;*/
       
        $totalSchools = $schools->count();
        // Schools with school_close = 'NO'
        $openSchools = $schools->filter(function ($school) {
            return $school->school_close === 'NO';
        })->count();
        $closeSchools = $totalSchools - $openSchools;



        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        

        $ng2gCount = $staffTransfersTable->find()
                ->select(['StaffTransfers.id'])
                 ->join([
                    'Schools' => [
                        'table' => 'schools',
                        'type' => 'INNER',
                        'conditions' => 'StaffTransfers.udise_number = Schools.udise_code'
                    ],
                    'Clusters' => [
                        'table' => 'clusters',
                        'type' => 'INNER',
                        'conditions' => 'Clusters.code = Schools.cluster_code'
                    ],
                    'Blocks' => [
                        'table' => 'blocks',
                        'type' => 'INNER',
                        'conditions' => 'Blocks.code = Clusters.block_code::int'
                    ]
                    
                ])     
                ->where([
                    'StaffTransfers.status IN' => $this->statuses,
                    'StaffTransfers.stage1_fwd_to' => $this->Jurisdiction,
                    'StaffTransfers.stage1_fwd_to_target' => (int) $this->dcode
                ])                
            ->count();


        
               
                
        $postWorkingTable = $this->fetchTable('PostWorking');

        $im_ng2gCount = $postWorkingTable->find()
                ->select(['transfer_id' => 'snt.id'])
                ->enableAutoFields(true)

            ->innerJoin(
                ['Schools' => 'schools'],
                'Schools.udise_code = PostWorking.udise_code'
            )
            ->leftJoin(
                ['am' => 'aid_master'],
                ['am.id = PostWorking.aid_id']
            )
            ->leftJoin(
                ['p' => 'posts'],
                [
                    'p.code = PostWorking.post_id',
                    'p.staff_type = PostWorking.post_type'
                ]
            )
            ->leftJoin(
                ['snt' => 'staff_ng2g_transfers'],
                ['snt.post_working_id = PostWorking.id']
            )
            ->where([
                'snt.status' => 'individual_order_eo_pending',
                'snt.fwd_to' => 1,
                'snt.fwd_to_target' => (int) $this->dcode,
               // 'PostWorking.ac_year' => $acYear,
                'PostWorking.aid_id IN' => [2,3,4,5,6]
            ])

            ->order([
                'PostWorking.date_of_joining' => 'ASC'
            ])
            ->count();
            

        /* 
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

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
                 'Sansthas' => [
                    'table' => 'sansthas',
                    'type' => 'INNER',
                    'conditions' => 'Sansthas.code = Schools.sanstha_code'
                ]
            ])
            ->where(['schools.sanstha_code' => $this->username])
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
            ->join([
                'Schools' => [
                    'table' => 'schools',
                    'type' => 'INNER',
                    'conditions' => 'Schools.udise_code = Staffs.udise_code'
                ],
                 'Sansthas' => [
                    'table' => 'sansthas',
                    'type' => 'INNER',
                    'conditions' => 'Sansthas.code = Schools.sanstha_code'
                ]
            ])
           ->where(['schools.sanstha_code' => $this->username])     
            ->group(['staff_update_status','emp_type']);

            

        
        foreach ($onboard as $row) {
            $updateStatus[$row->staff_update_status][$row->emp_type] =  $row->count;           
        }*/
        
        
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
        $this->set('im_ng2gCount', $im_ng2gCount);
        $this->set('ng2gCount', $ng2gCount);

       // $this->set('updateStatus', $updateStatus);
        //$this->set('staffsType', $result);


        //$this->render('/Headmaster/dashboard');
    }

    public function ng2gReturnedTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('district-superintendent');
    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        
        
        if($this->Jurisdiction == 1){
            $status= ['eo_primary_desk_returned','eo_primary_desk_forwarded'];
        }else{
            $status= ['eo_secondary_desk_returned','eo_secondary_desk_forwarded'];                   
        }
        


        $ng2g = $staffTransfersTable->find()
                ->select([
                            'block' => 'Blocks.name',
                            'cluster' => 'Clusters.name',
                            'StaffTransfers.id', 
                            'StaffTransfers.created_at', 
                            'StaffTransfers.staff_id', 
                            'StaffTransfers.employee_name', 
                            'StaffTransfers.designation',
                            'institution_name', 
                            'StaffTransfers.created_at',  // newly added
                            'StaffTransfers.school_name', 
                            'StaffTransfers.school_name_at_transfer', 
                            'StaffTransfers.staff_type_name', 
                            'StaffTransfers.aid_name',
                            'StaffTransfers.status'
                            ])
                 ->join([
                    'Schools' => [
                        'table' => 'schools',
                        'type' => 'INNER',
                        'conditions' => 'StaffTransfers.udise_number = Schools.udise_code'
                    ],
                    'Clusters' => [
                        'table' => 'clusters',
                        'type' => 'INNER',
                        'conditions' => 'Clusters.code = Schools.cluster_code'
                    ],
                    'Blocks' => [
                        'table' => 'blocks',
                        'type' => 'INNER',
                        'conditions' => 'Blocks.code = Clusters.block_code::int'
                    ]
                    
                ])     
                ->where([

                    'StaffTransfers.status IN' => $status,
                    'StaffTransfers.stage1_fwd_to' => $this->Jurisdiction,
                    'StaffTransfers.stage1_fwd_to_target' => (int) $this->dcode
                ])
                ->orderBy([
                    'StaffTransfers.id' => 'ASC'
                ])
                
            ->all();
        /*echo "<pre>";
        echo "<hr>". $this->dcode;
        echo count($ng2g);
        print_r($ng2g);
        exit;*/
        $this->set('ng2g', $ng2g);
    }
    public function pendingIndividualApproval()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('district');

        $acYear = "2025-26";

        $storage = new EsdlStorageService();
       
        /*
        
        $fileName = $storage->signedUrl('prod/staff/transfer_orders/707/1774861578_ipro.pdf');
        exit;*/


        $postWorkingTable = $this->fetchTable('PostWorking');

        $ng2g = $postWorkingTable->find()
                ->distinct()
                ->select([
                'PostWorking.post_type',
                'PostWorking.unaided_vaiyaktik_manyata',
                'PostWorking.post_id',
                'post_name' => 'p.name',
                'PostWorking.aid_id',
                'aid_name'  => 'am.name',
                'school_name' => 'Schools.school_name',

                // New fields from staff_ng2g_transfers
                'transfer_id' => 'snt.id',
                'status' => 'snt.status',
                'personal_recognition_number' => 'snt.personal_recognition_number',
                'personal_recognition_date' => 'snt.personal_recognition_date',
                'personal_recognition_file' => 'snt.personal_recognition_file'
            ])
            ->enableAutoFields(true)

            ->innerJoin(
                ['Schools' => 'schools'],
                'Schools.udise_code = PostWorking.udise_code'
            )
            ->leftJoin(
                ['am' => 'aid_master'],
                ['am.id = PostWorking.aid_id']
            )
            ->leftJoin(
                ['p' => 'posts'],
                [
                    'p.code = PostWorking.post_id',
                    'p.staff_type = PostWorking.post_type'
                ]
            )
            ->leftJoin(
                ['snt' => 'staff_ng2g_transfers'],
                ['snt.post_working_id = PostWorking.id']
            )
            ->where([
                'snt.status' => 'individual_order_eo_pending',
                //'snt.fwd_to' => 1,
                'snt.fwd_to' => $this->Jurisdiction,                
                'snt.fwd_to_target' => (int) $this->dcode,
                'PostWorking.ac_year IN' => [$acYear,'2026-27'],
                //'PostWorking.ac_year' => $acYear,
                'snt.personal_recognition_file IS NOT NULL',
                'PostWorking.aid_id IN' => [2,3,4,5,6]
            ])

            ->order([
                'PostWorking.date_of_joining' => 'ASC'
            ])
            ->all();

        foreach ($ng2g as $row) {

            if (!empty($row->personal_recognition_file)) {
                 $row->personal_recognition_file = $storage->signedUrl(
                    $row->personal_recognition_file
                );
            }
        }
       /*echo "<pre>";
       print_r($ng2g);
       exit;*/
        $this->set('ng2g', $ng2g);

    }

    public function processIndividualApprovalOrder()
    {
       
        //$this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
       
      

        $files = $this->request->getUploadedFiles();

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
            /* ===============================
            * 1. SAVE STAFF TRANSFER (TEXT)
            * =============================== */
           
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            if (!empty($data['app_id'])) {
                //$transfer = $staffTransferTable->get(['post_working_id' => $data['app_id']]);
                $transfer = $staffTransferTable->find()->where(['post_working_id' => $data['app_id']])->first();
               
            } else {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to save staff transfer'
                    ]));
            }

            if(isset($data['im_outward_fwd_np']) && $data['im_outward_fwd_np'] == 1){
                $status = 'individual_order_np_pending';
            }else{
                if($data['im_outward_match'] == 1){
                    $status = 'sanstha_application_pending';
                }else{
                    $status = 'individual_order_rejected_by_eo';
                }
            }
           
            $staffData = [
                'status'            => $status,
               // 'im_outward_match_eo_np_fwd_status'  => $data['im_outward_fwd_np'] ?? null, 
                'im_outward_match_eo_status'  => $data['im_outward_match'] ?? null, 
                'im_outward_match_eo_remark'  => $data['im_outward_matchremark'] ?? null,
                'im_outward_match_eo_user_id' => $this->user_id,
                'im_outward_match_eo_date'  => time()
            ];
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if (!$staffTransferTable->save($transfer)) {
                $ng2g_id= $transfer->id;
                $stTime = time();
                $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
                $logData = [
                    'ng2g_id'      => $ng2g_id,
                    'transaction_id' => $stTime,
                    'app_stage'    => $app_stage,
                    'stage_remark' => $data['im_outward_matchremark'] ?? null,
                    'created_by'   => $this->user_id,
                    'created_at'   => $stTime
                ];
                $log = $ng2gApplicationLogsTable->newEntity($logData);
                if ($ng2gApplicationLogsTable->save($log)){     
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Unable to save staff transfer'
                        ]));
                }
            }

            

            $connection->commit();

            /* ===============================
            * 4. JSON Response
            * =============================== */
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $transfer->id,
                    'message' => 'Transfer details saved successfully'
                ]));

           

        } catch (\Throwable $e) {
            $connection->rollback();

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' => $e->getMessage()
                ]));
        }
    }


    public function ng2gTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('district');
    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        

        $ng2g = $staffTransfersTable->find()
                ->select([
                            'block' => 'Blocks.name',
                            'cluster' => 'Clusters.name',
                            'StaffTransfers.id', 
                            'StaffTransfers.created_at', 
                            'StaffTransfers.staff_id', 
                            'StaffTransfers.employee_name', 
                            'StaffTransfers.designation',
                            'institution_name', 
                            'StaffTransfers.created_at',  // newly added
                            'StaffTransfers.school_name', 
                            'StaffTransfers.school_name_at_transfer', 
                            'StaffTransfers.staff_type_name', 
                            'StaffTransfers.aid_name',
                            'StaffTransfers.status'
                            ])
                 ->join([
                    'Schools' => [
                        'table' => 'schools',
                        'type' => 'INNER',
                        'conditions' => 'StaffTransfers.udise_number = Schools.udise_code'
                    ],
                    'Clusters' => [
                        'table' => 'clusters',
                        'type' => 'INNER',
                        'conditions' => 'Clusters.code = Schools.cluster_code'
                    ],
                    'Blocks' => [
                        'table' => 'blocks',
                        'type' => 'INNER',
                        'conditions' => 'Blocks.code = Clusters.block_code::int'
                    ]
                    
                ])     
                ->where([
                    'StaffTransfers.status IN' => $this->statuses,
                    'StaffTransfers.stage1_fwd_to' => $this->Jurisdiction,
                    'StaffTransfers.stage1_fwd_to_target' => (int) $this->dcode
                ])
                ->orderBy([
                    'StaffTransfers.id' => 'ASC'
                ])
                
            ->all();
        /*echo "<pre>";
        echo "<hr>". $this->dcode;
        echo count($ng2g);
        print_r($ng2g);
        exit;*/
        $this->set('ng2g', $ng2g);

        

    }

    public function ng2gApproveTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        
        /*echo "<pre>";
       
        print_r( $data);
        exit;*/
        $files = $this->request->getUploadedFiles();

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
           
           
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            
            if (!empty($data['ng2g_id'])) {
                $transfer = $staffTransferTable->get($data['ng2g_id']);
            }else{
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }

            if($transfer->id < 1){
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }
            
           $app_stage = 'eo_primary_approved';
            $status= 'dyd_clerk_primary_desk_pending';
            if($transfer->stage1_fwd_to == 1){
                $app_stage = 'eo_primary_approved';
                $status= 'dyd_clerk_primary_desk_pending';
            }else if($transfer->stage1_fwd_to == 2){
                $app_stage = 'eo_secondary_approved';
                $status= 'dyd_clerk_secondary_desk_pending';
            }
            
            //'pending'::staff_update_statuses_enum
            $staffData = [               
                'status'            => $status, 
                'eo_remark'        => $data['app_remark'] ?? null,
                'eo_replied_by' => $this->user_id,
                'eo_replied_at'  =>  time()           

            ];
            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/transfers/'.$transfer->id;

           

            if (!empty($data['app_doc']) && $data['app_doc']->getError() === UPLOAD_ERR_OK) {

                $file = $data['app_doc'];
                
                if ($file->getClientMediaType() !== 'application/pdf') {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be a PDF File'
                        ]));
                }

                if ($file->getSize() > (2 * 1024 * 1024)) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit File'
                        ]));
                }

                if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Invalid File'
                        ]));
                    //$this->Flash->error('Invalid file');
                }


                // Get temp path safely
                $tmpPath = $file->getStream()->getMetadata('uri');

                // Extract extension (safe)
                $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                // New filename
                $newFileName = 'eo_replied_file.' . $extension;

                // Create NEW UploadedFile object
                $renamedFile = new UploadedFile(
                    $tmpPath,
                    $file->getSize(),
                    $file->getError(),
                    $newFileName,
                    $file->getClientMediaType()
                );

                $storage = new EsdlStorageService();
                $fileName = $storage->upload($renamedFile, $bucketPath);

                $staffData['eo_replied_file'] = $fileName;
            } 
    
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'
                    ]));
            }

            if (!$staffTransferTable->save($transfer)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to approve staff transfer'
                    ]));
            }

            $ng2g_id = $transfer->id;            
            $stTime = time();
            $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
            $logData = [
                'ng2g_id'      => $ng2g_id,
                'transaction_id' => $stTime,
                'app_stage'    => $app_stage,
                'stage_remark' => $data['app_remark'] ?? null,
                'created_by'   => $this->user_id,
                'created_at'   => $stTime
            ];

            $log = $ng2gApplicationLogsTable->newEntity($logData);

            if (!$ng2gApplicationLogsTable->save($log)){
                $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to Approve Application'
                    ]));  
            }

            $connection->commit();

            /* ===============================
            * 4. JSON Response
            * =============================== */
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $transfer->id,
                    'message' => 'Transfer application approved successfully'
                ]));

           

        } catch (\Throwable $e) {
            $connection->rollback();

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' => $e->getMessage()
                ]));
        }
    }
 
    public function ng2gRejectTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        
        /*echo "<pre>";
       
        print_r( $data);
        exit;*/
        $files = $this->request->getUploadedFiles();

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
           
           
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            
            if (!empty($data['ng2g_id'])) {
                $transfer = $staffTransferTable->get($data['ng2g_id']);
            }else{
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }

            if($transfer->id < 1){
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }
        
            
            //'pending'::staff_update_statuses_enum
            $staffData = [               
                'status'            => 'eo_rejected', 
                'eo_remark'        => $data['reject_remark'] ?? null,
                'eo_replied_by' => $this->user_id,
                'eo_replied_at'  =>  time()           

            ];
            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/transfers/'.$transfer->id;

            
                

            if (!empty($data['reject_doc']) && $data['reject_doc']->getError() === UPLOAD_ERR_OK) {

                $file = $data['reject_doc'];
                
                if ($file->getClientMediaType() !== 'application/pdf') {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be a PDF File'
                        ]));
                }

                if ($file->getSize() > (2 * 1024 * 1024)) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit File'
                        ]));
                }

                if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Invalid File'
                        ]));
                    //$this->Flash->error('Invalid file');
                }


                // Get temp path safely
                $tmpPath = $file->getStream()->getMetadata('uri');

                // Extract extension (safe)
                $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                // New filename
                $newFileName = 'eo_replied_file.' . $extension;

                // Create NEW UploadedFile object
                $renamedFile = new UploadedFile(
                    $tmpPath,
                    $file->getSize(),
                    $file->getError(),
                    $newFileName,
                    $file->getClientMediaType()
                );

                $storage = new EsdlStorageService();
                $fileName = $storage->upload($renamedFile, $bucketPath);

                $staffData['eo_replied_file'] = $fileName;
            } 
    
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'
                    ]));
            }

            if (!$staffTransferTable->save($transfer)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to reject staff transfer'
                    ]));
            }

            $app_stage = 'eo_primary_rejected';          
            if($transfer->stage1_fwd_to == 1){
                $app_stage = 'eo_primary_rejected';             
            }else if($transfer->stage1_fwd_to == 2){
                $app_stage = 'eo_secondary_rejected';               
            }

            
            $ng2g_id = $transfer->id;            
            $stTime = time();
            $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
            $logData = [
                'ng2g_id'      => $ng2g_id,
                'transaction_id' => $stTime,
                'app_stage'    => $app_stage,
                'stage_remark' => $data['reject_remark'] ?? null,
                'created_by'   => $this->user_id,
                'created_at'   => $stTime
            ];

            $log = $ng2gApplicationLogsTable->newEntity($logData);

            if (!$ng2gApplicationLogsTable->save($log)){
                $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to reject Application'
                    ]));  
            }
            $connection->commit();

            /* ===============================
            * 4. JSON Response
            * =============================== */
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $transfer->id,
                    'message' => 'Transfer application rejected successfully'
                ]));

           

        } catch (\Throwable $e) {
            $connection->rollback();

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' => $e->getMessage()
                ]));
        }
    }
    
  }
