<?php

namespace App\Controller\Recruit;

use App\Controller\AppController;
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
use Dompdf\Dompdf;
use Dompdf\Options;


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
            'processIndividualApprovalOrder',
            'ng2gApproveTransfer',
            'ng2gRejectTransfer',
            'users',
            'editUser',
            'advertisementVacancyAjax',
            'advertisementPostApprovel',
            'addApplicationLog',
            'staffOnboardGenrateFile',
            'staffOnboardReject',
            'headerUpload',
            'headerDelete'
        ]);



        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
        }
        
        $sessionUser = $this->request->getSession()->read('Auth.User');
       
        if (!$sessionUser) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
        }

        $role = $user->getOriginalData()->role ?? null;

       
        if ($role !== 'district') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
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
        $this->viewBuilder()->setLayout('recruit-district');
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
        $this->viewBuilder()->setLayout('recruit-district');

      /*  $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

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

      
        $totalSchools = $schools->count();
        // Schools with school_close = 'NO'
        $openSchools = $schools->filter(function ($school) {
            return $school->school_close === 'NO';
        })->count();
        $closeSchools = $totalSchools - $openSchools; 
        */

        $postAdvertisementTable = $this->fetchTable('PostAdvertisement');
        $advertisementStatusCounts = [
            'total' => 0,
            'pending' => 0,
            'approved' => 0,
            'rejected' => 0,
            'resubmission' => 0
        ];

        $advertisementStatusRows = $postAdvertisementTable->find()
            ->select([
                'status' => 'PostAdvertisement.status',
                'count' => $postAdvertisementTable->find()->func()->count('PostAdvertisement.id')
            ])
            ->innerJoin(
                ['Sansthas' => 'sansthas'],
                'Sansthas.code = PostAdvertisement.institution_code'
            )
            ->where([
                //'Sansthas.district_code' => (int)$this->dcode
            ])
            ->group(['PostAdvertisement.status'])
            ->all();

   

        foreach ($advertisementStatusRows as $statusRow) {
            $count = (int)$statusRow->count;
            $advertisementStatusCounts['total'] += $count;

            if ($statusRow->status === 'pending') {
                $advertisementStatusCounts['pending'] = $count;
            } elseif ($statusRow->status === 'approved') {
                $advertisementStatusCounts['approved'] = $count;
            } elseif ($statusRow->status === 'rejected') {
                $advertisementStatusCounts['rejected'] = $count;
            } elseif (in_array($statusRow->status, ['send_back_correction', 'resubmission_required'], true)) {
                $advertisementStatusCounts['resubmission'] += $count;
            }
        }

        /*$staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        

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

        */
        
               
                
        /*$postWorkingTable = $this->fetchTable('PostWorking');

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
            */

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
        //$this->set('schools', $schools);
        ///$this->set('totalSchools', $totalSchools);
        //$this->set('openSchools', $openSchools);
        //$this->set('closeSchools', $closeSchools);
        $this->set('advertisementStatusCounts', $advertisementStatusCounts);
       // $this->set('im_ng2gCount', $im_ng2gCount);
       // $this->set('ng2gCount', $ng2gCount);

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


     public function advertisementList()
    {
      
        $districtTable = TableRegistry::getTableLocator()->get('Districts');
        $districts = $districtTable->find()->all();
        $regionTable = TableRegistry::getTableLocator()->get('Regions');
        $regions = $regionTable->find()->all();
        
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-district');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();

        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategoriesDetails = $casteCategoriesTable->find()->all();

        
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategoriesDetails = $horizontalCategoriesTable->find()->all();
         
        $acYear = ["2025-26","2026-27"];
        $postWorkingTable = $this->fetchTable('PostWorking');

        $postAdvertisementTable = $this->fetchTable('PostAdvertisement');
        $ng2g = $postAdvertisementTable->getAdvertisementList();

        
       
       

        $ddovacantTable = $this->fetchTable('DdoVacantMaster');    
        $PostAdvertisementVacanciesTable = $this->fetchTable('PostAdvertisementVacancies');
        $usedPostIds = $PostAdvertisementVacanciesTable->find()
                        ->select(['post_id'])
                        ->where(['post_id IS NOT' => null]);
                        
        $ddovacant = $ddovacantTable->find()
                       ->select([
                        'DdoVacantMaster.id',
                        'DdoVacantMaster.post_name',
                        'DdoVacantMaster.post_id',
                        'school_name' => 'schools.school_name',
                        'udise_code' => 'schools.udise_code',                       
                    ])  
                     ->enableAutoFields(true)
                    ->innerJoin(
                        ['Schools' => 'schools'],
                        'CAST(Schools.udise_code AS VARCHAR) = DdoVacantMaster.school_udise_code'
                    ) 
                    ->innerJoin(
                        ['Sansthas' => 'sansthas'],
                        'Schools.sanstha_code = Sansthas.code'
                    )  
                      ->where([
                        'DdoVacantMaster.id NOT IN' => $usedPostIds,
                    ])
                    /* ->where([
                        'Schools.sanstha_code' => $this->username,
                    ])*/ 
                    ->all();

        $approvedLogDocuments = [];
        $rejectLogDocuments = [];
        $applicationIds = array_map(static function ($post): int {
            return (int)$post->id;
        }, $ng2g->toArray());

        
        if ($applicationIds !== []) {
            $logsTable = TableRegistry::getTableLocator()->get('PostAdvertisementAuditLogs');
            $approvedLogs = $logsTable->find()
                ->select(['post_advertisement_id', 'stage_doc', 'created_at'])
                ->where([
                    'post_advertisement_id IN' => $applicationIds,
                    'new_status' => 'approved',
                    'stage_doc IS NOT' => null,
                ])
                ->order(['created_at' => 'DESC'])
                ->all();

            foreach ($approvedLogs as $approvedLog) {
                $approvedLogDocuments[(int)$approvedLog->post_advertisement_id] ??= $approvedLog->stage_doc;
            }

             $rejectLogs = $logsTable->find()
                ->select(['post_advertisement_id', 'stage_doc', 'created_at'])
                ->where([
                    'post_advertisement_id IN' => $applicationIds,
                    'new_status' => 'rejected',
                    'stage_doc IS NOT' => null,
                ])
                ->order(['created_at' => 'DESC'])
                ->all();

            
            foreach ($rejectLogs as $rejectLog) {
                $rejectLogDocuments[(int)$rejectLog->post_advertisement_id] ??= $rejectLog->stage_doc;
            }
        }

        //echo "<pre>";print_r($approvedLogDocuments);exit;
        $this->set('ddovacant', $ddovacant);               
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);        
        $this->set('districts', $districts);
        $this->set('regions', $regions);
        $this->set('approvedLogDocuments', $approvedLogDocuments);
        $this->set('rejectLogDocuments', $rejectLogDocuments);

    }

    public function advertisementVacancyAjax()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $postAdvertisementId = $data['post_id'];
        
        $ng2g = $this->fetchTable('PostAdvertisement')
                     ->getAdvertisementDetails($postAdvertisementId);   
        
       $approvalLetterUrl = null;
       if ($ng2g && !empty($ng2g->approval_letter)) {
           $storage = new EsdlStorageService();
           $approvalLetterUrl = $storage->signedUrl($ng2g->approval_letter);
       }
                    
       $sanchManyataUrls = [];
       if ($ng2g && !empty($ng2g->sanch_manyata)) {
           $storedFiles = json_decode($ng2g->sanch_manyata, true);
           if (!is_array($storedFiles)) {
               $storedFiles = ['document' => $ng2g->sanch_manyata];
           }

           $storage = new EsdlStorageService();
           foreach ($storedFiles as $udiseCode => $storedFile) {
               if (!empty($storedFile)) {
                   $sanchManyataUrls[(string)$udiseCode] =
                       $storage->signedUrl($storedFile);
               }
           }
       }             
       
        $sansthaTable = $this->fetchTable('Sansthas');
        $sansthaRecord = $sansthaTable->find()
                    ->where(['code' => $ng2g['institution_code']])
                    ->first();

        $minority_status =  (($sansthaRecord['minority_sanstha'] == 2) || ($sansthaRecord['minority_sanstha'] == 3)) ? '<span class="badge rounded-pill bg-success">Minority Sanstha ('.$sansthaRecord['sanstha_minority_name'].')</span>' : '<span class="badge rounded-pill bg-warning text-dark">Non-Minority Sanstha</span>';        
       
        
        $vacancyData = $this->fetchTable('PostAdvertisementVacancies')
                    ->getVacanciesByAdvertisement($postAdvertisementId);

         $html = '';   
         $i = 1;
         foreach($vacancyData as $dataVal){
            $html .= ' <tr> <td>'.$i.'</td>
                                <td>'.$dataVal['school_name'].'</td>
                                <td>'.$dataVal['school_udise_code'].' </td>                                    
                                <td> '.$dataVal['post_name'].'</td>
                                  <td> '.$dataVal['category'].'</td>
                            </tr>';
             $i++;               
         }    

         $auditTable = $this->fetchTable('PostAdvertisementAuditLogs');

        $auditLogs = $auditTable->find()
            ->where([
                'post_advertisement_id' => $postAdvertisementId
            ])
            ->order([
                'created_at' => 'DESC'
            ])
            ->toArray();

        $audithtml = '';
        $j = 1;
       
        if (!empty($auditLogs)) {
            foreach ($auditLogs as $log) {
                 $audithtml .= ' <tr> <td>'.$j.'</td>
                                <td>'.$log->created_at.'</td>
                                <td>'.$log->user_name.' </td>                                    
                                <td> '.$this->getAuditActionBadge($log->action).'</td>
                                <td> '.$log->previous_status.'</td>
                                <td> '.$log->new_status.'</td>
                                <td> '.$log->remarks.'</td>
                                <td> '.$log->ip_address.'</td>
                            </tr>';
             $j++;     
           
        }
        }else{
            $audithtml .='<tr> <td colspan="8"
                                                class="text-center text-muted">
                                                No audit history found.
                                            </td>
                                        </tr>';
        }
        
        $audithtmlHistory = '';
        $k = 0;
          if (!empty($auditLogs)) {
            foreach ($auditLogs as $log) {
                $is_left = ($k % 2 != 0) ? 'left' : 'right';
                $ip = ($log->ip_address === '::1')?'127.0.0.1':$log->ip_address;

                 $audithtmlHistory .= ' <div class="timeline '.$is_left.'">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <h3>'.$log->created_at.'</h3>
                                            <p class="mb-0">'.$log->user_name.' posted a '.$log->action.' update</p>
                                            <p class="mb-0"> Old status: '.$log->previous_status.' change to New status: '.$log->new_status.'</p>
                                            <p class="mb-0">'.$log->remarks.'</p>
                                            <p class="mb-0">'.$ip.'</p>
                                        </div>
                                    </div>
                                </div>';
             $k++;     
            }
        
        }else{
            $audithtmlHistory .='<div class="timeline right">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <h3 class="text-center">No audit history found.</h3>
                                        </div>
                                    </div>
                                </div>';                                            
        }


    

        return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => [
                        'ng2g'=>$ng2g,
                        'vancancyData'=>$vacancyData,
                        'sanchManyataUrls' => $sanchManyataUrls,
                        'approvalLetterUrl' => $approvalLetterUrl,
                        'auditLogsHistory' => $audithtmlHistory
                     ],
                    'html'=> $html,
                    'audithtml'=>$audithtml,
                    'minority_status'=> $minority_status,
                    'message' => 'Application forwarded successfully'
                ]));


    }

    function getAuditActionBadge(?string $action): string
        {
            $badgeClass = 'bg-secondary';
            $text = $action ?? '-';

            switch ($action) {

                case 'created':
                    $badgeClass = 'bg-secondary';
                    $text = 'Created';
                    break;

                case 'submitted':
                    $badgeClass = 'bg-primary';
                    $text = 'Submitted';
                    break;

                case 'viewed':
                    $badgeClass = 'bg-info';
                    $text = 'Viewed';
                    break;

                case 'approved':
                    $badgeClass = 'bg-success';
                    $text = 'Approved';
                    break;

                case 'rejected':
                    $badgeClass = 'bg-danger';
                    $text = 'Rejected';
                    break;

                case 'correction':
                case 'send_back_correction':
                    $badgeClass = 'bg-warning text-dark';
                    $text = 'Send Back for Correction';
                    break;

                case 'clarification':
                case 'request_clarification':
                    $badgeClass = 'bg-info';
                    $text = 'Request Clarification';
                    break;

                case 'resubmitted':
                    $badgeClass = 'bg-primary';
                    $text = 'Resubmitted';
                    break;
            }

            return '<span class="badge ' . $badgeClass . '">'
                . h($text)
                . '</span>';
        }


    public function advertisementPostApprovel(){

         $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $postAdvertisementId = $data['post_id'];
        $action = strtolower(trim($data['action'] ?? ''));
        $rejectReason = trim($data['reject_reason'] ?? '');
        $forwardReason = trim($data['remark'] ?? '');
       

          // Validate post_id
        if (empty($postAdvertisementId)) {
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Post ID is required'
                ]));
        }

        // Convert action to database status
        $statusMap = [
            'approve'       => 'approved',
            'reject'        => 'rejected',
            //'correction'    => 'send_back_correction',
            //'clarification' => 'request_clarification'
        ];

        // Validate action
        if (!isset($statusMap[$action])) {
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Invalid action'
                ]));
        }

         // Reject reason is mandatory
        if ($action === 'reject' && empty($rejectReason)) {
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Reject reason is required'
                ]));
        }

        $newStatus = $statusMap[$action];

        // Find advertisement
         $postAdvertisementTable = $this->fetchTable('PostAdvertisement');

        $postAdvertisement = $postAdvertisementTable->find()
            ->where([
                'id' => $postAdvertisementId
            ])
            ->first();

        // Check record exists
        if (!$postAdvertisement) {
            return $this->response
                ->withType('application/json')
                ->withStatus(404)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Advertisement not found'
                ]));
        }

        $previousStatus = $postAdvertisement->status;

        // Save reject reason
        if ($action === 'reject') {
            $postAdvertisement->reject_reason = $rejectReason;
        }
        
         $identity = $this->request->getAttribute('identity');

        $userId = $identity
            ? $identity->getIdentifier()
            : null;

        $stage_doc = null;
        if ($action === 'approve') {
            $stage_doc = $this->generateAdvertisementApprovalPdf($postAdvertisementId);
            if ($stage_doc === null) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(500)
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to generate the approval document'
                    ]));
            }
        }

          if ($action === 'reject') {
            $stage_doc = $this->generateAdvertisementRejectPdf($postAdvertisementId,$rejectReason);
            if ($stage_doc === null) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(500)
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to generate the approval document'
                    ]));
            }
        }


        // Persist approval only after the document has been generated.
        $postAdvertisement->status = $newStatus;

        // Save
        if ($postAdvertisementTable->save($postAdvertisement)) {

            $messages = [
                'approved' => 'Application Approved successfully',
                'rejected' => 'Application Rejected successfully',
                //'send_back_correction' => 'Application sent back for correction successfully',
                //'request_clarification' => 'Clarification requested successfully'
            ];

            $this->createAdvertisementAudit(
                    $postAdvertisementId,
                    $userId,
                    $action,
                    $previousStatus,
                    $newStatus,
                    $forwardReason,
                    1,
                    $stage_doc
                );

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => [
                        'post_id' => $postAdvertisementId,
                        'action' => $action,
                        'status' => $newStatus
                    ],
                    'message' => $messages[$newStatus]
                ]));
        }

        // Save failed
        return $this->response
            ->withType('application/json')
            ->withStatus(500)
            ->withStringBody(json_encode([
                'success' => false,
                'message' => 'Failed to update application status',
                'errors' => $postAdvertisement->getErrors()
            ]));
        
   

    }



