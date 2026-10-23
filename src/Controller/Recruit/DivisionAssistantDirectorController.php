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

class DivisionAssistantDirectorController extends AppController
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
            'ng2gApproveTransfer','ng2gRejectTransfer',
            'staffSeniorityList','advertisementVacancyAjax',
            'advertisementList',            
            'staffOnboardForward',
            'advertisementPostforword'
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
        
        
        $this->statuses = ['dyd_assistant_director_higher_secondary_desk_pending'];   
        $this->set('user', $user);
        $this->set('division', $division);       
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }

    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        
        $this->viewBuilder()->setLayout('recruit/division-assistant-director');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

       // $schools = $schoolsTable->find()->all();
       
       /* $totalSchools = $schoolsTable
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

       // pending
       //  $sanchPostSanctionWorkingTable = TableRegistry::getTableLocator()->get('SanchPostSanctionWorking');

       /* echo "<pre>";
        print_r($updateStatus);
        exit;*/
        //$this->set('schools', $schools);
       /* $this->set('totalSchools', $totalSchools);
        $this->set('openSchools', $openSchools);
        $this->set('closeSchools', $closeSchools);
        $this->set('ng2gCount', $ng2gCount);
        $this->set('udise', $this->username);
        $this->set('updateStatus', $updateStatus);
        $this->set('staffsType', $result);
        $this->set('districtCount', $districts);
        $this->set('blockCount', $blocks);
        $this->set('clusterCount', $clusters);*/

         $this->set('advertisementStatusCounts', $advertisementStatusCounts);
        
    }
 
  


     public function advertisementList()
    {
      
       $districtTable = TableRegistry::getTableLocator()->get('Districts');
        $districts = $districtTable->find()->all();
        $regionTable = TableRegistry::getTableLocator()->get('Regions');
        $regions = $regionTable->find()->all();
        
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit/division-assistant-director');

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
        $ng2g = $postAdvertisementTable->getAdvertisementHSList();

        
       
       

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

        $this->set('ddovacant', $ddovacant);               
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);        
        $this->set('districts', $districts);
        $this->set('regions', $regions);



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
        
        

        return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => ['ng2g'=>$ng2g,
                    'vancancyData'=>$vacancyData,
                    'approvalLetterUrl' => $approvalLetterUrl,
                    'sanchManyataUrls' => $sanchManyataUrls
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
        $this->viewBuilder()->setLayout('recruit/division-assistant-director');

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


 $approvedLogDocuments = [];
        $applicationIds = array_map(static function ($post): int {
            return (int)$post->soa_id;
        }, $ng2g->toArray());

        if ($applicationIds !== []) {
            $logsTable = $this->fetchTable('StaffOnboardApplicationLogs');
            $approvedLogs = $logsTable->find()
                ->select(['app_id', 'stage_doc', 'created_at'])
                ->where([
                    'app_id IN' => $applicationIds,
                    'app_stage' => 'Approved',
                    'stage_doc IS NOT' => null,
                ])
                ->order(['created_at' => 'DESC'])
                ->all();

            foreach ($approvedLogs as $approvedLog) {
                $approvedLogDocuments[(int)$approvedLog->app_id] ??= $approvedLog->stage_doc;
            }
        }

       //echo "<pre>"; print_r($ng2g);  exit;
                    
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);  
        $this->set('mnp_nps', $mnp_nps);
        $this->set('districts', $districts);
        $this->set('regions', $regions);
         $this->set('approvedLogDocuments', $approvedLogDocuments);


    }


    
     public function staffOnboardForward()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $files = $this->request->getUploadedFiles();
        $identity = $this->request->getAttribute('identity');
        $userId = $identity ? $identity->getIdentifier() : null; 
        $connection = ConnectionManager::get('default');
        $connection->begin();

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
            
          
            $staffData = [               
                'status'            => 'Forwarded',
                'remark'            => trim($data['remark'] ?? '')

            ];
           
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
                        'message' => 'Unable to forward Staff Onboarding application'
                    ]));
            }

     
            if (!$this->addApplicationLog(
                                   $onboard->id,
                                    'forword',
                                    $userId,
                                    $data['forword_remark'] ?? null,
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
                    'message' => 'Staff Onboarding application forwarded successfully'
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

    
     public function advertisementPostforword(){

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
            'forward'       => 'forwarded_dyd_ad',
            'reject'        => 'rejected',
            'correction'    => 'send_back_correction',
            'clarification' => 'request_clarification'
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

        $previousStatus = $postAdvertisement->status;    

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

        // Update status
        $postAdvertisement->status = $newStatus;

         // Save reject reason
        if ($action === 'reject') {
            $postAdvertisement->reject_reason = $rejectReason;
        }
        if ($action === 'forward' || $action === 'approve') {
            $postAdvertisement->remark  = $forwardReason;
        }
        
         $identity = $this->request->getAttribute('identity');

        $userId = $identity
            ? $identity->getIdentifier()
            : null;

       // Save
        if ($postAdvertisementTable->save($postAdvertisement)) {

            $messages = [
                'approved' => 'Application Approved successfully',
                'forwarded' => 'Application Forwarded successfully',
                'rejected' => 'Application Rejected successfully',
                'send_back_correction' => 'Application sent back for correction successfully',
                'request_clarification' => 'Clarification requested successfully',
                'forwarded_dyd_dadi' => 'Application forwarded to DYD/DADI successfully',
                'forwarded_dyd_ad' => 'Application forwarded to DYD/AD successfully'
            ];

            $this->createAdvertisementAudit(
                    $postAdvertisementId,
                    $userId,
                    $action,
                    $previousStatus,
                    $newStatus,
                    $forwardReason,
                    1
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

    private function createAdvertisementAudit(
                        int $postAdvertisementId,
                        ?int $userId,
                        string $action,
                        ?string $previousStatus,
                        ?string $newStatus,
                        ?string $remarks = null,
                        ?int $version = null)
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
            'metadata' => null
        ]);

        return $auditTable->save($audit);
    }

  }
