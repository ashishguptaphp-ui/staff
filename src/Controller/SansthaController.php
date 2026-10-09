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
            'processIndividualApprovalOrder'
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

       
        if ($role !== 'sanstha') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
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
        $this->viewBuilder()->setLayout('sanstha');

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
            

                /*echo "<pre>";

                print_r($statusCounts);
                exit;*/
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

        /*$staffsTable = TableRegistry::getTableLocator()->get('Staffs');

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
        }
        
        */
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

        
       // $this->set('staffsType', $result);


        //$this->render('/Headmaster/dashboard');
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
        $this->viewBuilder()->setLayout('sanstha');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();

        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategoriesDetails = $casteCategoriesTable->find()->all();

        
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategoriesDetails = $horizontalCategoriesTable->find()->all();
 
        // Inside your current controller
        //$data = $this->requestAction('/staff-qualifications/level-degrees/4');


        
        $acYear = ["2025-26","2026-27"];
        $postWorkingTable = $this->fetchTable('PostWorking');

        $ng2g = $postWorkingTable->find()
                ->select([
                        'PostWorking.post_type',
                        'PostWorking.unaided_vaiyaktik_manyata',
                        'PostWorking.post_id',
                        'post_name' => 'p.name',
                        'PostWorking.aid_id',
                        'ng2g_id' => 'st.id',
                        'is_minority_school' => 'st.is_minority_school',
                        'personal_recognition_number' => 'st.personal_recognition_number',
                        'aid_name'  => 'am.name',
                        'school_name' => 'schools.school_name',
                        'udise_code' => 'schools.udise_code',
                        'sanstha_name' => 'sansthas.name',
                        'sanstha_code' => 'sansthas.code',                       
                        'medium' => 'm.name',
                        'status' => 'st.status'
                    ])
            ->enableAutoFields(true)
            ->innerJoin(
                ['Schools' => 'schools'],
                'Schools.udise_code = PostWorking.udise_code'
            )
             ->innerJoin(
                ['Sansthas' => 'sansthas'],
                'Schools.sanstha_code = Sansthas.code'
            )            
            ->leftJoin(
                ['am' => 'aid_master'],
                ['am.id = PostWorking.aid_id']
            )
             ->leftJoin(
                ['st' => 'staff_ng2g_transfers'],
                ['st.post_working_id = PostWorking.id']
            )
            
             ->leftJoin(
                ['m' => 'mediums'],
                ['m.id = PostWorking.medium_id']
            )            
            ->leftJoin(
                ['p' => 'posts'],
                [
                    'p.code = PostWorking.post_id',
                    'p.staff_type = PostWorking.post_type'
                ]
            )            
            ->where([
                'Schools.sanstha_code' => $this->username,
                'PostWorking.ac_year IN' => $acYear,
                //'PostWorking.aid_id IN'=> [2,3,4,5,6]
            ])
            ->order([
                    'PostWorking.post_type' => 'ASC',
                    'PostWorking.date_of_joining' => 'ASC'
                ])
            ->all();



       /*echo "<pre>";
       print_r($ng2g);
       exit;*/
                    
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);  
        $this->set('mnp_nps', $mnp_nps);
        $this->set('districts', $districts);
        $this->set('regions', $regions);


    }
    public function sanctionedWorkingStrength()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('sanstha');

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
        $this->viewBuilder()->setLayout('sanstha');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();
       
      

       

        $this->set('schools', $schools);
     


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

            /* ===============================
            * 4. JSON Response
            * =============================== */
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

  }