private function generateAdvertisementRejectPdf($appId, $rejectReason): ?string
    {
        $this->autoRender = false;

        try {
            $appId = (int)$appId;
            if ($appId <= 0) {
                throw new \InvalidArgumentException('Invalid application ID');
            }

            $staffName = 'श्री. अमोल रमेश पाटील';
            $orderDate = '24-08-2026';
            $post = 'सहाय्यक शिक्षक';
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $proposalDate = '15-08-2026';

            $sansthaCode = '';
            $sansthaName = '';
            $schoolCode = '';
            $sansthaName = 'श्री शिवाजी हायस्कूल व कनिष्ठ महाविद्यालय, कोल्हापूर';

            $sourceAided = 'विना अनुदानित';
            $targetAided = 'अंशतः अनुदानित (२० टक्के)';
            $unaidedTimeFrame = 'विना अनुदान सेवा कालावधी';
            $educationQualification = 'शैक्षणिक पात्रता';
            $payScale = 'वेतनश्रेणी';
            $unaidedOrderDate = 'अनुदानित वरील नेमणुक दिनांक';
            $remark = 'शेरा';
            $status = 'मान्य';

            $refNo = 'जा.क्र.: शिसंमा-' . date('Y') . "/विना-अनु बदली आदेश/" . $staffName . "/" . sprintf('%06d', $appId);
            $letterData = [
                'ref_no' => $refNo,
                'letter_date' => $orderDate,
                'division_name' => 'पुणे',
                'proposal_number' => $proposalNumber,
                'proposal_date' => $proposalDate,
                'teacher_name' => $staffName,
                'designation' => $post,
                'sanstha_code' => $sansthaCode,
                'sanstha_name' => $sansthaName,
                'school_code' => $schoolCode,
                'school_name' => $sansthaName,
                'source_aided' => $sourceAided,
                'target_aided' => $targetAided,
                'unaided_time_frame' => $unaidedTimeFrame,
                'education_qualification' => $educationQualification,
                'pay_scale' => $payScale,
                'unaided_order_date' => $unaidedOrderDate,
                'remark' => $remark,
                'status' => $status,
            ];

            $uploadDir = WWW_ROOT . 'uploads' . DS . 'staffonboarding' . DS . 'advtreject' . DS;
            $qrcodeDir = $uploadDir . 'qrcodes' . DS;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!is_dir($qrcodeDir)) {
                mkdir($qrcodeDir, 0777, true);
            }

            $endPoint = 'uploads/staffonboarding/advtreject/advt_order_' . $appId . '.pdf';
            $outputPath = WWW_ROOT . $endPoint;
            $tempHtmlPath = $uploadDir . 'temp_advt_reject_letter.html';

            $basePath = $this->request->getAttribute('base') ?? '';
            $fullUrl = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/' . $endPoint;

            $vacancyData = $this->fetchTable('PostAdvertisementVacancies')
                    ->getVacanciesByAdvertisement($appId);

            $letterData['app_id'] = $appId;
            $letterData['Datalist'] = $vacancyData;
            $letterData['rejectReason'] = $rejectReason;
            $letterData['targetAppUrl'] = $fullUrl;
            $letterData['targetQRUrl'] = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/uploads/staffonboarding/advtreject/qrcodes/advt_order_' . $appId . '.png';
            $letterData['targetQRPath'] = $qrcodeDir . 'advt_order_' . $appId . '.png';

            //$this->generateQRCode($fullUrl, $appId);
            $html = $this->renderAdvertisementRejectLetterViewContent($letterData);

            $writeResult = file_put_contents($tempHtmlPath, $html);
            if ($writeResult === false) {
                throw new \RuntimeException('Unable to write temporary reject letter HTML.');
            }

            $wkhtmltopdfBinary = $this->findWkhtmltopdfBinary();
            if ($wkhtmltopdfBinary === null) {
                throw new \RuntimeException('wkhtmltopdf is not installed or not available in PATH.');
            }

            $cmd = sprintf(
                '%s --enable-local-file-access --encoding UTF-8 --page-size A4 %s %s',
                escapeshellarg($wkhtmltopdfBinary),
                escapeshellarg($tempHtmlPath),
                escapeshellarg($outputPath)
            );

            exec($cmd . ' 2>&1', $output, $statusCode);

            if ($statusCode !== 0 || !file_exists($outputPath)) {
                $error = implode("\n", $output);
                throw new \RuntimeException('PDF generation failed: ' . $error);
            }

            return $endPoint;
            
        } catch (\Throwable $e) {
            error_log('generateRejectLetter failed: ' . $e->getMessage());
            return null;
        }
    }


 private function renderAdvertisementRejectLetterViewContent($data): string
    {
        $base64ImageQR = '';
        if (!empty($data['targetQRPath']) && file_exists($data['targetQRPath'])) {
            $imageDataQR = base64_encode(file_get_contents($data['targetQRPath']));
            $base64ImageQR = 'data:image/png;base64,' . $imageDataQR;
        }

        $base64Image = $this->getActiveHeaderImageDataUri((int)$this->user_id);
        $todate = date('d-m-Y', time());

        $html = '<!DOCTYPE html>
                <html lang="mr">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        @page {
                            size: A4 portrait;
                            margin: 12mm;
                        }
                        body {
                            font-family: "DejaVu Sans", "Nirmala UI", "Mangal", "Arial Unicode MS", sans-serif;
                            font-size: 17px;
                            line-height: 1.7;
                            margin: 0;
                            padding: 0;
                            color: #111;
                        }
                        .letter-page {
                            width: 100%;
                            box-sizing: border-box;
                        }
                        .header-wrap {
                            text-align: center;
                            margin: 0 auto 12px auto;
                        }
                        .header-img {
                            display: block;
                            width: 180px;
                            height: auto;
                            margin: 0 auto 8px auto;
                        }
                        .letter-title {
                            font-size: 20px;
                            font-weight: 700;
                            text-align: center;
                            margin-top: 6px;
                            letter-spacing: 0.5px;
                        }
                        .qrcode-img {
                            width: 300px;
                            border:2px solid #1da5bd;
                        }
                        .meta-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 15px;
                        }
                        .meta-table td {
                            vertical-align: top;
                            padding: 2px 0;
                        }
                        .text-right {
                            text-align: right;
                        }
                        .recipient {
                            margin: 15px 0;
                            line-height: 1.6;
                        }
                        .subject-box {
                            font-weight: bold;
                            margin: 15px 0;
                            padding: 6px 10px;
                            background-color: #f4f4f4;
                            border-left: 3px solid #666;
                        }
                        .reference {
                            margin-bottom: 15px;
                        }
                        .content {
                            text-align: justify;
                            text-indent: 30px;
                            margin-top: 15px;
                            line-height: 1.8;
                        }
                        .content p {
                            margin: 10px 0;
                        }
                        .signature-table {
                            width: 100%;
                            margin-top: 50px;
                            border-collapse: collapse;
                            page-break-inside: avoid;
                        }
                        .copy-section {
                            margin-top: 40px;
                            padding-top: 10px;
                            border-top: 1px dashed #aaa;
                            font-size: 13px;
                            page-break-inside: avoid;
                        }
                        .right {
                            float:right;
                        }
                        .signature-wrap {
                            width: 100%;
                            margin-top: 40px;
                            clear: both;
                        }
                        .signature-block {
                            float: right;
                            width: 260px;
                            text-align: right;
                            margin-top: 10px;
                            margin-bottom: 10px;
                        }
                        .signature {
                            text-align: right;
                            margin: 0;
                        }
                        .copy-to {
                            margin-top: 70px;
                            clear: both;
                            font-weight: 600;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            table-layout: fixed;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 6px 4px;
                            vertical-align: top;
                            text-align: center;
                            word-wrap: break-word;
                        }
                    </style>
                </head>
                <body>
                <div class="letter-page">
                    ' . (!empty($base64Image) ? '<div class="header-wrap"><img class="header-img" src="' . $base64Image . '"></div>' : '') . '
                    <div class="letter-title">शासन आदेश</div>

                    <div>
                        आदेश :-
                    </div>

                
               <br>
                <div class="subject">
                    विषय :- कनिष्ठ लिपिक प्रयोगशाळा सहाय्यक / ग्रंथपाल / भरतीसाठी जाहीरात परवानगी बाबत.
                </div>
                <br>
                <div>
                      संदर्भ :-
                    <br>
                    ' . $this->transliterateToMarathi("१. शासन निर्णय दिनांक ११/०८/२०२६ व दि.१६/०८/२०२६ नुसार.
                    <br>
                    २. आपल्या  संस्थेची  जाहीरात  परवानगी  मागणी  दि १६/०८/२०२६ ") . ' </div>

                <div class="content">
                    <p>संस्थेने दि. ________ रोजी सादर केलेल्या प्रस्तावाची पडताळणी केली असता,शिक्षकेतर पदभरतीची मागणी खालीलप्रमाणे आहे.</p>
                    <table style="width:100%;border:1px solid green;">
                        <tr>
                            <th>अ.क्र.</th>
                            <th>संस्थेचे नाव </th>
                            <th>संस्था कोड</th>
                            <th>पदभरतीच्या पदांचा तपशील</th>
                            <th>संवर्ग</th>
                            <th>पदसंख्या</th>
                             <th>वेतनश्रेणी</th>
                        </tr>';
                    $i = 1;
                     foreach ($data['Datalist'] as $item) {
                        $html .= '<tr>
                            <td>' . h($i) . '.</td>
                            <td>' . h($item['school_name']) . '</td>
                            <td>' . h($item['school_udise_code']) . '</td>
                            <td>' . h($item['post_name']) . '</td>
                            <td>' . h($item['category']) . '</td>
                            <td>' . h($item['vacancy_count']) . '</td>
                            <td>' . h($item['pay_scale']) . '</td>
                        </tr>';
                        $i++;
                     }   
                   
                      
                  $html .='  </table>
                    <p>सादर प्रस्तावामध्ये खालीलप्रमाणे त्रुटी दिसून येतात:</p>
                    '.$data['rejectReason'].'
                    <p></p>
                    <p>सदर केलेल्या प्रस्तावामध्ये वर नमूद केलेल्या त्रुटी असल्यामुळे, जाहिरात परवानगी  प्रस्ताव अमान्य / परत करण्यात येत आहे.</p>
                </div>

        

                <div>
                        <p class="right" style="text-align:right; margin:0;">
                            स्वाक्षरी/-
                        </p>

                  
                       
                    </div>


                <div style="clear:both;"></div>
                </div>
            </body>
            </html>';

        return $html; 
    
    }


    private function generateAdvertisementApprovalPdf($appId): ?string
    {
        $this->autoRender = false;

        try {
            $appId = (int)$appId;
            if ($appId <= 0) {
                throw new \InvalidArgumentException('Invalid application ID');
            }

            $staffName = 'श्री. अमोल रमेश पाटील';
            $orderDate = '24-08-2026';
            $post = 'सहाय्यक शिक्षक';
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $proposalDate = '15-08-2026';

            $sansthaCode = '';
            $sansthaName = '';
            $schoolCode = '';
            $sansthaName = 'श्री शिवाजी हायस्कूल व कनिष्ठ महाविद्यालय, कोल्हापूर';

            $sourceAided = 'विना अनुदानित';
            $targetAided = 'अंशतः अनुदानित (२० टक्के)';
            $unaidedTimeFrame = 'विना अनुदान सेवा कालावधी';
            $educationQualification = 'शैक्षणिक पात्रता';
            $payScale = 'वेतनश्रेणी';
            $unaidedOrderDate = 'अनुदानित वरील नेमणुक दिनांक';
            $remark = 'शेरा';
            $status = 'मान्य';

            $refNo = 'जा.क्र.: शिसंमा-' . date('Y') . "/विना-अनु बदली आदेश/" . $staffName . "/" . sprintf('%06d', $appId);
            $letterData = [
                'ref_no' => $refNo,
                'letter_date' => $orderDate,
                'division_name' => 'पुणे',
                'proposal_number' => $proposalNumber,
                'proposal_date' => $proposalDate,
                'teacher_name' => $staffName,
                'designation' => $post,
                'sanstha_code' => $sansthaCode,
                'sanstha_name' => $sansthaName,
                'school_code' => $schoolCode,
                'school_name' => $sansthaName,
                'source_aided' => $sourceAided,
                'target_aided' => $targetAided,
                'unaided_time_frame' => $unaidedTimeFrame,
                'education_qualification' => $educationQualification,
                'pay_scale' => $payScale,
                'unaided_order_date' => $unaidedOrderDate,
                'remark' => $remark,
                'status' => $status,
            ];

            $uploadDir = WWW_ROOT . 'uploads' . DS . 'staffonboarding' . DS . 'advtapprove' . DS;
            $qrcodeDir = $uploadDir . 'qrcodes' . DS;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!is_dir($qrcodeDir)) {
                mkdir($qrcodeDir, 0777, true);
            }

            $endPoint = 'uploads/staffonboarding/advtapprove/advt_order_' . $appId . '.pdf';
            $outputPath = WWW_ROOT . $endPoint;
            $tempHtmlPath = $uploadDir . 'temp_advt_approval_letter.html';

            $basePath = $this->request->getAttribute('base') ?? '';
            $fullUrl = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/' . $endPoint;

            $vacancyData = $this->fetchTable('PostAdvertisementVacancies')
                    ->getVacanciesByAdvertisement($appId);

            $letterData['app_id'] = $appId;
            $letterData['Datalist'] = $vacancyData;
            $letterData['targetAppUrl'] = $fullUrl;
            $letterData['targetQRUrl'] = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/uploads/staffonboarding/advtapprove/qrcodes/advt_order_' . $appId . '.png';
            $letterData['targetQRPath'] = $qrcodeDir . 'advt_order_' . $appId . '.png';

            //$this->generateQRCode($fullUrl, $appId);
            $html = $this->renderAdvertisementApprovalLetterViewContent($letterData);

            $writeResult = file_put_contents($tempHtmlPath, $html);
            if ($writeResult === false) {
                throw new \RuntimeException('Unable to write temporary approval letter HTML.');
            }

            $wkhtmltopdfBinary = $this->findWkhtmltopdfBinary();
            if ($wkhtmltopdfBinary === null) {
                throw new \RuntimeException('wkhtmltopdf is not installed or not available in PATH.');
            }

            $cmd = sprintf(
                '%s --enable-local-file-access --encoding UTF-8 --page-size A4 %s %s',
                escapeshellarg($wkhtmltopdfBinary),
                escapeshellarg($tempHtmlPath),
                escapeshellarg($outputPath)
            );

            exec($cmd . ' 2>&1', $output, $statusCode);

            if ($statusCode !== 0 || !file_exists($outputPath)) {
                $error = implode("\n", $output);
                throw new \RuntimeException('PDF generation failed: ' . $error);
            }

            return $endPoint;
            
        } catch (\Throwable $e) {
            error_log('generateApprovalLetter failed: ' . $e->getMessage());
            return null;
        }
    }


    
    private function renderAdvertisementApprovalLetterViewContent($data): string
    {
        $base64ImageQR = '';
        if (!empty($data['targetQRPath']) && file_exists($data['targetQRPath'])) {
            $imageDataQR = base64_encode(file_get_contents($data['targetQRPath']));
            $base64ImageQR = 'data:image/png;base64,' . $imageDataQR;
        }

        $base64Image = $this->getActiveHeaderImageDataUri((int)$this->user_id);
        $todate = date('d-m-Y', time());

        $html = '<!DOCTYPE html>
                <html lang="mr">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        @page {
                            size: A4 portrait;
                            margin: 12mm;
                        }
                        body {
                            font-family: "DejaVu Sans", "Nirmala UI", "Mangal", "Arial Unicode MS", sans-serif;
                            font-size: 17px;
                            line-height: 1.7;
                            margin: 0;
                            padding: 0;
                            color: #111;
                        }
                        .letter-page {
                            width: 100%;
                            box-sizing: border-box;
                        }
                        .header-wrap {
                            text-align: center;
                            margin: 0 auto 12px auto;
                        }
                        .header-img {
                            display: block;
                            width: 180px;
                            height: auto;
                            margin: 0 auto 8px auto;
                        }
                        .letter-title {
                            font-size: 20px;
                            font-weight: 700;
                            text-align: center;
                            margin-top: 6px;
                            letter-spacing: 0.5px;
                        }
                        .qrcode-img {
                            width: 300px;
                            border:2px solid #1da5bd;
                        }
                        .meta-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 15px;
                        }
                        .meta-table td {
                            vertical-align: top;
                            padding: 2px 0;
                        }
                        .text-right {
                            text-align: right;
                        }
                        .recipient {
                            margin: 15px 0;
                            line-height: 1.6;
                        }
                        .subject-box {
                            font-weight: bold;
                            margin: 15px 0;
                            padding: 6px 10px;
                            background-color: #f4f4f4;
                            border-left: 3px solid #666;
                        }
                        .reference {
                            margin-bottom: 15px;
                        }
                        .content {
                            text-align: justify;
                            text-indent: 30px;
                            margin-top: 15px;
                            line-height: 1.8;
                        }
                        .content p {
                            margin: 10px 0;
                        }
                        .signature-table {
                            width: 100%;
                            margin-top: 50px;
                            border-collapse: collapse;
                            page-break-inside: avoid;
                        }
                        .copy-section {
                            margin-top: 40px;
                            padding-top: 10px;
                            border-top: 1px dashed #aaa;
                            font-size: 13px;
                            page-break-inside: avoid;
                        }
                        .right {
                            float:right;
                        }
                        .signature-wrap {
                            width: 100%;
                            margin-top: 40px;
                            clear: both;
                        }
                        .signature-block {
                            float: right;
                            width: 260px;
                            text-align: right;
                            margin-top: 10px;
                            margin-bottom: 10px;
                        }
                        .signature {
                            text-align: right;
                            margin: 0;
                        }
                        .copy-to {
                            margin-top: 70px;
                            clear: both;
                            font-weight: 600;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            table-layout: fixed;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 6px 4px;
                            vertical-align: top;
                            text-align: center;
                            word-wrap: break-word;
                        }
                    </style>
                </head>
                <body>
                <div class="letter-page">
                    ' . (!empty($base64Image) ? '<div class="header-wrap"><img class="header-img" src="' . $base64Image . '"></div>' : '') . '
                    <div class="letter-title">शासन आदेश</div>

                    <div>
                        आदेश :-
                    </div>

                
               <br>
                <div class="subject">
                    विषय :- कनिष्ठ लिपिक प्रयोगशाळा सहाय्यक / ग्रंथपाल / भरतीसाठी जाहीरात परवानगी बाबत.
                </div>
                <br>
                <div>
                    संदर्भ :-
                    <br>
                    ' . $this->transliterateToMarathi("१. शासन निर्णय दिनांक ११/०८/२०२६ व अधिसूचना दि.१६/०८/२०२६ नंतर.
                    <br>
                    २. आपल्या  संस्थेची  जाहीरात  परवानगी  मागणी  दि १६/०८/२०२६ ") . ' </div>

                <div class="content">
                    <p>संस्थेने दि. १६/०८/२०२६ रोजी सादर केलेल्या प्रस्तावाची पडताळणी केली असता,शिक्षकेतर पदभरतीची मागणी खालीलप्रमाणे आहे.</p>
                    <table style="width:100%;border:1px solid green;">
                        <tr>
                            <th>अ.क्र.</th>
                            <th>संस्थेचे नाव </th>
                            <th>संस्था कोड</th>
                            <th>पदभरतीच्या पदांचा तपशील</th>
                            <th>संवर्ग</th>
                            <th>पदसंख्या</th>
                             <th>वेतनश्रेणी</th>
                        </tr>';
                    $i = 1;
                     foreach ($data['Datalist'] as $item) {
                        $html .= '<tr>
                            <td>' . h($i) . '.</td>
                            <td>' . h($item['school_name']) . '</td>
                            <td>' . h($item['school_udise_code']) . '</td>
                            <td>' . h($item['post_name']) . '</td>
                            <td>' . h($item['category']) . '</td>
                            <td>' . h($item['vacancy_count']) . '</td>
                            <td>' . h($item['pay_scale']) . '</td>
                        </tr>';
                        $i++;
                     }   
                   
                      
                  $html .='  </table>

                    <p>जाहिरात परवानगी बाबत अटी व शर्ती.</p>
                    <p>१.  संस्थेने  मागणी केलेले  व या कार्यालयाकडून  बिंदुनामावली  पडताळणी  अंती  मंजूर  करून दिलेल्या संवर्गातील पदे भरणे बंधनकारक राहील.</p>
                    <p>२. शासन निर्णय दिनांक ११/०८/२०२६ आणि अधिसूचना दि. १६/०८/२०२६ मधील  तरतुदी  नुसार  शैक्षणिक अर्हता असणे  बंधनकारक राहील.</p>
                    <p>३. सदरची  भरती प्रक्रियेची  जाहीरात  स्थानिक व जादा  खपाच्या किमान २ वृत्तपत्रामध्ये प्रसारित करणे बंधनकारक राहील.</p>
                    <p>४. जाहिरात परवानगीमध्ये  दिलेल्या अटी  शर्ती पेक्षा अन्य पदे / संवर्ग  बदल केल्यास वै. मान्यता  व अनुषंगिक  कार्यवाहीसाठी  प्रस्ताव  स्वीकारला जाणार नाही.</p>
                    <p>५. सदर जिल्हा/विभागामध्ये शिक्षकेतर पद अतिरिक्त नसल्याचे प्रमाणित केले आहे.</p>
                    <p>६. संस्था अंतर्गत अनुकंपा पदभरती प्रतीक्षा यादीमध्ये नाव समाविष्ट नाही, तथापि त्याबाबत तक्रार उपलब्ध झाल्यास पदभरतीस  परवानगी रद्द केली जाईल.</p> 
                    <p></p>
                    <p>वरील अटी व शर्तींच्या अधीन राहून पदभरती जाहिरात परवानगी देण्यात येत आहे.</p>
                </div>

        

                <div>
                        <p class="right" style="text-align:right; margin:0;">
                            स्वाक्षरी/-
                        </p>

                  
                       
                    </div>


                <div style="clear:both;"></div>
                </div>
            </body>
            </html>';

        return $html; 
    
    }

    private function createAdvertisementAudit(
                        int $postAdvertisementId,
                        ?int $userId,
                        string $action,
                        ?string $previousStatus,
                        ?string $newStatus,
                        ?string $remarks = null,
                        ?int $version = null,
                        ?string $stage_doc = null,)
    {
        $auditTable = $this->fetchTable('PostAdvertisementAuditLogs');

        $request = $this->getRequest();

        $audit = $auditTable->newEntity([
            'post_advertisement_id' => $postAdvertisementId,
            'user_id' => $userId,
            'user_name' => $this->username,
            'action' => $action,
            'previous_status' => $previousStatus,
            'new_status' => $newStatus,
            'remarks' => $remarks,
            'ip_address' => $request->clientIp(),
            'user_agent' => $request->getHeaderLine('User-Agent'),
            'version' => $version,
            'stage_doc' => $stage_doc,
            'metadata' => null
        ]);

        return $auditTable->save($audit);
    }
    
    
    public function staffSeniorityList()
    {
      
        $mnp_npTable = TableRegistry::getTableLocator()->get('MnpNps');
        $mnp_nps = $mnp_npTable->find()->all();
        $districtTable = TableRegistry::getTableLocator()->get('Districts');
        $districts = $districtTable->find()->all();
        $regionTable = TableRegistry::getTableLocator()->get('Regions');
        $regions = $regionTable->find()->all();
        /*echo "<pre>";
        print_r($regions);
        exit;*/
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-district');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();

        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategoriesDetails = $casteCategoriesTable->find()->all();

       
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategoriesDetails = $horizontalCategoriesTable->find()->all();
 
              
        $postAdvertisementVacanciesTable = $this->fetchTable('PostAdvertisementVacancies');

        $ng2g = $postAdvertisementVacanciesTable->find()
            ->select([
                'id' => 'PostAdvertisementVacancies.id',
                'post_name' => 'PostAdvertisementVacancies.post_name',
                'school_name' => 'PostAdvertisementVacancies.school_name',
                'udise_code' => 'PostAdvertisementVacancies.school_udise_code',
                'post_id' => 'PostAdvertisementVacancies.post_id',
                'category' => 'PostAdvertisementVacancies.category',
                'post_advertisement_id' => 'PostAdvertisementVacancies.post_advertisement_id',
                'status' => 'SOA.status',
                'soa_id' =>'SOA.id',
                'is_onboarding_submitted' => 'CASE
                    WHEN SOA.id IS NOT NULL THEN 1
                    ELSE 0
                END'
            ])
            ->leftJoin(
                ['SOA' => 'staff_onboarding_appointments'],
                'CAST(SOA.staff_id AS TEXT) = CAST(PostAdvertisementVacancies.id AS TEXT)'
            )
            ->innerJoin(
                ['PostAdvertisement' => 'post_advertisement'],
                'PostAdvertisement.id = PostAdvertisementVacancies.post_advertisement_id'
            )
            ->where([
                'PostAdvertisement.status' => 'approved',
                 'SOA.id IS NOT' => null
                //'PostAdvertisement.institution_code' => $this->username
            ])
            ->order([
                'PostAdvertisement.created_at' => 'DESC',
                'PostAdvertisementVacancies.id' => 'ASC'
            ])
            ->all();



       //echo "<pre>"; print_r($ng2g);  exit;
                    
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);  
        $this->set('mnp_nps', $mnp_nps);
        $this->set('districts', $districts);
        $this->set('regions', $regions);


    }

 
   
    public function staffOnboardApprove()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $files = $this->request->getUploadedFiles();
        $identity = $this->request->getAttribute('identity');
        $userId = $identity ? $identity->getIdentifier() : null;  
        $connection = ConnectionManager::get('default');
        $connection->begin();
        $fileName = null;

        try {
            $StaffOnboardingAppointmentsTable = TableRegistry::getTableLocator()->get('StaffOnboardingAppointments');            
            if (!empty($data['app_id'])) {
                $onboard = $StaffOnboardingAppointmentsTable->get($data['app_id']);
            }else{
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application ID'
                            ]));
            }

            if($onboard->id < 1){
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }
            
          
            
            //'pending'::staff_update_statuses_enum
            $staffData = [               
                'status'            => 'Approved'        

            ];
            $config = Configure::read('ESDL');
            
            $bucketPath = $config['mode'].'/staff/onboarding/'.$onboard->id;        

            if (!empty($data['app_doc']) && $data['app_doc']->getError() === UPLOAD_ERR_OK) {

                $file = $data['app_doc'];
                
                if ($file->getClientMediaType() !== 'application/pdf') {
                    $connection->rollback();
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be a PDF File'
                        ]));
                }

                if ($file->getSize() > (2 * 1024 * 1024)) {
                    $connection->rollback();
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit File'
                        ]));
                }

                if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                    $connection->rollback();
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
                $newFileName = 'approved_file.' . $extension;

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

               
            } 

            if (empty($fileName)) {
                $generatedDocument = 'uploads/staffonboarding/approve/staff_order_' . $onboard->id . '.pdf';
                if (is_file(WWW_ROOT . $generatedDocument)) {
                    $fileName = $generatedDocument;
                }
            }
    
            
            $onboard = $StaffOnboardingAppointmentsTable->patchEntity($onboard, $staffData);

            if ($onboard->hasErrors()) {
                $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'
                    ]));
            }

            if (!$StaffOnboardingAppointmentsTable->save($onboard)) {
                $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to approve Staff Onboarding application'
                    ]));
            }

            if (!$this->addApplicationLog(
                                    $data['app_id'],
                                    'Approved',
                                    $userId,
                                    $data['remark'] ?? null,
                                    $fileName ?? null,
                                )) {
                throw new \RuntimeException('Unable to save approval document in application log');
            }

            
            $connection->commit();
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $onboard->id,
                    'file' => $fileName,
                    'message' => 'Staff Onboarding application approved successfully'
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
 
    public function staffOnboardReject()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $files = $this->request->getUploadedFiles();
        $identity = $this->request->getAttribute('identity');
        $userId = $identity ? $identity->getIdentifier() : null;            
        $connection = ConnectionManager::get('default');
        $connection->begin();
        $fileName = null;            
        try {
           
                    
           
            $StaffOnboardingAppointmentsTable = TableRegistry::getTableLocator()->get('StaffOnboardingAppointments');
            
            if (!empty($data['reject_id'])) {
                $staffId = !empty($data['reject_id']) ? (int)$data['reject_id'] : 0;
                $onboard = $StaffOnboardingAppointmentsTable->find()
                            ->where(['staff_id' => $staffId])
                            ->first();
                                            
            }else{
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }

            if($onboard->id < 1){
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }
        
            
            //'pending'::staff_update_statuses_enum
            $staffData = [               
                'status'            => 'Rejected', 
                
            ];
            $insertData = [];
            $config = Configure::read('ESDL');
           
            $bucketPath = $config['mode'].'/staff/onboarding/'.$onboard->id;

            
                

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
                $newFileName = 'replied_file.' . $extension;

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

                // $staffData['eo_clk_replied_file'] = $fileName;
            } 
    
            $rejectedDocumentFields = [
                'ssc_doc_chk' => 'माध्यमिक (SSC)',
                'hsc_doc_chk' => 'उच्च माध्यमिक (HSC)',
                'graduate_doc_chk' => 'पदवी (Graduate Degree)',
                'post_graduate_doc_chk' => 'पदव्युत्तर पदवी (Post Graduate Degree)',
                'adv_approval_doc_chk' => 'जाहिरात मंजूरी पत्र',
                'advertisement_doc_chk' => 'जाहिरात',
                'signature_doc_chk' => 'उमेदवारांच्या स्वाक्षरीची यादी',
                'marking_doc_chk' => 'उमेदवार गुणांकन',
                'resolution_doc_chk' => 'संस्थेचा ठराव',
                'order_doc_chk' => 'आदेश',
                'court_roster_doc_chk' => 'रोस्टर (Roster)',
                'no_post_vacant' => 'पद रिक्त नाही ',
            ];

            foreach ($rejectedDocumentFields as $checkboxName => $fieldName) {
                if (!empty($data[$checkboxName])) {
                    $insertData[] = ['rtn_field_name' => $fieldName];
                }
            }

        $insertDataText = implode(', ', array_column($insertData, 'rtn_field_name'));

        $insertDataText2 = implode('<br> ', array_map(
                function ($item, $index) {
                    return ($index + 1) . '.' . $item['rtn_field_name'];
                },
                $insertData,
                array_keys($insertData)
            ));

        if (!empty($insertDataText)) {
            if (!empty($data['reject_remark'])) {
                $data['reject_remark'] .= "\nDocuments rejected: " . $insertDataText;
            } else {
                $data['reject_remark'] = 'Documents rejected: ' . $insertDataText;
            }
        }




              if (empty($fileName)) {

               $this->generateRejectLetter($onboard->id,$insertDataText2);

                $generatedDocument = 'uploads/staffonboarding/reject/staff_order_reject_' . $onboard->id . '.pdf';
                if (is_file(WWW_ROOT . $generatedDocument)) {
                    $fileName = $generatedDocument;
                }
            }

            $onboard = $StaffOnboardingAppointmentsTable->patchEntity($onboard, $staffData);

            if ($onboard->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'
                    ]));
            }

            if (!$StaffOnboardingAppointmentsTable->save($onboard)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to reject staff onboarding application'
                    ]));
            }

            
          $this->addApplicationLog(
                                    $data['reject_id'],
                                    'rejected',
                                    $userId,
                                    $data['reject_remark'] ?? null,
                                    $fileName ?? null,
                                );

            $connection->commit();

            /* ===============================
            * 4. JSON Response
            * =============================== */
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $onboard->id,
                    'message' => 'Onboarding application rejected successfully'
                ]));

           

        } catch (\Throwable $e) {
            $connection->rollback();
            error_log('staffOnboardReject failed: ' . $e->getMessage());

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' => $e->getMessage()
                ]));
        }
    }


     private function addApplicationLog(
        int $appId,
        string $appStage,
        int $createdBy,
        ?string $stageRemark = null,
        ?string $stageDoc = null,
        int $appStageMode = 0
    ): bool {

        $staffOnboardApplicationLogsTable =
            TableRegistry::getTableLocator()->get(
                'StaffOnboardApplicationLogs'
            );
        $transactionId = time();            
        $log = $staffOnboardApplicationLogsTable->newEntity([
            'app_id'          => $appId,
            'app_stage'       => $appStage,
            'stage_remark'    => $stageRemark,
            'created_by'      => $createdBy,
            'created_at'      => time(),
            'transaction_id' => $transactionId,
            'stage_doc'      => $stageDoc,
            'app_stage_mode' => $appStageMode,
        ]);

        return (bool)$staffOnboardApplicationLogsTable->save($log);
    }


     public function staffOnboardGenrateFile()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $appId = (int)($data['app_id'] ?? 0);

        if ($appId <= 0) {
            return $this->response
                ->withStatus(400)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Application ID is required',
                ]));
        }

        $fileName = $this->generateApprovalLetter($appId);
        if ($fileName === null) {
            return $this->response
                ->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Unable to generate the approval document',
                ]));
        }

        $basePath = $this->request->getAttribute('base') ?? '';
        $pdfUrl = $this->request->scheme() . '://' . $this->request->host()
            . $basePath . '/' . ltrim($fileName, '/');

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'success' => true,
                'url' => $pdfUrl,
                'staffId' => $appId,
            ]));
    }


    public function generateApprovalLetter($appId)
    {
        $this->autoRender = false;

        try {
            $appId = (int)$appId;
            if ($appId <= 0) {
                throw new \InvalidArgumentException('Invalid application ID');
            }

       $appointmentsTable = TableRegistry::getTableLocator()->get('StaffOnboardingAppointments');

        $appointment = $appointmentsTable->find()
            ->contain(['StaffOnboardingDocuments'])
            ->where(['id' => (int)$appId])
            ->first();

            $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');

        // Get Original Category
        $originalCategory = null;
        if (!empty($appointment->original_category)) {
            $originalCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointment->original_category])
                ->first();
        }

        $originalCategoryName = $originalCategory ? $originalCategory->category_name: '-';

        $documents = $appointment->staff_onboarding_documents ?? [];
            $qualificationStr = '';
            foreach ($documents as $doc) {
                if($doc->document_type=='ssc'){
                    $qualificationStr .= 'माध्यमिक (SSC), ';

                }
                if($doc->document_type=='hsc'){
                    $qualificationStr .= 'उच्च माध्यमिक (HSC), ';
                }
                if($doc->document_type=='graduate'){
                    $qualificationStr .= 'पदवी (Graduate Degree), ';
                }
                if($doc->document_type=='post_graduate'){
                    $qualificationStr .= 'पदव्युत्तर पदवी (Post Graduate Degree), ';
                }
            }
            $qualificationStr = rtrim($qualificationStr, ', ');

$postAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies');
$postAdvertisementVacancy = $postAdvertisementVacanciesTable->find()
                            ->where(['id' => $appointment->staff_id])
                            ->first();

            $staffName = 'श्री. अमोल रमेश पाटील';
            $orderDate = '24-08-2026';
            $post = 'सहाय्यक शिक्षक';
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $proposalDate = '15-08-2026';

            $sansthaCode = '';
            $sansthaName = '';
            $schoolCode = '';
            $sansthaName = 'श्री शिवाजी हायस्कूल व कनिष्ठ महाविद्यालय, कोल्हापूर';

            $sourceAided = 'विना अनुदानित';
            $targetAided = 'अंशतः अनुदानित (२० टक्के)';
            $unaidedTimeFrame = 'विना अनुदान सेवा कालावधी';
            $educationQualification = 'शैक्षणिक पात्रता';
            $payScale = 'वेतनश्रेणी';
            $unaidedOrderDate = 'अनुदानित वरील नेमणुक दिनांक';
            $remark = 'शेरा';
            $status = 'मान्य';

            $refNo = 'जा.क्र.: शिसंमा-' . date('Y') . "/विना-अनु बदली आदेश/" . $staffName . "/" . sprintf('%06d', $appId);
            $letterData = [
                'ref_no' => $refNo,
                'letter_date' => $orderDate,
                'division_name' => 'पुणे',
                'proposal_number' => $proposalNumber,
                'proposal_date' => $proposalDate,
                'teacher_name' => $staffName,
                'designation' => $post,
                'sanstha_code' => $sansthaCode,
                'sanstha_name' => $sansthaName,
                'school_code' => $schoolCode,
                'school_name' => $sansthaName,
                'source_aided' => $sourceAided,
                'target_aided' => $targetAided,
                'unaided_time_frame' => $unaidedTimeFrame,
                'education_qualification' => $educationQualification,
                'pay_scale' => $payScale,
                'unaided_order_date' => $unaidedOrderDate,
                'remark' => $remark,
                'status' => $status,
                'staffRows' => [[
                    'name' => $appointment->candidate_name,
                    'qualification' => $qualificationStr,
                    'caste_category' => $originalCategoryName,
                    'designation' => $postAdvertisementVacancy ? $postAdvertisementVacancy->post_name : '-',
                    'appointment_date' => $appointment->appointment_date,
                    'eo_date' => $appointment->eo_date,
                    'pay_scale' => $postAdvertisementVacancy ? $postAdvertisementVacancy->pay_scale : '-',
                    'approval_type' => $appointment->approval_type,
                    'remark' => $appointment->remark,
                ]],
            ];

            $uploadDir = WWW_ROOT . 'uploads' . DS . 'staffonboarding' . DS . 'approve' . DS;
            $qrcodeDir = $uploadDir . 'qrcodes' . DS;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!is_dir($qrcodeDir)) {
                mkdir($qrcodeDir, 0777, true);
            }

            $endPoint = 'uploads/staffonboarding/approve/staff_order_' . $appId . '.pdf';
            $outputPath = WWW_ROOT . $endPoint;
            $tempHtmlPath = $uploadDir . 'temp_approval_letter.html';

            $basePath = $this->request->getAttribute('base') ?? '';
            $fullUrl = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/' . $endPoint;

            $letterData['app_id'] = $appId;
            $letterData['targetAppUrl'] = $fullUrl;
            $letterData['targetQRUrl'] = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/uploads/staffonboarding/approve/qrcodes/staff_order_' . $appId . '.png';
            $letterData['targetQRPath'] = $qrcodeDir . 'staff_order_' . $appId . '.png';

            //$this->generateQRCode($fullUrl, $appId);
            $html = $this->renderApprovalLetterViewContent($letterData);

            $writeResult = file_put_contents($tempHtmlPath, $html);
            if ($writeResult === false) {
                throw new \RuntimeException('Unable to write temporary approval letter HTML.');
            }

            $wkhtmltopdfBinary = $this->findWkhtmltopdfBinary();
            if ($wkhtmltopdfBinary === null) {
                throw new \RuntimeException('wkhtmltopdf is not installed or not available in PATH.');
            }

            $cmd = sprintf(
                '%s --enable-local-file-access --encoding UTF-8 --page-size A4 --orientation Portrait --margin-top 12mm --margin-right 12mm --margin-bottom 12mm --margin-left 12mm %s %s',
                escapeshellarg($wkhtmltopdfBinary),
                escapeshellarg($tempHtmlPath),
                escapeshellarg($outputPath)
            );

            exec($cmd . ' 2>&1', $output, $statusCode);

            if ($statusCode !== 0 || !file_exists($outputPath)) {
                $error = implode("\n", $output);
                throw new \RuntimeException('PDF generation failed: ' . $error);
            }

            return $endPoint;
        } catch (\Throwable $e) {
            error_log('generateApprovalLetter failed: ' . $e->getMessage());
            return null;
        }
    }

    private function findWkhtmltopdfBinary(): ?string
{
    $candidates = [
        'C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
        'C:\\Program Files (x86)\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
        'wkhtmltopdf', 
        'C:\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
    ];

    foreach ($candidates as $candidate) {
            if (empty($candidate)) {
                continue;
            }

            if (is_executable($candidate) || is_file($candidate)) {
                return $candidate;
            }

            $command = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'
                ? 'where "' . $candidate . '" 2>nul'
                : 'command -v "' . $candidate . '" 2>/dev/null';

            $result = @shell_exec($command);
            if (!empty($result)) {
                $path = trim((string) explode(PHP_EOL, $result)[0]);
                if ($path !== '') {
                    return $path;
                }
            }
        }

    return null;
}

    private function renderApprovalLetterViewContent($data): string
    {
        $base64ImageQR = '';
        if (!empty($data['targetQRPath']) && file_exists($data['targetQRPath'])) {
            $imageDataQR = base64_encode(file_get_contents($data['targetQRPath']));
            $base64ImageQR = 'data:image/png;base64,' . $imageDataQR;
        }

        $base64Image = $this->getActiveHeaderImageDataUri((int)$this->user_id);
        $staffRows = $data['staffRows'] ?? $data['staff_rows'] ?? [];
        $staffTableRows = '';

        if (empty($staffRows)) {
            $staffTableRows = '<tr><td colspan="9">कोणताही कर्मचारी डेटा उपलब्ध नाही.</td></tr>';
        } else {
            foreach ($staffRows as $index => $row) {
                $staffTableRows .= '<tr>
                    <td>' . h($index + 1) . '</td>
                    <td>' . h($row['name'] ?? $row['employee_name'] ?? '—') . '</td>
                    <td>' . h($row['qualification'] ?? $row['education_qualification'] ?? '—') . '</td>
                    <td>' . h($row['caste_category'] ?? $row['caste'] ?? '—') . '</td>
                    <td>' . h($row['designation'] ?? $row['post_name'] ?? '—') . '</td>
                    <td>' . h($row['appointment_date'] ?? $row['joining_date'] ?? '—') . '</td>
                    <td>' . h($row['pay_scale'] ?? $row['salary_scale'] ?? '—') . '</td>
                    <td>' . h($row['approval_type'] ?? $row['status'] ?? '—') . '</td>
                    <td>' . h($row['remark'] ?? '—') . '</td>
                </tr>';
            }
        }

        return '<!DOCTYPE html>
                <html lang="mr">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        @page {
                            size: A4 portrait;
                            margin: 12mm;
                        }
                        body {
                            font-family: "DejaVu Sans", "Nirmala UI", "Mangal", "Arial Unicode MS", sans-serif;
                            font-size: 17px;
                            line-height: 1.7;
                            margin: 0;
                            padding: 0;
                            color: #111;
                        }
                        .letter-page {
                            width: 100%;
                            box-sizing: border-box;
                        }
                        .header-wrap {
                            text-align: center;
                            margin: 0 auto 12px auto;
                        }
                        .header-img {
                            display: block;
                            width: 180px;
                            height: auto;
                            margin: 0 auto 8px auto;
                        }
                        .letter-title {
                            font-size: 20px;
                            font-weight: 700;
                            text-align: center;
                            margin-top: 6px;
                            letter-spacing: 0.5px;
                        }
                        .qrcode-img {
                            width: 300px;
                            border:2px solid #1da5bd;
                        }
                        .meta-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 15px;
                        }
                        .meta-table td {
                            vertical-align: top;
                            padding: 2px 0;
                        }
                        .text-right {
                            text-align: right;
                        }
                        .recipient {
                            margin: 15px 0;
                            line-height: 1.6;
                        }
                        .subject-box {
                            font-weight: bold;
                            margin: 15px 0;
                            padding: 6px 10px;
                            background-color: #f4f4f4;
                            border-left: 3px solid #666;
                        }
                        .reference {
                            margin-bottom: 15px;
                        }
                        .content {
                            text-align: justify;
                            text-indent: 30px;
                            margin-top: 15px;
                            line-height: 1.8;
                        }
                        .content p {
                            margin: 10px 0;
                        }
                        .signature-table {
                            width: 100%;
                            margin-top: 50px;
                            border-collapse: collapse;
                            page-break-inside: avoid;
                        }
                        .copy-section {
                            margin-top: 40px;
                            padding-top: 10px;
                            border-top: 1px dashed #aaa;
                            font-size: 13px;
                            page-break-inside: avoid;
                        }
                        .right {
                            float:right;
                        }
                        .signature-wrap {
                            width: 100%;
                            margin-top: 40px;
                            clear: both;
                        }
                        .signature-block {
                            float: right;
                            width: 260px;
                            text-align: right;
                            margin-top: 10px;
                            margin-bottom: 10px;
                        }
                        .signature {
                            text-align: right;
                            margin: 0;
                        }
                        .copy-to {
                            margin-top: 70px;
                            clear: both;
                            font-weight: 600;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            table-layout: fixed;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 6px 4px;
                            vertical-align: top;
                            text-align: center;
                            word-wrap: break-word;
                        }
                    </style>
                </head>
                <body>
                <div class="letter-page">
                    ' . (!empty($base64Image) ? '<div class="header-wrap"><img class="header-img" src="' . $base64Image . '"></div>' : '') . '
                    <div class="letter-title">शासन आदेश</div>

                    <div>
                        आदेश :-
                    </div>

                <br>

                प्रति,
                <div>
                    <span class="indent">अध्यक्ष/सचिव,</span>
                    
                </div>

                <br>
                <div class="subject">
                    विषय :- कनिष्‍ठ लिपिक/प्रयोगशाळा सहाय्यक/ग्रंथपाल पदी वैयक्तीक मान्यता देणे बाबत---.
                </div>
                <br>
                <div>
                    संदर्भ :-
                    <br>
                    ' . $this->transliterateToMarathi("१. शासन पत्र क्र.न्‍यायाप्र/२०२३/प्र.क्र.३०/टिएनटी-२ दि.२१.०२.२०२४.
                    <br>
                    २. शिक्षण संचालनालयाचे पत्रक्र.शिसंमा-२०२४/शिक्षकेत्‍तर/न्‍याप्र-५०५८/२१/टी-४/११७९ दि.०१.०३.२०२४.
                    <br>
                    ३. संचालनालयाचे पत्रक्र.शिसंमा/शिक्षकेत्‍तर पदभरती/कार्यासन टि-४/२५९२ दि.२८.०५.२०२५.
                    <br>
                     ४. शालेय शिक्षण व क्रीडा विभाग यांचे शासन निर्णय क्रमांक संकीर्ण-२०२६/प्र.क्र.२६६/ई- १७६८६६७/टीएनटी-१ दि.११.०८.२०२६.
                    <br>
                    ५. शाळेचा प्रस्‍ताव ") . '
                </div>

                <div class="content">
                    <p>वरील संदर्भीय विषयाचे आपणास कळविण्यात येते की, आपल्या संस्थेमार्फत केलेल्या नेमणुकीस कनिष्ठ लिपिक या पदाचा नेमणुकीस आपण प्रस्तावासोबत सादर केलेल्या कागदपत्रांच्या अधीन राहून खालील तपशीलाप्रमाणे नमूद अटीच्या अधीन राहून मान्यता देण्यात येत आहे.</p>

                     <table style="width:100%;border:1px solid green;">
                        <tr>
                            <th>अ.क्र.</th>
                            <th>शिक्षकेत्‍तर कर्मचा-यांचे नाव </th>
                            <th>शैक्षणिक पात्रता</th>
                            <th>जात प्रवर्ग</th>
                            <th>पदनाम</th>
                            <th>नेमणूकीचा दिनांक</th>
                            <th>वेतनश्रेणी/मानधन</th>
                            <th>मान्‍यता प्रकार</th>
                            <th>शेरा</th>
                        </tr>
                        ' . $staffTableRows . '
                    </table>
                    <p>अटी -</p>
                    <p>१. शिक्षकेतरांच्या मान्यते संदर्भातील शासन निर्णय क्रमांक शालेय शिक्षण व क्रीडा विभाग क्र. एसएसएन-२६०३/(४१/०३)/माशि-२ दि.२५ नोव्हेंबर २००५ व शासन शुध्दीपत्रक क्र.एसएसएन-१००८/(२००/०८)/माशि-२ दि.१३ मार्च २००९ व शासन निर्णय, वित्त विभाग, क्रमांक असंप्र-१०१०/प्र.क्र.१/२०१० वित्तीय सुधारणा-१ दिनांक ०५ जून २०१० व शासन निर्णय क्रमांक दिनांक २८/१/२०१९ च्या आकृतीबंधानुसार प्रयोगशाळा सहायक / कनिष्ठ लिपीक पदासाठी अनुज्ञेय असलेल्या नेमणुकीस मान्यता देण्यात येत आहे.</p>
                    <p>२.  शाळेने /संस्थेने या कार्यालयात सादर केलेल्या प्रस्तावानुसार संबंधित कर्मचाऱ्याच्या नेमणुकीस मान्यता देण्यात येत आहे. या बाबत एखाद्या कर्मचाऱ्याने न्यायीक मार्गाचा अवलंब केल्यास न्यायालयाचा निर्णय संस्थेवर बंधनकारक राहील तसेच एखाद्या कर्मचाऱ्याने तक्रार केल्यास व त्यामध्ये तथ्य आढळल्यास दिलेली मान्यता रद्द करण्यात येईल.</p>
                    <p>३. सध्या सेवेत असलेल्या कर्मचाऱ्यास सेवेतून कमी करून नवीन कर्मचाऱ्याची नेमणूक केली असेल तर या कार्यालयाचे मान्यता घेतली असल्याचे निदर्शनास येताच सदरचे मान्यता आदेश रद्द करण्यात येतील व अदा करण्यात आलेले वेतन विहीत पद्धतीचा अवलंब करून संस्थेकडून वसूल करण्यात येईल.</p>
                    <p>४. मंजूर पदापेक्षा जादा शिक्षक / शिक्षकेतर कर्मचाऱ्याच्या नेमणुका केल्यास व त्यास या कार्यालयाची मान्यता घेतल्यास संबंधित शाळेच्या मुख्याध्यापकास व संस्थेस जबाबदार धरण्यात येईल व मंजूर पदापेक्षा जादा नेमणुका करण्यात आलेल्या कर्मचाऱ्याच्या वेतनाची वसुली संस्थेस देय वेतनेत्तर अनुदानातून कपात करण्यात येईल.</p>
                    <p>५. संस्थेत अतिरिक्त कर्मचारी असताना नवीन नेमणुकीस मान्यता घेतल्यास सदर नेमणुकीची मान्यता रद्द करून नवीन नेमणूक केलेल्या कर्मचाऱ्यास दिलेले वेतन व भत्ते संस्थेकडून वसूल करण्यात येईल.</p>
                    <p>६. एखाद्या कर्मचाऱ्याचे प्रकरण न्यायप्रविष्ठ असेल अशा कर्मचाऱ्याच्या जागी दुसऱ्या कर्मचाऱ्याची नेमणूक करू नये. सदर बाब या कार्यालयाच्या निदर्शनास न आणता अशा जागी संस्थेने नेमणूक केली असल्यास व अशा नवीन नेमणूक केलेल्या सेवकाची या कार्यालयाकडून मान्यता घेऊन संबंधित सेवकास दिलेले वेतन संस्थेकडून वसूल करण्यात येईल.</p>
                    <p>७. संस्थेतील अतिरिक्त कर्मचाऱ्याचे या पूर्वी कोणत्याही इतर संस्थेच्या माध्यमिक शाळेत समावेश केला असल्यास व नवीन नेमणुकीपूर्वी अशा कर्मचाऱ्याचा संस्थेत पुन्हा सेवेत घेण्याबाबतचा विकल्प (नाहरकत) न घेता नवीन नेमणूक केली असल्यास व अशा नेमणुकीस खात्याकडून मान्यता घेतल्याचे निदर्शनास आल्यास या पूर्वी समावेश केलेल्या सेवकाची तक्रार आल्यास नव्या नेमणुकीस दिलेली मान्यता रद्द करण्यात येईल व नव्याने नेमणूक दिलेल्या कर्मचाऱ्याचे वेतन संस्थेकडून वसूल करण्यात येईल.</p>
                    <p>८. मान्यतेसाठी पाठविलेल्या प्रस्तावात एखाद्या कर्मचाऱ्याचे नाव वगळून दुसऱ्याच कर्मचाऱ्याच्या नेमणुकीस मान्यता घेतली असल्यास व माहितीमध्ये एखादे प्रकरण उद्भवल्यास होणाऱ्या परिणामास मुख्याध्यापक व संस्था जबाबदार राहील.</p>
                    <p>९. सदरचे प्रस्ताव शालार्थ प्रणालीमध्ये समाविष्ट करण्यासाठी मा. शिक्षण उपसंचालक कार्यालयाकडेस पाठविणेत येतील. त्यांच्या स्तरावरून सदर कर्मचाऱ्याचे नाव शालार्थ प्रणालीमध्ये समाविष्ट न झाल्यास दिलेली ही मान्यता रद्द समजण्यात येईल.</p>
                    <p></p>
                    <p></p>
                </div>

        

                <div>
                        <p class="right" style="text-align:right; margin:0;">
                            स्वाक्षरी/-
                        </p>

                        <!-- Fixed space -->
                        <div style="height: 150px;"></div>

                        <p style="margin:0;">
                            प्रत -
                        </p>

                        <p>
                            १. अधिक्षक वेतन पथक भविष्‍य निर्वाह निधी (माध्‍यमिक)--------- यांना माहितीसाठी व पुढील कार्यवाहीसाठी.
                        </p>

                        <p>
                            २. मुख्‍याध्‍यापक संबंधित शाळा यांना माहितीसाठी व पुढील कार्यवाहीसाठी.
                        </p>

                        <p>
                            ३. संबंधित कर्मचारी यांना मुख्‍याध्‍यापकामार्फत.
                        </p>
                    </div>


                <div style="clear:both;"></div>
                </div>
            </body>
            </html>';
    }


    public function generateRejectLetter($appId,$text)
    {
        $this->autoRender = false;

        try {
            $appId = (int)$appId;
            if ($appId <= 0) {
                throw new \InvalidArgumentException('Invalid application ID');
            }

            $staffName = 'श्री. अमोल रमेश पाटील';
            $orderDate = '24-08-2026';
            $post = 'सहाय्यक शिक्षक';
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $proposalDate = '15-08-2026';

            $sansthaCode = '';
            $sansthaName = '';
            $schoolCode = '';
            $sansthaName = 'श्री शिवाजी हायस्कूल व कनिष्ठ महाविद्यालय, कोल्हापूर';

            $sourceAided = 'विना अनुदानित';
            $targetAided = 'अंशतः अनुदानित (२० टक्के)';
            $unaidedTimeFrame = 'विना अनुदान सेवा कालावधी';
            $educationQualification = 'शैक्षणिक पात्रता';
            $payScale = 'वेतनश्रेणी';
            $unaidedOrderDate = 'अनुदानित वरील नेमणुक दिनांक';
            $remark = 'शेरा';
            $status = 'मान्य';

            $refNo = 'जा.क्र.: शिसंमा-' . date('Y') . "/विना-अनु बदली आदेश/" . $staffName . "/" . sprintf('%06d', $appId);
            $letterData = [
                'ref_no' => $refNo,
                'letter_date' => $orderDate,
                'division_name' => 'पुणे',
                'proposal_number' => $proposalNumber,
                'proposal_date' => $proposalDate,
                'teacher_name' => $staffName,
                'designation' => $post,
                'sanstha_code' => $sansthaCode,
                'sanstha_name' => $sansthaName,
                'school_code' => $schoolCode,
                'school_name' => $sansthaName,
                'source_aided' => $sourceAided,
                'target_aided' => $targetAided,
                'unaided_time_frame' => $unaidedTimeFrame,
                'education_qualification' => $educationQualification,
                'pay_scale' => $payScale,
                'unaided_order_date' => $unaidedOrderDate,
                'remark' => $remark,
                'status' => $status,
            ];

            $uploadDir = WWW_ROOT . 'uploads' . DS . 'staffonboarding' . DS . 'reject' . DS;
            $qrcodeDir = $uploadDir . 'qrcodes' . DS;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!is_dir($qrcodeDir)) {
                mkdir($qrcodeDir, 0777, true);
            }

            $endPoint = 'uploads/staffonboarding/reject/staff_order_reject_' . $appId . '.pdf';
            $outputPath = WWW_ROOT . $endPoint;
            $tempHtmlPath = $uploadDir . 'temp_reject_letter.html';

            $basePath = $this->request->getAttribute('base') ?? '';
            $fullUrl = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/' . $endPoint;

            $letterData['app_id'] = $appId;
            $letterData['targetAppUrl'] = $fullUrl;
            $letterData['targetQRUrl'] = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/uploads/staffonboarding/reject/qrcodes/staff_order_reject_' . $appId . '.png';
            $letterData['targetQRPath'] = $qrcodeDir . 'staff_order_reject_' . $appId . '.png';
            $letterData['reject_text'] = $text;

            //$this->generateQRCode($fullUrl, $appId);
            $html = $this->renderRejectLetterViewContent($letterData);

            $writeResult = file_put_contents($tempHtmlPath, $html);
            if ($writeResult === false) {
                throw new \RuntimeException('Unable to write temporary approval letter HTML.');
            }

            $wkhtmltopdfBinary = $this->findWkhtmltopdfBinary();
            if ($wkhtmltopdfBinary === null) {
                throw new \RuntimeException('wkhtmltopdf is not installed or not available in PATH.');
            }

            $cmd = sprintf(
                '%s --enable-local-file-access --encoding UTF-8 --page-size A4 %s %s',
                escapeshellarg($wkhtmltopdfBinary),
                escapeshellarg($tempHtmlPath),
                escapeshellarg($outputPath)
            );

            $output = [];
            $statusCode = 0;

            exec($cmd . ' 2>&1', $output, $statusCode);

            if ($statusCode !== 0 || !file_exists($outputPath)) {
                throw new \RuntimeException(
                    "PDF generation failed.\n" .
                    "Exit code: {$statusCode}\n" .
                    implode("\n", $output)
                );
            }

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'url' => $fullUrl,
                    'path' => $outputPath,
                    'message' => 'Reject letter generated successfully',
                ]));
        } catch (\Throwable $e) {
            error_log('generateApprovalLetter failed: ' . $e->getMessage());

            return $this->response
                ->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => $e->getMessage(),
                ]));
        }
    }

    private function renderRejectLetterViewContent($data): string
    {
        $base64ImageQR = '';
        if (!empty($data['targetQRPath']) && file_exists($data['targetQRPath'])) {
            $imageDataQR = base64_encode(file_get_contents($data['targetQRPath']));
            $base64ImageQR = 'data:image/png;base64,' . $imageDataQR;
        }

        $base64Image = $this->getActiveHeaderImageDataUri((int)$this->user_id);

        return '<!DOCTYPE html>
                <html lang="mr">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        body {
                            font-family: "DejaVu Sans", "Nirmala UI", "Mangal", "Arial Unicode MS", sans-serif;
                            font-size: 18px;
                            line-height: 1.7;
                            margin: 0px 30px;
                            color: #111;
                        }
                        .header-img {
                            width: 250px;
                            height: 250px;
                        }
                        .qrcode-img {
                            width: 300px;
                            border:2px solid #1da5bd;
                        }
                        .meta-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 15px;
                        }
                        .meta-table td {
                            vertical-align: top;
                            padding: 2px 0;
                        }
                        .text-right {
                            text-align: right;
                        }
                        .recipient {
                            margin: 15px 0;
                            line-height: 1.6;
                        }
                        .subject-box {
                            font-weight: bold;
                            margin: 15px 0;
                            padding: 6px 10px;
                            background-color: #f4f4f4;
                            border-left: 3px solid #666;
                        }
                        .reference {
                            margin-bottom: 15px;
                        }
                        .content {
                            text-align: justify;
                            text-indent: 30px;
                            margin-top: 15px;
                            line-height: 1.8;
                        }
                        .signature-table {
                            width: 100%;
                            margin-top: 50px;
                            border-collapse: collapse;
                            page-break-inside: avoid;
                        }
                        .copy-section {
                            margin-top: 40px;
                            padding-top: 10px;
                            border-top: 1px dashed #aaa;
                            font-size: 13px;
                            page-break-inside: avoid;
                        }
                        .right {
                            float:right;
                        }
                        .signature-wrap {
                            width: 100%;
                            margin-top: 40px;
                            clear: both;
                        }
                        .signature-block {
                            float: right;
                            width: 260px;
                            text-align: right;
                            margin-top: 10px;
                            margin-bottom: 10px;
                        }
                        .signature {
                            text-align: right;
                            margin: 0;
                        }
                        .copy-to {
                            margin-top: 70px;
                            clear: both;
                            font-weight: 600;
                        }
                    </style>
                </head>
                <body>
                ' . (!empty($base64Image) ? '<img class="header-img" src="' . $base64Image . '">' : '') . '

               
                <br>

                प्रति,
                <div>
                    <span class="indent">अध्यक्ष/सचिव संबंधित शाळा,
                    </span>
                    
                </div>

                <br>
                <div class="subject">
                      विषय :- कनिष्‍ठ लिपिक/प्रयोगशाळा सहाय्यक/ग्रंथपाल पदी वैयक्तीक मान्‍यताबाबत.
                </div>
                <br>
                <div>
                    संदर्भ :-
                    <br>
                    ' . $this->transliterateToMarathi("१. शासन पत्र क्र.न्‍यायाप्र/२०२३/प्र.क्र.३०/टिएनटी-२ दि.२१.०२.२०२४.
                    <br>
                    २. शिक्षण संचालनालयाचे पत्रक्र.शिसंमा-२०२४/शिक्षकेत्‍तर/न्‍याप्र-५०५८/२१/टी-४/११७९ दि.०१.०३.२०२४.
                    <br>
                    ३. संचालनालयाचे पत्रक्र.शिसंमा/शिक्षकेत्‍तर पदभरती/कार्यासन टि-४/२५९२ दि.२८.०५.२०२५.
                    <br>
                     ४. शालेय शिक्षण व क्रीडा विभाग यांचे शासन निर्णय क्रमांक संकीर्ण-२०२६/प्र.क्र.२६६/ई-१७६८६६७/टीएनटी-१ दि.११.०८.२०२६.
                    <br>
                    ५. शाळेचा प्रस्‍ताव ") . '
                </div>

                <div class="content">
                    <p>उपरोक्त संदर्भाधिन पत्राानुसार निर्देशित करण्यांत येते की, संदर्भाधिन प्रस्तावामध्ये ............................ या शाळेतील/कनिष्ठ महाविदयालयातील नियुक्त शिक्षकेत्तर कर्मचारी (कनिष्ठ लिपिक,प्रयोगशाळा सहाय्यक,ग्रंथपाल) यांचे पदास मान्यता मिळणेबाबतचा प्रस्ताव सादर करण्यात आलेला होता..</p>
                    <p>त्यास अनुसरुन...........................................स्तरावर करण्यात आलेल्या छाननीअंती आपल्या प्रस्तावात त्रुटी आढळून आल्या आहेत.</p>
                     
                </div>

                <div>'.$data['reject_text'].'</div>
        

                <div>
                        <p class="right" style="text-align:right; margin:0;">
                            स्वाक्षरी/-
                        </p>

                        <!-- Fixed space -->
                        <div style="height: 150px;"></div>

                        <p style="margin:0;">
                            प्रत -
                        </p>

                        <p>
                            १. अधिक्षक वेतन पथक भविष्‍य निर्वाह निधी (माध्‍यमिक) --------- यांना माहितीसाठी व पुढील कार्यवाहीसाठी.
                        </p>

                        <p>
                            २. मुख्‍याध्‍यापक  संबंधित शाळा  यांना माहितीसाठी व पुढील कार्यवाहीसाठी
                        </p>

                        <p>
                            ३.संबंधित कर्मचारी यांना मुख्‍याध्‍यापकामार्फत.
                        </p>

                       
                    </div>


                <div style="clear:both;"></div>
            </body>
            </html>';
    }


    public function generateReturnLetter($appId)
    {
        $this->autoRender = false;

        try {
            $appId = (int)$appId;
            if ($appId <= 0) {
                throw new \InvalidArgumentException('Invalid application ID');
            }

            $staffName = 'श्री. अमोल रमेश पाटील';
            $orderDate = '24-08-2026';
            $post = 'सहाय्यक शिक्षक';
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $proposalDate = '15-08-2026';

            $sansthaCode = '';
            $sansthaName = '';
            $schoolCode = '';
            $sansthaName = 'श्री शिवाजी हायस्कूल व कनिष्ठ महाविद्यालय, कोल्हापूर';

            $sourceAided = 'विना अनुदानित';
            $targetAided = 'अंशतः अनुदानित (२० टक्के)';
            $unaidedTimeFrame = 'विना अनुदान सेवा कालावधी';
            $educationQualification = 'शैक्षणिक पात्रता';
            $payScale = 'वेतनश्रेणी';
            $unaidedOrderDate = 'अनुदानित वरील नेमणुक दिनांक';
            $remark = 'शेरा';
            $status = 'मान्य';

            $refNo = 'जा.क्र.: शिसंमा-' . date('Y') . "/विना-अनु बदली आदेश/" . $staffName . "/" . sprintf('%06d', $appId);
            $letterData = [
                'ref_no' => $refNo,
                'letter_date' => $orderDate,
                'division_name' => 'पुणे',
                'proposal_number' => $proposalNumber,
                'proposal_date' => $proposalDate,
                'teacher_name' => $staffName,
                'designation' => $post,
                'sanstha_code' => $sansthaCode,
                'sanstha_name' => $sansthaName,
                'school_code' => $schoolCode,
                'school_name' => $sansthaName,
                'source_aided' => $sourceAided,
                'target_aided' => $targetAided,
                'unaided_time_frame' => $unaidedTimeFrame,
                'education_qualification' => $educationQualification,
                'pay_scale' => $payScale,
                'unaided_order_date' => $unaidedOrderDate,
                'remark' => $remark,
                'status' => $status,
            ];

            $uploadDir = WWW_ROOT . 'uploads' . DS . 'staffonboarding' . DS . 'return' . DS;
            $qrcodeDir = $uploadDir . 'qrcodes' . DS;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!is_dir($qrcodeDir)) {
                mkdir($qrcodeDir, 0777, true);
            }

            $endPoint = 'uploads/staffonboarding/return/staff_order_return_' . $appId . '.pdf';
            $outputPath = WWW_ROOT . $endPoint;
            $tempHtmlPath = $uploadDir . 'temp_return_letter.html';

            $basePath = $this->request->getAttribute('base') ?? '';
            $fullUrl = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/' . $endPoint;

            $letterData['app_id'] = $appId;
            $letterData['targetAppUrl'] = $fullUrl;
            $letterData['targetQRUrl'] = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/uploads/staffonboarding/return/qrcodes/staff_order_return_' . $appId . '.png';
            $letterData['targetQRPath'] = $qrcodeDir . 'staff_order_return_' . $appId . '.png';

            //$this->generateQRCode($fullUrl, $appId);
            $html = $this->renderReturnLetterViewContent($letterData);

            $writeResult = file_put_contents($tempHtmlPath, $html);
            if ($writeResult === false) {
                throw new \RuntimeException('Unable to write temporary approval letter HTML.');
            }

            $wkhtmltopdfBinary = $this->findWkhtmltopdfBinary();
            if ($wkhtmltopdfBinary === null) {
                throw new \RuntimeException('wkhtmltopdf is not installed or not available in PATH.');
            }

            $cmd = sprintf(
                '%s --enable-local-file-access --encoding UTF-8 --page-size A4 %s %s',
                escapeshellarg($wkhtmltopdfBinary),
                escapeshellarg($tempHtmlPath),
                escapeshellarg($outputPath)
            );

            exec($cmd . ' 2>&1', $output, $statusCode);

            if ($statusCode !== 0 || !file_exists($outputPath)) {
                $error = implode("\n", $output);
                throw new \RuntimeException('PDF generation failed: ' . $error);
            }

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'url' => $fullUrl,
                    'path' => $outputPath,
                    'message' => 'return letter generated successfully',
                ]));
        } catch (\Throwable $e) {
            error_log('generateApprovalLetter failed: ' . $e->getMessage());

            return $this->response
                ->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => $e->getMessage(),
                ]));
        }
    }


    private function renderReturnLetterViewContent($data): string
    {
        $base64ImageQR = '';
        if (!empty($data['targetQRPath']) && file_exists($data['targetQRPath'])) {
            $imageDataQR = base64_encode(file_get_contents($data['targetQRPath']));
            $base64ImageQR = 'data:image/png;base64,' . $imageDataQR;
        }

        $base64Image = $this->getActiveHeaderImageDataUri((int)$this->user_id);

        return '<!DOCTYPE html>
                <html lang="mr">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        body {
                            font-family: "DejaVu Sans", "Nirmala UI", "Mangal", "Arial Unicode MS", sans-serif;
                            font-size: 18px;
                            line-height: 1.7;
                            margin: 0px 30px;
                            color: #111;
                        }
                        .header-img {
                            width: 250px;
                            height: 250px;
                        }
                        .qrcode-img {
                            width: 300px;
                            border:2px solid #1da5bd;
                        }
                        .meta-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 15px;
                        }
                        .meta-table td {
                            vertical-align: top;
                            padding: 2px 0;
                        }
                        .text-right {
                            text-align: right;
                        }
                        .recipient {
                            margin: 15px 0;
                            line-height: 1.6;
                        }
                        .subject-box {
                            font-weight: bold;
                            margin: 15px 0;
                            padding: 6px 10px;
                            background-color: #f4f4f4;
                            border-left: 3px solid #666;
                        }
                        .reference {
                            margin-bottom: 15px;
                        }
                        .content {
                            text-align: justify;
                            text-indent: 30px;
                            margin-top: 15px;
                            line-height: 1.8;
                        }
                        .signature-table {
                            width: 100%;
                            margin-top: 50px;
                            border-collapse: collapse;
                            page-break-inside: avoid;
                        }
                        .copy-section {
                            margin-top: 40px;
                            padding-top: 10px;
                            border-top: 1px dashed #aaa;
                            font-size: 13px;
                            page-break-inside: avoid;
                        }
                        .right {
                            float:right;
                        }
                        .signature-wrap {
                            width: 100%;
                            margin-top: 40px;
                            clear: both;
                        }
                        .signature-block {
                            float: right;
                            width: 260px;
                            text-align: right;
                            margin-top: 10px;
                            margin-bottom: 10px;
                        }
                        .signature {
                            text-align: right;
                            margin: 0;
                        }
                        .copy-to {
                            margin-top: 70px;
                            clear: both;
                            font-weight: 600;
                        }
                    </style>
                </head>
                <body>
                ' . (!empty($base64Image) ? '<img class="header-img" src="' . $base64Image . '">' : '') . '

               
                <br>

                प्रति,
                <div>
                    <span class="indent">अध्यक्ष/सचिव संबंधित शाळा,
                    </span>
                    
                </div>

                <br>
                <div class="subject">
                      विषय :- कनिष्‍ठ लिपिक/प्रयोगशाळा सहाय्यक/ग्रंथपाल पदी वैयक्तीक मान्‍यताबाबत.
                </div>
                <br>
                <div>
                    संदर्भ :-
                    <br>
                    ' . $this->transliterateToMarathi("१. शासन पत्र क्र.न्‍यायाप्र/२०२३/प्र.क्र.३०/टिएनटी-२ दि.२१.०२.२०२४.<br>
	               २. शिक्षण संचालनालयाचे पत्रक्र.शिसंमा-२०२४/शिक्षकेत्‍तर/न्‍याप्र-५०५८/२१/टी-४/११७९ दि.०१.०३.२०२४.<br>
	               ३. संचालनालयाचे पत्रक्र.शिसंमा/शिक्षकेत्‍तर पदभरती/कार्यासन टि-४/२५९२ दि.२८.०५.२०२५.<br>
	               ४. शालेय शिक्षण व क्रीडा विभाग यांचे शासन निर्णय क्रमांक संकीर्ण-२०२६/प्र.क्र.२६६/ई-१७६८६६७/टीएनटी-१ दि.११.०८.२०२६.<br>
	               ५. शाळेचा प्रस्‍ताव ") . '
                </div>

                <div class="content">
                    <p>उपरोक्त संदर्भाधिन पत्राानुसार निर्देशित करण्यांत येते की, संदर्भाधिन प्रस्तावामध्ये ............................ या शाळेतील/कनिष्ठ महाविदयालयातील नियुक्त शिक्षकेत्तर कर्मचारी (कनिष्ठ लिपिक,प्रयोगशाळा सहाय्यक,ग्रंथपाल) यांचे पदास मान्यता मिळणेबाबतचा प्रस्ताव सादर करण्यात आलेला होता.</p>

                    <p>
                    त्यास अनुसरुन...........................................स्तरावर करण्यात आलेल्या छाननीअंती आपल्या प्रस्तावात त्रुटी आढळून आल्या आहेत</p>
                     <p>1.</p>
                     <p>2.</p>
                     <p>3.</p>
                     <p>4.</p>
                     <p>5.</p>
                     <p>वरील त्रुटी असल्याने आपला शिक्षकेत्तर कर्मचारी (कनिष्ठ लिपिक,प्रयोगशाळा सहाय्यक,ग्रंथपाल) पदास मान्यता मिळणेबाबतचा प्रस्ताव अमान्य करण्यात येत आहे.</p>
                </div>

        

                <div>
                        <p class="right" style="text-align:right; margin:0;">
                            स्वाक्षरी/-
                        </p>

                        <!-- Fixed space -->
                        <div style="height: 150px;"></div>

                        <p style="margin:0;">
                            प्रत -
                        </p>

                        <p>
                            १. विभागीय अध्यक्ष,महाराष्ट्र राज्य माध्यमिक व उच्च माध्यमिक शिक्षण मंडळ सर्व.
                        </p>

                        <p>
                            २. विभागीय शिक्षण उपसंचालक सर्व.
                        </p>

                        <p>
                            ३.शिक्षणाधिकारी (माध्यमिक/प्राथमिक) व शिक्षण निरीक्षक(उ/द/प) सर्व.
                        </p>

                       

                        <p>
                            4.	अधीक्षक,वेतन व भविष्य निर्वाह निधी पथक.
                        </p>

                        <p>
                            5.	संबंधित कर्मचारी.
                        </p>                      

                    </div>


                <div style="clear:both;"></div>
            </body>
            </html>';
    }

    public function generateQRCode($targetAppUrl,$appId)
    {        
        $targetUrl = $targetAppUrl;

        // 2. Build the QR Code object
        $qrCode = new QrCode(
            data: $targetUrl,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin
        );
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // 3. Set destination folder (e.g., webroot/img/qrcodes/)
        $outputDir = WWW_ROOT . 'uploads' . DS . 'ng2gtransfers' . DS. 'approve' . DS. 'qrcodes' . DS;

        // Ensure directory exists
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // 4. Save PNG image to file
        $fileName = 'staff_order_' . $appId . '.png';
        $filePath = $outputDir . $fileName;
        $result->saveToFile($filePath);

       // $this->Flash->success(__('QR Code successfully saved to {0}', $fileName));
       // return $this->redirect(['action' => 'index']);
    }
    function transliterateToMarathi($text)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $mar = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        return str_replace($eng, $mar, (string)$text);
    }

    public function headerUpload()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-district');

        if (!$this->request->is('post')) {
            $headerFilesTable = $this->fetchTable('HeaderFiles');
            $headerFile = $headerFilesTable->find()
                ->where([
                    'user_id' => (int)$this->user_id,
                    'is_active' => true,
                ])
                ->order(['created_at' => 'DESC'])
                ->first();

            if ($headerFile) {
                $storage = new EsdlStorageService();
                $headerFile->set('preview_url', $storage->signedUrl($headerFile->storage_path));
            }

            $this->set('headerFile', $headerFile);
            return;
        }

        $file = $this->request->getUploadedFile('header_file');
        $title = trim((string)$this->request->getData('header_title'));
        $allowedMimeTypes = ['image/png', 'image/jpeg', 'application/pdf'];
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
        $maxFileSize = 2 * 1024 * 1024;

        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
            $this->Flash->error('Please select a valid file.');
            return;
        }

        $originalName = basename((string)$file->getClientFilename());
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $mimeType = (string)$file->getClientMediaType();
        $fileSize = (int)$file->getSize();

        if (!in_array($mimeType, $allowedMimeTypes, true)
            || !in_array($extension, $allowedExtensions, true)
            || $fileSize <= 0
            || $fileSize > $maxFileSize
        ) {
            $this->Flash->error('Only PNG, JPG, JPEG, and PDF files up to 2 MB are allowed.');
            return;
        }

        $temporaryPath = $file->getStream()->getMetadata('uri');
        $checksum = hash_file('sha256', $temporaryPath);
        $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $originalName);
        $storagePath = 'district/headers/' . $this->user_id;

        try {
            $storage = new EsdlStorageService();
            $storedPath = $storage->upload($file, $storagePath);

            $connection = ConnectionManager::get('default');
            $connection->begin();

            $headerFilesTable = $this->fetchTable('HeaderFiles');
            $headerFilesTable->updateAll(
                ['is_active' => false, 'updated_at' => FrozenTime::now()],
                ['user_id' => (int)$this->user_id, 'is_active' => true]
            );

            $headerFile = $headerFilesTable->newEntity([
                'user_id' => (int)$this->user_id,
                'title' => $title !== '' ? $title : pathinfo($originalName, PATHINFO_FILENAME),
                'original_name' => $originalName,
                'stored_name' => $safeName,
                'storage_path' => $storedPath,
                'mime_type' => $mimeType,
                'file_extension' => $extension,
                'file_size' => $fileSize,
                'file_checksum' => $checksum,
                'is_active' => true,
            ]);

            if (!$headerFilesTable->save($headerFile)) {
                $connection->rollback();
                $this->Flash->error('Unable to save the header file.');
                return;
            }

            $connection->commit();
            $this->Flash->success('Header file uploaded successfully.');
            return $this->redirect(['action' => 'headerUpload']);
        } catch (\Throwable $exception) {
            if (isset($connection) && $connection->inTransaction()) {
                $connection->rollback();
            }

            error_log('headerUpload failed: ' . $exception->getMessage());
            $this->Flash->error('Unable to upload the header file.');
        }
    }

    public function headerDelete()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);

        $headerFilesTable = $this->fetchTable('HeaderFiles');
        $headerFile = $headerFilesTable->find()
            ->where([
                'id' => (int)$this->request->getData('id'),
                'user_id' => (int)$this->user_id,
                'is_active' => true,
            ])
            ->first();

        if (!$headerFile) {
            $this->Flash->error('Header file not found.');
            return $this->redirect(['action' => 'headerUpload']);
        }

        try {
            $storage = new EsdlStorageService();
            $storage->delete($headerFile->storage_path);
        } catch (\Throwable $exception) {
            error_log('headerDelete storage cleanup failed: ' . $exception->getMessage());
        }

        $headerFile->set('is_active', false);
        if ($headerFilesTable->save($headerFile)) {
            $this->Flash->success('Header file deleted successfully.');
        } else {
            $this->Flash->error('Unable to delete the header file.');
        }

        return $this->redirect(['action' => 'headerUpload']);
    }
    
  }
