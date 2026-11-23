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

class DivisionClerkController extends AppController
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
            'ng2gApproveTransfer','ng2gRejectTransfer'
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
        if ($role !== 'division') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->user_id = $this->request->getSession()->read('Auth.User.id');
        $this->username = $this->request->getSession()->read('Auth.User.username');
        $user = $this->request->getSession()->read('Auth.User');
        $division = $this->request->getSession()->read('Auth.Division');
        $this->did =  $division->id;
        $this->dcode =  $division->code;
        $this->Jurisdiction =  $division->Jurisdiction;
        
        $this->statuses = [
                        'dyd_clerk_primary_desk_pending','dyd_clerk_secondary_desk_pending','dyd_clerk_higher_secondary_desk_pending'
                        ];   
        $this->set('user', $user);
        $this->set('division', $division);       
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }

    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('division-clerk');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

       // $schools = $schoolsTable->find()->all();
       
        $totalSchools = $schoolsTable
                            ->find()
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
                                ],
                                'Districts' => [
                                    'table' => 'districts',
                                    'type' => 'INNER',
                                    'conditions' => 'Districts.code = Blocks.district_code::int'
                                ]
                            ])
                            ->where([
                                'Districts.region_id' => (int) $this->did
                            ])
                            ->count();
        // Schools with school_close = 'NO'
        $openSchools = $schoolsTable->find()
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
                                ],
                                'Districts' => [
                                    'table' => 'districts',
                                    'type' => 'INNER',
                                    'conditions' => 'Districts.code = Blocks.district_code::int'
                                ]
                            ])
                            ->where([
                                'Districts.region_id' => (int) $this->did,
                                'school_close' => 'NO'
                            ])
                            ->count();
       
        $closeSchools = $totalSchools - $openSchools;

        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        $ng2gCount = $staffTransfersTable->find() 
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
                                ],
                                'Districts' => [
                                    'table' => 'districts',
                                    'type' => 'INNER',
                                    'conditions' => 'Districts.code = Blocks.district_code::int'
                                ]
                            ])
                            ->where([
                                'Districts.region_id' => (int) $this->did,
                                'status IN' => $this->statuses
                            ])
                            ->count();

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
                    'conditions' => 'Staffs.udise_code = Schools.udise_code'
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
                ],
                'Districts' => [
                    'table' => 'districts',
                    'type' => 'INNER',
                    'conditions' => 'Districts.code = Blocks.district_code::int'
                ]
            ])
            ->where([
                'Districts.region_id' => (int) $this->did
            ])
            ->group(['current_post_aid_type', 'emp_type']);

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
           // ->where(['udise_code' => $this->username])            
            ->group(['staff_update_status','emp_type']);

            

        
        foreach ($onboard as $row) {
            $updateStatus[$row->staff_update_status][$row->emp_type] =  $row->count;           
        }
        $districtsTable = TableRegistry::getTableLocator()->get('Districts');
        $districts = $districtsTable->find()->where([
                            'region_id' => (int) $this->did
                        ])
                        ->count();

        $blocksTable = TableRegistry::getTableLocator()->get('Blocks');

        $blocks = $blocksTable->find()->join([                
                'Districts' => [
                    'table' => 'districts',
                    'type' => 'INNER',
                    'conditions' => 'Districts.code = Blocks.district_code::int'
                ]
            ])
            ->where([
                'Districts.region_id' => (int) $this->did
            ])->count();

        $clustersTable = TableRegistry::getTableLocator()->get('Clusters');
        $clusters = $clustersTable->find()->join([
              
                'Blocks' => [
                    'table' => 'blocks',
                    'type' => 'INNER',
                    'conditions' => 'Blocks.code = Clusters.block_code::int'
                ],
                'Districts' => [
                    'table' => 'districts',
                    'type' => 'INNER',
                    'conditions' => 'Districts.code = Blocks.district_code::int'
                ]
            ])
            ->where([
                'Districts.region_id' => (int) $this->did
            ])->count();
        
       // pending
       //  $sanchPostSanctionWorkingTable = TableRegistry::getTableLocator()->get('SanchPostSanctionWorking');

       /* echo "<pre>";
        print_r($updateStatus);
        exit;*/
        //$this->set('schools', $schools);
        $this->set('totalSchools', $totalSchools);
        $this->set('openSchools', $openSchools);
        $this->set('closeSchools', $closeSchools);
        $this->set('ng2gCount', $ng2gCount);
        $this->set('udise', $this->username);
        $this->set('updateStatus', $updateStatus);
        $this->set('staffsType', $result);
        $this->set('districtCount', $districts);
        $this->set('blockCount', $blocks);
        $this->set('clusterCount', $clusters);
        
    }

     

    public function ng2gReturnedTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('district-clerk');
    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        if($this->Jurisdiction == 1){
            $status= ['dyd_clerk_primary_desk_returned','dyd_clerk_primary_desk_forwarded'];
        }elseif($this->Jurisdiction == 2){
            $status= ['dyd_clerk_secondary_desk_returned','dyd_clerk_secondary_desk_forwarded'];
        }else{
            $status= ['dyd_clerk_higher_secondary_desk_returned','dyd_clerk_higher_secondary_desk_forwarded'];                   
        }
        $ng2g = $staffTransfersTable->find()
                ->select([
                            'district' => 'Districts.name',
                            'block' => 'Blocks.name',
                            'cluster' => 'Clusters.name',
                            'StaffTransfers.id', 
                            'StaffTransfers.staff_id', 
                            'StaffTransfers.employee_name', 
                            'StaffTransfers.designation',
                            'institution_name', 
                            'StaffTransfers.school_name', 
                            'StaffTransfers.created_at',  // newly added
                            'StaffTransfers.school_name_at_transfer', 
                            'StaffTransfers.staff_type_name', 
                            'StaffTransfers.aid_name',
                            'StaffTransfers.status',
                            'StaffTransfers.stage1_fwd_to_target'
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
                    ],
                    'Districts' => [
                        'table' => 'districts',
                        'type' => 'INNER',
                        'conditions' => 'Districts.code = Blocks.district_code::int'
                    ]                    
                ])     
                ->where([
                    'StaffTransfers.status IN' => $status,
                    'StaffTransfers.stage1_fwd_to' =>  $this->Jurisdiction,
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


    public function ng2gTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('division-clerk');
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        $ng2g = $staffTransfersTable->find()
                ->select([
                            'district' => 'Districts.name',
                            'block' => 'Blocks.name',
                            'cluster' => 'Clusters.name',
                            'StaffTransfers.id', 
                            'StaffTransfers.staff_id', 
                            'StaffTransfers.employee_name', 
                            'StaffTransfers.designation',
                            'institution_name', 
                            'StaffTransfers.school_name', 
                            'StaffTransfers.created_at',  // newly added
                            'StaffTransfers.school_name_at_transfer', 
                            'StaffTransfers.staff_type_name', 
                            'StaffTransfers.aid_name',
                            'StaffTransfers.status',
                            'StaffTransfers.stage1_fwd_to_target'
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
                    ],
                    'Districts' => [
                        'table' => 'districts',
                        'type' => 'INNER',
                        'conditions' => 'Districts.code = Blocks.district_code::int'
                    ]
                    
                ])     
                ->where([
                    'StaffTransfers.status IN' => $this->statuses,
                    'StaffTransfers.stage1_fwd_to' => $this->Jurisdiction,
                    //'StaffTransfers.stage1_fwd_to_target' => (int) $this->dcode
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

    public function ng2gTransferPriSec()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('division-clerk');    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');     

        $ng2g = $staffTransfersTable->find()
                ->select([
                            'district' => 'Districts.name',
                            'block' => 'Blocks.name',
                            'cluster' => 'Clusters.name',
                            'StaffTransfers.id', 
                            'StaffTransfers.staff_id', 
                            'StaffTransfers.employee_name', 
                            'StaffTransfers.designation',
                            'institution_name', 
                            'StaffTransfers.school_name', 
                            'StaffTransfers.school_name_at_transfer', 
                            'StaffTransfers.staff_type_name', 
                            'StaffTransfers.aid_name',
                            'StaffTransfers.status',
                            'StaffTransfers.stage1_fwd_to_target'
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
                    ],
                    'Districts' => [
                        'table' => 'districts',
                        'type' => 'INNER',
                        'conditions' => 'Districts.code = Blocks.district_code::int'
                    ],
                    'Regions' => [
                        'table' => 'regions',
                        'type' => 'INNER',
                        'conditions' => 'Regions.id = Districts.region_id::int' 
                    ]
                    
                ])     
                ->where([
                    'StaffTransfers.status' => 'dyd_clerk_desk_pending',
                    'StaffTransfers.stage1_fwd_to IN' => [1,2],
                    //'StaffTransfers.stage1_fwd_to_target' => (int) $this->dcode
                    'Regions.code' => (int)$this->dcode
                    
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
           
            $app_stage = 'dyd_clerk_primary_approved';
            $status= 'dyd_deputy_education_inspector_primary_desk_pending';
            if($transfer->stage1_fwd_to == 1){
                $app_stage = 'dyd_clerk_primary_approved';
            $status= 'dyd_deputy_education_inspector_primary_desk_pending';
            }else if($transfer->stage1_fwd_to == 2){
                $app_stage = 'dyd_clerk_secondary_approved';
                $status= 'dyd_deputy_education_inspector_secondary_desk_pending';
            }else if($transfer->stage1_fwd_to == 4){
                $app_stage = 'dyd_clerk_higher_secondary_approved';
                $status= 'dyd_assistant_deputy_inspector_higher_secondary_desk_pending';
            }


            //'pending'::staff_update_statuses_enum
            $staffData = [               
                'status'            => $status, 
                'dyd_clk_remark'        => $data['app_remark'] ?? null,
                'dyd_clk_replied_by' => $this->user_id,
                'dyd_replied_at'  =>  time()           

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
                $newFileName = 'dyd_clk_replied_file.' . $extension;

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

                $staffData['dyd_clk_replied_file'] = $fileName;
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
                'stage_doc' => $fileName,
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
                'status'            => 'dyd_clerk_rejected', 
                'dyd_clk_remark'        => $data['reject_remark'] ?? null,
                'dyd_clk_replied_by' => $this->user_id,
                'dyd_clk_replied_at'  =>  time()           

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
                $newFileName = 'dyd_clk_replied_file.' . $extension;

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

                $staffData['dyd_clk_replied_file'] = $fileName;
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


            $app_stage = 'dyd_clerk_primary_rejected';           
            if($transfer->stage1_fwd_to == 1){
                $app_stage = 'dyd_clerk_primary_rejected';            
            }else if($transfer->stage1_fwd_to == 2){
                $app_stage = 'dyd_clerk_secondary_rejected';              
            }else if($transfer->stage1_fwd_to == 4){
                $app_stage = 'dyd_clerk_secondary_rejected';             
            }

            $ng2g_id = $transfer->id;            
            $stTime = time();
            $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
            $logData = [
                'ng2g_id'      => $ng2g_id,
                'transaction_id' => $stTime,
                'app_stage'    => $app_stage,
                'stage_remark' => $data['reject_remark'] ?? null,
                'stage_doc' => $fileName,
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
