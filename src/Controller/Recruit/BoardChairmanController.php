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


class BoardChairmanController extends AppController
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
            'staffSeniorityList','advertisementVacancyAjax',
            'advertisementList',
            'staffOnboardForward',
            'advertisementPostforword',
            'staffOnboardRejectPrepare',
            'addApplicationLog',
            'staffOnboardGenrateFile',
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
        $this->viewBuilder()->setLayout('recruit/board-chairman');

        


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
        $this->viewBuilder()->setLayout('recruit/board-chairman');

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
        
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit/board-chairman');

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
                'status'            => 'Forwarded_dyd_clerk',
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
                                    'Forwarded_dyd_clerk',
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
            'forward'       => 'forwarded_dyd_clerk',
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
                'forwarded_dyd_clerk' => 'Application forwarded to DYD Clerk successfully'
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

     public function headerUpload()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit/board-chairman');

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

    public function staffOnboardRejectPrepare()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $staffId = filter_var($data['reject_id'] ?? null, FILTER_VALIDATE_INT);

        if (!$staffId) {
            return $this->response
                ->withStatus(400)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Invalid staff application.',
                ]));
        }

        $appointmentsTable = $this->fetchTable('StaffOnboardingAppointments');
        $onboard = $appointmentsTable->find()
            ->where(['staff_id' => $staffId])
            ->order(['id' => 'DESC'])
            ->first();

        if (!$onboard) {
            return $this->response
                ->withStatus(404)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Staff onboarding application not found.',
                ]));
        }

        $rejectedDocuments = $this->getStaffOnboardRejectedDocuments($data);
        $remark = trim((string)($data['reject_remark'] ?? ''));
        if (!$rejectedDocuments && $remark === '') {
            return $this->response
                ->withStatus(400)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Select a rejection reason or enter a remark.',
                ]));
        }

        $pdfLines = [];
        foreach ($rejectedDocuments as $index => $document) {
            $pdfLines[] = ($index + 1) . '. ' . $document;
        }
        if ($remark !== '') {
            $pdfLines[] = 'शेरा: ' . $remark;
        }

        $generatedDocument = 'uploads/staffonboarding/reject/staff_order_reject_' . $onboard->id . '.pdf';
        $generation = $this->generateRejectLetter((int)$onboard->id, implode("\n", $pdfLines));
        if (
            !is_file(WWW_ROOT . $generatedDocument)
            || (is_object($generation) && method_exists($generation, 'getStatusCode') && $generation->getStatusCode() >= 400)
        ) {
            return $this->response
                ->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Unable to generate the rejection PDF.',
                ]));
        }

        $basePath = $this->request->getAttribute('base') ?? '';
        $pdfUrl = $this->request->scheme() . '://' . $this->request->host()
            . $basePath . '/' . ltrim($generatedDocument, '/')
            . '?v=' . filemtime(WWW_ROOT . $generatedDocument);

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'success' => true,
                'url' => $pdfUrl,
                'staff_id' => $staffId,
                'application_id' => $onboard->id,
            ]));
    }

    private function getStaffOnboardRejectedDocuments(array $data): array
    {
        $fields = [
            'ssc_doc_chk' => 'माध्यमिक (SSC)',
            'hsc_doc_chk' => 'उच्च माध्यमिक (HSC)',
            'graduate_doc_chk' => 'पदवी (Graduate Degree)',
            'post_graduate_doc_chk' => 'पदव्युत्तर पदवी (Post Graduate Degree)',
            'horizontalcertificate_doc_chk' => 'समांतर आरक्षण प्रमाणपत्र',
            'castecertificate_doc_chk' => 'जात प्रमाणपत्र',
            'validcastecertificate_doc_chk' => 'जात वैधता प्रमाणपत्र',
            'adv_approval_doc_chk' => 'जाहिरात मंजूरी पत्र',
            'advertisement_doc_chk' => 'जाहिरात',
            'signature_doc_chk' => 'उमेदवारांच्या स्वाक्षरीची यादी',
            'marking_doc_chk' => 'उमेदवार गुणांकन',
            'resolution_doc_chk' => 'संस्थेचा ठराव',
            'order_doc_chk' => 'आदेश',
            'court_roster_doc_chk' => 'रोस्टर (Roster)',
            'court_order_doc_chk' => 'न्यायालयीन आदेश',
            'no_post_vacant' => 'पद रिक्त नाही',
        ];

        $selected = [];
        foreach ($fields as $field => $label) {
            if (!empty($data[$field])) {
                $selected[] = $label;
            }
        }

        return $selected;
    }

    public function generateRejectLetter($appId,$text)
    {
        $this->autoRender = false;

        try {
            $appId = (int)$appId;
            if ($appId <= 0) {
                throw new \InvalidArgumentException('Invalid application ID');
            }

            $appointment = $this->fetchTable('StaffOnboardingAppointments')->find()
                ->where(['id' => $appId])
                ->first();
            if (!$appointment) {
                throw new \RuntimeException('Staff onboarding application not found.');
            }

            $vacancy = $this->fetchTable('PostAdvertisementVacancies')->find()
                ->where(['id' => $appointment->staff_id])
                ->first();
            if (!$vacancy) {
                throw new \RuntimeException('Staff vacancy details not found.');
            }

            $postAdvertisement = $this->fetchTable('PostAdvertisement')->find()
                ->where(['id' => $vacancy->post_advertisement_id])
                ->first();
            if (!$postAdvertisement) {
                throw new \RuntimeException('Advertisement details not found.');
            }

            $staffName = (string)$appointment->candidate_name;
            $orderDate = date('d-m-Y');
            $post = (string)$vacancy->post_name;
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $createdAt = $appointment->created_at ?? null;
            $proposalDate = $createdAt instanceof \DateTimeInterface
                ? $createdAt->format('d-m-Y')
                : date('d-m-Y');
            $sansthaCode = (string)($postAdvertisement->institution_code ?? '');
            $sansthaName = (string)($postAdvertisement->institution_name ?? '');
            $schoolCode = (string)($vacancy->school_udise_code ?? '');
            $schoolName = (string)($vacancy->school_name ?? $sansthaName);

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
                'school_name' => $schoolName,
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
            $letterData['reject_text'] = nl2br(h((string)$text));


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
                            font-size: 20px;
                            line-height: 1.7;
                            margin: 0px 30px;
                            color: #111;
                        }
                       .header-img {
                            display: block;
                            width: 100%;
                            height: auto;
                            margin: 0 auto 8px auto;
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
                        .reject-dsc-signature-block {
                            position: relative;
                            width: 180px;
                            margin-left: auto;
                            margin-right: 0;
                            text-align: center;
                            margin-top: 20px;
                        }
                        .reject-dsc-signature-label {
                            margin: 0 0 5px;
                            font-size: 14px;
                            font-weight: 600;
                        }
                        .reject-dsc-signature-marker {
                            display: inline-block;
                            font-size: 1px;
                            line-height: 1px;
                            color: #ffffff;
                        }
                        .reject-dsc-signature-area {
                            height: 65px;
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
                    <span class="indent">अध्यक्ष/सचिव संबंधित संस्था,
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
                    <p>उपरोक्त संदर्भाधिन पत्रानुसार <strong>' . h($data['school_name'] ?? '') . '</strong> येथील <strong>' . h($data['teacher_name'] ?? '') . '</strong> यांची <strong>' . h($data['designation'] ?? '') . '</strong> पदावर नियुक्ती मान्यतेसाठी प्रस्ताव सादर करण्यात आला होता.</p>
                    <p>प्रस्तावाच्या छाननीअंती खालील त्रुटी आढळून आल्या आहेत.</p>
                </div>

                <div>' . ($data['reject_text'] ?? '') . '</div>
        
                <div>
                <p>उपरोक्त प्रस्तावामध्ये वरील त्रुटी आढळून आल्याने सदर प्रस्ताव परत पाठविण्यात येत आहे. सदर प्रस्तावातील त्रुटींची पूर्तता करून १५ दिवसांच्या आत फेरसादर करावा.</p>
                </div>
                <div>
                        <div class="reject-dsc-signature-block" id="reject-dsc-signature-position">
                            <p class="reject-dsc-signature-label">स्वाक्षरी/-</p>
                            <span class="reject-dsc-signature-marker">DSC_REJECT_POSITION_2026</span>
                            <div class="reject-dsc-signature-area"></div>
                        </div>

                        <!-- Fixed space -->
                        <div style="height: 150px;"></div>

                        <p style="margin:0;">
                            प्रत -
                        </p>

                       
                        <p>
                            १. मुख्‍याध्‍यापक  संबंधित शाळा  यांना माहितीसाठी व पुढील कार्यवाहीसाठी
                        </p>
                        <p>
                            २.संबंधित कर्मचारी यांना मुख्‍याध्‍यापकामार्फत.
                        </p>

                       
                    </div>


                <div style="clear:both;"></div>
            </body>
            </html>';
    }

private function findWkhtmltopdfBinary(): ?string
{
    $candidates = [
        'C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
        'C:\\Program Files (x86)\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
        'wkhtmltopdf', 
        '/usr/bin/wkhtmltopdf',
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


  function transliterateToMarathi($text)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $mar = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        return str_replace($eng, $mar, (string)$text);
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

            if (!$appointment) {
                throw new \RuntimeException('Staff onboarding application not found.');
            }

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

            if (!$postAdvertisementVacancy) {
                throw new \RuntimeException('Staff vacancy details not found.');
            }

            $postAdvertisement = TableRegistry::getTableLocator()
                ->get('PostAdvertisement')
                ->find()
                ->where(['id' => $postAdvertisementVacancy->post_advertisement_id])
                ->first();

            $staffName = (string)$appointment->candidate_name;
            $orderDate = date('d-m-Y');
            $post = (string)$postAdvertisementVacancy->post_name;
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $createdAt = $appointment->created_at ?? null;
            $proposalDate = $createdAt instanceof \DateTimeInterface
                ? $createdAt->format('d-m-Y')
                : date('d-m-Y');

            $sansthaCode = (string)($postAdvertisement->institution_code ?? '');
            $sansthaName = (string)($postAdvertisement->institution_name ?? '');
            $schoolCode = (string)($postAdvertisementVacancy->school_udise_code ?? '');
            $schoolName = (string)($postAdvertisementVacancy->school_name ?? $sansthaName);

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
                'school_name' => $schoolName,
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
            $html = $this->normalizeMarathiText($this->renderApprovalLetterViewContent($letterData));

            
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
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

                    <style>
                        @page {
                            size: A4 portrait;
                            margin: 12mm;
                        }
                        body {
                            font-family: "Kokila", "Arial Unicode MS", "Noto Sans Devanagari","Mangal", sans-serif;
                            font-size: 24px;
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
                            width: 100%;
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
                        .dsc-signature-block {
                            width: 260px;
                            margin-left: auto;
                            margin-top: 25px;
                            text-align: right;
                            page-break-inside: avoid;
                        }
                        .dsc-signature-label {
                            margin: 0;
                            text-align: right;
                        }
                        .dsc-signature-area {
                            height: 75px;
                            width: 260px;
                            margin-left: auto;
                        }
                        .dsc-signature-marker {
                            display: block;
                            font-family: Arial, sans-serif;
                            font-size: 8px;
                            line-height: 10px;
                            color: #ffffff;
                            white-space: nowrap;
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
                    <div>
                        आदेश :-
                    </div>
                <br>
                प्रति,
               <div>
                <span class="indent">अध्यक्ष / सचिव, संबंधित संस्था,</span>                    
            </div>
            <br>
            <div class="subject">
                विषय :- कनिष्ठ लिपिक/प्रयोगशाळा सहाय्यक/ग्रंथपाल पदाची वैयक्तिक मान्यता देणे बाबत.
            </div>
            <br>
            <div>
                संदर्भ :-
                <br>
                ' . $this->transliterateToMarathi("१. शासन पत्र क्र. न्यायाप्र/२०२३/प्र.क्र.३०/टिएनटी-२ दि. २१.०२.२०२४.
                <br>
                २. शिक्षण संचालनालयाचे पत्र क्र. शिसंमा-२०२४/शिक्षकेतर/न्याप्र-५०५८/२१/टी-४/११७९ दि. ०१.०३.२०२४.
                <br>
                ३. संचालनालयाचे पत्र क्र. शिसंमा/शिक्षकेतर पदभरती/कार्यासन टी-४/२५९२ दि. २८.०५.२०२५.
                <br>
                ४. शालेय शिक्षण व क्रीडा विभाग यांचे शासन निर्णय क्रमांक संकीर्ण-२०२६/प्र.क्र.२६६/ई-१७६८६६७/टीएनटी-१ दि. ११.०८.२०२६.
                <br>
                ५. शाळेचा प्रस्ताव.") . '
            </div>

            <div class="content">
                <p>वरील संदर्भीय विषयास अनुसरून आपणास कळविण्यात येते की, आपल्या संस्थेमार्फत करण्यात आलेल्या नेमणुकीस, कनिष्ठ लिपिक पदाच्या नेमणुकीस आपण प्रस्तावासोबत सादर केलेल्या कागदपत्रांच्या व खालील तपशिलाप्रमाणे नमूद अटींच्या अधीन राहून मान्यता देण्यात येत आहे.</p>

                <table style="width:100%; border:1px solid green; border-collapse: collapse;">
                    <tr>
                        <th style="border:1px solid green; padding: 5px;">अ.क्र.</th>
                        <th style="border:1px solid green; padding: 5px;">शिक्षकेतर कर्मचाऱ्याचे नाव</th>
                        <th style="border:1px solid green; padding: 5px;">शैक्षणिक पात्रता</th>
                        <th style="border:1px solid green; padding: 5px;">जात प्रवर्ग</th>
                        <th style="border:1px solid green; padding: 5px;">पदनाम</th>
                        <th style="border:1px solid green; padding: 5px;">नेमणुकीचा दिनांक</th>
                        <th style="border:1px solid green; padding: 5px;">वेतनश्रेणी / मानधन</th>
                        <th style="border:1px solid green; padding: 5px;">मान्यता प्रकार</th>
                        <th style="border:1px solid green; padding: 5px;">शेरा</th>
                    </tr>
                    ' . $staffTableRows . '
                </table>
            </div>
            <div class="content">                  
                <p><strong>अटी :-</strong></p>
                <p>१. शिक्षकेतर कर्मचाऱ्यांच्या मान्यतेसंदर्भातील शालेय शिक्षण व क्रीडा विभागाचा शासन निर्णय क्र. एसएसएन-२६०३/(४१/०३)/माशि-२ दि. २५ नोव्हेंबर २००५, शासन शुद्धीपत्रक क्र. एसएसएन-१००८/(२००/०८)/माशि-२ दि. १३ मार्च २००९, वित्त विभागाचा शासन निर्णय क्रमांक असंप्र-१०१०/प्र.क्र.१/२०१० वित्तीय सुधारणा-१ दिनांक ०५ जून २०१० आणि शासन निर्णय दिनांक २८/०१/२०१९ च्या आकृतीबंधानुसार प्रयोगशाळा सहायक / कनिष्ठ लिपिक पदासाठी अनुज्ञेय असलेल्या नेमणुकीस मान्यता देण्यात येत आहे.</p>
                <p>२. कर्मचाऱ्यांनी / संस्थेनी या कार्यालयात सादर केलेल्या प्रस्तावानुसार संबंधित कर्मचाऱ्याच्या नेमणुकीस मान्यता देण्यात येत आहे. या बाबत एखाद्या कर्मचाऱ्याने न्यायिक मार्गाचा अवलंब केल्यास न्यायालयाचा निर्णय संस्थेवर बंधनकारक राहील. तसेच एखाद्या कर्मचाऱ्याने तक्रार केल्यास व त्यामध्ये तथ्य आढळल्यास दिलेली मान्यता रद्द करण्यात येईल.</p>
                <p>३. सध्या सेवेत असलेल्या कर्मचाऱ्यास सेवेतून कमी करून नवीन कर्मचाऱ्याची नेमणूक केली असल्याचे या कार्यालयाच्या निदर्शनास आल्यास, सदरचे मान्यता आदेश तात्काळ रद्द करण्यात येतील आणि अदा करण्यात आलेले वेतन विहित पद्धतीचा अवलंब करून संस्थेकडून वसूल करण्यात येईल.</p>
                <p>४. मंजूर पदापेक्षा जास्त शिक्षक / शिक्षकेतर कर्मचाऱ्यांच्या नेमणुका केल्यास व त्यासाठी या कार्यालयाची मान्यता घेतल्यास, संबंधित शाळेचे मुख्याध्यापक व संस्था यासाठी जबाबदार राहील. तसेच मंजूर पदापेक्षा जादा नेमणूक करण्यात आलेल्या कर्मचाऱ्याच्या वेतनाची वसुली संस्थेस देय असलेल्या वेतनेत्तर अनुदानातून कपात करण्यात येईल.</p>
                <p>५. संस्थेत अतिरिक्त कर्मचारी असताना नवीन नेमणुकीस मान्यता घेतल्यास, सदर नेमणुकीची मान्यता रद्द करून नवीन नेमणूक केलेल्या कर्मचाऱ्यास दिलेले वेतन व भत्ते संस्थेकडून वसूल केले जातील.</p>
                <p>६. एखाद्या कर्मचाऱ्याचे प्रकरण न्यायप्रविष्ट असेल, अशा कर्मचाऱ्याच्या जागी दुसऱ्या कर्मचाऱ्याची नेमणूक करू नये. सदर बाब या कार्यालयाच्या निदर्शनास न आणता संस्थेने अशी नेमणूक केली असल्यास आणि अशा नवीन नेमणूक केलेल्या सेवकाची या कार्यालयाकडून मान्यता घेऊन संबंधित सेवकास वेतन अदा केल्यास, ते वेतन संस्थेकडून वसूल करण्यात येईल.</p>
                <p>७. संस्थेतील अतिरिक्त कर्मचाऱ्याचा यापूर्वी इतर कोणत्याही संस्थेच्या माध्यमिक शाळेत सामावून घेण्यात आले असल्यास आणि नवीन नेमणुकीपूर्वी अशा कर्मचाऱ्यास संस्थेत पुन्हा सेवेत घेण्याबाबतचा विकल्प (ना हरकत प्रमाणपत्र) न घेता नवीन नेमणूक केल्यास व अशा नेमणुकीस खात्याकडून मान्यता घेतल्याचे निदर्शनास आल्यास, यापूर्वी सामावून घेतलेल्या सेवकाची तक्रार आल्यास नव्या नेमणुकीस दिलेली मान्यता रद्द करण्यात येईल व नव्याने नेमणूक दिलेल्या कर्मचाऱ्याचे वेतन संस्थेकडून वसूल करण्यात येईल.</p>
                <p>८. मान्यतेसाठी पाठविलेल्या प्रस्तावात एखाद्या कर्मचाऱ्याचे नाव वगळून दुसऱ्या कर्मचाऱ्याच्या नेमणुकीस मान्यता घेतली असल्यास व भविष्यात याबाबत कोणतीही अडचण उद्भवल्यास, त्यास मुख्याध्यापक व संस्था पूर्णपणे जबाबदार राहील.</p>
                <p>९. सदरचे प्रस्ताव शालार्थ प्रणाली मध्ये समाविष्ट करण्यासाठी मा. शिक्षण / विभागीय शिक्षण मंडळ कार्यालयाकडे पाठविण्यात येतील. त्यांच्या स्तरावरून सदर कर्मचाऱ्याचे नाव शालार्थ प्रणालीमध्ये समाविष्ट न झाल्यास, दिलेली ही मान्यता रद्द समजण्यात येईल.</p>
            </div>     

            <div class="content">
                    <div class="dsc-signature-block" id="dsc-signature-position">
                        <p class="dsc-signature-label">स्वाक्षरी/-</p>
                        <span class="dsc-signature-marker">DSC_SIGNATURE_POSITION_2026</span>
                        <div class="dsc-signature-area"></div>
                    </div>

                    <!-- Fixed space -->
                    <div style="height: 150px;"></div>

                    <p style="margin:0;">
                        <strong>प्रत :-</strong>
                    </p>
                    <p>१. शिक्षण उपसंचालक / अध्यक्ष, विभागीय शिक्षण मंडळ.</p>
                    <p>२. अधीक्षक, वेतन पथक व भविष्य निर्वाह निधी (माध्यमिक) --------- यांना माहितीसाठी व पुढील कार्यवाहीसाठी.</p>
                    <p>३. मुख्याध्यापक, संबंधित शाळा यांना माहितीसाठी व पुढील कार्यवाहीसाठी.</p>
                    <p>४. संबंधित कर्मचारी यांना मुख्याध्यापकांमार्फत.</p>
                </div>

                            <div style="clear:both;"></div>
                            </div>
                        </body>
                        </html>';
    }

    private function normalizeMarathiText(string $text): string
    {
        // Remove UTF-8 BOM if present
        $text = preg_replace('/^\xEF\xBB\xBF/', '', $text);

        // Normalize Unicode characters to NFC, if intl extension is enabled
        if (class_exists(\Normalizer::class)) {
            $normalized = \Normalizer::normalize(
                $text,
                \Normalizer::FORM_C
            );

            if ($normalized !== false) {
                $text = $normalized;
            }
        }

        // Remove invalid UTF-8 sequences only when necessary
        if (!mb_check_encoding($text, 'UTF-8')) {
            $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        }

        return $text;
    }

  }
