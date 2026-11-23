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


class SchoolController extends AppController
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
            'updateSchoolShalarthData',
            'fetchSanchDetails',
            'createTransferApplication',
            'updateTransferDetails',
            'salaryGradesByCommission',
            'updateStep2TransferDetails',
            'updateStep3TransferDetails',
            'updateStep4TransferDetails',
            'updateStep5TransferDetails',
            'updateStep6TransferDetails'
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

        $action = $this->request->getParam('action');
        
        if (!((($role == 'sanstha') && ($action == 'updateSanchData' || $action == 'updateSchoolShalarthData' || $action == 'updateTransferDetails' || $action == 'createTransferApplication' || 
        $action == 'updateStep2TransferDetails' || $action == 'updateStep3TransferDetails' || $action == 'updateStep4TransferDetails' || $action == 'updateStep5TransferDetails' || $action == 'updateStep6TransferDetails')) || ($role == 'school'))) {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->user_id = $this->request->getSession()->read('Auth.User.id');
        $this->username = $this->request->getSession()->read('Auth.User.username');
     
        $school = $this->request->getSession()->read('Auth.School');


        // //

        /*echo "<pre>";
        print_r($school);

        exit;*/
        //17743
        $this->set('school', $school);
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
        $this->viewBuilder()->setLayout('school');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schoolDetails = $schoolsTable->find()
                    ->contain(['SchoolManagements'])
                    ->contain(['SchoolSubManagements']) 
                    ->contain(['SchoolCategories'])                    
                    ->where(['udise_code' => $this->username])->first();
            /*echo "<pre>";
            print_r($schoolDetails);
            exit;*/

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $query = $staffsTable->find()
            ->select([
                'current_post_aid_type',
                'emp_type',
                'count' => $staffsTable->find()->func()->count('*')
            ])
            ->where(['udise_code' => $this->username])
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
            ->where(['udise_code' => $this->username])            
            ->group(['staff_update_status','emp_type']);

            

        
        foreach ($onboard as $row) {
            $updateStatus[$row->staff_update_status][$row->emp_type] =  $row->count;           
        }
        
        
       // pending
       //  $sanchPostSanctionWorkingTable = TableRegistry::getTableLocator()->get('SanchPostSanctionWorking');

       /* echo "<pre>";
        print_r($updateStatus);
        exit;*/

        $acYear = "2025-26";
        /*$postSanctionedTbl = TableRegistry::getTableLocator()->get('PostSanctioned');

        $query = $postSanctionedTbl->find()
            ->select([
                'post_type'      => 'PostSanctioned.post_type',
                'medium_id'      => 'PostSanctioned.medium_id',
                'post_id'        => 'PostSanctioned.post_id',
                'aid_id'         => 'PostSanctioned.aid_id',
                'num_posts'      => 'PostSanctioned.num_posts',
                'working_posts'  => $query = $postSanctionedTbl->find()->func()->count('PostWorking.id')
            ])
            ->leftJoin(
                ['PostWorking' => 'post_working'],
                [
                    'PostSanctioned.post_type = PostWorking.post_type',
                    'PostSanctioned.medium_id = PostWorking.medium_id',
                    'PostSanctioned.post_id = PostWorking.post_id',
                    'PostSanctioned.aid_id = PostWorking.aid_id',
                    'PostSanctioned.udise_code = PostWorking.udise_code',
                    'PostSanctioned.ac_year = PostWorking.ac_year'
                ]
            )
            ->contain([
                'StaffsTypes' => function ($q) {
                    return $q->select([
                        'StaffsTypes.id',
                        'StaffsTypes.staff_type_name'
                    ]);
                },
                'Posts' => function ($q) {
                    return $q->select([
                        'Posts.id',
                        'Posts.name'
                    ]);
                }
            ])
            ->where([
                'PostSanctioned.udise_code' => $this->username,
                'PostSanctioned.ac_year'   => $acYear
            ])
            ->group([
                'PostSanctioned.post_type',
                'PostSanctioned.medium_id',
                'PostSanctioned.post_id',
                'PostSanctioned.aid_id',
                'PostSanctioned.num_posts',
                'StaffsTypes.id',
                'Posts.id'
            ])
            ->order([
                'PostSanctioned.post_type' => 'ASC',
                'PostSanctioned.medium_id' => 'ASC',
                'PostSanctioned.post_id'   => 'ASC',
                'PostSanctioned.aid_id'    => 'ASC'
            ]);

        $sanch = $query->enableHydration(false)->toArray();*/

        $connection = ConnectionManager::get('default');

        /*$sql = "
        WITH sanctioned AS (
            SELECT post_type, medium_id, post_id, p.name as post_name, aid_id,am.name as aid_name, udise_code, ac_year, num_posts
            FROM post_sanctioned
            LEFT JOIN public.aid_master AS am ON (am.id = post_sanctioned.aid_id)
            LEFT JOIN public.posts AS p ON (p.code = post_sanctioned.post_id AND p.staff_type = post_sanctioned.post_type)
            WHERE udise_code = :udise_code
            AND ac_year = :ac_year
        ),
        working AS (
            SELECT post_type, medium_id, post_id, p.name as post_name, aid_id, am.name as aid_name, udise_code, ac_year,
                COUNT(post_working.id) AS working_posts
            FROM post_working
            LEFT JOIN public.aid_master AS am ON (am.id = post_working.aid_id)
            LEFT JOIN public.posts AS p ON (p.code = post_working.post_id AND p.staff_type = post_working.post_type)
            WHERE udise_code = :udise_code
            AND ac_year = :ac_year
            GROUP BY post_type, medium_id, post_id, post_name, aid_id, aid_name, udise_code, ac_year
        )
        SELECT 
            COALESCE(s.post_type, w.post_type) AS post_type,
            COALESCE(s.medium_id, w.medium_id) AS medium_id,
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
            AND s.medium_id = w.medium_id
            AND s.post_id   = w.post_id
            AND s.aid_id    = w.aid_id
        ORDER BY post_type, medium_id, post_id, aid_id
        ";*/

        $sql = "
        WITH sanctioned AS (
            SELECT post_type,  post_id, p.name as post_name, aid_id,am.name as aid_name, udise_code, ac_year, num_posts
            FROM post_sanctioned
            LEFT JOIN public.aid_master AS am ON (am.id = post_sanctioned.aid_id)
            LEFT JOIN public.posts AS p ON (p.code = post_sanctioned.post_id AND p.staff_type = post_sanctioned.post_type)
            WHERE udise_code = :udise_code
            AND ac_year = :ac_year
        ),
        working AS (
            SELECT post_type,  post_id, p.name as post_name, aid_id, am.name as aid_name, udise_code, ac_year,
                COUNT(post_working.id) AS working_posts
            FROM post_working
            LEFT JOIN public.aid_master AS am ON (am.id = post_working.aid_id)
            LEFT JOIN public.posts AS p ON (p.code = post_working.post_id AND p.staff_type = post_working.post_type)
            WHERE udise_code = :udise_code
            AND ac_year = :ac_year
            GROUP BY post_type, post_id, post_name, aid_id, aid_name, udise_code, ac_year
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
            'udise_code' => $this->username,
            'ac_year'    => $acYear
        ]);

        $sanch = $stmt->fetchAll('assoc');

        /*echo '<pre>';
        print_r($sanch);
        exit;*/

        
        $this->set('school', $schoolDetails);
        $this->set('udise', $this->username);
        $this->set('updateStatus', $updateStatus);
        $this->set('staffsType', $result);
        $this->set('sanch', $sanch);


        //$this->render('/Headmaster/dashboard');
    }

     public function updateProfile($staffId = null)
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
    public function profile()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('school');
        //$this->render('/Headmaster/dashboard');
    }

    public function ngtogTransfer()
    {
        $this->viewBuilder()->setLayout('school');    
        /*$staffsTable = TableRegistry::getTableLocator()->get('Staffs');                   
        $staffDetails = $staffsTable->find()
                                    ->contain(['CasteCategories','Posts','StaffTransfers'])
                                    ->where([
                                            'udise_code' => $this->username,
                                            'emp_type' => 1
                                        ])
                                    ->all();*/


        $acYear = "2025-26";
        $postWorkingTbl = TableRegistry::getTableLocator()->get('PostWorking');

        $staffDetails = $postWorkingTbl->find()
                            ->contain(['StaffsTypes','Posts','Mediums','AidMaster'])
                            ->where([
                                'udise_code' => $this->username,
                                'ac_year'   => $acYear,
                                'aid_id IN'  => [2, 3, 4, 5, 6]
                            ])
                            ->all();


        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schoolDetails = $schoolsTable->find()
                    ->contain(['SchoolManagements'])
                    ->contain(['SchoolSubManagements']) 
                    ->contain(['SchoolCategories'])                    
                    ->where(['udise_code' => $this->username])->first();

        //$postsTable = TableRegistry::getTableLocator()->get('Posts');                   
        //$postsDetails = $postsTable->find()->where(['staff_type' => 1])->all();

        //$payScalesTable = TableRegistry::getTableLocator()->get('PayScales');                   
        //$payScalesDetails = $payScalesTable->find()->all();

        //$payCommissionsTable = TableRegistry::getTableLocator()->get('PayCommissions');                   
        //$payCommissionsDetails = $payCommissionsTable->find()->all();

        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategoriesDetails = $casteCategoriesTable->find()->all();

        
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategoriesDetails = $horizontalCategoriesTable->find()->all();

        $mediumsTable = TableRegistry::getTableLocator()->get('Mediums');                   
        $mediums = $mediumsTable->find()->all();
        $subjectsTable = TableRegistry::getTableLocator()->get('Subjects');                   
        $subjects = $subjectsTable->find()->all();


        /*echo "<pre>";
        print_r($subjects);
        exit;*/
        $this->set('staffs', $staffDetails);   
        $this->set('school', $schoolDetails);   

        
        //$this->set('posts', $postsDetails); 
       // $this->set('payCommissions', $payCommissionsDetails);      
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);   
          
        $this->set('mediums', $mediums);  
        $this->set('subjects', $subjects);     

    }
    
    public function salaryGradesByCommission($commissionId)
    {   
        $this->request->allowMethod(['get', 'ajax']);
        $payScalesTable = TableRegistry::getTableLocator()->get('PayScales');                   
        $payScalesDetails = $payScalesTable->find()->where(['commission_id' => $commissionId])->all();

         $response = [
                'status' => 'success',
                'statusCode' => 200,
                'payScales' => $payScalesDetails
            ];
        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->setClassName('Json');


    }
    

    public function createTransferApplication()
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
            
            if (!empty($data['ng2g_id'])) {
                $transfer = $staffTransferTable->get($data['ng2g_id']);
            } else {
                $transfer = $staffTransferTable->newEmptyEntity();
            }
            $is_transfer_school = 0;
            if(isset($data['transferCheck']) && ($data['transferCheck']== 'on')){
                $is_transfer_school = 1;
            }

            $is_minority_school = 0;
            if(isset($data['minorityCheck']) && ($data['minorityCheck']== 'on')){
                $is_minority_school = 1;
            }

            
            //'pending'::staff_update_statuses_enum
            $staffData = [
                'staff_id'          => $data['staffId'] ?? null,
                'post_working_id'   => $data['app_id'] ?? null,
                'status'            => 'application_draft_step_1', 
                'pan_number'        => $data['panNumber'] ?? null,
                'aadhar_number'     => $data['aadharNumber'] ?? null,
                'minority_cert_outward_number'        => $data['minorityCertOutwardNumber'] ?? null,
                'minority_cert_outward_date'          => $data['minorityCertOutwardDate'] ?? null,

                'institution_code'  => $data['institution_code'] ?? null,
                'institution_name'  => $data['institution_name'] ?? null,
                'udise_number'      => $data['udise_code'] ?? null,
                'school_name'       => $data['school_name'] ?? null,
                'school_location'   => $data['schoolLocation'] ?? null,
                
                'employee_name'     => $data['emp_name'] ?? null,
                'designation'       => $data['post_name'] ?? null,    
                'salary_grade'      => $data['pay_scale'] ?? null,
                'teaching_subject'  => $data['subject_taught'] ?? null,
                
                'is_transfer_school'  => $data['is_transfer_school'] ?? null, // new
                'is_minority_school'  => $data['is_minority_school'] ?? null, // new
                'staff_type'  => $data['staff_type'] ?? null, // new
                'staff_type_name'  => $data['staff_type_name'] ?? null, // new
                'aid_name'  => $data['aid_name'] ?? null, // new
                'email'  => $data['email'] ?? null, // new
                'mobile'  => $data['mobile'] ?? null, // new
                'medium'  => $data['medium'] ?? null, // new

                'udise_number_at_transfer'      => $data['transferSchool'] ?? null,
                'school_name_at_transfer'       => $data['schoolNameAtTransfer'] ?? null, // need to add in form

                'original_category' => $data['originalCategory'] ?? null,
                'appointment_category'  => $data['appointmentCategory'] ?? null,
                'horizontal_category'  => $data['horizontalCategory'] ?? null,  
                'appointment_date'  => $data['appointmentDate'] ?? null,
                'teaching_classes'  => $data['teachingClasses'] ?? null,
                'tet_number'  => $data['tetnumber'] ?? null,
                'tet_year'  => $data['tetExam'] ?? null,
                'tet_paper'  => $data['tetPaper'] ?? null,
                'ctet_number'  => $data['ctetnumber'] ?? null,
                'ctet_year'  => $data['ctetExam'] ?? null,
                'ctet_paper'  => $data['ctetPaper'] ?? null,
               

            ];

            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/'.$data['staffId'].'/transfers';

            $fileFields = array(
                'minority_cert_outward_file' => 'minorityCertOutwardFile',
                'tet_certificate_file' => 'tetCertificateFile',
                'ctet_certificate_file' => 'ctetCertificateFile'
            );

            
            foreach ($fileFields as $key => $field) {

                if (!empty($data[$field]) && $data[$field]->getError() === UPLOAD_ERR_OK) {

                    $file = $data[$field];

                   

                    //$file = $this->request->getData('document');
                 
                    if ($file->getClientMediaType() !== 'application/pdf') {
                        //throw new BadRequestException("$field must be a PDF");
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Must be a PDF File - '.$field
                            ]));
                    }

                    if ($file->getSize() > (2 * 1024 * 1024)) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Exceeds 2MB limit File - '.$field
                            ]));
                        //throw new BadRequestException("$field exceeds 2MB limit");
                    }

                    if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid File - '.$field
                            ]));
                        //$this->Flash->error('Invalid file');
                    }


                    // Get temp path safely
                    $tmpPath = $file->getStream()->getMetadata('uri');

                    // Extract extension (safe)
                    $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                    // New filename
                    $newFileName = $key . '.' . $extension;

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

                    $staffData[$key] = $fileName;
                } 
            }
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'.$field
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

    public function updateStep2TransferDetails()
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
           
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            $transfer = $staffTransferTable->get($data['ng2g_id']);
            /*echo "<pre>";
            print_r( $transfer);
            exit;*/
            if (!($transfer->id)) {
                 return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to find transfer application'
                    ]));
            }           
            $staffData = [
                'status' => 'application_draft_step_2', 
                'graduate_degree'  => $data['transferGraduateDegree'] ?? null,
                'graduate_degree_subject'  => $data['transferGraduateDegreeSubject'] ?? null,
                'post_graduate_degree'  => $data['transferPostGraduateDegree'] ?? null,
                'post_graduate_degree_subject'  => $data['transferPostGraduateDegreeSubject'] ?? null,
                'professional_diploma'  => $data['transferProfessionalDiploma'] ?? null,
                'graduate_professional_degree'  => $data['transferGraduateProfessionalDegree'] ?? null,
                'post_graduate_professional_degree'  => $data['transferPostGraduateProfessionalDegree'] ?? null
            ];

            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/'.$transfer->staff_id.'/transfers';

            $fileFields = array(
                'hsc_file' => 'hscFile',
                'graduate_file' => 'graduateFile',
                'post_graduate_file' => 'postGraduateFile',
                'ded_file' => 'dedFile',
                'bed_file' => 'bedFile',
                'mped_file' => 'mpedFile'
            );

            
            foreach ($fileFields as $key => $field) {

                if (!empty($data[$field]) && $data[$field]->getError() === UPLOAD_ERR_OK) {

                    $file = $data[$field];

                   

                    //$file = $this->request->getData('document');
                 
                    if ($file->getClientMediaType() !== 'application/pdf') {
                        //throw new BadRequestException("$field must be a PDF");
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Must be a PDF File - '.$field
                            ]));
                    }

                    if ($file->getSize() > (2 * 1024 * 1024)) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Exceeds 2MB limit File - '.$field
                            ]));
                        //throw new BadRequestException("$field exceeds 2MB limit");
                    }

                    if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid File - '.$field
                            ]));
                        //$this->Flash->error('Invalid file');
                    }


                    // Get temp path safely
                    $tmpPath = $file->getStream()->getMetadata('uri');

                    // Extract extension (safe)
                    $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                    // New filename
                    $newFileName = $key . '.' . $extension;

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

                    $staffData[$key] = $fileName;
                } 
            }
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'.$field
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

    public function updateStep3TransferDetails()
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
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            $transfer = $staffTransferTable->get($data['ng2g_id']);
            /*echo "<pre>";
            print_r( $transfer);
            exit;*/
            if (!($transfer->id)) {
                 return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to find transfer application'
                    ]));
            } 

            //'pending'::staff_update_statuses_enum
            $staffData = [
                'status' => 'application_draft_step_3',                 
                'vacant_post_causing_transfer'  => $data['vacantPostCausingTransfer'] ?? null,
                'vacant_post_date'  => $data['vacantPostDate'] ?? null,
                'school_committee_outward_number'        => $data['schoolCommitteeOutwardNumber'] ?? null,
                'school_committee_outward_date'          => $data['schoolCommitteeOutwardDate'] ?? null,
                'origin_sanstha_appointment_number'        => $data['originSansthaAppointmentNumber'] ?? null,
                'origin_sanstha_appointment_date'          => $data['originSansthaAppointmentDate'] ?? null,
                'personal_recognition_number'              => $data['personalRecognitionNumber'] ?? null,
                'personal_recognition_date'                => $data['personalRecognitionDate'] ?? null,
                'service_seniority_list_number'            => $data['serviceSeniorityListNumber'] ?? null,
                'service_seniority_list_date'              => $data['serviceSeniorityListDate'] ?? null,
                'vacant_post_merit_list_number'            => $data['vacantPostAsMeritListNumber'] ?? null,
                'vacant_post_merit_list_date'              => $data['vacantPostAsMeritListDate'] ?? null,
            ];

            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/'.$transfer->staff_id.'/transfers';

            $fileFields = array(
              
                'school_committee_outward_file' => 'schoolCommitteeOutwardFile',
                'origin_sanstha_appointment_file' => 'originSansthaAppointmentFile',
                'personal_recognition_file' => 'personalRecognitionFile',
                'service_seniority_list_file' => 'serviceSeniorityListFile',
                'vacant_post_merit_list_file' => 'vacantPostAsMeritListFile',
                'five_years_hm_certificate_file' => 'fiveYrsHMCertificateFile',
                'vacant_post_causing_transfer_file' => 'vacantPostCausingTransferFile'            
            );

            
            foreach ($fileFields as $key => $field) {

                if (!empty($data[$field]) && $data[$field]->getError() === UPLOAD_ERR_OK) {

                    $file = $data[$field];

                   

                    //$file = $this->request->getData('document');
                 
                    if ($file->getClientMediaType() !== 'application/pdf') {
                        //throw new BadRequestException("$field must be a PDF");
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Must be a PDF File - '.$field
                            ]));
                    }

                    if ($file->getSize() > (2 * 1024 * 1024)) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Exceeds 2MB limit File - '.$field
                            ]));
                        //throw new BadRequestException("$field exceeds 2MB limit");
                    }

                    if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid File - '.$field
                            ]));
                        //$this->Flash->error('Invalid file');
                    }


                    // Get temp path safely
                    $tmpPath = $file->getStream()->getMetadata('uri');

                    // Extract extension (safe)
                    $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                    // New filename
                    $newFileName = $key . '.' . $extension;

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

                    $staffData[$key] = $fileName;
                } 
            }
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'.$field
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

            $connection->commit();

            /* ===============================
            * 4. JSON Response
            * =============================== */
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $transfer->id,
                    'is_minority_school' => $transfer->is_minority_school,
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

    public function updateStep4TransferDetails()
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
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            $transfer = $staffTransferTable->get($data['ng2g_id']);
            /*echo "<pre>";
            print_r( $transfer);
            exit;*/
            if (!($transfer->id)) {
                 return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to find transfer application'
                    ]));
            } 

            //'pending'::staff_update_statuses_enum
            $staffData = [
                'status' => 'application_draft_step_4', 
                'mavak_checklist_date'                      => $data['mavakCheckListDate'] ?? null,
                'recruitment_noc_outward_number'            => $data['recruitmentNocOutwardNumber'] ?? null,
                'recruitment_noc_outward_date'              => $data['recruitmentNocOutwardDate'] ?? null,
                'advrt_newspaper_name'                      => $data['advrtNewspaperName'] ?? null,
                'advrt_newspaper_date'                      => $data['advrtNewspaperDate'] ?? null,   
                'interview_date'                            => $data['interviewDate'] ?? null,
                'report_ng_principle_date'                  => $data['reportNGPrincipleDate'] ?? null,
                'report_g_principle_date'                   => $data['reportGPrincipleDate'] ?? null,
                'self_financing_certificate_outward_number' => $data['selfFinancingCertificateOutwardNumber'] ?? null,
                'self_financing_certificate_date'           => $data['selfFinancingCertificateDate'] ?? null,
                'transfer_not_higher_post_outward_number'  => $data['transferNotHigherPostOutwardNumber'] ?? null,
                'transfer_not_higher_post_date'            => $data['transferNotHigherPostDate'] ?? null             

            ];

            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/'.$transfer->staff_id.'/transfers';

            $fileFields = array(
                'mavak_checklist_file' => 'mavakCheckListFile',   
                'recruitment_noc_outward_file' => 'recruitmentNocOutwardFile',
                'advrt_newspaper_file' => 'advrtNewspaperFile',
                'transfer_not_higher_post_file' => 'transferNotHigherPostFile',
                'interview_file' => 'interviewFile',
                'report_ng_principle_file' => 'reportNGPrincipleFile',
                'report_g_principle_file' => 'reportGPrincipleFile',
                'self_financing_certificate_file' => 'selfFinancingCertificateFile',
                'salary_subsidy_guarantee_letter_file' => 'salarySubsidyGuaranteeLetterFile'                
            );

            
            foreach ($fileFields as $key => $field) {

                if (!empty($data[$field]) && $data[$field]->getError() === UPLOAD_ERR_OK) {

                    $file = $data[$field];

                   

                    //$file = $this->request->getData('document');
                 
                    if ($file->getClientMediaType() !== 'application/pdf') {
                        //throw new BadRequestException("$field must be a PDF");
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Must be a PDF File - '.$field
                            ]));
                    }

                    if ($file->getSize() > (2 * 1024 * 1024)) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Exceeds 2MB limit File - '.$field
                            ]));
                        //throw new BadRequestException("$field exceeds 2MB limit");
                    }

                    if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid File - '.$field
                            ]));
                        //$this->Flash->error('Invalid file');
                    }


                    // Get temp path safely
                    $tmpPath = $file->getStream()->getMetadata('uri');

                    // Extract extension (safe)
                    $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                    // New filename
                    $newFileName = $key . '.' . $extension;

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

                    $staffData[$key] = $fileName;
                } 
            }
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'.$field
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
    
    public function updateStep5TransferDetails()
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
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            $transfer = $staffTransferTable->get($data['ng2g_id']);
            /*echo "<pre>";
            print_r( $transfer);
            exit;*/
            if (!($transfer->id)) {
                 return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to find transfer application'
                    ]));
            } 

            $is_court_order = 0;
            if(isset($data['courtOrder']) && ($data['courtOrder']== '1')){
                $is_court_order = 1;
            }

            //'pending'::staff_update_statuses_enum
            $staffData = [
                'is_court_order' => $is_court_order,
                'status' => 'application_draft_step_5',                
                'bank_statement_from_date'                  => $data['bankStatementFromDate'] ?? null,
                'bank_statement_to_date'                    => $data['bankStatementToDate'] ?? null,                
                'court_order_petition_number'               => $data['courtOrderPetitionNumber'] ?? null,
                'court_order_date'                          => $data['courtOrderDate'] ?? null,
                'no_benefits_certificate_details'           => $data['noBenefitsCertificateDetails'] ?? null
            ];

            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/'.$transfer->staff_id.'/transfers';

            $fileFields = array(
                'itr1_file' => 'itr1File',
                'itr2_file' => 'itr2File',
                'itr3_file' => 'itr3File',
                'bank_statement_file' => 'bankStatementFile',
                'court_order_file' => 'courtOrderFile',    
                'no_benefits_certificate_file' => 'noBenefitsCertificateFile',
                'nps_scheme' => 'npsScheme',
                'institution_guarantee_file' => 'institutionGuaranteeFile',
                'institution_no_disbute_file' => 'institutionNoDisbuteFile',
                'other_documents_file' => 'otherDocuments'
            );

            
            foreach ($fileFields as $key => $field) {

                if (!empty($data[$field]) && $data[$field]->getError() === UPLOAD_ERR_OK) {

                    $file = $data[$field];

                   

                    //$file = $this->request->getData('document');
                 
                    if ($file->getClientMediaType() !== 'application/pdf') {
                        //throw new BadRequestException("$field must be a PDF");
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Must be a PDF File - '.$field
                            ]));
                    }

                    if ($file->getSize() > (2 * 1024 * 1024)) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Exceeds 2MB limit File - '.$field
                            ]));
                        //throw new BadRequestException("$field exceeds 2MB limit");
                    }

                    if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid File - '.$field
                            ]));
                        //$this->Flash->error('Invalid file');
                    }


                    // Get temp path safely
                    $tmpPath = $file->getStream()->getMetadata('uri');

                    // Extract extension (safe)
                    $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                    // New filename
                    $newFileName = $key . '.' . $extension;

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

                    $staffData[$key] = $fileName;
                } 
            }
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'.$field
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

    public function updateStep6TransferDetails()
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
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            $transfer = $staffTransferTable->get($data['ng2g_id']);
            /*echo "<pre>";
            print_r( $transfer);
            exit;*/
            if (!($transfer->id)) {
                 return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to find transfer application'
                    ]));
            } 
            
            

            //'pending'::staff_update_statuses_enum
            $staffData = [
                'status'            => 'dy_eo_desk_pending',  
                'stage1_fwd_at'  => time(),                       
                'stage1_fwd_to'  => (int) ($data['sa_forward_to'] ?? 0),
                'stage1_fwd_to_target'  => (int) ($data['sa_forward_to_target'] ?? 0)
            ];
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);           

            if (!$staffTransferTable->save($transfer)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to save staff transfer'
                    ]));
               // throw new BadRequestException('Unable to save staff transfer');
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
                    'message' => 'बदली अर्जाची माहिती यशस्वीरीत्या जतन करण्यात आली आहे. पुढील कार्यवाहीसाठी अर्ज पुढील स्तरावर पाठविण्यात आला आहे.'
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

    public function updateTransferDetails()
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
            $is_transfer_school = 0;
            if(isset($data['transferCheck']) && ($data['transferCheck']== 'on')){
                $is_transfer_school = 1;
            }

            $is_minority_school = 0;
            if(isset($data['minorityCheck']) && ($data['minorityCheck']== 'on')){
                $is_minority_school = 1;
            }

            $is_court_order = 0;
            if(isset($data['courtOrder']) && ($data['courtOrder']== '1')){
                $is_court_order = 1;
            }

            //'pending'::staff_update_statuses_enum
            $staffData = [
                'staff_id'          => $data['staffId'] ?? null,
                'post_working_id'   => $data['app_id'] ?? null,
                'status'            => 'dy_eo_desk_pending', 
                'pan_number'        => $data['panNumber'] ?? null,
                'aadhar_number'     => $data['aadharNumber'] ?? null,
                'minority_cert_outward_number'        => $data['minorityCertOutwardNumber'] ?? null,
                'minority_cert_outward_date'          => $data['minorityCertOutwardDate'] ?? null,


                'institution_code'  => $data['institutionCode'] ?? null,
                'institution_name'  => $data['institutionName'] ?? null,
                'udise_number'      => $data['udiseNumber'] ?? null,
                'school_name'       => $data['schoolName'] ?? null,
                'school_location'   => $data['schoolLocation'] ?? null,
                'original_category' => $data['originalCategory'] ?? null,
                'appointment_category'  => $data['appointmentCategory'] ?? null,                
                'employee_name'     => 'dddddddddd',//$data['employeeName'] ?? null,
                'designation'       => $data['designation'] ?? null,    
                'salary_grade'      => $data['salaryGrade'] ?? null,
                'teaching_subject'  => $data['teachingSubject'] ?? null,
                'udise_number_at_transfer'      => $data['transferSchool'] ?? null,
                'school_name_at_transfer'       => $data['schoolNameAtTransfer'] ?? null, // need to add in form
                ///'school_location_at_transfer'   => $data['schoolLocationAtTransfer'] ?? null,
                ///'school_permission_order_number'        => $data['schoolPermissionOrderNumber'] ?? null,
                ///'school_permission_order_date'          => $data['schoolPermissionOrderDate'] ?? null,
                'appointment_date'  => $data['appointmentDate'] ?? null,
                'teaching_classes'  => $data['teachingClasses'] ?? null,
                'tet_number'  => $data['tetnumber'] ?? null,
                'tet_year'  => $data['tetExam'] ?? null,
                'tet_paper'  => $data['tetPaper'] ?? null,
                'ctet_number'  => $data['ctetnumber'] ?? null,
                'ctet_year'  => $data['ctetExam'] ?? null,
                'ctet_paper'  => $data['ctetPaper'] ?? null,
                'transfer_graduate_degree'  => $data['transferGraduateDegree'] ?? null,
                'transfer_graduate_degree_subject'  => $data['transferGraduateDegreeSubject'] ?? null,
                'transfer_post_graduate_degree'  => $data['transferPostGraduateDegree'] ?? null,
                'transfer_post_graduate_degree_subject'  => $data['transferPostGraduateDegreeSubject'] ?? null,
                'transfer_professional_diploma'  => $data['transferProfessionalDiploma'] ?? null,
                'transfer_graduate_professional_degree'  => $data['transferGraduateProfessionalDegree'] ?? null,
                'transfer_post_graduate_professional_degree'  => $data['transferPostGraduateProfessionalDegree'] ?? null,
                'Vacant_post_causing_transfer'  => $data['VacantPostCausingTransfer'] ?? null,
                'vacant_post_date'  => $data['vacantPostDate'] ?? null,
                'school_committee_outward_number'        => $data['schoolCommitteeOutwardNumber'] ?? null,
                'school_committee_outward_date'          => $data['schoolCommitteeOutwardDate'] ?? null,
                'origin_sanstha_appointment_number'        => $data['originSansthaAppointmentNumber'] ?? null,
                'origin_sanstha_appointment_date'          => $data['originSansthaAppointmentDate'] ?? null,
                'personal_recognition_number'              => $data['personalRecognitionNumber'] ?? null,
                'personal_recognition_date'                => $data['personalRecognitionDate'] ?? null,
                'service_seniority_list_number'            => $data['serviceSeniorityListNumber'] ?? null,
                'service_seniority_list_date'              => $data['serviceSeniorityListDate'] ?? null,
                'vacant_post_merit_list_number'            => $data['vacantPostAsMeritListNumber'] ?? null,
                'vacant_post_merit_list_date'              => $data['vacantPostAsMeritListDate'] ?? null,
                'mavak_checklist_date'                      => $data['mavakCheckListDate'] ?? null,
                'recruitment_noc_outward_number'            => $data['recruitmentNocOutwardNumber'] ?? null,
                'recruitment_noc_outward_date'              => $data['recruitmentNocOutwardDate'] ?? null,
                'advrt_newspaper_name'                      => $data['advrtNewspaperName'] ?? null,
                'advrt_newspaper_date'                      => $data['advrtNewspaperDate'] ?? null,   
                'interview_date'                            => $data['interviewDate'] ?? null,
                'report_ng_principle_date'                  => $data['reportNGPrincipleDate'] ?? null,
                'report_g_principle_date'                   => $data['reportGPrincipleDate'] ?? null,
                'self_financing_certificate_outward_number' => $data['selfFinancingCertificateOutwardNumber'] ?? null,
                'self_financing_certificate_date'           => $data['selfFinancingCertificateDate'] ?? null,
                'transfer_not_higher_post_outward_number'  => $data['transferNotHigherPostOutwardNumber'] ?? null,
                'transfer_not_higher_post_date'            => $data['transferNotHigherPostDate'] ?? null,
                'bank_statement_from_date'                  => $data['bankStatementFromDate'] ?? null,
                'bank_statement_to_date'                    => $data['bankStatementToDate'] ?? null,                
                'court_order_petition_number'               => $data['courtOrderPetitionNumber'] ?? null,
                'court_order_date'                          => $data['courtOrderDate'] ?? null,
              //  'opinion_eodd_recognition_number'           => $data['opinionEoDDRecognitionNumber'] ?? null,
               // 'opinion_eodd_recognition_date'             => $data['opinionEoDDRecognitionDate'] ?? null,   
              //  'outward_number_match_certificate_date'     => $data['outwardNumberMatchCertificateDate'] ?? null,
                'no_benefits_certificate_details'           => $data['noBenefitsCertificateDetails'] ?? null,                
                'fwd_to'  => (int) ($data['sa_forward_to'] ?? 0),
                'fwd_to_target'  => (int) ($data['sa_forward_to_target'] ?? 0)

            ];

            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/'.$data['staffId'].'/transfers';

            $fileFields = array(
                //'school_permission_order_file' => 'schoolPermissionOrderFile',
                'minority_cert_outward_file' => 'minorityCertOutwardFile',
                //'school_at_transfer_file' => 'schoolAtTransferFile',
                //'qualification_1_file' => 'qualifications1File',
                //'qualification_2_file' => 'qualifications2File',
                //'qualification_3_file' => 'qualifications3File',
                //'qualification_4_file' => 'qualifications4File',
                //'qualification_5_file' => 'qualifications5File',
                'school_committee_outward_file' => 'schoolCommitteeOutwardFile',
                'origin_sanstha_appointment_file' => 'originSansthaAppointmentFile',
                'personal_recognition_file' => 'personalRecognitionFile',
                'service_seniority_list_file' => 'serviceSeniorityListFile',
                'vacant_post_merit_list_file' => 'vacantPostAsMeritListFile',
                //'opinion_eodd_recognition_file' => 'opinionEoDDRecognitionFile',
                'five_years_hm_certificate_file' => 'fiveYrsHMCertificateFile',
                'vacant_post_causing_transfer_file' => 'vacantPostCausingTransferFile',
                'mavak_checklist_file' => 'mavakCheckListFile',

                'tet_certificate_file' => 'tetCertificateFile',
                'ctet_certificate_file' => 'ctetCertificateFile',
                'hsc_file' => 'hscFile',
                'graduate_file' => 'graduateFile',
                'post_graduate_file' => 'postGraduateFile',
                'ded_file' => 'dedFile',
                'bed_file' => 'bedFile',
                'mped_file' => 'mpedFile',
                'nps_scheme' => 'npsScheme',
                'institution_no_disbute_file' => 'institutionNoDisbuteFile',

                'recruitment_noc_outward_file' => 'recruitmentNocOutwardFile',
                'advrt_newspaper_file' => 'advrtNewspaperFile',
                'transfer_not_higher_post_file' => 'transferNotHigherPostFile',
                'interview_file' => 'interviewFile',
                'report_ng_principle_file' => 'reportNGPrincipleFile',
                'report_g_principle_file' => 'reportGPrincipleFile',
                //'outward_number_match_certificate_file' => 'outwardNumberMatchCertificateFile',
                'self_financing_certificate_file' => 'selfFinancingCertificateFile',
                'salary_subsidy_guarantee_letter_file' => 'salarySubsidyGuaranteeLetterFile',
                'itr1_file' => 'itr1File',
                'itr2_file' => 'itr2File',
                'itr3_file' => 'itr3File',
                'bank_statement_file' => 'bankStatementFile',
                'court_order_file' => 'courtOrderFile',
                'no_benefits_certificate_file' => 'noBenefitsCertificateFile',
                'institution_guarantee_file' => 'institutionGuaranteeFile',
                'other_documents_file' => 'otherDocuments'
            );

            /*
            foreach ($fileFields as $key => $field) {

                if (!empty($data[$field]) && $data[$field]->getError() === UPLOAD_ERR_OK) {

                    $file = $data[$field];

                   

                    //$file = $this->request->getData('document');
                 
                    if ($file->getClientMediaType() !== 'application/pdf') {
                        //throw new BadRequestException("$field must be a PDF");
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Must be a PDF File - '.$field
                            ]));
                    }

                    if ($file->getSize() > (2 * 1024 * 1024)) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Exceeds 2MB limit File - '.$field
                            ]));
                        //throw new BadRequestException("$field exceeds 2MB limit");
                    }

                    if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid File - '.$field
                            ]));
                        //$this->Flash->error('Invalid file');
                    }


                    // Get temp path safely
                    $tmpPath = $file->getStream()->getMetadata('uri');

                    // Extract extension (safe)
                    $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                    // New filename
                    $newFileName = $key . '.' . $extension;

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

                    $staffData[$key] = $fileName;
                } 
            }*/
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'.$field
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

    private function validatePdf($file)
    {
        $allowedTypes = ['application/pdf'];
        $maxSize = 5 * 1024 * 1024; // 5 MB

        if (!in_array($file->getClientMediaType(), $allowedTypes)) {
            throw new BadRequestException('Only PDF files are allowed');
        }

        if ($file->getSize() > $maxSize) {
            throw new BadRequestException('PDF size must be less than 5MB');
        }
    }

    public function staffs()
    {
        $this->viewBuilder()->setLayout('school');
    
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

                   
        $staffDetails = $staffsTable->find()
                        ->where(['udise_code' => $this->username])
                        //->where(['emp_type' => 1])
                        ->all();

        //dd($staffDetails);
        $this->set('staffs', $staffDetails);

        

    }

    public function teachingStaff()
    {
        $this->viewBuilder()->setLayout('school');
    
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

                   
        $staffDetails = $staffsTable->find()
                        ->where(['udise_code' => $this->username])
                        ->where(['emp_type' => 1])
                        ->all();

        //dd($staffDetails);
        $this->set('staffs', $staffDetails);

        

    }


    public function updateSanchData()
    {       
        $this->request->allowMethod(['post', 'ajax']);
                $data = $this->request->getData();

        /*$rawBody = $this->getRequest()->getBody()->getContents();
        
        $data = json_decode($rawBody, true);
        if (!$data) {            

            $msg = 'Invalid JSON payload. Please coordinate with the technical team for assistance.';
          
            $response = [
                'status' => 'error',
                'statusCode' => -4,
                'message' => $msg
            ];
           
        }*/

       

        $schoolId = $data['school_id'];

        $sanchDataStatus = $this->fetchSanchDetails($schoolId);
       
        if ($sanchDataStatus == 1) {
            // Suppose update was successful
            $response = [
                'status' => 'success',
                'statusCode' => $sanchDataStatus,
                'message' => "The Sanch Manayata record has been successfully synchronized from the Saral Portal to the Staff Portal for UDISE '{$schoolId}'."
            ];
           
        } else {
            $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            if($sanchDataStatus == -1){
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

        

        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->setClassName('Json');
    }

    public function fetchSanchDetails($schoolId)
    {
      
        $acYear = "2025-26";
        $password = "Staff@31102025#";
        $passwordWorking = "Staff@06022025#";
        //$sanctionedAPI = 'https://education.maharashtra.gov.in/sanch/reports/sanchSanctionWorkingTeachingNonteachingPostsAPI';
        $sanctionedAPI = 'https://education.maharashtra.gov.in/sanch/reports/sanchSanctionTeachingNonteachingPostsToStaffPortalAPI';
        $workingAPI = 'https://education.maharashtra.gov.in/sanch/reports/sanchWorkingPostsToStaffPortalAPI';
        // Initialize CakePHP HTTP client
        $http = new Client([
            'timeout' => 15,
        ]);

        // Prepare API request payload
        $payload = ['school_code' => $schoolId,"ac_year" => $acYear,"password" => $password];  
        
        /** Sanctioned API Call */ 
        $response = $http->post($sanctionedAPI,
            json_encode($payload),
            [
                'type' => 'json',
                'headers' => [                    
                    'Content-Type' => 'application/json'
                ],
            ]
        );
        $body = $response->getJson();  
       
       
        // Handle API response
        if ((!$body['success']) || (!is_array($body['data'])) || (count($body['data'])<=0)) {
            return -1;
            //There was an issue while fetching data from Sanch Manyata. Please try again.
        }
        $data = $body['data'];

        /** Working API Call */   
        $http = new Client([
            'timeout' => 15,
        ]);
        $payload = ['school_code' => $schoolId,"ac_year" => $acYear,"password" => $passwordWorking]; 
        $responseWorking = $http->post($workingAPI,
            json_encode($payload),
            [
                'type' => 'json',
                'headers' => [                    
                    'Content-Type' => 'application/json'
                ],
            ]
        );





        //echo "<pre>2222222222222";
        //print_r($responseWorking);
        $bodyWorking = $responseWorking->getJson();  
        //print_r($bodyWorking[0]); 
        //exit;
       
        // Handle API response
        //if ((!(isset($bodyWorking) && is_array($bodyWorking))) || (!is_array($bodyWorking[0])) || (count($bodyWorking[0])<=0)) {

        



        $table = TableRegistry::getTableLocator()->get('PostSanctioned');
        $tableWorking = TableRegistry::getTableLocator()->get('PostWorking');

        $connection = ConnectionManager::get('default');

        $dataWorking = $bodyWorking;
       
        return $connection->transactional(function () use ($table, $tableWorking, $schoolId, $acYear, $data, $dataWorking) {

            // 1️⃣ DELETE existing records for school + year
            $table->deleteAll([
                'udise_code'   => $schoolId,
                'ac_year' => $acYear
            ]);

            // 2️⃣ Prepare bulk insert data
            $entities = [];

            foreach ($data as $row) {
                foreach($row as $row1){

                    $aided = (int) ($row1['sanctioned_aided'] ?? 0);
                    $part80 = (int) ($row1['sanctioned_part80'] ?? 0);
                    $part60 = (int) ($row1['sanctioned_part60'] ?? 0); 
                    $part40 = (int) ($row1['sanctioned_part40'] ?? 0);
                    $part20 = (int) ($row1['sanctioned_part20'] ?? 0);
                    $unaided = (int) ($row1['sanctioned_unaided'] ?? 0);
                    $perunaided = (int) ($row1['sanctioned_perunaided'] ?? 0);
                    $sf = (int) ($row1['sanctioned_sf'] ?? 0);

                    $sanch_manyata_date_sec = time();// $row1['sanch_manyata_date_sec'];                    
                    $post_id = (int) ($row1['postid'] ?? 0);
                    $medium_id = (int) ($row1['medium'] ?? 0);
                    $post_type = (int) ($row1['posttype'] ?? 1);
                    if( $aided >0){    
                        $aid_id = 1;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $aided,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }

                    if( $part80 >0){    
                        $aid_id = 2;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $part80,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }
                    if( $part60 >0){    
                        $aid_id = 3;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $part60,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }

                    if( $part40 >0){    
                        $aid_id = 4;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $part40,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }
                    if( $part20 >0){    
                        $aid_id = 5;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $part20,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }
                 
                    if( $unaided >0){    
                        $aid_id = 6;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $unaided,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }

                    if( $perunaided >0){    
                        $aid_id = 7;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $perunaided,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }
                    if( $sf >0){    
                        $aid_id = 8;
                        $entities[] = $table->newEntity([
                            'udise_code' => $schoolId,
                            'ac_year' => $acYear,
                            'post_type' => $post_type,
                            'medium_id' => $medium_id,
                            'post_id' => $post_id,
                            'aid_id' => $aid_id,
                            'num_posts' => $sf,                
                            'sanch_manyata_date_sec' => $sanch_manyata_date_sec
                        ]);
                    }
                    
                }
            }

            /*echo "<pre>";
            print_r($entities);
            exit;*/
            // 3️⃣ Bulk save
            if (!empty($entities)) {
                $table->saveMany($entities, [
                    'atomic' => true,
                    'checkRules' => false
                ]);
            }

            /**** Working API */

            $tableWorking->deleteAll([
                'udise_code'   => $schoolId,
                'ac_year' => $acYear
            ]);

            // 2️⃣ Prepare bulk insert data
            $entities = [];

            $isWorkingPosts = true;
            if (!is_array($dataWorking)) {
                $isWorkingPosts = false;
            }
            if (!isset($dataWorking[0])) {
                $isWorkingPosts = false;
            }
            /*if (!is_array($dataWorking[0])) {
                $isWorkingPosts = false;
            }
            if (count($dataWorking[0])<=0) {
                $isWorkingPosts = false;
            }*/
            if ($isWorkingPosts) {
                foreach ($dataWorking as $row2) {
                    foreach($row2 as $row1){                   
                        $gender = (int) ($row1['gender'] ?? 0);
                        if($row1['aid'] == 6){
                            $entities[] = $tableWorking->newEntity([
                                'udise_code' =>  $schoolId,
                                'ac_year' =>  $acYear,
                                'post_type' => $row1['posttype'] ?? 0,
                                'medium_id' => $row1['medium'] ?? 0,
                                'post_id' => $row1['postid'] ?? 0,
                                'aid_id' => $row1['aid'] ?? 0,           
                                'sanch_manyata_date_sec' => $row1['sanch_manyata_date_sec'] ?? '',
                                'shalarth_id' => $row1['shalarth_id'] ?? '',
                                'teacher_name' => $row1['teacher_name'] ?? '',
                                'email' => $row1['email'] ?? '',
                                'mobile' => $row1['mobile'] ?? '',
                                'date_of_joining' => $row1['date_of_joining'] ?? '',
                                'date_of_retirement' => $row1['date_of_retirement'] ?? '',
                                'date_of_birth' => $row1['date_of_birth'] ?? '',
                                'qualification' => $row1['qualification'] ?? '',
                                'more_qualification' => $row1['more_qualification'] ?? '',
                                'pay_scale' => $row1['pay_scale'] ?? '',
                                'subject_taught' => $row1['subject_taught'] ?? '',
                                'gender_id' => $gender
                            ]);      
                        }                                  
                    }
                }

                /*echo "<pre>";
                print_r($entities);
                exit;*/
                // 3️⃣ Bulk save
                if (!empty($entities)) {
                    $tableWorking->saveMany($entities, [
                        'atomic' => true,
                        'checkRules' => false
                    ]);
                }
            }
            return 1;
        });


        


    }
    public function updateSchoolShalarthData()
    {       
        $this->request->allowMethod(['post', 'ajax']);

        $data = $this->request->getData();
        if (empty($data)) {
            $data = (string)$this->request->getBody();
        }

        //$rawBody = $this->getRequest()->getBody()->getContents();
       

       // $data = json_decode($rawBody, true);
        if (!$data) {            

            $msg = 'Invalid JSON payload. Please coordinate with the technical team for assistance.';
          
            $response = [
                'status' => 'error',
                'statusCode' => -4,
                'message' => $msg
            ];
           
        }

       

       // $staffId = $data['staff_id'];

        //$shalarthId = '05DEDSMCF8802';//$data['shalarth_id'];
        $schoolId = $data['school_id'];

        $shalarthDataStatus = $this->fetchSchoolShalarthDetails($schoolId);
       
        if ($shalarthDataStatus == 1) {
            // Suppose update was successful
            $response = [
                'status' => 'success',
                'statusCode' => $shalarthDataStatus,
                'message' => "The staff record has been successfully synchronized from the Shalarth Portal to the Staff Portal for Shalarth ID '{$schoolId}'."
            ];
        } else {
            $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            if($shalarthDataStatus == -1){
                $msg = 'There was an issue while fetching data from Shalarth. Please try again.';
            }else if($shalarthDataStatus == -2){
                $msg = 'No record was found in the Shalarth system for the provided Shalarth ID. Please verify the ID or contact the Shalarth technical team for further assistance.';
            }else if($shalarthDataStatus == -3){
                $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            }
            $response = [
                'status' => 'error',
                'statusCode' => $shalarthDataStatus,
                'message' => $msg
            ];
        }

        

        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->setClassName('Json');
    }

    private function fetchSchoolShalarthDetails($schoolId)
    {
      

        // Initialize CakePHP HTTP client
        $http = new Client([
            'timeout' => 15,
        ]);

        // Prepare API request payload
        $payload = ['udisecode' => $schoolId];
        //$surl = 'http://115.124.116.194:8083/ShalarthPlus/V2/Staffportal/employee/details-Report';
        $surl = 'https://shalarth.maharashtra.gov.in/ShalarthPlus/V2/Staffportal/employee/details-Report';
        // Call external Shalarth API
        $response = $http->post(
            $surl,
            json_encode($payload),
            [
                'type' => 'json',
                'headers' => [
                    'X-API-KEY' => 'd2VsY29tZSB0byByZWcgYXBp',
                    'Content-Type' => 'application/json',
                ],
            ]
        );
       /* echo "<pre>11111111111111111111111";
        print_r($response );
        exit;*/

        // Handle API response
        if (!$response->isOk()) {
            return -1;
            //There was an issue while fetching data from Shalarth. Please try again.
        }

        $body = $response->getJson();    
        
        //echo "-------------------------------------------------------------------";
       
        if(!isset($body['StatusMessage'])){
            return -2;
            //No record was found in the Shalarth system for the provided Shalarth ID. Please verify the ID or contact the Shalarth technical team for further assistance.
        }
        if($body['StatusMessage'] != 'Success'){
            return -2;
            //No record was found in the Shalarth system for the provided Shalarth ID. Please verify the ID or contact the Shalarth technical team for further assistance.
        }

        if(!isset($body['schools'][0])){
            return -2;
            //No record was found in the Shalarth system for the provided Shalarth ID. Please verify the ID or contact the Shalarth technical team for further assistance.
        }

      
            
            $shalarthJson = $body['schools'];//json_encode($body[0]);

            /*echo "<pre>";
            print_r($shalarthJson);
            exit;*/
            // Load table
            $shalarthDatasetsTable = TableRegistry::getTableLocator()->get('ShalarthDatasets');

            // Create new entity
            $dataset = $shalarthDatasetsTable->newEmptyEntity();
            $dataset->shalarth_id = $schoolId;
            $dataset->shalarth_json = $shalarthJson;
            $dataset->created_at = time();

        // Save record
        if ($shalarthDatasetsTable->save($dataset)) {
              foreach($body['schools'][0]['employees'] as $sd){

                $tableWorking = TableRegistry::getTableLocator()->get('PostWorking');

                 
                $acYear='2025-26';
               


                // Get the Staffs table
                $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

                // Check if staff record exists
                $staff = $staffsTable->find()
                    ->where(['shalarth_code' => $sd['shalarthId']])
                    ->first();

                if (!$staff) {
                    $staff = $staffsTable->newEntity([
                        'shalarth_code' => $sd['shalarthId']
                    ]);
                    $staffsTable->save($staff);
                   
                }
                $staffId = $staff->id;
                //echo "dd111->". $staffId;
                //echo "dd->". $staffId;
                
                //echo "<pre>";
                //print_r($staff);
                
                //exit;

                $mode = 2 ;
                $staffUpdateModes = TableRegistry::getTableLocator()->get('StaffUpdateMode');

                $record = $staffUpdateModes->find()
                    ->where(['staff_id' => $staffId])
                    ->first();

                if ($record) {
                    $record = $staffUpdateModes->patchEntity($record, [
                        'mode' => $mode,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $record = $staffUpdateModes->newEntity([
                        'staff_id' => $staffId,
                        'mode' => $mode
                    ]);
                }

                if (!$staffUpdateModes->save($record)) {
                    return -3;
                }
                $shalarthId = $sd['shalarthId'];
                //$adminCode = $sd['ADMIN_CODE'];
                //$adminName = $sd['ADMIN_NAME'];
                ///$schCategory = $sd['SCH_CATEGORY'];
                ///$diceCode = $sd['DICE_CODE'];
                ///$ddoCode = $sd['DDO_CODE'];
                //$offName = $sd['OFF_NAME'];
                $empName = $sd['EMP_NAME'];
                $dob = $sd['DOB'];
                $gender_id = 3;
                if($sd['GENDER'] == 'M'){
                    $gender_id = 1;
                }elseif($sd['GENDER'] == 'F'){
                    $gender_id = 2;
                }
            

            
                $employee_type_id = 3;
                if($sd['Employee_Type'] == 'TEACHING'){
                    $employee_type_id = 1;
                }elseif($sd['Employee_Type'] == 'NON_TEACHING'){
                    $employee_type_id = 2;
                }           
                $adharNo = $sd['adhar_no'];
                $encryptedAdharNo = $sd['encrypted_adharno'];
                $employeeContact = $sd['employee_contact'];
                $employeeMail = $sd['employee_mail'];
                $joiningDate = $sd['joining_date'];
                $superAnnDate = $sd['SUPER_ANN_DATE'];
                $currentPost = $sd['Current_Post'];
                $desigGrp = $sd['DESIG_GRP'];                

                $percentageOfBasic = $sd['PERCENTAGE_OF_BASIC'];
                $currentPostAidType = $sd['Current_post_Aid_Type'];
                $dateOfJoiningCurrentSchool = $sd['Date_of_Joining_Current_School'];
                
                $physicallyChallenged = 0;     
                if($sd['physically_challnged'] == 'YES'){
                    $physicallyChallenged =    1;     
                }
                $panNo = $sd['PAN_NO'];
                
                if(!empty($sd['Mode_of_Recruitment'])){
                    $recruitmentMode = $sd['Mode_of_Recruitment'];
                }else{
                    $recruitmentMode = "";
                }
                $recModeId = 0;
                $recruitmentModeId = $sd['MODE_OF_RECRUITMENT_ID'];
                if(!empty($recruitmentModeId) && $recruitmentModeId>0){
                    $recModeId = $recruitmentModeId;
                }
                $recruitmentModeId = $recModeId;
                $parentInstituteDate = $sd['PARENT_INSTITUTE_DATE'];
                $maritalStatus = 0; // Need Master $$$$$
                if($sd['MARITIAL_STATUS'] == 'NON MENTIONED'){
                    $maritalStatus = 0;
                }elseif($sd['MARITIAL_STATUS'] == 'MARRIED'){
                    $maritalStatus = 1;
                }elseif($sd['MARITIAL_STATUS'] == 'UNMARRIED'){
                    $maritalStatus = 2;
                }elseif($sd['MARITIAL_STATUS'] == 'DIVORCED'){
                    $maritalStatus = 3;
                }elseif($sd['MARITIAL_STATUS'] == 'WIDOWED'){
                    $maritalStatus = 4;
                }
                

                $postType = 0; // Need Master $$$$$
                if($sd['post_type'] == 'FULL TIME'){
                    $postType = 1;
                }elseif($sd['post_type'] == 'PART TIME'){
                    $postType = 2;
                }           
                /*echo "<pre>";
                print_r($sd);
                exit;*/
                $subject ="";
                if(!empty($sd['SUBJECT'])){
                    $subject = trim($sd['SUBJECT']);
                }
            
                $subject_id = 0;
                if(!empty($subject)){
                    $subjectsTable = TableRegistry::getTableLocator()->get('Subjects');
        
                    $subjectDetails = $subjectsTable->find()
                                            ->where(['name ILIKE' => $subject])
                                            ->first();

                    if(!empty($subjectDetails) && $subjectDetails->id>0){
                    $subject_id = $subjectDetails->id;
                    }

                }

                

                $social_category_id = 0;
                if($sd['SOCIAL_CATEGORY_ID']>0){
                    $social_category_id =$sd['SOCIAL_CATEGORY_ID'];
                }


                $shalarth_post_id = 0;
                $post_id = 0;
                $post_code = 0;
                if($sd['SARAL_DESIGNATION_ID']>0){
                    $shalarth_post_id =$sd['SARAL_DESIGNATION_ID'];
                    $postsTable = TableRegistry::getTableLocator()->get('Posts');

                    $postDetails = $postsTable->find()
                                            ->where(['shalarth_code' => $shalarth_post_id])
                                            ->first();

                    if(!empty($postDetails) && $postDetails->id>0){
                    $post_id = $postDetails->id;
                     $post_code = $postDetails->code;
                    }


                }

                

                /*$casteTable = TableRegistry::getTableLocator()->get('CasteCategories');
        


                $casteDetails = $casteTable->find()
                                        ->where(['category_name ILIKE' => $social_category_id])
                                        ->first();

            
                $social_category_id = $casteDetails->id?? 0;*/
            
                
                

                /*$recruitment_category_id = $sd['Recruitment_Category'];

                $casteTable = TableRegistry::getTableLocator()->get('CasteCategories');
        
                $recruitmentCasteDetails = $casteTable->find()
                                        ->where(['category_name ILIKE' => $recruitment_category_id])
                                        ->first();

                $recruitment_category_id = $recruitmentCasteDetails->id?? 0;*/

                $recruitment_category_id = 0;
                if($sd['RECRUITMENT_CATEGORY_ID']>0){
                    $recruitment_category_id = $sd['RECRUITMENT_CATEGORY_ID'];
                }
                $employeeRetirementDate = $sd['Employee_Retirement_Date'];
                $empRegDate = $sd['EMP_REG_DATE'];
                $saralDesignation = $sd['saral_designation'];
                $photoBase64 = $sd['photoBase64'];
                $signatureBase64 = $sd['signatureBase64']; 
                
                

                // Assign values from variables or request data
                $staff->udise_code = $schoolId ?? null;
                $staff->is_onboarded = 1;
                //$staff->shalarth_code = $shalarthId ?? null;
                $staff->emp_type = $employee_type_id ?? null;
                $staff->emp_name = $empName ?? null;
                $staff->gender_id = $gender_id ?? null;
                $staff->dob = !empty($dob) ? new FrozenTime($dob) : null;
                $staff->social_category_id = $social_category_id ?? null;
                $staff->shalarth_post_id = $shalarth_post_id ?? null;
                $staff->post_id = $post_id ?? null;            
                $staff->mobile = $employeeContact ?? null;
                $staff->email = $employeeMail ?? null;

                $staff->ddo_code = $ddoCode ?? null;
                $staff->adhar_no = $adharNo ?? null;
                $staff->encrypted_adhar_no = $encryptedAdharNo ?? null;
                $staff->joining_date = !empty($joiningDate) ? new FrozenTime($joiningDate) : null;
                $staff->super_ann_date = !empty($superAnnDate) ? new FrozenTime($superAnnDate) : null;
                $staff->current_post = $currentPost ?? null;
                $staff->desig_grp = $desigGrp ?? null;
                $staff->percentage_of_basic = $percentageOfBasic ?? null;
                $staff->current_post_aid_type = $currentPostAidType ?? null;
                $staff->date_of_joining_current_school = !empty($dateOfJoiningCurrentSchool) ? new FrozenTime($dateOfJoiningCurrentSchool) : null;
                $staff->physically_challenged = $physicallyChallenged ?? null;
                $staff->pan_no = $panNo ?? null;

                $staff->mode_of_recruitment = $recruitmentMode ?? null;
                $staff->mode_of_recruitment_id = $recruitmentModeId;
                $staff->parent_institute_date = !empty($parentInstituteDate) ? new FrozenTime($parentInstituteDate) : null;
                $staff->maritial_status = $maritalStatus ?? null;
                $staff->post_type = $postType ?? null;
                $staff->subject = $subject_id;
                $staff->employee_retirement_date = !empty($employeeRetirementDate) ? new FrozenTime($employeeRetirementDate) : null;
                $staff->emp_reg_date = !empty($empRegDate) ? new FrozenTime($empRegDate) : null;
                $staff->saral_designation = $saralDesignation ?? null;
                $staff->recruitment_category = $recruitment_category_id ?? null;
                $staff->photo_base64 = "data:image/jpeg;base64,".$photoBase64 ?? null;
                $staff->signature_base64 = $signatureBase64 ?? null;
                $staff->shalarth_updated_at = new DateTime('now');
                //echo "###########################################################";
                // Save or update record
            
            
                if (!$staffsTable->save($staff)) {
                    
                return -3;
                }

            
                $paydata = array(
                    "pay_commission_id" => $sd['Pay_Commission_Id'],
                    "scale_id" => $sd['SCALE_ID'],
                    "pay_matrix" => $sd['pay_matrix'],
                    "pay_in_band" => $sd['PAY_IN_PAYBAND'],
                    "grade_pay" => $sd['GRADE_PAY'],
                    "basic_pay" => $sd['BASIC_PAY'],
                    "next_increment_date" => $sd['Next_Increment_Date']
                );


                    // Get the Staffs table
                $staffPayDetailsTable = TableRegistry::getTableLocator()->get('StaffPayDetails');

                    // Check if staff record exists
                $staffPayDetail = $staffPayDetailsTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();
                
                if ($staffPayDetail) {
                    $staffPayDetail = $staffPayDetailsTable->patchEntity($staffPayDetail, $paydata);
                } else {
                    $paydata['staff_id'] = $staffId;
                    $staffPayDetail = $staffPayDetailsTable->newEntity($paydata);
                }
                
                if (!$staffPayDetailsTable->save($staffPayDetail)) {
                    return -3;
                }


                $bankdata = array(
                    "bank_id" => $sd['BANK_ID'],
                    "bank_name" => $sd['BANK_NAME'],
                    "bank_account_number" => $sd['BANK_ACNT_NO'],
                    "branch_id" => $sd['BRANCH_ID'],
                    "branch_name" => $sd['BRANCH_NAME'],
                    "ifsc" => $sd['IFSC_CODE']
                );


                    // Get the Staffs table
                $staffBankDetailsTable = TableRegistry::getTableLocator()->get('StaffBankDetails');

                    // Check if staff record exists
                $staffBankDetail = $staffBankDetailsTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();
                
                if ($staffBankDetail) {
                    $staffBankDetail = $staffBankDetailsTable->patchEntity($staffBankDetail, $bankdata);
                } else {
                    $bankdata['staff_id'] = $staffId;
                    $staffBankDetail = $staffBankDetailsTable->newEntity($bankdata);
                }
                
                if (!$staffBankDetailsTable->save($staffBankDetail)) {
                    return -3;
                }

                $pfdata = array(
                    "account_type" => $sd['OPS_OR_NPS'],
                    "account_maintained_by" => $sd['AC_MAINTAINED_BY'],
                    "pf_account_no" => $sd['GPF_ACC_NO'],
                    "pf_series" => $sd['PF_SERIES']
                );

                    // Get the Staffs table
                $staffPfGpfDetailsTable = TableRegistry::getTableLocator()->get('StaffPfGpfDetails');

                    // Check if staff record exists
                $staffPfGpfDetail = $staffPfGpfDetailsTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();
                
                if ($staffPfGpfDetail) {
                    $staffPfGpfDetail = $staffPfGpfDetailsTable->patchEntity($staffPfGpfDetail, $pfdata);
                } else {
                    $pfdata['staff_id'] = $staffId;
                    $staffPfGpfDetail = $staffPfGpfDetailsTable->newEntity($pfdata);
                }                
                if($percentageOfBasic == 20){
                    $aid = 5;
                }else if($percentageOfBasic == 40){
                    $aid = 4;
                }else if($percentageOfBasic == 60){
                    $aid = 3;
                }else if($percentageOfBasic == 80){
                    $aid = 2;
                }else if($percentageOfBasic == 100){
                    $aid = 1;
                }else{
                    $aid = 6;
                }
                $workingData = $tableWorking->newEntity([
                                    'udise_code' =>  $schoolId,
                                    'ac_year' =>  $acYear,
                                    'post_type' => $employee_type_id ?? 0,
                                    'medium_id' => '-',
                                    'post_id' => $post_code ?? 0,
                                    'aid_id' => $aid ?? 0,           
                                    'shalarth_id' => trim($shalarthId ?? ''),
                                    'teacher_name' => trim($empName ?? ''),
                                    'mobile' => trim($employeeContact ?? ''),
                                    'email' => trim($employeeMail ?? ''),
                                    'date_of_joining' => trim($joiningDate ?? ''),
                                    'date_of_retirement' => trim($superAnnDate ?? ''),
                                    'date_of_birth' => trim($dob ?? ''),
                                    'qualification' =>  '',
                                    'more_qualification' =>  '',
                                    'pay_scale' => trim($sd['pay_matrix'] ?? ''),
                                    'subject_taught' => trim($sd['SUBJECT'] ?? ''),
                                    'gender_id' => $gender_id
                                ]);                           
                   
                
             
                $tableWorking->save($workingData);
                
                
                if (!$staffPfGpfDetailsTable->save($staffPfGpfDetail)) {
                    return -3;
                }
            }
            return 1;
        // $this->log("✅ Shalarth dataset inserted successfully (ID: {$shalarthId})", 'info');
        } else {
            return -3;
            //There seems to be an issue. Please coordinate with the technical team for assistance.
        // $this->log("❌ Failed to insert dataset for Shalarth ID: {$shalarthId}", 'error');
        }
       

       //Shalarth data has been successfully retrieved and updated in the staff portal.
    }

    public function updateShalarthData()
    {       
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        
        $data = json_decode($rawBody, true);
        if (!$data) {            

            $msg = 'Invalid JSON payload. Please coordinate with the technical team for assistance.';
          
            $response = [
                'status' => 'error',
                'statusCode' => -4,
                'message' => $msg
            ];
           
        }

       

        $staffId = $data['staff_id'];

        //$shalarthId = '05DEDSMCF8802';//$data['shalarth_id'];
        $shalarthId = $data['shalarth_id'];

        $shalarthDataStatus = $this->fetchShalarthDetails($shalarthId,$staffId);
       
        if ($shalarthDataStatus == 1) {
            // Suppose update was successful
            $response = [
                'status' => 'success',
                'statusCode' => $shalarthDataStatus,
                'message' => "The staff record has been successfully synchronized from the Shalarth Portal to the Staff Portal for Shalarth ID '{$shalarthId}'."
            ];
        } else {
            $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            if($shalarthDataStatus == -1){
                $msg = 'There was an issue while fetching data from Shalarth. Please try again.';
            }else if($shalarthDataStatus == -2){
                $msg = 'No record was found in the Shalarth system for the provided Shalarth ID. Please verify the ID or contact the Shalarth technical team for further assistance.';
            }else if($shalarthDataStatus == -3){
                $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            }
            $response = [
                'status' => 'error',
                'statusCode' => $shalarthDataStatus,
                'message' => $msg
            ];
        }

        

        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->setClassName('Json');
    }

    private function fetchShalarthDetails($shalarthId,$staffId)
    {
      

        // Initialize CakePHP HTTP client
        $http = new Client([
            'timeout' => 15,
        ]);

        // Prepare API request payload
        $payload = ['shalarthId' => $shalarthId];
    
        //$surl = ' 'http://115.124.116.194:8083/ShalarthPlus/employee/details-Report'';
        $surl = 'https://shalarth.maharashtra.gov.in/ShalarthPlus/employee/details-Report';
        
        
        // Call external Shalarth API
        $response = $http->post(
           $surl,
            json_encode($payload),
            [
                'type' => 'json',
                'headers' => [
                    'X-API-KEY' => 'd2VsY29tZSB0byByZWcgYXBp',
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        // Handle API response
        if (!$response->isOk()) {
            return -1;
            //There was an issue while fetching data from Shalarth. Please try again.
        }

        $body = $response->getJson();    
        
        //echo "-------------------------------------------------------------------";
        //print_r($body[0]['shalarthId']);

        if(!isset($body[0])){
            return -2;
            //No record was found in the Shalarth system for the provided Shalarth ID. Please verify the ID or contact the Shalarth technical team for further assistance.
        }

        $shalarthJson = $body[0];//json_encode($body[0]);

        // Load table
        $shalarthDatasetsTable = TableRegistry::getTableLocator()->get('ShalarthDatasets');

        // Create new entity
        $dataset = $shalarthDatasetsTable->newEmptyEntity();
        $dataset->shalarth_id = $shalarthId;
        $dataset->shalarth_json = $shalarthJson;
        $dataset->created_at = time();

        // Save record
        if ($shalarthDatasetsTable->save($dataset)) {
            $mode = 2 ;
            $staffUpdateModes = TableRegistry::getTableLocator()->get('StaffUpdateMode');

            $record = $staffUpdateModes->find()
                ->where(['staff_id' => $staffId])
                ->first();

            if ($record) {
                $record = $staffUpdateModes->patchEntity($record, [
                    'mode' => $mode,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $record = $staffUpdateModes->newEntity([
                    'staff_id' => $staffId,
                    'mode' => $mode
                ]);
            }

            if (!$staffUpdateModes->save($record)) {
                return -3;
            }
            $shalarthId = $body[0]['shalarthId'];
            //$adminCode = $body[0]['ADMIN_CODE'];
            //$adminName = $body[0]['ADMIN_NAME'];
            $schCategory = $body[0]['SCH_CATEGORY'];
            $diceCode = $body[0]['DICE_CODE'];
            $ddoCode = $body[0]['DDO_CODE'];
            //$offName = $body[0]['OFF_NAME'];
            $empName = $body[0]['EMP_NAME'];
            $dob = $body[0]['DOB'];
            $gender_id = 3;
            if($body[0]['GENDER'] == 'M'){
                $gender_id = 1;
            }elseif($body[0]['GENDER'] == 'F'){
                $gender_id = 2;
            }
           

           
            $employee_type_id = 3;
            if($body[0]['Employee_Type'] == 'TEACHING'){
                $employee_type_id = 1;
            }elseif($body[0]['Employee_Type'] == 'NON_TEACHING'){
                $employee_type_id = 2;
            }           
            $adharNo = $body[0]['adhar_no'];
            $encryptedAdharNo = $body[0]['encrypted_adharno'];
            $employeeContact = $body[0]['employee_contact'];
            $employeeMail = $body[0]['employee_mail'];
            $joiningDate = $body[0]['joining_date'];
            $superAnnDate = $body[0]['SUPER_ANN_DATE'];
            $currentPost = $body[0]['Current_Post'];
            $desigGrp = $body[0]['DESIG_GRP'];

            $percentageOfBasic = $body[0]['PERCENTAGE_OF_BASIC'];
            $currentPostAidType = $body[0]['Current_post_Aid_Type'];
            $dateOfJoiningCurrentSchool = $body[0]['Date_of_Joining_Current_School'];
            
            $physicallyChallenged = 0;     
            if($body[0]['physically_challnged'] == 'YES'){
                $physicallyChallenged =    1;     
            }
            $panNo = $body[0]['PAN_NO'];
            
            if(!empty($body[0]['Mode_of_Recruitment'])){
                $recruitmentMode = $body[0]['Mode_of_Recruitment'];
            }else{
                $recruitmentMode = "";
            }
            $recModeId = 0;
            $recruitmentModeId = $body[0]['MODE_OF_RECRUITMENT_ID'];
            if(!empty($recruitmentModeId) && $recruitmentModeId>0){
                $recModeId = $recruitmentModeId;
            }
            $recruitmentModeId = $recModeId;
            $parentInstituteDate = $body[0]['PARENT_INSTITUTE_DATE'];
            $maritalStatus = 0; // Need Master $$$$$
            if($body[0]['MARITIAL_STATUS'] == 'NON MENTIONED'){
                $maritalStatus = 0;
            }elseif($body[0]['MARITIAL_STATUS'] == 'MARRIED'){
                $maritalStatus = 1;
            }elseif($body[0]['MARITIAL_STATUS'] == 'UNMARRIED'){
                $maritalStatus = 2;
            }elseif($body[0]['MARITIAL_STATUS'] == 'DIVORCED'){
                $maritalStatus = 3;
            }elseif($body[0]['MARITIAL_STATUS'] == 'WIDOWED'){
                $maritalStatus = 4;
            }
             

            $postType = 0; // Need Master $$$$$
            if($body[0]['post_type'] == 'FULL TIME'){
                $postType = 1;
            }elseif($body[0]['post_type'] == 'PART TIME'){
                $postType = 2;
            }           
            /*echo "<pre>";
            print_r($body[0]);
            exit;*/
            $subject ="";
            if(!empty($body[0]['SUBJECT'])){
                 $subject = trim($body[0]['SUBJECT']);
            }
           
            $subject_id = 0;
            if(!empty($subject)){
                $subjectsTable = TableRegistry::getTableLocator()->get('Subjects');
    
                $subjectDetails = $subjectsTable->find()
                                        ->where(['name ILIKE' => $subject])
                                        ->first();

                if(!empty($subjectDetails) && $subjectDetails->id>0){
                   $subject_id = $subjectDetails->id;
                }

            }

            

            $social_category_id = 0;
            if($body[0]['SOCIAL_CATEGORY_ID']>0){
                $social_category_id =$body[0]['SOCIAL_CATEGORY_ID'];
            }


            $shalarth_post_id = 0;
            $post_id = 0;
            if($body[0]['SARAL_DESIGNATION_ID']>0){
                $shalarth_post_id =$body[0]['SARAL_DESIGNATION_ID'];
                $postsTable = TableRegistry::getTableLocator()->get('Posts');

                 $postDetails = $postsTable->find()
                                        ->where(['shalarth_code' => $shalarth_post_id])
                                        ->first();

                if(!empty($postDetails) && $postDetails->id>0){
                   $post_id = $postDetails->id;
                }


            }

            

            /*$casteTable = TableRegistry::getTableLocator()->get('CasteCategories');
       


            $casteDetails = $casteTable->find()
                                    ->where(['category_name ILIKE' => $social_category_id])
                                    ->first();

           
            $social_category_id = $casteDetails->id?? 0;*/
         
            
            

            /*$recruitment_category_id = $body[0]['Recruitment_Category'];

            $casteTable = TableRegistry::getTableLocator()->get('CasteCategories');
       
            $recruitmentCasteDetails = $casteTable->find()
                                    ->where(['category_name ILIKE' => $recruitment_category_id])
                                    ->first();

            $recruitment_category_id = $recruitmentCasteDetails->id?? 0;*/

            $recruitment_category_id = 0;
            if($body[0]['RECRUITMENT_CATEGORY_ID']>0){
                $recruitment_category_id = $body[0]['RECRUITMENT_CATEGORY_ID'];
            }
            $employeeRetirementDate = $body[0]['Employee_Retirement_Date'];
            $empRegDate = $body[0]['EMP_REG_DATE'];
            $saralDesignation = $body[0]['saral_designation'];
            $photoBase64 = $body[0]['photoBase64'];
            $signatureBase64 = $body[0]['signatureBase64']; 
            
            // Get the Staffs table
            $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

            // Check if staff record exists
            $staff = $staffsTable->find()
                ->where(['id' => $staffId])
                ->first();

            if (!$staff) {
                //echo "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb";
                return -3;
                // Create new entity if not exists
                //$staff = $staffsTable->newEmptyEntity();
               // $staff->id = $staffId;
            }

            // Assign values from variables or request data
            $staff->udise_code = $diceCode ?? null;
            $staff->is_onboarded = 1;
            //$staff->shalarth_code = $shalarthId ?? null;
            $staff->emp_type = $employee_type_id ?? null;
            $staff->emp_name = $empName ?? null;
            $staff->gender_id = $gender_id ?? null;
            $staff->dob = !empty($dob) ? new FrozenTime($dob) : null;
            $staff->social_category_id = $social_category_id ?? null;
            $staff->shalarth_post_id = $shalarth_post_id ?? null;
            $staff->post_id = $post_id ?? null;            
            $staff->mobile = $employeeContact ?? null;
            $staff->email = $employeeMail ?? null;

            $staff->ddo_code = $ddoCode ?? null;
            $staff->adhar_no = $adharNo ?? null;
            $staff->encrypted_adhar_no = $encryptedAdharNo ?? null;
            $staff->joining_date = !empty($joiningDate) ? new FrozenTime($joiningDate) : null;
            $staff->super_ann_date = !empty($superAnnDate) ? new FrozenTime($superAnnDate) : null;
            $staff->current_post = $currentPost ?? null;
            $staff->desig_grp = $desigGrp ?? null;
            $staff->percentage_of_basic = $percentageOfBasic ?? null;
            $staff->current_post_aid_type = $currentPostAidType ?? null;
            $staff->date_of_joining_current_school = !empty($dateOfJoiningCurrentSchool) ? new FrozenTime($dateOfJoiningCurrentSchool) : null;
            $staff->physically_challenged = $physicallyChallenged ?? null;
            $staff->pan_no = $panNo ?? null;

            $staff->mode_of_recruitment = $recruitmentMode ?? null;
            $staff->mode_of_recruitment_id = $recruitmentModeId;
            $staff->parent_institute_date = !empty($parentInstituteDate) ? new FrozenTime($parentInstituteDate) : null;
            $staff->maritial_status = $maritalStatus ?? null;
            $staff->post_type = $postType ?? null;
            $staff->subject = $subject_id;
            $staff->employee_retirement_date = !empty($employeeRetirementDate) ? new FrozenTime($employeeRetirementDate) : null;
            $staff->emp_reg_date = !empty($empRegDate) ? new FrozenTime($empRegDate) : null;
            $staff->saral_designation = $saralDesignation ?? null;
            $staff->recruitment_category = $recruitment_category_id ?? null;
            $staff->photo_base64 = "data:image/jpeg;base64,".$photoBase64 ?? null;
            $staff->signature_base64 = $signatureBase64 ?? null;
            $staff->shalarth_updated_at = new DateTime('now');
            //echo "###########################################################";
            // Save or update record
           
          
            if (!$staffsTable->save($staff)) {
                
               return -3;
            }

        
            $paydata = array(
                "pay_commission_id" => $body[0]['Pay_Commission_Id'],
                "scale_id" => $body[0]['SCALE_ID'],
                "pay_matrix" => $body[0]['pay_matrix'],
                "pay_in_band" => $body[0]['PAY_IN_PAYBAND'],
                "grade_pay" => $body[0]['GRADE_PAY'],
                "basic_pay" => $body[0]['BASIC_PAY'],
                "next_increment_date" => $body[0]['Next_Increment_Date']
            );


                // Get the Staffs table
            $staffPayDetailsTable = TableRegistry::getTableLocator()->get('StaffPayDetails');

                // Check if staff record exists
            $staffPayDetail = $staffPayDetailsTable->find()
                    ->where(['staff_id' => $staffId])
                    ->first();
            
            if ($staffPayDetail) {
                $staffPayDetail = $staffPayDetailsTable->patchEntity($staffPayDetail, $paydata);
            } else {
                $paydata['staff_id'] = $staffId;
                $staffPayDetail = $staffPayDetailsTable->newEntity($paydata);
            }
            
            if (!$staffPayDetailsTable->save($staffPayDetail)) {
                return -3;
            }


            $bankdata = array(
                "bank_id" => $body[0]['BANK_ID'],
                "bank_name" => $body[0]['BANK_NAME'],
                "bank_account_number" => $body[0]['BANK_ACNT_NO'],
                "branch_id" => $body[0]['BRANCH_ID'],
                "branch_name" => $body[0]['BRANCH_NAME'],
                "ifsc" => $body[0]['IFSC_CODE']
            );


                // Get the Staffs table
            $staffBankDetailsTable = TableRegistry::getTableLocator()->get('StaffBankDetails');

                // Check if staff record exists
            $staffBankDetail = $staffBankDetailsTable->find()
                    ->where(['staff_id' => $staffId])
                    ->first();
            
            if ($staffBankDetail) {
                $staffBankDetail = $staffBankDetailsTable->patchEntity($staffBankDetail, $bankdata);
            } else {
                $bankdata['staff_id'] = $staffId;
                $staffBankDetail = $staffBankDetailsTable->newEntity($bankdata);
            }
            
            if (!$staffBankDetailsTable->save($staffBankDetail)) {
                return -3;
            }

            $pfdata = array(
                "account_type" => $body[0]['OPS_OR_NPS'],
                "account_maintained_by" => $body[0]['AC_MAINTAINED_BY'],
                "pf_account_no" => $body[0]['GPF_ACC_NO'],
                "pf_series" => $body[0]['PF_SERIES']
            );

                // Get the Staffs table
            $staffPfGpfDetailsTable = TableRegistry::getTableLocator()->get('StaffPfGpfDetails');

                // Check if staff record exists
            $staffPfGpfDetail = $staffPfGpfDetailsTable->find()
                    ->where(['staff_id' => $staffId])
                    ->first();
            
            if ($staffPfGpfDetail) {
                $staffPfGpfDetail = $staffPfGpfDetailsTable->patchEntity($staffPfGpfDetail, $pfdata);
            } else {
                $pfdata['staff_id'] = $staffId;
                $staffPfGpfDetail = $staffPfGpfDetailsTable->newEntity($pfdata);
            }
            
            if (!$staffPfGpfDetailsTable->save($staffPfGpfDetail)) {
                return -3;
            }


            return 1;
           // $this->log("✅ Shalarth dataset inserted successfully (ID: {$shalarthId})", 'info');
        } else {
             return -3;
        //There seems to be an issue. Please coordinate with the technical team for assistance.
           // $this->log("❌ Failed to insert dataset for Shalarth ID: {$shalarthId}", 'error');
        }

       //Shalarth data has been successfully retrieved and updated in the staff portal.
    }


    




    public function saveStaffUpdateMode($staffId, $mode = 2)
    {
        $staffUpdateModes = TableRegistry::getTableLocator()->get('StaffUpdateMode');

        // Try to find existing record by staff_id
        $record = $staffUpdateModes->find()
            ->where(['staff_id' => $staffId])
            ->first();

        if ($record) {
            // Update existing record
            $record = $staffUpdateModes->patchEntity($record, [
                'mode' => $mode,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Create new record
            $record = $staffUpdateModes->newEntity([
                'staff_id' => $staffId,
                'mode' => $mode
            ]);
        }

        if ($staffUpdateModes->save($record)) {
            return true;
        } else {
            return false;
        }
    }

    
            

    public function onBoardUdiseStaff($staffId = null)
    {



        $this->viewBuilder()->setLayout('school');


        $this->request->allowMethod(['get','post']);

        $file = $this->request->getData('photo');
        $isUploadOk = true; 
        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
            $this->Flash->error("Please upload a valid file.");
            $isUploadOk = false;
            //return  $this->redirect(['controller' => 'School', 'action' => 'onBoardUdiseStaff', $staffId]);
        }

        if( $isUploadOk){
            // Validate extension
            $allowed = ['jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                $isUploadOk = false;
                $this->Flash->error("Only JPG and PNG formats are allowed.");
            // return $this->redirect(['controller' => 'School', 'action' => 'onBoardUdiseStaff', $staffId]);
            }
        }

        if( $isUploadOk){
            // Convert to Base64
            $imageData = file_get_contents($file->getStream()->getMetadata('uri'));
            $base64 = 'data:image/' . $ext . ';base64,' . base64_encode($imageData);       

            $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
            // Try to find existing record by staff_id
            $staffTable = $staffsTable->find()
                ->where(['id' => $staffId])
                ->first();

            $record = $staffsTable->patchEntity($staffTable, [
                'is_onboarded' => 1,
                'photo_base64' => $base64,
                'updated_at' => date('Y-m-d H:i:s')
            ]); 

            if ( $staffsTable->save($record)) {
                //$this->Flash->success("Profile photo uploaded successfully!");
                //$result = $this->saveStaffUpdateMode($staffId, 1);
                $this->saveStaffUpdateMode($staffId, 1);
                //$this->staffProfile($staffId);
                return $this->redirect(['controller' => 'School', 'action' => 'staffProfile', $staffId]);
            } else {
                $this->Flash->error("Failed to save profile photo.");
            }
        }

    
        $this->set('staffId', $staffId);
        /*return $this->redirect($this->referer());

    



        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');


        // Try to find existing record by staff_id
        $record = $staffsTable->find()
            ->where(['id' => $staffId])
            ->first();

        
        $record = $staffsTable->patchEntity($record, [
            'is_onboarded' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);       

        $staffsTable->save($record);
          
        //$result = $this->saveStaffUpdateMode($staffId, 1);
        $this->saveStaffUpdateMode($staffId, 1);
        $this->staffProfile($staffId);
        return $this->redirect(['controller' => 'School', 'action' => 'staffProfile', $staffId]);
        */
        

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

     public function updateUdiseDataByEmpId()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);
        if (!$data) {            

            $msg = 'Invalid JSON payload. Please coordinate with the technical team for assistance.';
          
            $response = [
                'status' => 'error',
                'statusCode' => -4,
                'message' => $msg
            ];
           
        }

       
        $empID = $data['emp_staff_id'];
        

        $udiseDataStatus = $this->fetchEmpUdiseDetails($empID);
       

        if ($udiseDataStatus == 1) {
            // Suppose update was successful
            $response = [
                'status' => 'success',
                'statusCode' => $udiseDataStatus,
                'message' => "The staffs record has been successfully synchronized from the Udise Portal to the Staff Portal for Udise ID '{$udiseID}'."
            ];
        } else {
            $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            if($udiseDataStatus == -1){
                $msg = 'There was an issue while fetching data from Udise. Please try again.';
            }else if($udiseDataStatus == -2){
                $msg = 'No record was found in the Udise system for the provided Udise ID. Please verify the Udise ID or contact the Udise technical team for further assistance.';
            }else if($udiseDataStatus == -3){
                $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            }
            $response = [
                'status' => 'error',
                'statusCode' => $udiseDataStatus,
                'message' => $msg
            ];
        }

        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->setClassName('Json');
    }

    private function fetchEmpUdiseDetails($empId)
    {
        ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
        set_time_limit(300); 
        $this->UD = $this->initUdise();
        /*$udise->clientId = 'maharashtra-prod';
        $udise->clientSecret = 'mrshtra-prod@6839!~';
        $udise->apiEndpoint = "https://api.udiseplus.gov.in/public-api"; 
        $udise->apiVersion = "v1.3";
        $udise->apiActionTeachingByModified = "teaching-staff/by-national-teacher-id/public";
        $udise->apiActionNonTeachingByModified = "non-teaching-staff/by-modified-time/public";
        $udise->baseDir = "'".$this->Url->build('/', ['fullBase' => true])."'";
        $udise->certificatePath = $udise->baseDir. "udise/documents/";*/


       echo $apiURL=$this->UD->apiEndpoint.'/v1.1/'.$this->UD->apiActionTeachingByEmpId;
        
        
        $requestPayload = [ 
                    'empStaffId' => $empId,
                    "stateId" =>'127'
                ];

                print_r( $requestPayload);
        $response = $this->callingAPIs($requestPayload, $apiURL);

        echo "<pre>".print_r($response['data'],true)."</pre>";
        print_r($response);
        exit;
        if(isset($response['data']) && is_array($response['data']) && count($response['data'])>0){
            $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
            $staffOtherDetailsTable = TableRegistry::getTableLocator()->get('StaffOtherDetails');
            $staffUdiseQualificationsTable = TableRegistry::getTableLocator()->get('StaffUdiseQualifications');
            $staffUdiseTainingTable = TableRegistry::getTableLocator()->get('StaffUdiseTaining');
            foreach($response['data'] as $row){                
                $staff = $staffsTable->find()
                    ->where(['emp_staff_id' => $row['empStaffId'] ])
                    //->where(['udise_code' => $row['udiseSchCode'] ])
                    ->first(); 
                
                if ($staff) {
                    $staff->udise_code = $row['udiseSchCode'];
                    $staff->udise_updated_at = new DateTime('now');
                    if ($row['empType'] == 2){                 
                        if(empty($row['natureOfAppt'])){
                            $staff->nature_of_appointment_id = null;
                        }else{
                            $staff->nature_of_appointment_id = (int) trim($row['natureOfAppt']);
                        }

                        if(empty($row['disabilityType'])){
                            $staff->physically_challenged = null;
                        }else{
                            $staff->physically_challenged = (int) trim($row['disabilityType']);
                        }

                        if(empty($row['isUidVerified'])){
                            $staff->is_uid_verified = null;
                        }else{
                            $staff->is_uid_verified = (int) trim($row['isUidVerified']);
                        }

                        

                        if(empty($row['empNamePerUid'])){
                            $staff->emp_name_per_uid = null;
                        }else{
                            $staff->emp_name_per_uid = trim($row['empNamePerUid']);
                        }                

                        if(empty($row['formFlag'])){
                            $staff->form_flag = null;
                        }else{
                            $staff->form_flag = (int) trim($row['formFlag']);
                        }

                        if(empty($row['empStatus1'])){
                            $staff->status_flag_1 = null;
                        }else{
                            $staff->status_flag_1 = (int) trim($row['empStatus1']);
                        }

                        if(empty($row['empStatus2'])){
                            $staff->status_flag_2 = null;
                        }else{
                            $staff->status_flag_2 = (int) trim($row['empStatus2']);
                        }

                        if(empty($row['natTchId'])){
                            $staff->nat_tch_id = null;
                        }else{
                            $staff->nat_tch_id = trim($row['natTchId']);
                        }
 
                    }else{
                        if(empty($row['dob'])){
                            $staff->dob = null;
                        }else{
                            
                            $staff->dob = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $row['dob']));
                        }

                        if(empty($row['gender'])){
                            $staff->gender_id = null;
                        }else{
                            $staff->gender_id = (int) trim($row['gender']);
                        }

                        

                        if(empty($row['empCodeState'])){
                            $staff->shalarth_code = null;
                        }else{
                            $staff->shalarth_code = trim($row['empCodeState']);
                        }

                        if(empty($row['empName'])){
                            $staff->emp_name = null;
                        }else{
                            $staff->emp_name = trim($row['empName']);
                        }

                        if(empty($row['socialCat'])){
                            $staff->social_category_id = null;
                        }else{
                            $staff->social_category_id = (int) trim($row['socialCat']);
                        }


                        if(empty($row['mobile'])){
                            $staff->mobile = null;
                        }else{
                            $staff->mobile = trim($row['mobile']);
                        }

                        if(empty($row['email'])){
                            $staff->email = null;
                        }else{
                            $staff->email = trim($row['email']);
                        }

                        if(empty($row['natureOfAppt'])){
                            $staff->nature_of_appointment_id = null;
                        }else{
                            $staff->nature_of_appointment_id = (int) trim($row['natureOfAppt']);
                        }

                        if(empty($row['disabilityType'])){
                            $staff->physically_challenged = null;
                        }else{
                            $staff->physically_challenged = (int) trim($row['disabilityType']);
                        }

                        if(empty($row['isUidVerified'])){
                            $staff->is_uid_verified = null;
                        }else{
                            $staff->is_uid_verified = (int) trim($row['isUidVerified']);
                        }

                        if(empty($row['dojService'])){
                            $staff->joining_date = null;
                        }else{
                            $staff->joining_date = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $row['dojService']));
                        }

                        if(empty($row['empNamePerUid'])){
                            $staff->emp_name_per_uid = null;
                        }else{
                            $staff->emp_name_per_uid = trim($row['empNamePerUid']);
                        }

                        if(empty($row['yojPresSch'])){
                            $staff->date_of_joining_current_school = null;
                        }else{
                            $staff->date_of_joining_current_school = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $row['yojPresSch']));
                        }

                        if(!empty($row['formFlag'])){
                            $staff->form_flag = (int) trim($row['formFlag']);
                        }

                        if(!empty($row['empStatus1'])){
                            $staff->status_flag_1 = (int) trim($row['empStatus1']);
                        }

                        if(!empty($row['empStatus2'])){
                            $staff->status_flag_2 = (int) trim($row['empStatus2']);
                        }

                        if(empty($row['natTchId'])){
                            $staff->nat_tch_id = null;
                        }else{
                            $staff->nat_tch_id = trim($row['natTchId']);
                        }

                        if(empty($row['apptSub'])){
                            $staff->subject = null;
                        }else{
                            $staff->subject = (int) trim($row['apptSub']);
                        }                
                    }
                    
                    $staff_other = new stdClass();
                    $staff_ud_qual = new stdClass();
                    $staff_ud_train = new stdClass();
                    ///staff_other_details
                    if(empty($row['mainLang1'])){
                        $staff_other->lang1 = null;
                    }else{
                        $staff_other->lang1 = (int) trim($row['mainLang1']);
                    }    
                    

                    if(empty($row['mainLang2'])){
                        $staff_other->lang2 = null;
                    }else{
                        $staff_other->lang2 = (int) trim($row['mainLang2']);
                    }

                    if(empty($row['mainLang3'])){
                        $staff_other->lang3 = null;
                    }else{
                        $staff_other->lang3 = (int) trim($row['mainLang3']);
                    }

                    if(empty($row['nontchDays'])){
                        $staff_other->days_spent_non_teaching_assignments = null;
                    }else{
                        $staff_other->days_spent_non_teaching_assignments = (int) trim($row['nontchDays']);
                    }

                    
                    if(empty($row['tchDeputation'])){
                        $staff_other->deputation_from_other_school = null;
                    }else{
                        $staff_other->deputation_from_other_school = (int) trim($row['tchDeputation']);
                    }

                    if(empty($row['tchFromOtherSchool'])){
                        $staff_other->teaching_at_other_school_as_guest = null;
                    }else{
                        $staff_other->teaching_at_other_school_as_guest = (int) trim($row['tchFromOtherSchool']);
                    }
                    if(empty($row['isCapableVc'])){
                        $staff_other->digital_devices = null;
                    }else{
                        $staff_other->digital_devices = (int) trim($row['isCapableVc']);
                    }

                    ///staff_udise_qualification_details
                    if(empty($row['qualAcad'])){
                        $staff_ud_qual->qual_acad = null;
                    }else{
                        $staff_ud_qual->qual_acad = (int) trim($row['qualAcad']);
                    }

                    if(empty($row['trade'])){
                        $staff_ud_qual->trade = null;
                    }else{
                        $staff_ud_qual->trade = (int) trim($row['trade']);
                    }
                    if(empty($row['qualProf'])){
                        $staff_ud_qual->qual_prof = null;
                    }else{
                        $staff_ud_qual->qual_prof = (int) trim($row['qualProf']);
                    }
                    if(empty($row['mathUpto'])){
                        $staff_ud_qual->math_upto = null;
                    }else{
                        $staff_ud_qual->math_upto = (int) trim($row['mathUpto']);
                    }
                    if(empty($row['scienceUpto'])){
                        $staff_ud_qual->science_upto = null;
                    }else{
                        $staff_ud_qual->science_upto = (int) trim($row['scienceUpto']);
                    }
                    if(empty($row['englishUpto'])){
                        $staff_ud_qual->english_upto = null;
                    }else{
                        $staff_ud_qual->english_upto = (int) trim($row['englishUpto']);
                    }
                    
                    if(empty($row['socStudyUpto'])){
                        $staff_ud_qual->soc_study_upto = null;
                    }else{
                        $staff_ud_qual->soc_study_upto = (int) trim($row['socStudyUpto']);
                    }
                    if(empty($row['langStudyUpto'])){
                        $staff_ud_qual->lang_study_upto = null;
                    }else{
                        $staff_ud_qual->lang_study_upto = (int) trim($row['langStudyUpto']);
                    }
                    if(empty($row['classTaught'])){
                        $staff_ud_qual->class_taught = null;
                    }else{
                        $staff_ud_qual->class_taught = (int) trim($row['classTaught']);
                    }
                    if(empty($row['appointedLevel'])){
                        $staff_ud_qual->appointed_level = null;
                    }else{
                        $staff_ud_qual->appointed_level = (int) trim($row['appointedLevel']);
                    }
                    if(empty($row['subTaught1'])){
                        $staff_ud_qual->sub_taught_1 = null;
                    }else{
                        $staff_ud_qual->sub_taught_1 = (int) trim($row['subTaught1']);
                    }
                    if(empty($row['subTaught2'])){
                        $staff_ud_qual->sub_taught_2 = null;
                    }else{
                        $staff_ud_qual->sub_taught_2 = (int) trim($row['subTaught2']);
                    }

                    if(empty($row['trainedCwsn'])){
                        $staff_ud_train->trained_cwsn = null;
                    }else{
                        $staff_ud_train->trained_cwsn = (int) trim($row['trainedCwsn']);
                    }
                    if(empty($row['trainedComp'])){
                        $staff_ud_train->trained_comp = null;
                    }else{
                        $staff_ud_train->trained_comp = (int) trim($row['trainedComp']);
                    }
                    if(empty($row['trngRcvd'])){
                        $staff_ud_train->trained_rcvd = null;
                    }else{
                        $staff_ud_train->trained_rcvd = (int) trim($row['trngRcvd']);
                    }
                    if(empty($row['trngNeeded'])){
                        $staff_ud_train->trained_needed = null;
                    }else{
                        $staff_ud_train->trained_needed = (int) trim($row['trngNeeded']);
                    }
                    if(empty($row['trgNishtha'])){
                        $staff_ud_train->trained_nishtha = null;
                    }else{
                        $staff_ud_train->trained_nishtha = (int) trim($row['trgNishtha']);
                    }
                    if(empty($row['trSsaYn'])){
                        $staff_ud_train->trained_ssa_yn = null;
                    }else{
                        $staff_ud_train->trained_ssa_yn = (int) trim($row['trSsaYn']);
                    }
                    if(empty($row['cyPsySocAspectYn'])){
                        $staff_ud_train->cy_sy_soc_aspect_yn = null;
                    }else{
                        $staff_ud_train->cy_sy_soc_aspect_yn = (int) trim($row['cyPsySocAspectYn']);
                    }
                    if(empty($row['receTrainingSupportCwsnYn'])){
                        $staff_ud_train->rece_training_support_cwsn_yn = null;
                    }else{
                        $staff_ud_train->rece_training_support_cwsn_yn = (int) trim($row['receTrainingSupportCwsnYn']);
                    }


                    $staffsTable->save($staff);
                    /*echo "======".$staff->id;
                    if($staffsTable->save($staff)){
                        echo 'okstaff-';
                       // exit;
                    }*/
                    

                    

                    $staffOtherDetail = $staffOtherDetailsTable->find()
                            ->where(['staff_id' => $staff->id])
                            ->first();

                    $staff_other = (array) $staff_other;
                    
                    if ($staffOtherDetail) {
                        $staffOtherDetail = $staffOtherDetailsTable->patchEntity($staffOtherDetail, $staff_other);
                    } else {
                        $staff_other['staff_id'] = $staff->id;
                        $staffOtherDetail = $staffOtherDetailsTable->newEntity($staff_other);
                    }
                    
                    $staffOtherDetailsTable->save($staffOtherDetail);
                    /*if($staffOtherDetailsTable->save($staffOtherDetail)){
                        echo 'okother-';
                       // exit;
                    }*/
                    

                    $staffUdQual = $staffUdiseQualificationsTable->find()
                            ->where(['staff_id' => $staff->id])
                            ->first();
                    $staff_ud_qual = (array) $staff_ud_qual;
                    if ($staffUdQual) {
                        $staffUdQual = $staffUdiseQualificationsTable->patchEntity($staffUdQual, $staff_ud_qual);
                    } else {
                        $staff_ud_qual['staff_id'] = $staff->id;
                        $staffUdQual = $staffUdiseQualificationsTable->newEntity($staff_ud_qual);
                    }
                    
                    $staffUdiseQualificationsTable->save($staffUdQual);

                    /*if($staffUdiseQualificationsTable->save($staffUdQual)){
                        echo 'okstaffqual--';
                       // exit;
                    }*/

                    $staffUdTrain = $staffUdiseTainingTable->find()
                            ->where(['staff_id' => $staff->id])
                            ->first();
                    $staff_ud_train = (array) $staff_ud_train;
                    if ($staffUdTrain) {
                        $staffUdTrain = $staffUdiseTainingTable->patchEntity($staffUdTrain, $staff_ud_train);
                    } else {
                        $staff_ud_train['staff_id'] = $staff->id;
                        $staffUdTrain = $staffUdiseTainingTable->newEntity($staff_ud_train);
                    }
                    
                    $staffUdiseTainingTable->save($staffUdTrain);
                    
                }            
            }
        }
        //exit;
        return true;
    }



    public function updateUdiseData()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);
        if (!$data) {            

            $msg = 'Invalid JSON payload. Please coordinate with the technical team for assistance.';
          
            $response = [
                'status' => 'error',
                'statusCode' => -4,
                'message' => $msg
            ];
           
        }

       
        $udiseID = $data['school_id'];
        

        $udiseDataStatus = $this->fetchUdiseDetails($udiseID);
       

        if ($udiseDataStatus == 1) {
            // Suppose update was successful
            $response = [
                'status' => 'success',
                'statusCode' => $udiseDataStatus,
                'message' => "The staffs record has been successfully synchronized from the Udise Portal to the Staff Portal for Udise ID '{$udiseID}'."
            ];
        } else {
            $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            if($udiseDataStatus == -1){
                $msg = 'There was an issue while fetching data from Udise. Please try again.';
            }else if($udiseDataStatus == -2){
                $msg = 'No record was found in the Udise system for the provided Udise ID. Please verify the Udise ID or contact the Udise technical team for further assistance.';
            }else if($udiseDataStatus == -3){
                $msg = 'There seems to be an issue. Please coordinate with the technical team for assistance.';
            }
            $response = [
                'status' => 'error',
                'statusCode' => $udiseDataStatus,
                'message' => $msg
            ];
        }

        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->setClassName('Json');
    }


    
    private function fetchUdiseDetails($udiseId)
    {
        ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
        set_time_limit(300); 
        $this->UD = $this->initUdise();
        /*$udise->clientId = 'maharashtra-prod';
        $udise->clientSecret = 'mrshtra-prod@6839!~';
        $udise->apiEndpoint = "https://api.udiseplus.gov.in/public-api"; 
        $udise->apiVersion = "v1.3";
        $udise->apiActionTeachingByModified = "teaching-staff/by-national-teacher-id/public";
        $udise->apiActionNonTeachingByModified = "non-teaching-staff/by-modified-time/public";
        $udise->baseDir = "'".$this->Url->build('/', ['fullBase' => true])."'";
        $udise->certificatePath = $udise->baseDir. "udise/documents/";*/


         $apiURL=$this->UD->apiEndpoint.'/v1.1/'.$this->UD->apiActionTeachingByModifiedBySchool;
        
        $requestPayload = [ 
                    'udiseSchCode' => $udiseId,
                    "fromDate" =>'12092025',
                    "toDate" => '10122025',
                ];
        $response = $this->callingAPIs($requestPayload, $apiURL);

        //echo "<pre>".print_r($response['data'],true)."</pre>";
        //print_r($response);
        //exit;
        if(isset($response['data']) && is_array($response['data']) && count($response['data'])>0){
            $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
            $staffOtherDetailsTable = TableRegistry::getTableLocator()->get('StaffOtherDetails');
            $staffUdiseQualificationsTable = TableRegistry::getTableLocator()->get('StaffUdiseQualifications');
            $staffUdiseTainingTable = TableRegistry::getTableLocator()->get('StaffUdiseTaining');
            foreach($response['data'] as $row){                
                $staff = $staffsTable->find()
                    ->where(['emp_staff_id' => $row['empStaffId'] ])
                    //->where(['udise_code' => $row['udiseSchCode'] ])
                    ->first(); 
                
                if ($staff) {
                    $staff->udise_code = $row['udiseSchCode'];
                    $staff->udise_updated_at = new DateTime('now');
                    if ($row['empType'] == 2){
                    
                    
                        if(empty($row['natureOfAppt'])){
                            $staff->nature_of_appointment_id = null;
                        }else{
                            $staff->nature_of_appointment_id = (int) trim($row['natureOfAppt']);
                        }

                        if(empty($row['disabilityType'])){
                            $staff->physically_challenged = null;
                        }else{
                            $staff->physically_challenged = (int) trim($row['disabilityType']);
                        }

                        if(empty($row['isUidVerified'])){
                            $staff->is_uid_verified = null;
                        }else{
                            $staff->is_uid_verified = (int) trim($row['isUidVerified']);
                        }

                        

                        if(empty($row['empNamePerUid'])){
                            $staff->emp_name_per_uid = null;
                        }else{
                            $staff->emp_name_per_uid = trim($row['empNamePerUid']);
                        }                

                        if(empty($row['formFlag'])){
                            $staff->form_flag = null;
                        }else{
                            $staff->form_flag = (int) trim($row['formFlag']);
                        }

                        if(empty($row['empStatus1'])){
                            $staff->status_flag_1 = null;
                        }else{
                            $staff->status_flag_1 = (int) trim($row['empStatus1']);
                        }

                        if(empty($row['empStatus2'])){
                            $staff->status_flag_2 = null;
                        }else{
                            $staff->status_flag_2 = (int) trim($row['empStatus2']);
                        }

                        if(empty($row['natTchId'])){
                            $staff->nat_tch_id = null;
                        }else{
                            $staff->nat_tch_id = trim($row['natTchId']);
                        }

                    }else{
                        if(empty($row['dob'])){
                            $staff->dob = null;
                        }else{
                            
                            $staff->dob = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $row['dob']));
                        }

                        if(empty($row['gender'])){
                            $staff->gender_id = null;
                        }else{
                            $staff->gender_id = (int) trim($row['gender']);
                        }

                        

                        if(empty($row['empCodeState'])){
                            $staff->shalarth_code = null;
                        }else{
                            $staff->shalarth_code = trim($row['empCodeState']);
                        }

                        if(empty($row['empName'])){
                            $staff->emp_name = null;
                        }else{
                            $staff->emp_name = trim($row['empName']);
                        }

                        if(empty($row['socialCat'])){
                            $staff->social_category_id = null;
                        }else{
                            $staff->social_category_id = (int) trim($row['socialCat']);
                        }


                        if(empty($row['mobile'])){
                            $staff->mobile = null;
                        }else{
                            $staff->mobile = trim($row['mobile']);
                        }

                        if(empty($row['email'])){
                            $staff->email = null;
                        }else{
                            $staff->email = trim($row['email']);
                        }

                        if(empty($row['natureOfAppt'])){
                            $staff->nature_of_appointment_id = null;
                        }else{
                            $staff->nature_of_appointment_id = (int) trim($row['natureOfAppt']);
                        }

                        if(empty($row['disabilityType'])){
                            $staff->physically_challenged = null;
                        }else{
                            $staff->physically_challenged = (int) trim($row['disabilityType']);
                        }

                        if(empty($row['isUidVerified'])){
                            $staff->is_uid_verified = null;
                        }else{
                            $staff->is_uid_verified = (int) trim($row['isUidVerified']);
                        }

                        if(empty($row['dojService'])){
                            $staff->joining_date = null;
                        }else{
                            $staff->joining_date = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $row['dojService']));
                        }

                        if(empty($row['empNamePerUid'])){
                            $staff->emp_name_per_uid = null;
                        }else{
                            $staff->emp_name_per_uid = trim($row['empNamePerUid']);
                        }

                        if(empty($row['yojPresSch'])){
                            $staff->date_of_joining_current_school = null;
                        }else{
                            $staff->date_of_joining_current_school = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $row['yojPresSch']));
                        }

                        if(!empty($row['formFlag'])){
                            $staff->form_flag = (int) trim($row['formFlag']);
                        }

                        if(!empty($row['empStatus1'])){
                            $staff->status_flag_1 = (int) trim($row['empStatus1']);
                        }

                        if(!empty($row['empStatus2'])){
                            $staff->status_flag_2 = (int) trim($row['empStatus2']);
                        }

                        if(empty($row['natTchId'])){
                            $staff->nat_tch_id = null;
                        }else{
                            $staff->nat_tch_id = trim($row['natTchId']);
                        }

                        if(empty($row['apptSub'])){
                            $staff->subject = null;
                        }else{
                            $staff->subject = (int) trim($row['apptSub']);
                        }                
                    }
                    
                    $staff_other = new stdClass();
                    $staff_ud_qual = new stdClass();
                    $staff_ud_train = new stdClass();
                    ///staff_other_details
                    if(empty($row['mainLang1'])){
                        $staff_other->lang1 = null;
                    }else{
                        $staff_other->lang1 = (int) trim($row['mainLang1']);
                    }    
                    

                    if(empty($row['mainLang2'])){
                        $staff_other->lang2 = null;
                    }else{
                        $staff_other->lang2 = (int) trim($row['mainLang2']);
                    }

                    if(empty($row['mainLang3'])){
                        $staff_other->lang3 = null;
                    }else{
                        $staff_other->lang3 = (int) trim($row['mainLang3']);
                    }

                    if(empty($row['nontchDays'])){
                        $staff_other->days_spent_non_teaching_assignments = null;
                    }else{
                        $staff_other->days_spent_non_teaching_assignments = (int) trim($row['nontchDays']);
                    }

                    
                    if(empty($row['tchDeputation'])){
                        $staff_other->deputation_from_other_school = null;
                    }else{
                        $staff_other->deputation_from_other_school = (int) trim($row['tchDeputation']);
                    }

                    if(empty($row['tchFromOtherSchool'])){
                        $staff_other->teaching_at_other_school_as_guest = null;
                    }else{
                        $staff_other->teaching_at_other_school_as_guest = (int) trim($row['tchFromOtherSchool']);
                    }
                    if(empty($row['isCapableVc'])){
                        $staff_other->digital_devices = null;
                    }else{
                        $staff_other->digital_devices = (int) trim($row['isCapableVc']);
                    }

                    ///staff_udise_qualification_details
                    if(empty($row['qualAcad'])){
                        $staff_ud_qual->qual_acad = null;
                    }else{
                        $staff_ud_qual->qual_acad = (int) trim($row['qualAcad']);
                    }

                    if(empty($row['trade'])){
                        $staff_ud_qual->trade = null;
                    }else{
                        $staff_ud_qual->trade = (int) trim($row['trade']);
                    }
                    if(empty($row['qualProf'])){
                        $staff_ud_qual->qual_prof = null;
                    }else{
                        $staff_ud_qual->qual_prof = (int) trim($row['qualProf']);
                    }
                    if(empty($row['mathUpto'])){
                        $staff_ud_qual->math_upto = null;
                    }else{
                        $staff_ud_qual->math_upto = (int) trim($row['mathUpto']);
                    }
                    if(empty($row['scienceUpto'])){
                        $staff_ud_qual->science_upto = null;
                    }else{
                        $staff_ud_qual->science_upto = (int) trim($row['scienceUpto']);
                    }
                    if(empty($row['englishUpto'])){
                        $staff_ud_qual->english_upto = null;
                    }else{
                        $staff_ud_qual->english_upto = (int) trim($row['englishUpto']);
                    }
                    
                    if(empty($row['socStudyUpto'])){
                        $staff_ud_qual->soc_study_upto = null;
                    }else{
                        $staff_ud_qual->soc_study_upto = (int) trim($row['socStudyUpto']);
                    }
                    if(empty($row['langStudyUpto'])){
                        $staff_ud_qual->lang_study_upto = null;
                    }else{
                        $staff_ud_qual->lang_study_upto = (int) trim($row['langStudyUpto']);
                    }
                    if(empty($row['classTaught'])){
                        $staff_ud_qual->class_taught = null;
                    }else{
                        $staff_ud_qual->class_taught = (int) trim($row['classTaught']);
                    }
                    if(empty($row['appointedLevel'])){
                        $staff_ud_qual->appointed_level = null;
                    }else{
                        $staff_ud_qual->appointed_level = (int) trim($row['appointedLevel']);
                    }
                    if(empty($row['subTaught1'])){
                        $staff_ud_qual->sub_taught_1 = null;
                    }else{
                        $staff_ud_qual->sub_taught_1 = (int) trim($row['subTaught1']);
                    }
                    if(empty($row['subTaught2'])){
                        $staff_ud_qual->sub_taught_2 = null;
                    }else{
                        $staff_ud_qual->sub_taught_2 = (int) trim($row['subTaught2']);
                    }

                    if(empty($row['trainedCwsn'])){
                        $staff_ud_train->trained_cwsn = null;
                    }else{
                        $staff_ud_train->trained_cwsn = (int) trim($row['trainedCwsn']);
                    }
                    if(empty($row['trainedComp'])){
                        $staff_ud_train->trained_comp = null;
                    }else{
                        $staff_ud_train->trained_comp = (int) trim($row['trainedComp']);
                    }
                    if(empty($row['trngRcvd'])){
                        $staff_ud_train->trained_rcvd = null;
                    }else{
                        $staff_ud_train->trained_rcvd = (int) trim($row['trngRcvd']);
                    }
                    if(empty($row['trngNeeded'])){
                        $staff_ud_train->trained_needed = null;
                    }else{
                        $staff_ud_train->trained_needed = (int) trim($row['trngNeeded']);
                    }
                    if(empty($row['trgNishtha'])){
                        $staff_ud_train->trained_nishtha = null;
                    }else{
                        $staff_ud_train->trained_nishtha = (int) trim($row['trgNishtha']);
                    }
                    if(empty($row['trSsaYn'])){
                        $staff_ud_train->trained_ssa_yn = null;
                    }else{
                        $staff_ud_train->trained_ssa_yn = (int) trim($row['trSsaYn']);
                    }
                    if(empty($row['cyPsySocAspectYn'])){
                        $staff_ud_train->cy_sy_soc_aspect_yn = null;
                    }else{
                        $staff_ud_train->cy_sy_soc_aspect_yn = (int) trim($row['cyPsySocAspectYn']);
                    }
                    if(empty($row['receTrainingSupportCwsnYn'])){
                        $staff_ud_train->rece_training_support_cwsn_yn = null;
                    }else{
                        $staff_ud_train->rece_training_support_cwsn_yn = (int) trim($row['receTrainingSupportCwsnYn']);
                    }


                    $staffsTable->save($staff);
                    /*echo "======".$staff->id;
                    if($staffsTable->save($staff)){
                        echo 'okstaff-';
                       // exit;
                    }*/
                    

                    

                    $staffOtherDetail = $staffOtherDetailsTable->find()
                            ->where(['staff_id' => $staff->id])
                            ->first();

                    $staff_other = (array) $staff_other;
                    
                    if ($staffOtherDetail) {
                        $staffOtherDetail = $staffOtherDetailsTable->patchEntity($staffOtherDetail, $staff_other);
                    } else {
                        $staff_other['staff_id'] = $staff->id;
                        $staffOtherDetail = $staffOtherDetailsTable->newEntity($staff_other);
                    }
                    
                    $staffOtherDetailsTable->save($staffOtherDetail);
                    /*if($staffOtherDetailsTable->save($staffOtherDetail)){
                        echo 'okother-';
                       // exit;
                    }*/
                    

                    $staffUdQual = $staffUdiseQualificationsTable->find()
                            ->where(['staff_id' => $staff->id])
                            ->first();
                    $staff_ud_qual = (array) $staff_ud_qual;
                    if ($staffUdQual) {
                        $staffUdQual = $staffUdiseQualificationsTable->patchEntity($staffUdQual, $staff_ud_qual);
                    } else {
                        $staff_ud_qual['staff_id'] = $staff->id;
                        $staffUdQual = $staffUdiseQualificationsTable->newEntity($staff_ud_qual);
                    }
                    
                    $staffUdiseQualificationsTable->save($staffUdQual);

                    /*if($staffUdiseQualificationsTable->save($staffUdQual)){
                        echo 'okstaffqual--';
                       // exit;
                    }*/

                    $staffUdTrain = $staffUdiseTainingTable->find()
                            ->where(['staff_id' => $staff->id])
                            ->first();
                    $staff_ud_train = (array) $staff_ud_train;
                    if ($staffUdTrain) {
                        $staffUdTrain = $staffUdiseTainingTable->patchEntity($staffUdTrain, $staff_ud_train);
                    } else {
                        $staff_ud_train['staff_id'] = $staff->id;
                        $staffUdTrain = $staffUdiseTainingTable->newEntity($staff_ud_train);
                    }
                    
                    $staffUdiseTainingTable->save($staffUdTrain);
                    /*if($staffUdiseTainingTable->save($staffUdTrain)){
                        echo 'oktrain-';
                       // exit;
                    }*/
                    /*[schoolName] => ZILLA PARISHAD PRIMARY SCHOOL,WAGDARI
                    
                    [stateCd] => 27
                    [districtCd] => 2729
                    [blockCd] => 272904
                    [villageCd] => 
                    [clusterCd] => 2729040006
                    [schCategoryId] => 2
                    [schMgmtId] => 16
                    [schType] => 3*/

                    /*
                    
                    /// [crrNo] => 

                    ///            [tchType] => 3

                    [isCtetStet] => 2
                    [ctetStet] => 0*/
                }            
            }
        }
        //exit;
        return true;
    }


    private function initUdise()
    {
        $udise = new stdClass();
        $udise->clientId = 'maharashtra-prod';
        $udise->clientSecret = 'mrshtra-prod@6839!~';
        $udise->apiEndpoint = "https://api.udiseplus.gov.in/public-api"; 
        $udise->apiVersion = "v1.3";
        $udise->apiActionTeachingByModified = "teaching-staff/by-national-teacher-id/public";
        $udise->apiActionTeachingByModifiedBySchool = "teaching-staff/by-udise-code-and-modified-date/public";
        $udise->apiActionTeachingByEmpId = "teaching-staff/by-emp-staff-id/public";
        
        $udise->apiActionNonTeachingByModified = "non-teaching-staff/by-modified-time/public";
        $udise->baseDir = WWW_ROOT ;//Router::url('/', true);
        $udise->certificatePath = $udise->baseDir. "imp_files".DS."udise".DS."documents";
        //$udise->certificatePath = $udise->baseDir. "udise/documents/udiseplusapi261024.cer";
        return $udise;

    }

    
    private function createAuthenticationToken($authenticateRequest) {
        

        $authenticateUrl = $this->UD->apiEndpoint . "/".$this->UD->apiVersion .'/authenticate';
      
        $apiCertPath = $this->UD->certificatePath . DS.'udiseplusapi261024.cer';
        $caCertPath = $this->UD->certificatePath .DS. 'cacert.pem';
      

       $requestJson = json_encode($authenticateRequest);
       $base64EncodedJson = base64_encode($requestJson);

       $publicKeyPem = $this->getPublicKeyFromCert($apiCertPath);

       $cipherText = $this->encryptRsa($base64EncodedJson, $publicKeyPem);
       $encryptedTextHex = $this->bytesToHex($cipherText);

       $encryptedRequestBody = json_encode(["data" => $encryptedTextHex]);

        $headers = [
            "Content-Type: application/json"
        ];

        $ch = curl_init($authenticateUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encryptedRequestBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Add this line pointing to your CA bundle file:
        curl_setopt($ch, CURLOPT_CAINFO, $caCertPath);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch) . "\n";
            curl_close($ch);
            return null;
        }
        curl_close($ch);

        if ($httpCode == 200) {
            $resp = json_decode($response, true);
            return $resp;
        } else {
            echo "Error: HTTP $httpCode\n$response\n";
            return null;
        }

        
    }


    private function loadOrCreateToken($authenticateRequest) {

        $tokenFilename = $this->UD->certificatePath . DS."saved_token.json";
        $existingData = [];

        if (file_exists($tokenFilename)) {
            $jsonContent = file_get_contents($tokenFilename);
            $existingData = json_decode($jsonContent, true) ?? [];

            $expiryStr = $existingData['data']['authTokenExpiryTime'] ?? null;
            if ($expiryStr) {
                // $timezone = new DateTimeZone('Asia/Kolkata');
                // $expiryTime = DateTime::createFromFormat('d-m-Y H:i:s', $expiryStr, $timezone);

                // echo "JSON Expiry :". $expiryStr ."\n";
                $expiryTime = DateTime::createFromFormat('d-m-Y H:i:s', $expiryStr);
                $currentTime = new DateTime('now');

                echo "Current Time: " . $currentTime->format('d-m-Y H:i:s') . "\n";
                echo "Expiry Time: " . $expiryTime->format('d-m-Y H:i:s') . "\n";

                if ($expiryTime && $expiryTime > $currentTime) {
                    echo "Fetched Token from the JSON file\n";
                    return $existingData;
                }

                echo "Token Expired in JSON File\n";
            }
        }

        $authResponse = $this->createAuthenticationToken($authenticateRequest);
        
        $token = $authResponse['data']['authToken'] ?? null;

        if ($authResponse && $token) {
            echo "Generated a new Authentication Token\n";

            $encryptedSek = base64_decode($authResponse['data']['sek']);
            $decryptedSek = $this->decrypt($encryptedSek, $authenticateRequest["appKey"]);

            $authResponse['data']['decryptedSek'] = $decryptedSek;

            file_put_contents($tokenFilename, json_encode($authResponse, JSON_PRETTY_PRINT));
            return $authResponse;

        } else {
            echo "Token Generation Failed\n";
            return null;
        }

    }


    private function callingAPIs($requestPayload, $apiURL){      
        $caCertPath = $this->UD->certificatePath . DS.'cacert.pem';

        $appKey = $this->getAesKey();
        $authenticateRequest = [
            "clientId" => $this->UD->clientId,
            "clientSecret" => $this->UD->clientSecret,
            "appKey" => $appKey
        ];

        $response = $this->loadOrCreateToken($authenticateRequest);

        $authToken = $response['data']['authToken'] ?? null;

        if ($response && $authToken){
            $decryptedSek = $response['data']['decryptedSek'];
            try {
                $objStr = json_encode($requestPayload);
                $encryptedText = $this->encrypt($objStr, $decryptedSek);

                $encryptedRequestBody = json_encode(["data" => $encryptedText]);

                $headers = [
                    "Authorization: Bearer " . $authToken,
                    "Content-Type: application/json"
                ];

                $ch = curl_init($apiURL);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $encryptedRequestBody);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_CAINFO, $caCertPath);
                // curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt($ch, CURLOPT_TIMEOUT, 180); // 3 minutes
                


                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if (curl_errno($ch)) {
                    echo "Curl error: " . curl_error($ch) . "\n";
                    curl_close($ch);
                    return null;
                }
                curl_close($ch);

                if ($httpCode == 200) {
                    $resp = json_decode($response, true);
                    return $resp;
                } else {
                    echo "Request failed: HTTP $httpCode\n$response\n";
                    return null;
                }
            } catch (Exception $e) {
                echo "Exception occurred: " . $e->getMessage() . "\n";
                return null;
            }
        }
        else {
            echo "Token Generation Failed.";
            print_r($response);
            die();
        }
    }
    
    private function getAesKey() {
        $key = random_bytes(32); // 256-bit key
        return base64_encode($key);
    }

    private function encryptRsa(string $text, string $publicKeyPem): string {
        $publicKey = openssl_pkey_get_public($publicKeyPem);
        if ($publicKey === false) {
            throw new Exception("Invalid public key");
        }

        $encrypted = '';
        $success = openssl_public_encrypt($text, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        if (!$success) {
            throw new Exception("RSA encryption failed");
        }

        return $encrypted;
    }

    private function getPublicKeyFromCert($certPath) {
        $certContent = file_get_contents($certPath);
        $cert = openssl_x509_read($certContent);
        $pubKeyResource = openssl_pkey_get_public($cert);

        if ($pubKeyResource === false) {
            throw new Exception("Unable to extract public key from certificate.");
        }

        $keyDetails = openssl_pkey_get_details($pubKeyResource);
        return $keyDetails['key'];
    }

    private function bytesToHex(string $byteString): string {
        return bin2hex($byteString);
    }

    private function hexToBytes(string $hexString): string {
        return hex2bin($hexString);
    }

    private function encrypt($text, $secret_key) {
        $decoded_key = base64_decode($secret_key);
        $cipher = openssl_encrypt($text, 'aes-256-ecb', $decoded_key, OPENSSL_RAW_DATA);
        return base64_encode($cipher);
    }

    private function decrypt($text, $secret_key) {
        $decoded_key = base64_decode($secret_key);
        $decrypted = openssl_decrypt(base64_decode($text), 'aes-256-ecb', $decoded_key, OPENSSL_RAW_DATA);
        return $decrypted;
    }

    private function isGatewayTimeout($response) {
        return strpos($response, '504 Gateway') !== false;
    }

  }
