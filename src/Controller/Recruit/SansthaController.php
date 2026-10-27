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
use App\Service\SmsNotificationService;

//App\Controller\stdClass


class SansthaController extends AppController
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
            'fetchSanchDetails',
            'sanctionedWorkingStrength',
            'unifiedDataIntegration',
            'processIndividualApprovalOrder',
            'updateSanchWorkingData',
            'processVacacyRequest',
            'uploadAdvertisementDocument',
            'advertisementVacancyAjax',
            'saveStaffOnboarding',
            'getStaffOnboardingDetails',
            'processVacacyPublish',
            'getStaffadvertisementDetails',
        ]);

        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
        }
        
        $sessionUser = $this->request->getSession()->read('Auth.User');

       // echo '<pre/>';print_r($user->Sanstha->name);exit;
       
        if (!$sessionUser) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $role = $user->getOriginalData()->role ?? null;

       
        if ($role !== 'sanstha') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
        }

        $this->user_id = $this->request->getSession()->read('Auth.User.id');
        $this->username = $this->request->getSession()->read('Auth.User.username');
     

        $user = $this->request->getSession()->read('Auth.User');
        $sanstha = $this->request->getSession()->read('Auth.Sanstha');
        /*echo "<pre>";
        print_r( $user);
        exit;*/
        $this->set('user', $user);
        $this->set('sanstha', $sanstha);
       
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }

    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-sanstha');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        //$schools = $schoolsTable->find()->where(['cluster_code' => $this->username])->all();

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();
       
        $totalSchools = $schools->count();
        // Schools with school_close = 'NO'
        $openSchools = $schools->filter(function ($school) {
            return $school->school_close === 'NO';
        })->count();
        $closeSchools = $totalSchools - $openSchools;

        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');


          $blockCode = $this->username;
            

            $ng2gCount = $staffTransfersTable->find()//->where(['sanstha_code' => $this->username])
             ->join([
                'Schools' => [
                    'table' => 'schools',
                    'type' => 'INNER',
                    'conditions' => 'Schools.udise_code = StaffTransfers.udise_number'
                ],
                'Sansthas' => [
                    'table' => 'sansthas',
                    'type' => 'INNER',
                    'conditions' => 'Sansthas.code = Schools.sanstha_code'
                ]
            ])
            ->where(['schools.sanstha_code' => $this->username])
                ->count();

        
       

        $this->set('cluster_code', $this->username);
        $this->set('schools', $schools);
        $this->set('totalSchools', $totalSchools);
        $this->set('openSchools', $openSchools);
        $this->set('closeSchools', $closeSchools);
         $this->set('ng2gCount', $ng2gCount);

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
        $this->viewBuilder()->setLayout('recruit-sanstha');

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
                'PostAdvertisement.institution_code' => $this->username
            ])    
            ->order([
                'PostAdvertisement.created_at' => 'DESC',
                'PostAdvertisementVacancies.id' => 'ASC'
            ])
            ->all();

        //$payScalesTable = TableRegistry::getTableLocator()->get('PayScales');                   
        //$payScalesDetails = $payScalesTable->find()->all();
        $payScalesDetails = [
                            'librarian'=>14000,
                            'laboratory_assistant'=>12000,
                            'junior_clerk'=>10000];
        $matrimonial = [
            'Single',
            'Married',
            'Divorced',
        ] ;                   

    
        $postKey = 'junior_clerk';

        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);  
        $this->set('mnp_nps', $mnp_nps);
        $this->set('districts', $districts);
        $this->set('regions', $regions);
        $this->set('postKey', $postKey);
        $this->set('payScales', $payScalesDetails);
        $this->set('matrimonial', $matrimonial);

    }
    public function sanctionedWorkingStrength()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-sanstha');

        $acYear = "2025-26";

      

        $postSanctionedTable = $this->fetchTable('PostSanctioned');
        $query = $postSanctionedTable->find();   
        $query->select([
                'post_type',
                'post_id',
                'post_name' => 'p.name',
                'aid_id',
                'aid_name' => 'am.name',
                'total_posts' => $query->func()->sum('PostSanctioned.num_posts')
            ])
            ->leftJoin(
                ['am' => 'aid_master'],
                ['am.id = PostSanctioned.aid_id']
            )
            ->leftJoin(
                ['p' => 'posts'],
                [
                    'p.code = PostSanctioned.post_id',
                    'p.staff_type = PostSanctioned.post_type'
                ]
            )
            ->leftJoin(
                ['s' => 'schools'],
                ['s.udise_code = PostSanctioned.udise_code']
            )
            ->where([
                's.sanstha_code' => $this->username,
                'PostSanctioned.ac_year' => $acYear
            ])
            ->group([
                'post_type',
                'post_id',
                'p.name',
                'aid_id',
                'am.name'
            ]);

        $postSanctioned = $query->all();

        $posts = [];

        foreach ($postSanctioned as $row) {

            $postType = $row->post_type;
            $postName = $row->post_name;

            // Initialize post_name bucket if not exists
            if (!isset($posts[$postType][$postName])) {
                $posts[$postType][$postName] = [
                    'post_name' => $postName,
                    'allow' => []
                ];
            }

            // Push aid data
            $posts[$postType][$postName]['allow'][] = [
                'aid_id' => $row->aid_id,
                'posts'  => $row->total_posts
            ];
        }

        /*
        * Optional: Re-index post_name level numerically
        */
        foreach ($posts as $type => $data) {
            $posts[$type] = array_values($data);
        }



        $postWorkingTable = $this->fetchTable('PostWorking');
        $query = $postWorkingTable->find();   
        $query->select([
                'post_type',
                'post_id',
                'post_name' => 'p.name',
                'aid_id',
                'aid_name' => 'am.name',
                'total_posts' => $query->func()->count('PostWorking.id')
            ])
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
                ['s' => 'schools'],
                ['s.udise_code = PostWorking.udise_code']
            )
            ->where([
                's.sanstha_code' => $this->username,
                'PostWorking.ac_year' => $acYear
            ])
            ->group([
                'post_type',
                'post_id',
                'p.name',
                'aid_id',
                'am.name'
            ]);

        $postWorking = $query->all();

        $working = [];

        foreach ($postWorking as $row) {

            $postType = $row->post_type;
            $postName = $row->post_name;

            // Initialize post_name bucket if not exists
            if (!isset($working[$postType][$postName])) {
                $working[$postType][$postName] = [
                    'post_name' => $postName,
                    'work' => []
                ];
            }

            // Push aid data
            $working[$postType][$postName]['work'][] = [
                'aid_id' => $row->aid_id,
                'working'  => $row->total_posts
            ];
        }

        /*
        * Optional: Re-index post_name level numerically
        */
        foreach ($working as $type => $data) {
            $working[$type] = array_values($data);
        }



        /*

        foreach ($postSanctioned as $row) {

            $postType  = $row->post_type;
            $postName  = $row->post_name;
            $aidId     = $row->aid_id;
            $total     = $row->total_posts;

            $posts[$postType][$postName][$aidId] = $total;
        }*/


        /*echo "<pre>";
        print_r($posts);
        exit;*/
        /*$connection = ConnectionManager::get('default');

        $sql = "
        WITH sanctioned AS (
            SELECT distinct post_type,  post_id, p.name as post_name, aid_id,am.name as aid_name, num_posts
            FROM post_sanctioned
            LEFT JOIN public.aid_master AS am ON (am.id = post_sanctioned.aid_id)
            LEFT JOIN public.posts AS p ON (p.code = post_sanctioned.post_id AND p.staff_type = post_sanctioned.post_type)
            LEFT JOIN public.schools AS s ON (s.udise_code = post_sanctioned.udise_code)
            WHERE s.sanstha_code = :sanstha_code
            AND ac_year = :ac_year
        ),
        working AS (
            SELECT distinct post_type,  post_id, p.name as post_name, aid_id, am.name as aid_name,
                COUNT(post_working.id) AS working_posts
            FROM post_working
            LEFT JOIN public.aid_master AS am ON (am.id = post_working.aid_id)
            LEFT JOIN public.posts AS p ON (p.code = post_working.post_id AND p.staff_type = post_working.post_type)
            LEFT JOIN public.schools AS s ON (s.udise_code = post_working.udise_code)
            WHERE s.sanstha_code = :sanstha_code
            AND ac_year = :ac_year
            GROUP BY post_type, post_id, post_name, aid_id, aid_name, post_working.udise_code, ac_year
        )
        SELECT 
            COALESCE(s.post_type, w.post_type) AS post_type,
           
            COALESCE(s.post_id, w.post_id)     AS post_id,
            COALESCE(s.post_name, w.post_name)     AS post_name,
            COALESCE(s.aid_id, w.aid_id)       AS aid_id,
            COALESCE(s.aid_name, w.aid_name)       AS aid_name,    
            COALESCE(s.num_posts, 0)           AS sanctioned_posts,
            COALESCE(w.working_posts, 0)       AS working_posts,
            (COALESCE(s.num_posts, 0) - COALESCE(w.working_posts, 0)) AS vacancy,
            CASE 
                WHEN COALESCE(s.num_posts, 0) = 0 
                    AND COALESCE(w.working_posts, 0) > 0 THEN 'Excess'
                WHEN COALESCE(s.num_posts, 0) > COALESCE(w.working_posts, 0) THEN 'Vacant'
                WHEN COALESCE(s.num_posts, 0) = COALESCE(w.working_posts, 0) THEN 'Filled'
                WHEN COALESCE(s.num_posts, 0) < COALESCE(w.working_posts, 0) THEN 'Excess'
                ELSE 'Unknown'
            END AS status
        FROM sanctioned s
        FULL OUTER JOIN working w
            ON  s.post_type = w.post_type          
            AND s.post_id   = w.post_id
            AND s.aid_id    = w.aid_id
        ORDER BY post_type, post_id, aid_id
        ";

        $stmt = $connection->execute($sql, [
            'sanstha_code' => $this->username,
            'ac_year'    => $acYear
        ]);

        $sanch = $stmt->fetchAll('assoc');*/

        $merged = [];

        foreach ($posts as $cat => $sposts) {
            foreach ($sposts as $p) {
                $postName = $p['post_name'];

                foreach ($p['allow'] as $a) {
                    $aid = $a['aid_id'];

                    $merged[$cat][$postName][$aid]['post_name'] = $postName;
                    $merged[$cat][$postName][$aid]['aid_id'] = $aid;
                    $merged[$cat][$postName][$aid]['allow'] = $a['posts'];
                    $merged[$cat][$postName][$aid]['work'] = 0;
                }
            }
        }

        foreach ($working as $cat => $wposts) {
            foreach ($wposts as $p) {
                $postName = $p['post_name'];

                foreach ($p['work'] as $w) {
                    $aid = $w['aid_id'];

                    if (!isset($merged[$cat][$postName][$aid])) {
                        $merged[$cat][$postName][$aid] = [
                            'post_name' => $postName,
                            'aid_id' => $aid,
                            'allow' => 0,
                            'work' => 0
                        ];
                    }

                    $merged[$cat][$postName][$aid]['work'] = $w['working'];
                }
            }
        }


       

        /*echo "<pre>";
         print_r($merged);
        print_r($posts);
        print_r($working);
        exit;*/
        $this->set('posts', $merged);
       // $this->set('working', $working);

    }
    public function unifiedDataIntegration()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-sanstha');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();

        $this->set('schools', $schools);
     


        //$this->render('/Headmaster/dashboard');
    }

    

    

    public function processIndividualApprovalOrder()
    {
       
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
       
        /*echo "<pre>";
        print_r( $data);
        exit;*/
        $files = $this->request->getUploadedFiles();

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
            /* ===============================
            * 1. SAVE STAFF TRANSFER (TEXT)
            * =============================== */
           
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            if (!empty($data['id'])) {
                $transfer = $staffTransferTable->get($data['id']);
            } else {
                $transfer = $staffTransferTable->newEmptyEntity();
            }

             //'pending'::staff id temp
            $data['staffId'] = $data['app_id'];
           
            $staffData = [
                'employee_name'=> $data['im_empName'] ?? null,              
                'staff_id' => $data['staffId'] ?? null,
                'status' => 'individual_order_eo_pending',
                'personal_recognition_number'  => $data['im_outwardNumber'] ?? null,
                'personal_recognition_date'  => $data['im_date'] ?? null,
                'fwd_to'  => (int) $data['forward_to'] ?? null,
                'fwd_to_target'  => (int) $data['forward_to_target'] ?? null,
                'post_working_id'   => $data['app_id'] ?? null
            ];

            /*echo "<pre>"; //staff_id, personal_recognition_number, personal_recognition_date, status, post_working_id
            print_r($staffData);
            exit;*/
           
            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/transfer_orders/'.$data['staffId'];

           

                
            if (!empty($data['im_doc']) && $data['im_doc']->getError() === UPLOAD_ERR_OK) {

                $file = $data['im_doc'];
                   
                if ($file->getClientMediaType() !== 'application/pdf') {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be a PDF File - Personal Recognition Document'
                        ]));
                }

                if ($file->getSize() > (2 * 1024 * 1024)) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit File - Personal Recognition Document'
                        ]));
                }

                if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Invalid File - Personal Recognition Document'
                        ]));
                }


                // Get temp path safely
                $tmpPath = $file->getStream()->getMetadata('uri');

                // Extract extension (safe)
                $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                // New filename
                $newFileName = 'ipro.' . $extension;

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

                $staffData['personal_recognition_file'] = $fileName;
            }
        
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);
           

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file - Personal Recognition Document'
                    ]));
                    //throw new BadRequestException(json_encode($transfer->getErrors()));
            }

            if (!$staffTransferTable->save($transfer)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to save staff transfer'
                    ]));
               // throw new BadRequestException('Unable to save staff transfer');
            }

            $postWorkingTable = $this->fetchTable('PostWorking');
            $workingPost = $postWorkingTable->get($data['app_id']);
            
            $postData = ['unaided_vaiyaktik_manyata' => true];

            $workingPost = $postWorkingTable->patchEntity($workingPost, $postData);
            $postWorkingTable->save($workingPost);

            $connection->commit();

           
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $transfer->id,
                    'ff' =>  $fileName ,
                    'message' => 'Transfer details saved successfully'.$fileName
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

    public function updateSanchWorkingData()
    {       
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $schoolId = $data['school_id'];
        $this->errorMsg = '';
        $sanchDataStatus = $this->fetchSanchWorkingDetails($schoolId);
       
        if ($sanchDataStatus == 1) {
            // Suppose update was successful
            $response = [
                'status' => 'success',
                'statusCode' => $sanchDataStatus,
                'message' => "The Sanch Manayata record has been successfully synchronized from the Saral Portal to the Staff Portal for UDISE '{$schoolId}'."
            ];
           
        } else {
            $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            if($sanchDataStatus == -101){
                if(empty($this->errorMsg)){
                    $msg = 'There was an issue while fetching data from Sanch Manayta. Please try again.';
                }else{
                    $msg = $this->errorMsg;
                }
                
            }else if($sanchDataStatus == -1){
                $msg = 'There was an issue while fetching data from Sanch Manayta. Please try again.';
            }else if($sanchDataStatus == -2){
                $msg = 'No record was found in the Sanch Manayta system for the provided School Code. Please verify the ID or contact the sanch technical team for further assistance.';
            }else if($sanchDataStatus == -3){
                $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            }
            $response = [
                'status' => 'error',
                'statusCode' => $sanchDataStatus,
                'message' => $msg
            ];
        }

        /* $response = [
                'status' => 'success',
                'statusCode' => 200,
                'message' => "The Sanch Manayata record has been successfully synchronized from the Saral Portal to the Staff Portal for UDISE '{$schoolId}'."
            ];*/

        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->setClassName('Json');
    }


    public function fetchSanchWorkingDetails($schoolId)
    {
    
        $workingAPI = 'http://115.124.116.194:8083/restApp/empinfo/brands/' . $schoolId;

        $http = new Client([
            'timeout' => 60.0,
            'connect_timeout' => 10.0,
        ]);

        $responseWorking = $http->get($workingAPI);
        $bodyWorking = $responseWorking->getJson();

        $tableWorking = TableRegistry::getTableLocator()->get('DdoMaster', [
            'table' => 'ddo_master',
            'className' => \Cake\ORM\Table::class,
        ]);

        $connection = ConnectionManager::get('default');

    
        //$dataWorking = $bodyWorking;

        $dataWorking = [[
                            6570792,
                            "02111100002",
                            "ganesh trainee School,andheri",
                            "15",
                            "357",
                            "385",
                            "02111100002",
                            "P",
                            2,
                            "2014-01-17T16:44:22.292Z[UTC]"
                            ]
                        ];

        //print_r($dataWorking);
        //exit;
        // debug removed — was halting execution before the save

        return $connection->transactional(function () use ($tableWorking, $schoolId, $dataWorking) {
            $entities = [];

                $inserted = 0;
                $updated = 0;
                $failed = 0;
                $total = 0;

                if (!is_array($dataWorking) || empty($dataWorking)) {
                    return [
                        'status'   => false,
                        'message'  => 'No DDO data found',
                        'total'    => 0,
                        'inserted' => 0,
                        'updated'  => 0,
                        'failed'   => 0,
                    ];
                }
        
            foreach ($dataWorking as $row1) {  
                  $total++;
            $locId = $row1[0] ?? null;

                if (!$locId) {
                    $failed++;
                    continue;
                }

                // Check if the DDO record already exists in ddo_master
                $existingEntity = $tableWorking->find()
                    ->where(['loc_id' => $locId])
                    ->first();

                   /*
                    * If loc_id is unique per school, use:
                    *
                    * ->where([
                    *     'loc_id' => $locId,
                    *     'school_udise_code' => $schoolId
                    * ])
                    */
    
                   $data = [
                            'school_udise_code' => $schoolId,
                            'loc_id'            => $locId,
                            'ddo_code'          => $row1[1] ?? '',
                            'off_name'          => $row1[2] ?? '',
                            'state_code'        => $row1[3] ?? '',
                            'district_code'     => $row1[4] ?? '',
                            'taluka_code'       => $row1[5] ?? '',
                            'dice_code'         => $row1[6] ?? '',
                            'dise_prefix'       => $row1[7] ?? '',
                            'ddo_type'          => $row1[8] ?? '',
                            'created_date'      => $row1[9] ?? null,
                        ];
                if ($existingEntity) {

                // UPDATE
                $entity = $tableWorking->patchEntity(
                    $existingEntity,
                    $data
                );

                if ($tableWorking->save($entity, [
                    'checkRules' => false
                ])) {

                    $updated++;

                    // Fetch vacancy details
                    $this->fetchDDOVacancyWorkingDetails(
                        $schoolId,
                        $row1[1] ?? null
                    );

                } else {

                    $failed++;

                    \Cake\Log\Log::error(
                        'Failed to update DDO: ' . ($row1[1] ?? 'Unknown')
                    );
                }

            } else {

                // INSERT
                $entity = $tableWorking->newEntity($data);

                if ($tableWorking->save($entity, [
                    'checkRules' => false
                ])) {

                    $inserted++;

                    // Fetch vacancy details
                    $this->fetchDDOVacancyWorkingDetails(
                        $schoolId,
                        $row1[1] ?? null
                    );

                } else {

                    $failed++;

                    \Cake\Log\Log::error(
                        'Failed to insert DDO: ' . ($row1[1] ?? 'Unknown')
                    );
                }
            }
                    
            }

        
            return [
                'status'   => true,
                'message'  => 'DDO data processed successfully',
                'total'    => $total,
                'inserted' => $inserted,
                'updated'  => $updated,
                'failed'   => $failed,
            ];
            

        });
    }


    public function fetchDDOVacancyWorkingDetails($schoolId,$ddo_code){

        $workingAPI = 'http://115.124.116.194:8083/restApp/empinfo/getdata/app/' . $ddo_code;

        $http = new Client([
            'timeout' => 60.0,
            'connect_timeout' => 10.0,
        ]);

        $responseWorking = $http->get($workingAPI);
        $bodyWorking = $responseWorking->getJson();

        $tableWorking = TableRegistry::getTableLocator()->get('DdoVacantMaster', [
            'table' => 'ddo_vacant_master',
            'className' => \Cake\ORM\Table::class,
        ]);

        $connection = ConnectionManager::get('default');

        //$dataWorking = $bodyWorking;

        $payScalesDetails = [
                        'librarian'             => 14000,
                        'laboratory_assistant'  => 12000,
                        'junior_clerk'          => 10000
                    ];


        $dataWorking = [   [
                            random_int(10000000, 99999999),
                            "librarian_77200438713"
                            ],
                            [
                            random_int(10000000, 99999999),
                            "laboratory_assistant_77200717411"
                            ],
                            [
                            random_int(10000000, 99999999),
                            "junior_clerk_77200717411"
                            ]];

        foreach ($dataWorking as &$row) {
                $payScale = null;

                foreach ($payScalesDetails as $postName => $scale) {
                    if (str_starts_with($row[1], $postName . '_')) {
                        $payScale = $scale;
                        break;
                    }
                }

                $row[] = $payScale;
            }

            unset($row);                    
        // debug removed — was halting execution before the save

        return $connection->transactional(function () use ($tableWorking, $schoolId, $ddo_code, $dataWorking) {
            $entities = [];

            if (!isset($dataWorking[0])) {
                return -1;
            }
        
            foreach ($dataWorking as $row1) {   
                
                $postId = $row1[0] ?? null;

                if (!$postId) {
                    continue;
                }

                // Check if the post_id already exists in ddo_vacant_master
                $existingEntity = $tableWorking->find()
                    ->where(['post_id' => $postId])
                    ->first();

                if ($existingEntity) {
                    // Update existing record
                    $entity = $tableWorking->patchEntity($existingEntity, [
                        'school_udise_code' => $schoolId,
                        'post_name'         => $row1[1] ?? '',
                        'ddo_code'          => $ddo_code,
                        'pay_scale'         => $row1[2] ?? null,
                    ]);
                } else {
                    // Create new record
                    $entity = $tableWorking->newEntity([
                        'school_udise_code' => $schoolId,
                        'post_id'           => $postId,
                        'post_name'         => $row1[1] ?? '',
                        'ddo_code'          => $ddo_code,
                        'pay_scale'         => $row1[2] ?? null,
                    ]);
                }

                 
                    
                if (!$tableWorking->save($entity, ['checkRules' => false])) {
                    \Cake\Log\Log::error('Failed to save vacant post entity for Post ID: ' . $postId);
                }
                    
            }

        
            return 1;
        });

    }


    public function schoolDdoPostData()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-sanstha');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

       
        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();
       
        $totalSchools = $schools->count();
        // Schools with school_close = 'NO'
        $openSchools = $schools->filter(function ($school) {
            return $school->school_close === 'NO';
        })->count();
        $closeSchools = $totalSchools - $openSchools;

        $DDoVacantTable = TableRegistry::getTableLocator()->get('DdoVacantMaster', ['table' => 'ddo_vacant_master']);
        $blockCode = $this->username;
            
        $ddoVacantData = $ddoVacantTable->find()
        ->join([
            'Schools' => [
                'table' => 'schools',
                'type' => 'INNER',
                'conditions' => 'Schools.udise_code = DdoVacantMaster.school_udise_code'
            ]
        ])
        ->where(['Schools.sanstha_code' => $this->username])
        ->all(); // Changed from ->get() to ->all() to fetch full result set

        //echo "<pre>"; print_r($ddoVacantData); exit;


        $this->set('cluster_code', $this->username);
        $this->set('schools', $schools);
        
    }
     

    public function advertisementList()
    {
      
        $mnp_npTable = TableRegistry::getTableLocator()->get('MnpNps');
        $mnp_nps = $mnp_npTable->find()->all();
        $districtTable = TableRegistry::getTableLocator()->get('Districts');
        $districts = $districtTable->find()->all();
        $regionTable = TableRegistry::getTableLocator()->get('Regions');
        $regions = $regionTable->find()->all();
       
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit-sanstha');

        $user = $this->request->getAttribute('identity');
        
        $minority_sanstha = $user->Sanstha->minority_sanstha;
        $sanstha_code = $user->Sanstha->code;
        $sanstha_name = $user->Sanstha->sanstha_name;

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();

        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategoriesDetails = $casteCategoriesTable->find()->all();

        
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategoriesDetails = $horizontalCategoriesTable->find()->all();
 
        $acYear = ["2025-26","2026-27"];
        $postWorkingTable = $this->fetchTable('PostWorking');

        $postAdvertisementTable = TableRegistry::getTableLocator()->get('PostAdvertisement');

        $ng2g = $postAdvertisementTable->getAdvertisementListWithSansthaCode($sanstha_code);
                
        $PostAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies');
        $usedPostIds = $PostAdvertisementVacanciesTable->find()
                        ->select(['post_id'])
                        ->where(['post_id IS NOT' => null]);

        $ddovacantTable = TableRegistry::getTableLocator()->get('DdoVacantMaster');                   
        $ddovacant = $ddovacantTable->getAvailableVacancies($usedPostIds, $sanstha_code);

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

        $this->set('ddovacant', $ddovacant);               
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);  
        $this->set('mnp_nps', $mnp_nps);
        $this->set('districts', $districts);
        $this->set('regions', $regions);
        $this->set('minority_sanstha', $minority_sanstha);
        $this->set('sanstha_name', $sanstha_name);
        $this->set('sanstha_code', $sanstha_code);
        $this->set('staff', '');
        $this->set('approvedLogDocuments', $approvedLogDocuments);
        $this->set('rejectLogDocuments', $rejectLogDocuments);


    }


     public function advertisementVacancyAjax()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $post_advertisement_id = $data['post_id'];
        $PostAdvertisementTable = $this->fetchTable('PostAdvertisement');


       $ng2g = $PostAdvertisementTable->find()
                    ->select([
                        'PostAdvertisement.created_at',
                        'PostAdvertisement.status',
                        'PostAdvertisement.approval_letter',
                        'PostAdvertisement.resolutionfile',
                        'PostAdvertisement.sanch_manyata',
                        'PostAdvertisement.sm_details',
                        'PostAdvertisement.period',
                        'PostAdvertisement.period2324',
                        'PostAdvertisement.period2324_file',
                        'PostAdvertisement.period_file',
                        'PostAdvertisement.cadetails',
                        'PostAdvertisement.cadetails_file',
                     ])  
                   ->where(['id' => $post_advertisement_id])
                   ->first();

       $approvalLetterUrl = null;
       if ($ng2g && !empty($ng2g->approval_letter)) {
           $storage = new EsdlStorageService();
           $approvalLetterUrl = $storage->signedUrl($ng2g->approval_letter);
       }

       $resolutionfile = null;
         if ($ng2g && !empty($ng2g->resolutionfile)) {
              $storage = new EsdlStorageService();
              $resolutionfile = $storage->signedUrl($ng2g->resolutionfile);    
        }

         $period2324file = null;
         if ($ng2g && !empty($ng2g->period2324_file)) {
              $storage = new EsdlStorageService();
              $period2324file = $storage->signedUrl($ng2g->period2324_file);    
        }
         $periodfile = null;
         if ($ng2g && !empty($ng2g->period_file)) {
              $storage = new EsdlStorageService();
              $periodfile = $storage->signedUrl($ng2g->period_file);    
        }

        $cadetailsfile = null;
         if ($ng2g && !empty($ng2g->cadetails_file)) {
              $storage = new EsdlStorageService();
              $cadetailsfile = $storage->signedUrl($ng2g->cadetails_file);    
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

       $smDetails = [];
       if ($ng2g && !empty($ng2g->sm_details)) {
           $storedSmDetails = json_decode($ng2g->sm_details, true);
           if (is_array($storedSmDetails)) {
               $storage = new EsdlStorageService();
               foreach ($storedSmDetails as $udiseCode => $details) {
                   if (!is_array($details)) {
                       continue;
                   }

                   $smDetails[(string)$udiseCode] = [
                       'smdetails' => (string)($details['smdetails'] ?? ''),
                       'fileUrl' => !empty($details['file'])
                           ? $storage->signedUrl($details['file'])
                           : null,
                   ];
               }
           }
       }
       
        $PostAdvertisementVacanciesTable = $this->fetchTable('PostAdvertisementVacancies');

       $vancancyData = $PostAdvertisementVacanciesTable->find()
                    ->select([
                        'PostAdvertisementVacancies.school_udise_code',
                        'PostAdvertisementVacancies.school_name',
                        'PostAdvertisementVacancies.post_code',
                        'PostAdvertisementVacancies.post_name',
                        'PostAdvertisementVacancies.category',
                     ])  
                     ->where([
                        'PostAdvertisementVacancies.post_advertisement_id' => $post_advertisement_id,
                    ]) 
                    ->all();

         $html = '';   
         $i = 1;
         foreach($vancancyData as $dataVal){
            $html .= ' <tr> <td>'.$i.'</td>
                                <td>'.$dataVal['school_name'].'</td>
                                <td>'.$dataVal['school_udise_code'].' </td>                                    
                                <td>'.$dataVal['post_name'].'</td>
                                <td>'.$dataVal['category'].'</td>
                            </tr>';
             $i++;               
         }    

         $periodDiv = '<h6>आपले सदस्य पद सन २०२३-२४ च्या संयमान्यतेनुसार आहे किंवा त्यापूर्वीचे पायाभूत आहे.</h6>';
         if ($ng2g && !empty($ng2g->period)) {
            $periodDiv .= '<div class="col-md-6"> ' . h($ng2g->period==1 ? 'पायाभूत' : '') . '</div>';
        }
        if ($ng2g && !empty($ng2g->period2324)) {
            $periodDiv .= '<div class="col-md-6"> ' . h($ng2g->period2324==1 ? 'आकृतिबंधाच्या मर्यादित २०२३-२४ च्या नंतरचे असल्यास, संचालित शासन मान्यता घेतली आहे का : होय' : 'नाही') . '</div>';
        }
        if ($ng2g && !empty($periodfile)) {
            $periodDiv .= '<div class="col-md-6"><strong>पायाभूत दस्तऐवज:</strong> <a href="' . h($periodfile) . '" target="_blank">View Document</a></div>';
        }
        if ($ng2g && !empty($period2324file)) {
            $periodDiv .= '<div class="col-md-6"><strong>सन २०२३-२४ च्या नंतरचे दस्तऐवज:</strong> <a href="' . h($period2324file) . '" target="_blank">View Document</a></div>';
        }

        $cadetailsDiv = '<br/><h6>अनुकंपा माहिती</h6>';
        if ($ng2g && !empty($cadetailsfile)) {  
            $cadetailsDiv .= '<div class="col-md-6"><strong>अनुकंपा माहिती: ' . h($ng2g->cadetails==1 ? 'होय' : 'नाही') . '</strong> <br/><a href="' . h($cadetailsfile) . '" target="_blank">View Document</a></div>';
        }

        return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => [
                        'ng2g' => $ng2g,
                        'vancancyData' => $vancancyData,
                        'approvalLetterUrl' => $approvalLetterUrl,
                        'resolutionfile' => $resolutionfile,
                        'sanchManyataUrls' => $sanchManyataUrls,
                        'smDetails' => $smDetails,
                        'periodDivShow' => $periodDiv,
                        'cadetailsDivShow' => $cadetailsDiv
                    ],
                    'html'=> $html,
                    'message' => 'Application forwarded successfully'
                ]));


    }


    public function uploadAdvertisementDocument()
    {
        $this->request->allowMethod(['post']);

        $data = $this->request->getData();
        $file = $data['file'] ?? null;
        $documentType = (string)($data['document_type'] ?? '');
        $udiseCode = trim((string)($data['udise_code'] ?? ''));
        $clientUploadId = strtolower(trim((string)($data['client_upload_id'] ?? '')));
        $allowedTypes = [
            'advApprovelFile',
            'resolutionFile',
            'CADetailsFile',
            'periodFile',
            'period2324File',
            'sanch_manyata',
            'smDetailsFile',
        ];
        $isSchoolDocument = in_array($documentType, ['sanch_manyata', 'smDetailsFile'], true);

        if (!in_array($documentType, $allowedTypes, true)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid document type.'], 400);
        }

        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-8][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $clientUploadId)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid upload request.'], 400);
        }

        if (($isSchoolDocument && $udiseCode === '') || (!$isSchoolDocument && $udiseCode !== '')) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid school document reference.'], 400);
        }

        if (!$file instanceof \Psr\Http\Message\UploadedFileInterface || $file->getError() !== UPLOAD_ERR_OK) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Unable to receive the PDF.'], 400);
        }

        $fileSize = (int)$file->getSize();
        if ($fileSize < 1 || $fileSize > 2 * 1024 * 1024) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'PDF must be between 1 byte and 2 MB.'], 400);
        }

        $tmpPath = (string)$file->getStream()->getMetadata('uri');
        $header = is_file($tmpPath) ? file_get_contents($tmpPath, false, null, 0, 1024) : false;
        $mimeType = is_file($tmpPath) ? (new \finfo(FILEINFO_MIME_TYPE))->file($tmpPath) : false;
        if ($header === false || strpos($header, '%PDF-') === false || $mimeType !== 'application/pdf') {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'The uploaded file is not a valid PDF.'], 400);
        }

        $contentSha256 = hash_file('sha256', $tmpPath);
        $identity = $this->request->getAttribute('identity');
        $sansthaCode = (string)$identity->Sanstha->code;

        if ($isSchoolDocument) {
            $school = $this->fetchTable('Schools')->find()
                ->select(['udise_code'])
                ->where([
                    'udise_code' => $udiseCode,
                    'sanstha_code' => $sansthaCode,
                ])
                ->first();

            if (!$school) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'School does not belong to this Sanstha.'], 403);
            }
            $udiseCode = trim((string)$school->udise_code);
        } else {
            $udiseCode = null;
        }

        $uploadTokensTable = $this->fetchTable('PostAdvertisementUploadTokens');
        $existingUpload = $uploadTokensTable->find()
            ->where([
                'user_id' => (string)$this->user_id,
                'sanstha_code' => $sansthaCode,
                'client_upload_id' => $clientUploadId,
            ])
            ->first();

        if ($existingUpload) {
            if (
                $existingUpload->document_type !== $documentType ||
                $existingUpload->udise_code !== $udiseCode ||
                $existingUpload->file_size !== $fileSize ||
                !hash_equals((string)$existingUpload->content_sha256, $contentSha256)
            ) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'This upload request ID was already used for a different file.'], 409);
            }

            if ($existingUpload->status === 'uploaded' && $existingUpload->expires_at > FrozenTime::now()) {
                return $this->advertisementJsonResponse([
                    'success' => true,
                    'upload_token' => $existingUpload->token,
                    'document_type' => $documentType,
                    'udise_code' => $udiseCode,
                ]);
            }

            return $this->advertisementJsonResponse(['success' => false, 'message' => 'This upload has expired or was already used. Please select the file again.'], 409);
        }

        $token = bin2hex(random_bytes(32));
        $renamedFile = new UploadedFile(
            $tmpPath,
            $fileSize,
            UPLOAD_ERR_OK,
            $token . '.pdf',
            'application/pdf'
        );
        $config = Configure::read('ESDL');
        $bucketPath = $config['mode'] . '/staff/post_advertisement';
        $this->request->getSession()->close();
        $storage = new EsdlStorageService();

        try {
            $storageKey = $storage->upload($renamedFile, $bucketPath);
            $uploadEntity = $uploadTokensTable->newEntity([
                'token' => $token,
                'client_upload_id' => $clientUploadId,
                'user_id' => (string)$this->user_id,
                'sanstha_code' => $sansthaCode,
                'document_type' => $documentType,
                'udise_code' => $udiseCode,
                'storage_key' => $storageKey,
                'file_size' => $fileSize,
                'content_sha256' => $contentSha256,
                'status' => 'uploaded',
                'created_at' => FrozenTime::now(),
                'expires_at' => FrozenTime::now()->addHours(24),
            ]);

            if (!$uploadTokensTable->save($uploadEntity)) {
                $storage->delete($storageKey);
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'Unable to register uploaded PDF. Please retry.'], 500);
            }
        } catch (\Throwable $exception) {
            if (isset($storageKey)) {
                try {
                    $storage->delete($storageKey);
                } catch (\Throwable $cleanupException) {
                    \Cake\Log\Log::error('Unable to remove unregistered advertisement PDF: ' . $cleanupException->getMessage());
                }
            }

            $existingUpload = $uploadTokensTable->find()
                ->where([
                    'user_id' => (string)$this->user_id,
                    'sanstha_code' => $sansthaCode,
                    'client_upload_id' => $clientUploadId,
                ])
                ->first();

            if (
                $existingUpload &&
                $existingUpload->status === 'uploaded' &&
                $existingUpload->file_size === $fileSize &&
                hash_equals((string)$existingUpload->content_sha256, $contentSha256)
            ) {
                return $this->advertisementJsonResponse([
                    'success' => true,
                    'upload_token' => $existingUpload->token,
                    'document_type' => $documentType,
                    'udise_code' => $udiseCode,
                ]);
            }

            \Cake\Log\Log::error('Advertisement PDF upload failed: ' . $exception->getMessage());
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'PDF upload failed. Please retry.'], 500);
        }

        return $this->advertisementJsonResponse([
            'success' => true,
            'upload_token' => $token,
            'document_type' => $documentType,
            'udise_code' => $udiseCode,
        ]);
    }

    public function processVacacyRequest()
    {
        return $this->submitAdvertisementApplication();
    }

    private function submitAdvertisementApplication()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $identity = $this->request->getAttribute('identity');
        $sansthaCode = (string)$identity->Sanstha->code;
        $sansthaName = (string)$identity->Sanstha->name;
        $userId = (string)$this->user_id;
        $schoolLevel = (string)($data['school_level'] ?? '');
        $submissionKey = strtolower(trim((string)($data['submission_key'] ?? '')));
        $postAdvertisementId = trim((string)($data['post_advertisement_id'] ?? ''));
        $vacancies = $data['vacancies'] ?? null;
        $uploadTokens = $data['upload_tokens'] ?? null;

        if ($postAdvertisementId === '') {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Advertisement ID is required'], 400);
        }
        if (!in_array($schoolLevel, ['primary', 'secondary', 'higher_secondary'], true)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Select a valid school level.'], 400);
        }
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-8][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $submissionKey)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid submission key. Refresh and try again.'], 400);
        }
        if (!is_array($vacancies) || !$vacancies) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Please select at least one vacancy'], 400);
        }
        if (!is_array($uploadTokens)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Upload the required PDFs before submitting.'], 400);
        }

        $categories = ['SC', 'ST', 'OBC', 'VJNT', 'EWS', 'GENERAL'];
        $vacancyPayload = [];
        $vacancyIds = [];
        foreach ($vacancies as $vacancy) {
            if (!is_array($vacancy)) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid vacancy selection.'], 400);
            }

            $vacancyId = filter_var($vacancy['vacancy_id'] ?? null, FILTER_VALIDATE_INT);
            $category = (string)($vacancy['category'] ?? '');
            if (!$vacancyId || !in_array($category, $categories, true) || isset($vacancyIds[$vacancyId])) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid or duplicate vacancy selection.'], 400);
            }

            $vacancyIds[$vacancyId] = true;
            $vacancyPayload[] = [
                'vacancy_id' => (int)$vacancyId,
                'category' => $category,
            ];
        }
        usort($vacancyPayload, static fn(array $left, array $right): int => $left['vacancy_id'] <=> $right['vacancy_id']);
        $vacancyIds = array_keys($vacancyIds);

        $ddoVacantMasterTable = $this->fetchTable('DdoVacantMaster');
        $ddoVacancies = $ddoVacantMasterTable->find()
            ->where(['id IN' => $vacancyIds])
            ->all()
            ->toArray();
        if (count($ddoVacancies) !== count($vacancyIds)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'One or more selected vacancies are no longer available.'], 409);
        }

        $udiseCodes = [];
        $ddoById = [];
        foreach ($ddoVacancies as $vacancy) {
            $udise = trim((string)$vacancy->school_udise_code);
            $udiseCodes[$udise] = true;
            $ddoById[(int)$vacancy->id] = $vacancy;
        }

        $schools = $this->fetchTable('Schools')->find()
            ->where([
                'udise_code IN' => array_keys($udiseCodes),
                'sanstha_code' => $sansthaCode,
            ])
            ->all()
            ->toArray();
        $schoolByUdise = [];
        foreach ($schools as $school) {
            $schoolByUdise[trim((string)$school->udise_code)] = $school;
        }

        $selectedUdiseCodes = [];
        foreach ($ddoById as $vacancy) {
            $udise = trim((string)$vacancy->school_udise_code);
            if (!isset($schoolByUdise[$udise])) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'A selected vacancy does not belong to this Sanstha.'], 403);
            }
            $selectedUdiseCodes[$udise] = true;
        }

        $smDetailsChoices = $data['smdetails'] ?? null;
        if (!is_array($smDetailsChoices)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Please select an answer for every selected school.'], 400);
        }
        foreach ($selectedUdiseCodes as $udise => $unused) {
            if (!isset($smDetailsChoices[$udise]) || !in_array((string)$smDetailsChoices[$udise], ['1', '2'], true)) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'Please select an answer for every selected school.'], 400);
            }
        }
        foreach ($smDetailsChoices as $udise => $choice) {
            if (!isset($selectedUdiseCodes[(string)$udise]) || !in_array((string)$choice, ['1', '2'], true)) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid संस्थेमध्ये शिक्षकेतर अतिरिक्त कर्मचारी selection'], 400);
            }
        }

        $period = (string)($data['period'] ?? '');
        $period2324 = (string)($data['period2324'] ?? '');
        $caDetails = (string)($data['cadetails'] ?? '');
        if (!in_array($period, ['1', '2'], true) || !in_array($caDetails, ['1', '2'], true)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Please complete the required application choices.'], 400);
        }
        if ($period === '2' && !in_array($period2324, ['1', '2'], true)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Please select the 2023-24 approval answer.'], 400);
        }

        $expectedUploads = [
            'advApprovelFile:' => ['document_type' => 'advApprovelFile', 'udise_code' => null],
            'resolutionFile:' => ['document_type' => 'resolutionFile', 'udise_code' => null],
            'CADetailsFile:' => ['document_type' => 'CADetailsFile', 'udise_code' => null],
        ];
        if ($period === '1') {
            $expectedUploads['periodFile:'] = ['document_type' => 'periodFile', 'udise_code' => null];
        } elseif ($period2324 === '1') {
            $expectedUploads['period2324File:'] = ['document_type' => 'period2324File', 'udise_code' => null];
        }
        foreach (array_keys($selectedUdiseCodes) as $udise) {
            $udise = (string)$udise;
            $expectedUploads['sanch_manyata:' . $udise] = ['document_type' => 'sanch_manyata', 'udise_code' => $udise];
            if ((string)$smDetailsChoices[$udise] === '2') {
                $expectedUploads['smDetailsFile:' . $udise] = ['document_type' => 'smDetailsFile', 'udise_code' => $udise];
            }
        }

        $flatTokens = [];
        foreach ($uploadTokens as $documentType => $value) {
            if (in_array($documentType, ['sanch_manyata', 'smDetailsFile'], true)) {
                if (!is_array($value)) {
                    return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid school document tokens.'], 400);
                }
                foreach ($value as $udise => $token) {
                    $flatTokens[$documentType . ':' . trim((string)$udise)] = $token;
                }
            } elseif (in_array($documentType, ['advApprovelFile', 'resolutionFile', 'CADetailsFile', 'periodFile', 'period2324File'], true)) {
                $flatTokens[$documentType . ':'] = $value;
            } else {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'Invalid document token type.'], 400);
            }
        }

        if (count($flatTokens) !== count($expectedUploads)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Upload all required PDFs before submitting.'], 400);
        }
        $tokenValues = [];
        foreach ($expectedUploads as $key => $expected) {
            $token = $flatTokens[$key] ?? null;
            if (!is_string($token) || !preg_match('/^[0-9a-f]{64}$/', $token)) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => 'A required PDF upload is missing.'], 400);
            }
            $expectedUploads[$key]['token'] = $token;
            $tokenValues[] = $token;
        }
        if (count(array_unique($tokenValues)) !== count($tokenValues)) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'The same PDF token cannot be used for multiple documents.'], 400);
        }

        $normalizedChoices = [];
        foreach ($smDetailsChoices as $udise => $choice) {
            $normalizedChoices[(string)$udise] = (string)$choice;
        }
        ksort($normalizedChoices);
        ksort($flatTokens);
        $canonicalPayload = [
            'post_advertisement_id' => $postAdvertisementId,
            'school_level' => $schoolLevel,
            'vacancies' => $vacancyPayload,
            'period' => $period,
            'period2324' => $period2324,
            'cadetails' => $caDetails,
            'minority_sanstha' => (string)($data['minority_sanstha'] ?? ''),
            'smdetails' => $normalizedChoices,
            'upload_tokens' => $flatTokens,
        ];
        $fingerprint = hash('sha256', json_encode($canonicalPayload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));

        $postAdvertisementTable = $this->fetchTable('PostAdvertisement');
        $existingApplication = $postAdvertisementTable->find()
            ->where(['submission_key' => $submissionKey])
            ->first();
        if ($existingApplication) {
            return $this->existingAdvertisementSubmissionResponse($existingApplication, $userId, $sansthaCode, $fingerprint);
        }

        $uploadTokensTable = $this->fetchTable('PostAdvertisementUploadTokens');
        $connection = ConnectionManager::get('default');
        $createdAt = time();

        try {
            $postAdvertisementId = $connection->transactional(function () use (
                $uploadTokensTable,
                $postAdvertisementTable,
                $expectedUploads,
                $tokenValues,
                $userId,
                $sansthaCode,
                $submissionKey,
                $fingerprint,
                $sansthaName,
                $schoolLevel,
                $vacancyPayload,
                $ddoById,
                $schoolByUdise,
                $selectedUdiseCodes,
                $smDetailsChoices,
                $period,
                $period2324,
                $caDetails,
                $createdAt
            ) {
                $tokenRows = $uploadTokensTable->find()
                    ->where(['token IN' => $tokenValues])
                    ->epilog('FOR UPDATE')
                    ->all()
                    ->toArray();
                if (count($tokenRows) !== count($expectedUploads)) {
                    throw new \DomainException('One or more PDF upload tokens are invalid or expired.');
                }

                $rowsByToken = [];
                foreach ($tokenRows as $tokenRow) {
                    $rowsByToken[(string)$tokenRow->token] = $tokenRow;
                }
                $fileKeys = [];
                foreach ($expectedUploads as $key => $expected) {
                    $row = $rowsByToken[$expected['token']] ?? null;
                    if (!$row) {
                        throw new \DomainException('One or more PDF upload tokens are invalid or expired.');
                    }
                    if ((string)$row->user_id !== $userId || (string)$row->sanstha_code !== $sansthaCode) {
                        throw new \DomainException('A PDF token does not belong to the logged-in Sanstha.');
                    }
                    if ($row->status !== 'uploaded' || $row->expires_at <= FrozenTime::now()) {
                        throw new \DomainException('A PDF upload token has expired or was already used.');
                    }
                    if ($row->document_type !== $expected['document_type'] || $row->udise_code !== $expected['udise_code']) {
                        throw new \DomainException('A PDF token is for a different document or school.');
                    }
                    $fileKeys[$key] = (string)$row->storage_key;
                }

                $sanchManyataFiles = [];
                $smDetails = [];
                foreach (array_keys($selectedUdiseCodes) as $udise) {
                    $udise = (string)$udise;
                    $sanchManyataFiles[$udise] = $fileKeys['sanch_manyata:' . $udise];
                    $smDetails[$udise] = [
                        'smdetails' => (string)$smDetailsChoices[$udise],
                        'file' => (string)$smDetailsChoices[$udise] === '2'
                            ? $fileKeys['smDetailsFile:' . $udise]
                            : null,
                    ];
                }

                $postData = [
                    'institution_code' => $sansthaCode,
                    'institution_name' => $sansthaName,
                    'status' => 'pending',
                    'created_by' => $this->user_id,
                    'created_at' => $createdAt,
                    'is_primary' => $schoolLevel === 'primary' ? 1 : 0,
                    'secondary' => $schoolLevel === 'secondary' ? 1 : 0,
                    'higher_secondary' => $schoolLevel === 'higher_secondary' ? 1 : 0,
                    'approval_letter' => $fileKeys['advApprovelFile:'],
                    'resolutionfile' => $fileKeys['resolutionFile:'],
                    'cadetails' => $caDetails,
                    'cadetails_file' => $fileKeys['CADetailsFile:'],
                    'period' => $period,
                    'period_file' => $period === '1' ? $fileKeys['periodFile:'] : null,
                    'period2324' => $period === '2' ? $period2324 : null,
                    'period2324_file' => $period === '2' && $period2324 === '1' ? $fileKeys['period2324File:'] : null,
                    'sanch_manyata' => json_encode($sanchManyataFiles, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR),
                    'sm_details' => json_encode($smDetails, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR),
                    'submission_key' => $submissionKey,
                    'submission_fingerprint' => $fingerprint,
                ];

                $application = $postAdvertisementTable->newEntity($postData);
                if (!$postAdvertisementTable->save($application)) {
                    throw new \RuntimeException('Unable to save advertisement application: ' . json_encode($application->getErrors()));
                }

                $postAdvertisementVacanciesTable = $this->fetchTable('PostAdvertisementVacancies');
                foreach ($vacancyPayload as $vacancyInput) {
                    $vacancy = $ddoById[$vacancyInput['vacancy_id']];
                    $udise = trim((string)$vacancy->school_udise_code);
                    $school = $schoolByUdise[$udise];
                    $vacancyEntity = $postAdvertisementVacanciesTable->newEntity([
                        'post_advertisement_id' => $application->id,
                        'school_udise_code' => $udise,
                        'school_name' => $school->school_name,
                        'post_id' => $vacancyInput['vacancy_id'],
                        'post_code' => $vacancy->post_id,
                        'post_name' => $vacancy->post_name,
                        'highest_class' => $school->highest_class,
                        'pay_scale' => $vacancy->pay_scale,
                        'category' => $vacancyInput['category'],
                    ]);
                    if (!$postAdvertisementVacanciesTable->save($vacancyEntity)) {
                        throw new \RuntimeException('Unable to save an advertisement vacancy: ' . json_encode($vacancyEntity->getErrors()));
                    }
                }

                if (!$this->createAdvertisementAudit(
                    (int)$application->id,
                    $this->user_id ? (int)$this->user_id : null,
                    'submitted',
                    null,
                    'pending',
                    'Advertisement application submitted',
                    1
                )) {
                    throw new \RuntimeException('Unable to save the advertisement audit entry.');
                }

                $dataSMSLog = [
                        'sms_template_id' => 1,
                        'text' => 'Your application has been approved.',
                        'sender' => 'SYSTEM',
                        'status' => 'pending',
                        'created_by' => $this->request->getAttribute('identity')?->getIdentifier(),
                        'application_id' => $application->id,
                        'module_name' => 'advertisement',
                    ]; 

                $smsService = new SmsNotificationService();
                $result = $smsService->logSms($dataSMSLog);

                if ($result['success']) {
                        $smsLogId = $result['id'];
                    } else {
                        $this->log('SMS log failed: ' . $result['message'],'error');
                    }    

                $consumedCount = $uploadTokensTable->updateAll(
                    [
                        'status' => 'consumed',
                        'consumed_at' => FrozenTime::now(),
                        'post_advertisement_id' => (string)$application->id,
                    ],
                    ['token IN' => $tokenValues, 'status' => 'uploaded']
                );
                if ($consumedCount !== count($tokenValues)) {
                    throw new \DomainException('A PDF token was consumed by another submission. Please retry.');
                }

                return (int)$application->id;
            });
        } catch (\Throwable $exception) {
            $existingApplication = $postAdvertisementTable->find()
                ->where(['submission_key' => $submissionKey])
                ->first();
            if ($existingApplication) {
                return $this->existingAdvertisementSubmissionResponse($existingApplication, $userId, $sansthaCode, $fingerprint);
            }
            if ($exception instanceof \DomainException) {
                return $this->advertisementJsonResponse(['success' => false, 'message' => $exception->getMessage()], 409);
            }

            \Cake\Log\Log::error('Advertisement application transaction failed: ' . $exception->getMessage());
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'Unable to submit application. Please retry.'], 500);
        }

        return $this->advertisementJsonResponse([
            'success' => true,
            'message' => 'Application forwarded successfully',
        ]);
    }

    private function existingAdvertisementSubmissionResponse($application, string $userId, string $sansthaCode, string $fingerprint): Response
    {
        if (
            (string)$application->created_by !== $userId ||
            (string)$application->institution_code !== $sansthaCode ||
            !hash_equals(trim((string)$application->submission_fingerprint), $fingerprint)
        ) {
            return $this->advertisementJsonResponse(['success' => false, 'message' => 'This submission key was already used for a different application.'], 409);
        }

        return $this->advertisementJsonResponse([
            'success' => true,
            'message' => 'Application forwarded successfully',
        ]);
    }

    private function advertisementJsonResponse(array $body, int $status = 200): Response
    {
        return $this->response
            ->withType('application/json')
            ->withStatus($status)
            ->withStringBody(json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public function import()
    {
        // Start execution timer
        $startTime = microtime(true);

        // 1. Disable the CakePHP template rendering engine
        /*
         "total_rows_processed": 17925,
        "records_inserted": 0,
        "records_updated": 3,
        "execution_time": "18.9613 seconds"

         "total_rows_processed": 17925,
         "records_inserted": 1699,
         "records_updated": 16226
         */
  
        $this->disableAutoRender();
        
        // 2. Set response type to JSON for API-style feedback
        $this->response = $this->response->withType('application/json');

        //$csvFilePath = WWW_ROOT . 'files' . DS . 'sanstha_data.csv';
         $csvFilePath = WWW_ROOT . 'files' . DS . 'VerifiedSansthaList21082026.csv'; 
 

        if (!file_exists($csvFilePath) || !($handle = fopen($csvFilePath, 'r'))) {
            $this->response = $this->response->withStatus(400);
            echo json_encode(['status' => 'error', 'message' => 'Cannot open CSV file at ' . $csvFilePath]);
            return;
        }
        
        // 4. Extract headers with quote enclosure support
        $headers = fgetcsv($handle, 1000, ",", '"');

        $connection = ConnectionManager::get('default');
        $sansthaTable = $this->fetchTable('Sansthas');
        
        // SAFETY CHECK: Ensure 'sanstha_code' column exists in the CSV header
        if (!in_array('sanstha_code', $headers)) {
            fclose($handle);
            $this->response = $this->response->withStatus(400);
            echo json_encode(['status' => 'error', 'message' => 'CSV file must contain a "sanstha_code" column header.']);
            return;
        }

        // Map CSV headers to Database fields
        $headerMap = [
            'sanstha_code'          => 'code',
            'sanstha_name'          => 'name',
            'minority_sanstha'      => 'minority_sanstha',
            'sanstha_minority_name' => 'sanstha_minority_name',
            'distcd'                => 'district_code',
            'distname'              => 'district_name',
            'mobile'                => 'mobile'
        ];

        // COUNTER TRACKING VARIABLES
        $insertedCount = 0;
        $updatedCount = 0;
        $processedRows = 0;

        $connection->begin();

        try {
            while (($row = fgetcsv($handle, 1000, ",", '"')) !== false) {
                // Skip trailing empty lines
                if (empty($row) || $row === [null]) {
                    continue;
                }

                $processedRows++;

                // Handle accidental column count mismatches safely
                $headerCount = count($headers);
                $rowCountElements = count($row);

                if ($rowCountElements < $headerCount) {
                    $row = array_pad($row, $headerCount, null);
                } elseif ($rowCountElements > $headerCount) {
                    $row = array_slice($row, 0, $headerCount);
                }

                $csvData = array_combine($headers, $row);
                
                // Map data
                $dbData = [];
                foreach ($csvData as $csvKey => $value) {
                    if (isset($headerMap[$csvKey])) {
                        $dbData[$headerMap[$csvKey]] = ($value !== null) ? trim($value) : null;
                    }
                }

                if (empty($dbData['code'])) {
                    continue;
                }

                // Check if record exists
                $existingRecord = $sansthaTable->find()
                    ->where(['code' => $dbData['code']])
                    ->first();

                if ($existingRecord) {
                    // UPDATE branch
                    $entity = $sansthaTable->patchEntity($existingRecord, $dbData);
                    $isNew = false;
                } else {
                    // INSERT branch
                    $entity = $sansthaTable->newEntity($dbData);
                    $isNew = true;
                }

                if ($entity->getErrors()) {
                    throw new \Exception("Row {$processedRows} validation failed: " . json_encode($entity->getErrors()));
                }

                // Track if fields actually modified during update tracking
                $isDirty = $entity->isDirty();

                // Attempt Database Save
                if ($sansthaTable->save($entity)) {
                    if ($isNew) {
                        $insertedCount++;
                    } elseif ($isDirty) {
                        // Only count as updated if values actually changed in the DB
                        $updatedCount++;
                    }
                }

                // Batch commits
                if ($processedRows % 1000 === 0) {
                    $connection->commit();
                    $connection->begin();
                }
            }

            $connection->commit();
            fclose($handle);

            // Calculate total execution time
            $endTime = microtime(true);
            $executionTime = round($endTime - $startTime, 4);

            // 5. Output response with specific counters and timing data
            $this->response = $this->response->withStatus(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Import completed successfully.',
                'summary' => [
                    'total_rows_processed' => $processedRows,
                    'records_inserted'     => $insertedCount,
                    'records_updated'      => $updatedCount,
                    'execution_time'       => $executionTime . ' seconds'
                ]
            ]);

        } catch (\Exception $e) {
            $connection->rollback();
            fclose($handle);

            $this->response = $this->response->withStatus(422);
            echo json_encode([
                'status' => 'error',
                'message' => 'Import halted and transaction rolled back.',
                'details' => $e->getMessage()
            ]);
        }
    }


    public function saveStaffOnboarding()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $this->disableAutoRender();

        $data = $this->request->getData();

        $appointmentsTable = $this->fetchTable('StaffOnboardingAppointments');
        $connection = $appointmentsTable->getConnection();
        $wasAutoQuotingEnabled = $connection->getDriver()->isAutoQuotingEnabled();
        $connection->getDriver()->enableAutoQuoting();
        $createdApprovalFilePath = null;

        try {

            $appointment = $connection->transactional(function () use (
                $appointmentsTable,
                $data,
                &$createdApprovalFilePath
            ) {

                /*
                * -----------------------------------------
                * 1. Main Appointment Data
                * -----------------------------------------
                */

                $rosterValue = $data['courtRoster'] ?? null;
                $courtOrderValue = $data['courtOrder'] ?? null;

                $roster = in_array((string)$rosterValue, ['1', 'true', 'yes', 'on'], true);
                $courtOrder = in_array((string)$courtOrderValue, ['1', 'true', 'yes', 'on'], true);

                $appointment = $appointmentsTable->newEntity([
                    'staff_id' => $data['staffId'] ?? null,

                    'candidate_name' => $data['candidateName'] ?? null,

                    'appointment_date' => !empty($data['appointmentDate'])
                        ? date(
                            'Y-m-d H:i:s',
                            strtotime($data['appointmentDate'])
                        )
                        : null,

                    'pan_number' => $data['panNumber'] ?? null,
                    'aadhar_number' => $data['aadharNumber'] ?? null,
                    'headmastername' => $data['headmastername'] ?? null,
                    'heademail' => $data['heademail'] ?? null,
                    'headmobilenumber' => $data['headmobilenumber'] ?? null,

                    'gender' => $data['gender'] ?? null,
                    'dob_date' => $data['dob_date'] ?? null,
                    'gender' => $data['gender'] ?? null,
                    'candidate_name' => $data['candidatename'] ?? null,
                    'candidateemail' => $data['candidateemail'] ?? null,
                    'candidatemobile' => $data['candidatemobile'] ?? null,
                    'pay_scale' => $data['pay_scale'] ?? null,
                    'graduate_degree' => $data['degree'] ?? null,
                    'matrimonial_status' => $data['matrimonial_status'] ?? null,
                    'post_graduate_degree' => $data['post_graduate_degree'] ?? null,
                    'original_category' => !empty($data['originalCategory'])
                        ? (int)$data['originalCategory']
                        : null,

                    'appointment_category' => !empty($data['appointmentCategory'])
                        ? (int)$data['appointmentCategory']
                        : null,

                    'horizontal_category' => !empty($data['horizontalCategory'])
                        ? (int)$data['horizontalCategory']
                        : null,
                    'period' => $data['period'] ?? null,
                    'period2324' => $data['period2324'] ?? null,
                    'status' => 'submitted',
                    'roster' => $roster,
                    'court_order' => $courtOrder,
                    'court_order_petition_number' => $data['courtOrderPetitionNumber'] ?? null,
                    'court_order_date' => $data['courtOrderDate']?? null,
                ]);


                /*
                * -----------------------------------------
                * 2. Validate Main Data
                * -----------------------------------------
                */

                if ($appointment->hasErrors()) {
                    throw new \RuntimeException(
                        json_encode($appointment->getErrors())
                    );
                }


                /*
                * -----------------------------------------
                * 3. Documents
                * -----------------------------------------
                */

                $documentFields = [
                    'sscFile' => 'ssc',
                    'hscFile' => 'hsc',
                    'graduateFile' => 'graduate',
                    'postGraduateFile' => 'post_graduate',
                    'advApprovelFile' => 'adv_approval',
                    'advertisementFile' => 'advertisement',
                    'signatureFile' => 'signature',
                    'markingFile' => 'marking',
                    'resolutionFile' => 'resolution',
                    'orderFile' => 'order',
                    'courtRosterFile' => 'court_roster',
                    'courtOrderFile' => 'court_order',
                    'governmentFile' => 'government',
                    'horizontalcertificateFile' => 'horizontalcertificate',
                    'castecertificateFile' => 'castecertificate',
                    'validcastecertificateFile' => 'validcastecertificate',
                    'periodFile' => 'periodFile',
                    'period2324File' => 'period2324File'

                ];


                $documents = [];

                foreach ($documentFields as $formField => $documentType) {

                    if (
                        !isset($data[$formField]) ||
                        empty($data[$formField])
                    ) {
                        continue;
                    }

                    $file = $data[$formField];

                    /*
                    * CakePHP UploadedFileInterface
                    */
                    if ($file instanceof \Psr\Http\Message\UploadedFileInterface) {

                        if ($file->getError() !== UPLOAD_ERR_OK) {
                            continue;
                        }

                        $originalName = $file->getClientFilename();

                        $extension = pathinfo(
                            $originalName,
                            PATHINFO_EXTENSION
                        );

                        $fileName = uniqid(
                            $documentType . '_',
                            true
                        ) . ($extension ? '.' . $extension : '');

                        $uploadPath = WWW_ROOT . 'uploads' .
                            DS . 'staff' .
                            DS . $data['staffId'];

                        if (!is_dir($uploadPath)) {
                            mkdir(
                                $uploadPath,
                                0775,
                                true
                            );
                        }

                        $filePath = $uploadPath . DS . $fileName;

                        $file->moveTo($filePath);

                        $relativePath =
                            'uploads/staff/' .
                            $data['staffId'] .
                            '/' .
                            $fileName;

                        $documents[] = [
                            'document_type' => $documentType,
                            'file_name' => $fileName,
                            'original_name' => $originalName,
                            'file_path' => $relativePath,
                            'file_size' => $file->getSize(),
                            'mime_type' => $file->getClientMediaType()
                        ];
                    }
                }

                $hasApprovalDocument = false;
                foreach ($documents as $document) {
                    if ($document['document_type'] === 'adv_approval') {
                        $hasApprovalDocument = true;
                        break;
                    }
                }

                if (!$hasApprovalDocument) {
                    $staffId = filter_var($data['staffId'] ?? null, FILTER_VALIDATE_INT);
                    if ($staffId === false || $staffId < 1) {
                        throw new \RuntimeException('Missing or invalid staff id for the advertisement approval document.');
                    }

                    $approvalLog = $this->fetchTable('PostAdvertisementAuditLogs')->find()
                        ->select(['PostAdvertisementAuditLogs.stage_doc'])
                        ->innerJoin(
                            ['PostAdvertisement' => 'post_advertisement'],
                            '"PostAdvertisement"."id" = "PostAdvertisementAuditLogs"."post_advertisement_id"'
                        )
                        ->innerJoin(
                            ['PostAdvertisementVacancies' => 'post_advertisement_vacancies'],
                            '"PostAdvertisementVacancies"."post_advertisement_id" = "PostAdvertisement"."id"'
                        )
                        ->where([
                            'PostAdvertisementVacancies.id' => $staffId,
                            'PostAdvertisement.status' => 'approved',
                            'PostAdvertisement.institution_code' => $this->username,
                            'PostAdvertisementAuditLogs.new_status' => 'approved',
                            'PostAdvertisementAuditLogs.stage_doc IS NOT' => null,
                        ])
                        ->order([
                            'PostAdvertisementAuditLogs.created_at' => 'DESC',
                            'PostAdvertisementAuditLogs.id' => 'DESC',
                        ])
                        ->first();

                    if (!$approvalLog || trim((string)$approvalLog->stage_doc) === '') {
                        throw new \RuntimeException('The approved advertisement approval document could not be found.');
                    }

                    $stageDoc = trim((string)$approvalLog->stage_doc);
                    $normalizedStageDoc = str_replace('\\', '/', $stageDoc);
                    if (
                        preg_match('#(^|/)\.\.?(/|$)#', $normalizedStageDoc) ||
                        preg_match('#^[a-z][a-z0-9+.-]*://#i', $normalizedStageDoc) ||
                        preg_match('#^[a-z]:/#i', $normalizedStageDoc)
                    ) {
                        throw new \RuntimeException('The approved advertisement document path is invalid.');
                    }

                    $relativeStageDoc = ltrim($normalizedStageDoc, '/');
                    $localStageDoc = realpath(WWW_ROOT . str_replace('/', DS, $relativeStageDoc));
                    $webRoot = realpath(WWW_ROOT);
                    if (
                        $localStageDoc !== false &&
                        $webRoot !== false &&
                        str_starts_with($localStageDoc, $webRoot . DS) &&
                        is_file($localStageDoc)
                    ) {
                        $approvalContents = file_get_contents($localStageDoc);
                        if ($approvalContents === false) {
                            throw new \RuntimeException('Unable to read the approved advertisement document.');
                        }
                    } else {
                        $approvalContents = (new EsdlStorageService())->getContents($stageDoc);
                    }

                    if (!str_starts_with($approvalContents, '%PDF-')) {
                        throw new \RuntimeException('The approved advertisement document is not a valid PDF.');
                    }

                    $uploadPath = WWW_ROOT . 'uploads' . DS . 'staff' . DS . $staffId;
                    if (!is_dir($uploadPath) && !mkdir($uploadPath, 0775, true) && !is_dir($uploadPath)) {
                        throw new \RuntimeException('Unable to create the staff document upload directory.');
                    }

                    $fileName = 'adv_approval_' . bin2hex(random_bytes(8)) . '.pdf';
                    $createdApprovalFilePath = $uploadPath . DS . $fileName;
                    if (file_put_contents($createdApprovalFilePath, $approvalContents, LOCK_EX) === false) {
                        throw new \RuntimeException('Unable to save the approved advertisement document.');
                    }

                    $documents[] = [
                        'document_type' => 'adv_approval',
                        'file_name' => $fileName,
                        'original_name' => basename($relativeStageDoc) ?: 'advertisement_approval.pdf',
                        'file_path' => 'uploads/staff/' . $staffId . '/' . $fileName,
                        'file_size' => strlen($approvalContents),
                        'mime_type' => 'application/pdf',
                    ];
                }

                /*
                * -----------------------------------------
                * 4. Attach Documents
                * -----------------------------------------
                */

                $documentsTable = $appointmentsTable
                    ->getAssociation('StaffOnboardingDocuments')
                    ->getTarget();

                $appointment->set(
                    'staff_onboarding_documents',
                    array_map(
                        fn (array $document) => $documentsTable->newEntity($document),
                        $documents
                    )
                );


                /*
                * -----------------------------------------
                * 5. Save Appointment + Documents
                * -----------------------------------------
                */

                if (!$appointmentsTable->save($appointment, [
                    'associated' => [
                        'StaffOnboardingDocuments'
                    ]
                ])) {

                    throw new \RuntimeException(
                        json_encode(
                            $appointment->getErrors()
                        )
                    );
                }


                return $appointment;
            });


            /*
            * -----------------------------------------
            * Success Response
            * -----------------------------------------
            */

            $this->response = $this->response
                ->withType('application/json');

            return $this->response->withStringBody(
                json_encode([
                    'success' => true,
                    'status' => true,
                    'message' => 'Staff onboarding saved successfully',
                    'data' => [
                        'id' => $appointment->id,
                        'staff_id' => $appointment->staff_id
                    ]
                ])
            );


        } catch (\Throwable $e) {
            if ($createdApprovalFilePath !== null && is_file($createdApprovalFilePath)) {
                unlink($createdApprovalFilePath);
            }

            $this->response = $this->response
                ->withStatus(500)
                ->withType('application/json');

            return $this->response->withStringBody(
                json_encode([
                    'status' => false,
                    'message' => 'Unable to save staff onboarding',
                    'error' => $e->getMessage()
                ])
            );
        } finally {
            if (!$wasAutoQuotingEnabled) {
                $connection->getDriver()->disableAutoQuoting();
            }
        }
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
    

    public function getStaffOnboardingDetails()
    {
        $this->request->allowMethod(['get', 'ajax']);
        $this->Authorization->skipAuthorization();

        $staffId = $this->request->getQuery('staff_id');
        if ($staffId === null || $staffId === '' || !is_numeric($staffId)) {
            $staffId = $this->request->getData('staff_id');
        }

        if ($staffId === null || $staffId === '' || !is_numeric($staffId)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Missing or invalid staff id',
                    'data' => []
                ]));
        }

        $appointmentsTable = $this->fetchTable('StaffOnboardingAppointments');

        $appointment = $appointmentsTable->find()
            ->contain(['StaffOnboardingDocuments'])
            ->where(['staff_id' => (int)$staffId])
            ->order(['StaffOnboardingAppointments.id' => 'DESC'])
            ->first();

        if (!$appointment) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'No onboarding record found',
                    'data' => []
                ]));
        }

        $appointmentData = $appointment->toArray();
        $appointmentData['documents'] = $appointment->staff_onboarding_documents ?? [];
        $htmlbody = $this->staffonboardinghtmlbody($appointmentData);
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'success' => true,
                'data' => $appointmentData,
                'htmlbody' => $htmlbody
            ]));
    }

    public function staffonboardinghtmlbody($appointmentData){


        $user = $this->request->getSession()->read('Auth.User');
        $sanstha = $this->request->getSession()->read('Auth.Sanstha');
       
        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');

        // Get Original Category
        $originalCategory = null;
        if (!empty($appointmentData['original_category'])) {
            $originalCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointmentData['original_category']])
                ->first();
        }

        $originalCategoryName = $originalCategory ? $originalCategory->category_name: '-';

        $appointmentCategory = null;
        if (!empty($appointmentData['appointment_category'])) {
            $appointmentCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointmentData['appointment_category']])
                ->first();
        }

        $appointmentCategoryName = $appointmentCategory ? $appointmentCategory->category_name: '-';

       $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');

        // Get Horizontal Category
        $horizontalCategory = null;
        if (!empty($appointmentData['horizontal_category'])) {
            $horizontalCategory = $horizontalCategoriesTable->find()
                ->where(['code' => $appointmentData['horizontal_category']])
                ->first();
        }

        $horizontalCategoryName = $horizontalCategory? $horizontalCategory->name : '-';
        

        $payScaleTable = TableRegistry::getTableLocator()->get('PayScales');

        // Get pay scale
        $payScale = null;
        if ($appointmentData['pay_scale'] !== null && $appointmentData['pay_scale'] !== '') {
            $payScale = $payScaleTable->find()
                ->where([
                    'id' => $appointmentData['pay_scale']
                ])
                ->first();
        }

         $payScaleName = ($appointmentData['pay_scale']!=null)? $appointmentData['pay_scale'] : '-';

         $username = $this->request->getSession()->read('Auth.User.username');
            $sansthasTable = TableRegistry::getTableLocator()->get('sansthas');
         $Sanstha = $sansthasTable->find()->where(['code' => $username])
            ->first();
  
         $institutionCode = h($Sanstha->code ?? '');
         $institutionName = h($Sanstha->name ?? '');

        $PostAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies');
        $PostAdvertisementVacanciesDetails = $PostAdvertisementVacanciesTable->find()->where(['id' => $appointmentData['staff_id']])->first();
       


         if($Sanstha->minority_sanstha==2 || $Sanstha->minority_sanstha == 3){
            $minority_sanstha_status = '<span class="badge rounded-pill bg-success">Minority Sanstha ('.h($Sanstha->sanstha_minority_name).')</span>';
         }else{
            $minority_sanstha_status = '<span class="badge rounded-pill bg-warning text-dark">Non-Minority Sanstha</span>';
         }
                                         
                               

         $html =' <div class="section">
                        <div class="section-title">👤 <span >'.$PostAdvertisementVacanciesDetails->post_name.'</span></div>
                        <input type="hidden" id="appointmentDate" name="appointmentDate" class="form-control">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="institutionCode" class="form-label marathi-label">संस्था कोड <span class="english-label">(Institution Code)</span> &rarr; 
                                <span class="txtval">
                                  ' . $institutionCode . '</span></label>                            
                            </div>
                            <div class="col-md-6">                            
                                <label for="institutionName" class="form-label marathi-label">संस्थेचे नाव <span class="english-label">(Institution Name)</span> &rarr; <span class="txtval">
                                ' . $institutionName . '</span></label> 
                            </div>
                             <div class="col-md-3">                            
                                '.$minority_sanstha_status.'
                            </div>
                        </div>
                    </div>';

        $html .='<div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label">UDISE क्रमांक 
                                <span class="english-label">(UDISE Code)</span> &rarr; 
                                <span class="txtval"> '.$PostAdvertisementVacanciesDetails->school_udise_code.' 
                                    </span></label> 
                        </div>
                    
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label">शाळेचे नाव 
                                <span class="english-label">(School Name)</span> &rarr; 
                                <span class="txtval" >'.$PostAdvertisementVacanciesDetails->school_name.'</span></label> 
                        </div>   
                       
                    </div>';            
        $html .='<div class="row mb-3">
                         <div class="col-md-3">
                            <label for="candidateName " class="form-label marathi-label ">मुख्याध्यापक नाव 
                             <span class="txtval">'.$appointmentData['headmastername'].'</span></label> 
                        </div>
                        <div class="col-md-3">
                            <label for="panNumber" class="form-label marathi-label ">ई-मेल 
                             <span class="txtval">'.$appointmentData['heademail'].'</span></label> 
                           
                        </div>
                        <div class="col-md-3">
                            <label for="aadharNumber" class="form-label marathi-label ">मोबाईल क्रमांक
                             <span class="txtval">'.$appointmentData['headmobilenumber'].'</span></label>                             
                        </div>
                      
                    </div>';
        $html .='<div class="row mb-3">
                         <div class="col-md-3">
                            <label for="candidateName " class="form-label marathi-label ">उमेदवाराचे नाव 
                             <span class="txtval">'.$appointmentData['candidate_name'].'</span></label> 
                        </div>
                        <div class="col-md-3">
                            <label for="gender" class="form-label marathi-label ">लिंग
                             <span class="txtval">'.$appointmentData['gender'].'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label ">जन्मतारीख
                             <span class="txtval">'.$appointmentData['dob_date'].'</span></label>                             
                        </div>
                       <div class="col-md-3">
                            <label for="matrimonial_status " class="form-label marathi-label ">अविवाहित/विवाहित
                             <span class="txtval">'.$appointmentData['matrimonial_status'].'</span></label>                             
                        </div>
                    </div>';             
        $html .='<div class="row mb-3">
                         <div class="col-md-3">
                            <label for="candidateemail " class="form-label marathi-label ">ई-मेल 
                             <span class="txtval">'.$appointmentData['candidateemail'].'</span></label> 
                        </div>
                          <div class="col-md-3">
                            <label for="candidatemobile " class="form-label marathi-label ">मोबाईल क्रमांक 
                             <span class="txtval">'.$appointmentData['candidatemobile'].'</span></label> 
                        </div>
                        <div class="col-md-3">
                            <label for="panNumber" class="form-label marathi-label ">पॅन क्रमांक <span class="english-label">(PAN)</span> 
                             <span class="txtval">'.$appointmentData['pan_number'].'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="aadharNumber" class="form-label marathi-label ">आधार क्रमांक <span class="english-label">(Aadhar)</span>
                             <span class="txtval">'.$appointmentData['aadhar_number'].'</span></label>                             
                        </div>
                      
                    </div>';

        $html .= '<div class="row mb-3" id="casteCategoryBox_onboard">';
        $html .= ' <div class="col-md-4">
                            <label for="originalCategory_onboard" class="form-label marathi-label">मूळ आरक्षण प्रवर्ग <span class="english-label">(Original)</span></label>
                           <span class="txtval">'.$originalCategoryName.'</span>
                        </div>
                         <div class="col-md-4">
                           <label for="appointmentCategory_onboard" class="form-label marathi-label">समांतर आरक्षण प्रवर्ग <span class="english-label">(Horizontal)</span></label>
                             <span class="txtval">'.$horizontalCategoryName.'</span>
                        </div>
                        <div class="col-md-4">
                            <label for="horizontalcertificateFile_onboard" class="form-label marathi-label ">लागू असल्यास प्रमाणपत्र अपलोड करा</label>
                              <span class="txtval">'.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'horizontalcertificate').'</span>
                        </div>';

        
        if (!in_array((int)$sanstha["minority_sanstha"], [2, 3], true)){
            
                  $html .= ' <div class="col-md-4">
                          <label for="appointmentCategory_onboard" class="form-label marathi-label required-field">नियुक्तीचा आरक्षण प्रवर्ग <span class="english-label">(Appointment)</span></label>
                             <span class="txtval">'.$appointmentCategoryName.'</span>
                        </div>
                        <div class="col-md-4">
                            <label for="castecertificateFile_onboard" class="form-label marathi-label ">जात प्रमाणपत्र अपलोड करा</label>
                             <span class="txtval">'.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'castecertificate').' </span>
                        </div>
                        <div class="col-md-4">
                            <label for="validcastecertificateFile_onboard" class="form-label marathi-label ">वैध जात प्रमाणपत्र अपलोड करा</label>
                            <span class="txtval">'.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'validcastecertificate').' </span>
                        </div>';  
        }
  
        $html .= ' <div class="col-md-4">
                          <label for="pay_scale_onboard" class="form-label marathi-label">वेतनश्रेणी  <span class="english-label">(Pay Scale)</span></label>
                              <span class="txtval">'.$payScaleName.'</span>
                        </div>
                     ';                                   

        $html .= '</div>';      
        
        $html.= '
                    <div class="pdf-field">
                        <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label for="sscFile" class="form-label marathi-label">
                                     माध्यमिक <span class="english-label">(SSC)</span>
                                </label>
                                <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'ssc').'
                            </div>      
                            </div>    
                            <div class="col-md-3">
                                <label for="hscFile" class="form-label marathi-label">
                                    उच्च माध्यमिक <span class="english-label">(HSC)</span>
                                </label>
                                <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'hsc').'
                            </div>      
                            </div>                     
                            <div class="col-md-3">
                                <label for="graduateFile" class="form-label marathi-label">
                                    पदवी <span class="english-label">(Graduate Degree)</span>
                                </label>
                                <div class="col-md-3" >
                              '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'graduate').'
                            </div>      
                            </div>
                                <div class="col-md-3">
                                <label for="postGraduateFile" class="form-label marathi-label">
                                    पदव्युत्तर पदवी  <span class="english-label">(Post Graduate Degree)</span>
                                </label>
                               <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'post_graduate').'
                            </div>      
                            </div>     
                                
                        </div>
                        <hr/>                        
                    </div>   
                    ';
        

        $html .= '   <div class="pdf-field">
                        <h3 class="section-title">जाहिरातीचा तपशील.</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="advApprovelFile" class="form-label english-label ">
                                     जाहिरात मंजूरी पत्र 
                                </label>                                
                            </div>    
                            <div class="col-md-3" >
                               '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'adv_approval').'
                            </div>      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3 mt-2">
                                <label for="advertisementFile" class="form-label english-label">
                                   जाहिरात
                                </label>                                    
                            </div>     
                            <div class="col-md-3">
                               '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'advertisement').'
                            </div>   
                        </div>
                        <hr/>                        
                    </div> ';  
        
        $html .=' <div class="pdf-field">
                        <h3 class="section-title">निवड प्रक्रिया</h3>
                        <div class="row mt-2">
                            <div class="col-md-2 mt-2">
                                <label for="signatureFile" class="form-label english-label">
                                     उमेदवारांच्या स्वाक्षरीची यादी
                                </label>                                
                            </div>    
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'signature').'
                           
                                
                            </div>      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="markingFile" class="form-label english-label">
                                  उमेदवार गुणांकन
                                </label>                                    
                            </div>     
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'marking').'
                           
                                
                            </div>   
                        </div>
                          <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="resolutionFile" class="form-label english-label ">
                                  संस्थेचा ठराव
                                </label>                                    
                            </div>     
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'resolution').'
                           

                            </div>   
                        </div>

                          <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="orderFile" class="form-label english-label">
                                  आदेश
                                </label>                                    
                            </div>     
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'order').'
                           
                            </div>   
                        </div>

                        <hr/>                        
                    </div>'; 
                    
                    
          if (!in_array((int)$Sanstha->minority_sanstha, [2, 3], true)){
                    $rosterValue = ($appointmentData['roster']==true)?'Yes':'No';
                     $html .='<div class="pdf-field">
                        <h3 class="section-title">रोस्टर (Roster)</h3>

                        <div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            या संस्थेमध्ये एकच शिक्षकेतर पद आहे का?   &rarr;
                            </label>
                           <div>
                            '.$rosterValue.'<br>
                            </div>
                        
                        </label>
                        
                        <div class="">                        
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div >
                                         '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'court_order').'
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>';

            }  
            
            $court_order = ($appointmentData['court_order']==true)?'Yes':'No';

            $html .='<div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का?  &rarr;
                            </label>
                            <div >'.$court_order.'
                                       
                                    </div>
                        
                        </label>';
                  if(($appointmentData['court_order']===true)) {    
                   $html .='   <div  class="">                        
                            <div class="row mb-3">     
                                <div class="col-md-3"><lavel>याचिका क्रमांक</lavel>                            
                                        '.h($appointmentData['court_order_petition_number']).'
                               </div>  
                                <div class="col-md-3"> <lavel>याचिका तारीख</lavel>                                    
                                         '.h($appointmentData['court_order_date']).'
                                </div>                
                                <div class="col-md-6">
                                    <div >
                                       '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'order').'
                                    </div>
                                </div>
                            </div>                    
                        </div>';
                    } 
                  $html .='  </div>';

        return $html;
    }


 public function getdocumentFileLink($staff_onboarding_documents, $document_type)
    {
        foreach ($staff_onboarding_documents as $document) {

            if ($document['document_type'] == $document_type) {

                $imageUrl = Router::url(
                    '/' . ltrim($document['file_path'], '/'),
                    true
                );

                return '<a class="" href="'.$imageUrl.'" target="_blank">कागदपत्र पहा  </a>';
            }
        }

        return 'कागदपत्र उपलब्ध नाही';
    }

    public function processVacacyPublish(){
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $stTime = time();
        $user = $this->request->getAttribute('identity');


        $postAdvertisementId =
            $data['post_advertisement_id'] ?? null;

        $vacancies =
            $data['vacancies'] ?? [];
        $schoolLevel = $data['school_level'] ?? null;
            
        if (!$postAdvertisementId) {

            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Advertisement ID is required'
                ]));
        }

          if (empty($vacancies)) {

                return $this->response
                    ->withType('application/json')
                    ->withStatus(400)
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Please select at least one vacancy'
                    ]));
            }

        if (!in_array($schoolLevel, ['primary', 'secondary', 'higher_secondary'], true)) {
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Select a valid school level.'
                ]));
        }
            

         
        $PostData = [
                'institution_code' => $user->Sanstha->code,
                'institution_name'    => $user->Sanstha->name,
                'status'    =>'approved',
                'created_by'   => $this->user_id,
                'created_at'   => $stTime,
                'remarks' => $data['remarks'] ?? null,
                'is_direct_approved' => 1,
                'is_primary' => $schoolLevel === 'primary',
                'secondary' => $schoolLevel === 'secondary',
                'higher_secondary' => $schoolLevel === 'higher_secondary'
            ];

         $PostAdvertisementTable = TableRegistry::getTableLocator()->get('PostAdvertisement'); 
         $transfer = $PostAdvertisementTable->newEmptyEntity();
         $transfer = $PostAdvertisementTable->patchEntity($transfer, $PostData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file - Personal Recognition Document'
                    ]));
                    //throw new BadRequestException(json_encode($transfer->getErrors()));
            }

            if ($PostAdvertisementTable->save($transfer)) {
                $post_advertisement_id = $transfer->id;
               
                foreach ($vacancies as $vacancy) {
                      $vacancyId =
                            $vacancy['vacancy_id'] ?? null;

                       $category =
                            $vacancy['category'] ?? null;


                        if (!$vacancyId || !$category) {

                            continue;
                        }

                        $DdoVacantMasterTable = TableRegistry::getTableLocator()->get('DdoVacantMaster');
               
                                // Check if the post_id already exists in ddo_vacant_master
                            $existingEntity = $DdoVacantMasterTable->find()
                                            ->where(['id' => $vacancyId])
                                            ->first();

                            // echo '<pre/>';print_r($PostAdvertisementTable);exit;              

                            if ($existingEntity) {
                            
                                $schoolsTable = TableRegistry::getTableLocator()->get('Schools');
                                $schools = $schoolsTable->find()->where(['udise_code' => $existingEntity->school_udise_code])
                                            ->first();
            
                                $vacancyData = [
                                    'post_advertisement_id' => $post_advertisement_id,
                                    'school_udise_code'    => $existingEntity->school_udise_code,
                                    'school_name'    => $schools->school_name,
                                    'post_id'   => $vacancyId,
                                    'post_code'   => $existingEntity->post_id,
                                    'post_name'   => $existingEntity->post_name,
                                    'highest_class' => $schools->highest_class ?? null,
                                    'category'   => $vacancy['category']
                                ];
                            $PostAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies'); 
                            $transferVacancies = $PostAdvertisementVacanciesTable->newEntity($vacancyData);

                            if ($PostAdvertisementVacanciesTable->save($transferVacancies)) {
                                $insertId = $transferVacancies->id; // grab new id if needed
                            } else {
                                debug($transferVacancies->getErrors()); // see why it failed
                            }

                } 

                
                }

                $this->createAdvertisementAudit(
                    (int)$post_advertisement_id,
                    $this->user_id ? (int)$this->user_id : null,
                    'submitted',
                    null,
                    'pending',
                    'Advertisement application Already submitted',
                    1
                );

               
             return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'message' => 'Application forwarded successfully'
                ]));

               // throw new BadRequestException('Unable to save staff transfer');
            }

            return $this->response
                ->withType('application/json')
                ->withStatus(422)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Unable to save advertisement application.',
                    'errors' => $transfer->getErrors()
                ]));

       

    }

    public function FileUploadsectionWithKey($data,$key){

        $config = Configure::read('ESDL');
        $bucketPath = $config['mode'].'/staff/post_advertisement';  

        if (empty($data[$key]) || $data[$key]->getError() !== UPLOAD_ERR_OK) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(400)
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Please upload ' . ucfirst(str_replace('File', ' ', $key)) . ' PDF.'
                    ]));
             }

             if (!empty($data[$key]) && $data[$key]->getError() === UPLOAD_ERR_OK) {

                $file = $data[$key];
                   
                if ($file->getClientMediaType() !== 'application/pdf') {
                    return $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be a PDF File - Personal Recognition Document'
                        ]));
                }

                if ($file->getSize() > (2 * 1024 * 1024)) {
                    return $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit File - Personal Recognition Document'
                        ]));
                }

                if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Invalid File - Personal Recognition Document'
                        ]));
                }


                // Get temp path safely
                $tmpPath = $file->getStream()->getMetadata('uri');

                // Extract extension (safe)
                $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                // New filename
                $newFileName = $key.'.' . $extension;

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

               return $fileName;
          

            }else{
                return null;
            }
         }

         public function getStaffadvertisementDetails($staff_id = null){
            
            $this->request->allowMethod(['get', 'ajax']);

            $staff_id = $this->request->getQuery('staff_id', $staff_id);
            if ($staff_id === null || $staff_id === '' || filter_var($staff_id, FILTER_VALIDATE_INT) === false || (int)$staff_id < 1) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(400)
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Missing or invalid staff id'
                    ]));
            }

         

            $PostAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies');
            $PostAdvertisementVacanciesDetails = $PostAdvertisementVacanciesTable->find()
                ->select([
                'id' => 'PostAdvertisementVacancies.id',
                'post_name' => 'PostAdvertisementVacancies.post_name',
                'school_name' => 'PostAdvertisementVacancies.school_name',
                'udise_code' => 'PostAdvertisementVacancies.school_udise_code',
                'post_id' => 'PostAdvertisementVacancies.post_id',
                'category' => 'PostAdvertisementVacancies.category',
                'post_advertisement_id' => 'PostAdvertisementVacancies.post_advertisement_id',
                'period' => 'PostAdvertisement.period',
                'period_file' => 'PostAdvertisement.period_file',
                'period2324' => 'PostAdvertisement.period2324',
                'period_file2324' => 'PostAdvertisement.period2324_file',
                'approved_file' => 'PostAdvertisementAuditLogs.stage_doc'
                               
            ])
               ->innerJoin(
                ['PostAdvertisement' => 'post_advertisement'],
                'PostAdvertisement.id = PostAdvertisementVacancies.post_advertisement_id'
                )
                   ->innerJoin(
                       ['PostAdvertisementAuditLogs' => 'post_advertisement_audit_logs'],
                       'PostAdvertisementAuditLogs.post_advertisement_id = PostAdvertisement.id'
                   )
                   ->where([
                       'PostAdvertisement.status' => 'approved',
                       'PostAdvertisement.institution_code' => $this->username,
                       'PostAdvertisementAuditLogs.new_status' => 'approved'
                   ])    
                ->where(['PostAdvertisementVacancies.id' => (int)$staff_id])
                    ->first();

            $periodDiv = '<h6>आपले सदस्य पद सन २०२३-२४ च्या संयमान्यतेनुसार आहे किंवा त्यापूर्वीचे पायाभूत आहे.</h6>';
            if ($PostAdvertisementVacanciesDetails && !empty($PostAdvertisementVacanciesDetails->period)) {
                $periodDiv .= '<div class="col-md-6"> ' . h($PostAdvertisementVacanciesDetails->period==1 ? 'पायाभूत' : '') . ' <input type="hidden" name="period" value="' . h($PostAdvertisementVacanciesDetails->period) . '"> </div>';
            }else{
               /* $periodDiv .= '<label class="form-label fw-bold d-block">
                            आपले सदस्य पद सन २०२३-२४ च्या संयमान्यतेनुसार आहे किंवा त्यापूर्वीचे पायाभूत आहे.
                            <span class="text-danger">*</span>
                        </label>

                        <div class="mt-3">

                            <div class="form-check mb-3">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    id="periodYes"
                                    name="period"
                                    value="1"
                                    onchange="hideDiv('periodDiv');showDiv('periodFileDiv');hideDiv('period2324Div');showBtn('saSubmitBtn_step6')"
                                >
                                <label class="form-check-label ms-2" for="periodYes">
                                    पायाभूत
                                </label>
                            </div>

                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    id="periodNo"
                                    name="period"
                                    value="2"
                                    onchange="hideDiv('periodFileDiv');showDiv('periodDiv');hideDiv('period2324Div')"
                                >
                                <label class="form-check-label ms-2" for="periodNo">
                                    सन २०२३-२४ नंतर पद मंजूर
                                </label>
                            </div>

                        </div>


                        <div id="periodDiv" class="mt-3 hidden">
                            <label for="courtOrdertext" class="form-label marathi-label required-field">
                                 २०२३-२४ च्या नंतरचे असल्यास, संचालित शासन मान्यता घेतली आहे का? 
                            </label>
                          <div class="d-flex w-25 mt-2">
                            <div class="form-check flex-fill">
                                <input class="form-check-input" type="radio"
                                    id="period2324Yes" name="period2324" value="1"
                                    onchange="showDiv('period2324Div');showBtn('saSubmitBtn_step6');">
                                <label class="form-check-label ms-2" for="period2324Yes">
                                    होय
                                </label>
                            </div>

                            <div class="form-check flex-fill">
                                <input class="form-check-input" type="radio"
                                    id="period2324No" name="period2324" value="2"
                                    onchange="hideDiv('period2324Div');hideBtn('saSubmitBtn_step6');">
                                <label class="form-check-label ms-2" for="period2324No">
                                    नाही
                                </label>
                            </div>
                        </div> 
                        </div>

                        <div id="period2324Div" class="form-group mt-2 hidden">      
                            <input type="file" id="period2324File" name="period2324File" class="form-control file-upload-check" accept=".pdf">
                        </div>

                        <div id="periodFileDiv" class="form-group mt-2 hidden">      
                            <input type="file" id="periodFile" name="periodFile" class="form-control file-upload-check" accept=".pdf">
                        </div>';
                        */
            }
            if ($PostAdvertisementVacanciesDetails && !empty($PostAdvertisementVacanciesDetails->period2324)) {
                $periodDiv .= '<div class="col-md-6"> ' . h($PostAdvertisementVacanciesDetails->period2324==1 ? 'आकृतिबंधाच्या मर्यादित २०२३-२४ च्या नंतरचे असल्यास, संचालित शासन मान्यता घेतली आहे का : होय' : 'नाही') . '<input type="hidden" name="period2324" value="' . h($PostAdvertisementVacanciesDetails->period2324) . '"> </div>';
            }
            if ($PostAdvertisementVacanciesDetails && !empty($PostAdvertisementVacanciesDetails->period_file)) {
                $periodDiv .= '<div class="col-md-6"><strong>पायाभूत दस्तऐवज:</strong> <a href="' . h($PostAdvertisementVacanciesDetails->period_file) . '" target="_blank">View Document</a></div>';
            }
            if ($PostAdvertisementVacanciesDetails && !empty($PostAdvertisementVacanciesDetails->period_file2324)) {
                $periodDiv .= '<div class="col-md-6"><strong>सन २०२३-२४ च्या नंतरचे दस्तऐवज:</strong> <a href="' . h($PostAdvertisementVacanciesDetails->period_file2324) . '" target="_blank">View Document</a></div>';
            }    

            //$PostAdvertisementVacanciesDetails->periodDiv = $periodDiv;

            if (!$PostAdvertisementVacanciesDetails) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(404)
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Staff onboarding details not found'
                    ]));
            }

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => $PostAdvertisementVacanciesDetails,
                    'periodDiv' => $periodDiv
                ]));
         }
  }
