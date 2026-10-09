<?php
declare(strict_types=1);
namespace App\Controller\Api;

use App\Controller\Api\AppController as ApiAppController;
use Cake\Event\EventInterface;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Http\Response;
use Cake\Http\CallbackStream;
use Cake\Utility\Security;
use Cake\Http\Exception\BadRequestException;
use Cake\Routing\Router;
use Cake\Http\Client;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;



class MasterController extends ApiAppController
{

public function initialize(): void
    {
        parent::initialize();

        // Load Authentication component explicitly (if not globally loaded in AppController)
        $this->loadComponent('Authentication.Authentication');
        $this->getEventManager()->off($this->FormProtection);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Allow unauthenticated users to access login and register
        $this->Authentication->addUnauthenticatedActions(['subjects', 'mediums', 'posts',
        'horizontalCategories','casteCategories','phCategories','phSubCategories',
        'lgdDistricts','lgdBlocks','lgdVillages','languages','religions','pavitraStates','stateUniversities',
        'bloodGroups','relationships','appointmentTypes','casteIssuingAuthorities','casteValidAuthorities',
        'professionalGrades','professionalClasses','tetYears','tetExamPapers','searchByUdise',
        'academicQualificationLevels','academicLevelDegrees','academicLevelDegreeStateUnivercities','academicLevelDegreeSubjects',
        'professionalQualificationLevels','professionalLevelDegrees','professionalLevelDegreeStateUnivercities','professionalLevelDegreeSubjects',
        'trainingTypes','trainingCategories','trainingInstitutes','trainingLevels']);
        $action = $this->request->getParam('action');
        $notRequired = Array('login');
        if(!in_array($action,$notRequired)){
            $token = $this->request->getHeaderLine('Authorization');
            $staff_id = $this->request->getHeaderLine('staff-id');
            $username = $this->request->getHeaderLine('username');

            if (!$token) {
                 return $this->error('Token missing', 401);
            }

            $token = str_replace('Bearer ', '', $token);
            $tokenHash = hash('sha256', $token);
            $staffMobileAppLoginAudit = TableRegistry::getTableLocator()->get('StaffMobileAppLoginAudit');  

            $audit = $staffMobileAppLoginAudit->find()
                    ->where(['token_hash' => $tokenHash, 'is_active' => 1])
                    ->first();
           
                /*echo "<pre>dfdfdf";
                print_r( $audit);
                exit;*/
            if (!$audit) {
                return $this->error('Invalid username session', 401);
            }else if ($username != $audit->username) {
                return $this->error('Invalid username', 401);
            }else if ($staff_id != $audit->staff_id) {
                return $this->error('Invalid staff id', 401);
            }
        
        }
    }
    public function subjects()
    {
        $this->request->allowMethod(['get']);
        $subjectsTable = TableRegistry::getTableLocator()->get('Subjects');
        $subjects = $subjectsTable->find()->all();
        if (!$subjects) {
            return $this->error('No data found', 401);
        }


        return $this->respond([
            'subjects' => $subjects
        ]);
    }

    public function mediums()
    {
        $this->request->allowMethod(['get']);
        $mediumsTable = TableRegistry::getTableLocator()->get('Mediums');
        $mediums = $mediumsTable->find()->all();
        if (!$mediums) {
            return $this->error('No data found', 401);
        }


        return $this->respond([
            'mediums' => $mediums
        ]);
    }

    public function posts()
    {
        $this->request->allowMethod(['get']);
        $postsTable = TableRegistry::getTableLocator()->get('Posts');
        $posts = $postsTable->find()->all();
        if (!$posts) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($posts);
        exit;*/

        return $this->respond([
            'posts' => $posts
        ]);
    }
    public function horizontalCategories()
    {
        $this->request->allowMethod(['get']);
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategories = $horizontalCategoriesTable->find()->all();
        if (!$horizontalCategories) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($horizontalCategories);
        exit;*/

        return $this->respond([
            'horizontalCategories' => $horizontalCategories
        ]);
    }
    public function casteCategories()
    {
        $this->request->allowMethod(['get']);
        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategories = $casteCategoriesTable->find()->all();
        if (!$casteCategories) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($casteCategories);
        exit;*/

        return $this->respond([
            'casteCategories' => $casteCategories
        ]);
    }

    public function phCategories()
    {
        $this->request->allowMethod(['get']);
        $disabilityTypesTable = TableRegistry::getTableLocator()->get('DisabilityTypes');
        $disabilityTypes = $disabilityTypesTable->find()->select(['id', 'dt_code'])->all();
        if (!$disabilityTypes) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($disabilityTypes);
        exit;*/

        return $this->respond([
            'disabilityTypes' => $disabilityTypes
        ]);
    }

    public function phSubCategories($cat_id)
    {
        $this->request->allowMethod(['get']);
        $disabilityTypesTable = TableRegistry::getTableLocator()->get('DisabilitySubTypes');
        $disabilityTypes = $disabilityTypesTable->find()->select(['id', 'name'])->where(['disability_type_id' => $cat_id])->all();
        if (!$disabilityTypes) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($disabilityTypes);
        exit;*/

        return $this->respond([
            'disabilityTypes' => $disabilityTypes
        ]);
    }

    

    public function lgdDistricts()
    {
        $this->request->allowMethod(['get']);
        $districtsTable = TableRegistry::getTableLocator()->get('LgdDistricts');
        $districts = $districtsTable->find()->select(['id','name_en'])->all();
        if (!$districts) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($districts);
        exit;*/

        return $this->respond([
            'districts' => $districts
        ]);
    }

    public function lgdBlocks($district_id)
    {
        $this->request->allowMethod(['get']);
        $blocksTable = TableRegistry::getTableLocator()->get('LgdBlocks');
        $blocks = $blocksTable->find()->select(['id','name_en'])->where(['district_id' => $district_id])->all();
        if (!$blocks) {
            return $this->error('No data found', 401);
        }
        /*
        echo "<pre>";
        print_r($blocks);
        exit;*/

        return $this->respond([
            'blocks' => $blocks
        ]);
    }

    public function lgdVillages($block_id)
    {
        $this->request->allowMethod(['get']);
        $villagesTable = TableRegistry::getTableLocator()->get('LgdVillages');
        $villages = $villagesTable->find()->select(['id','name_en'])->where(['block_id' => $block_id])->all();
        if (!$villages) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($villages);
        exit;*/

        return $this->respond([
            'villages' => $villages
        ]);
    }

    public function bloodGroups()
    {
        $this->request->allowMethod(['get']);
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $bloodGrps = array();
        foreach ($bloodGroups as $group){
            $bloodGrps[]=array('code'=>$group,'name'=>$group);
        }
                                                   

       
        /*echo "<pre>";
        print_r($bloodGrps);
        exit;*/

        return $this->respond([
            'bloodGroups' => $bloodGrps
        ]);
    }
   

     
    public function relationships()
    {
        $this->request->allowMethod(['get']);
        $relationshipsTable = TableRegistry::getTableLocator()->get('Relationships');
        $relationships = $relationshipsTable->find()->select(['id','relationship','description'])->all();
        if (!$relationships) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($relationships);
        exit;*/

        return $this->respond([
            'relationships' => $relationships
        ]);
    }

    public function appointmentTypes()
    {
        $this->request->allowMethod(['get']);
        $appointmentTypesTable = TableRegistry::getTableLocator()->get('AppointmentTypes');
        $appointmentTypes = $appointmentTypesTable->find()->select(['id','name'])->all();
        if (!$appointmentTypes) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($appointmentTypes);
        exit;*/

        return $this->respond([
            'appointmentTypes' => $appointmentTypes
        ]);
    }

    
    public function casteIssuingAuthorities()
    {
        $this->request->allowMethod(['get']);
        /*$casteIssuingAuthorityTable = TableRegistry::getTableLocator()->get('CasteIssuingAuthority');
        $casteIssuingAuthority = $casteIssuingAuthorityTable->find()->select(['id','name'])->all();
        if (!$casteIssuingAuthority) {
            return $this->error('No data found', 401);
        } 

        echo "<pre>";
        print_r($casteIssuingAuthority);
        exit;*/

        $casteIssuingAuthority =array();
        $casteIssuingAuthority[] =array('id'=>1, 'name'=>'Tahasildar');
       
        $casteIssuingAuthority[] =array('id'=>2, 'name'=>'Subdivisional Officer');
       

        return $this->respond([
            'casteIssuingAuthority' => $casteIssuingAuthority
        ]);
    }

    public function casteValidAuthorities()
    {
        $this->request->allowMethod(['get']);
        $casteValidAuthorityTable = TableRegistry::getTableLocator()->get('CasteValidAuthority');
        $casteValidAuthority = $casteValidAuthorityTable->find()->select(['id','name'])->all();
        if (!$casteValidAuthority) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($casteValidAuthority);
        exit;*/

        return $this->respond([
            'casteValidAuthority' => $casteValidAuthority
        ]);
    }
    public function languages()
    {
        $this->request->allowMethod(['get']);
        $languagesTable = TableRegistry::getTableLocator()->get('Languages');
        $languages = $languagesTable->find()->select(['id','name'])->all();
        if (!$languages) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($languages);
        exit;*/

        return $this->respond([
            'languages' => $languages
        ]);
    }

    public function religions()
    {
        $this->request->allowMethod(['get']);
        $religionsTable = TableRegistry::getTableLocator()->get('Religions');
        $religions = $religionsTable->find()->select(['id','name'])->all();
        if (!$religions) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($religions);
        exit;*/

        return $this->respond([
            'religions' => $religions
        ]);
    }


    public function pavitraStates()
    {
        $this->request->allowMethod(['get']);
        $statesTable = TableRegistry::getTableLocator()->get('PavitraStates');
        $states = $statesTable->find()->select(['id','name'])->all();
        if (!$states) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($states);
        exit;*/

        return $this->respond([
            'states' => $states
        ]);
    }

    

    public function stateUniversities($state_id)
    {
        $this->request->allowMethod(['get']);
        $universitiesTable = TableRegistry::getTableLocator()->get('Universities');
        $universities = $universitiesTable->find()->select(['id','name','type'])->where(['state_id' => $state_id])->all();
        if (!$universities) {
            return $this->error('No data found', 401);
        }

        /*echo "<pre>";
        print_r($universities);
        exit;*/

        return $this->respond([
            'universities' => $universities
        ]);
    }
       
    public function academicQualificationLevels()
    {
        $this->request->allowMethod(['get']);
        $academicQualificationLevelsTable = TableRegistry::getTableLocator()->get('AcademicQualificationLevels');
        $academicQualificationLevels = $academicQualificationLevelsTable->find()->select(['id','level_name','description','seq_no'])->all();
        if (!$academicQualificationLevels) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($academicQualificationLevels);
        exit;*/

        return $this->respond([
            'academicQualificationLevels' => $academicQualificationLevels
        ]);
    }


    public function academicLevelDegrees($level_id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $degreesTable = $this->fetchTable('AcademicQualificationDegrees');

        $degrees = $degreesTable->find()
            ->where(['qualification_level_id' => $level_id])
            ->order(['name' => 'ASC'])
            ->all();

        if (!$degrees) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($degrees);
        exit;*/

        return $this->respond([
            'degrees' => $degrees
        ]);
    }
   
    
    public function academicLevelDegreeStateUnivercities($level_id,$state_id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $universitiesTable = $this->fetchTable('Universities');
        if(($level_id == 8) ||  ($level_id == 7) || ($level_id == 6)){
            $type = 'X';
        }else if(($level_id == 5) ||  ($level_id == 4)){
             $type = 'U';
        } else if(($level_id == 3) ||  ($level_id == 2)){
             $type = 'B';
        }else{
            $type = 'N';
        }
        
        $universities = $universitiesTable->find()
            ->where(['type' => $type])
              ->where(['state_id' => $state_id])
            ->order(['name' => 'ASC'])
            ->all();

        if (!$universities) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($universities);
        exit;*/

        return $this->respond([
            'universities' => $universities
        ]);
    }

    public function academicLevelDegreeSubjects($level_id,$degree_id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $subjectsTable = $this->fetchTable('Subjects');

        $subjects = $subjectsTable->find()
            ->select(['id', 'name'])
            ->contain(['AcademicQualificationsSubjects' => [
                'conditions' => [
                    'AcademicQualificationsSubjects.degree_id' =>  $degree_id,
                    'AcademicQualificationsSubjects.level_id' =>  $level_id
                ]
            ]])           
            ->all();

         if (!$subjects) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($subjects);
        exit;*/

        return $this->respond([
            'subjects' => $subjects
        ]);
    }
    
    
    public function professionalGrades()
    {
        $this->request->allowMethod(['get']);       

        $professionalGrades =array();
        $professionalGrades[] =array('id'=>1, 'name'=>'A++');       
        $professionalGrades[] =array('id'=>2, 'name'=>'A+');
        $professionalGrades[] =array('id'=>3, 'name'=>'A');      
        $professionalGrades[] =array('id'=>4, 'name'=>'B++');
        $professionalGrades[] =array('id'=>5, 'name'=>'B+');       
        $professionalGrades[] =array('id'=>6, 'name'=>'B');
        $professionalGrades[] =array('id'=>7, 'name'=>'C++');       
        $professionalGrades[] =array('id'=>8, 'name'=>'C+');
        $professionalGrades[] =array('id'=>9, 'name'=>'C+');
       

        return $this->respond([
            'professionalGrades' => $professionalGrades
        ]);
    }
    public function professionalClasses()
    {
        $this->request->allowMethod(['get']);       

        $professionalClasses =array();
        $professionalClasses[] =array('id'=>1, 'name'=>'Distinction');       
        $professionalClasses[] =array('id'=>2, 'name'=>'First Division');
        $professionalClasses[] =array('id'=>3, 'name'=>'Second Division');      
        $professionalClasses[] =array('id'=>4, 'name'=>'Third Division');
        $professionalClasses[] =array('id'=>5, 'name'=>'Pass'); 
       

        return $this->respond([
            'professionalClasses' => $professionalClasses
        ]);
    }

    public function professionalQualificationLevels()
    {
        $this->request->allowMethod(['get']);
        $professionalQualificationLevelsTable = TableRegistry::getTableLocator()->get('ProfessionalQualificationLevels');
        $professionalQualificationLevels = $professionalQualificationLevelsTable->find()->select(['id','level_name','description','seq_no'])->all();
        if (!$professionalQualificationLevels) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($professionalQualificationLevels);
        exit;*/

        return $this->respond([
            'professionalQualificationLevels' => $professionalQualificationLevels
        ]);
    }
    public function professionalLevelDegrees($level_id)
    {
        $this->request->allowMethod(['get']);

        $degreesTable = $this->fetchTable('ProfessionalQualificationDegrees');

        $degrees = $degreesTable->find()
            ->where(['qualification_level_id' => $level_id])
            ->order(['name' => 'ASC'])
            ->all();

        if (!$degrees) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($degrees);
        exit;*/

        return $this->respond([
            'degrees' => $degrees
        ]);

    
            
    }
    
    public function professionalLevelDegreeStateUnivercities($level_id,$state_id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $universitiesTable = $this->fetchTable('Universities');
        if(($level_id == 8) ||  ($level_id == 7) || ($level_id == 6)){
            $type = 'X';
        }else if(($level_id == 5) ||  ($level_id == 4)){
             $type = 'U';
        } else if(($level_id == 3) ||  ($level_id == 2)){
             $type = 'B';
        }else{
            $type = 'N';
        }
        
        $universities = $universitiesTable->find()
            ->where(['type' => $type])
              ->where(['state_id' => $state_id])
            ->order(['name' => 'ASC'])
            ->all();

        if (!$universities) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($universities);
        exit;*/

        return $this->respond([
            'universities' => $universities
        ]);
    }

    public function professionalLevelDegreeSubjects($level_id,$degree_id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $subjectsTable = $this->fetchTable('Subjects');

        $subjects = $subjectsTable->find()
            ->select(['id', 'name'])
            ->contain(['ProfessionalQualificationsSubjects' => [
                'conditions' => [
                    'ProfessionalQualificationsSubjects.degree_id' =>  $degree_id,
                    'ProfessionalQualificationsSubjects.level_id' =>  $level_id
                ]
            ]])           
            ->all();


        if (!$subjects) {
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($subjects);
        exit;*/

        return $this->respond([
            'subjects' => $subjects
        ]);
    }
   
    public function tetYears()
    {
        $this->request->allowMethod(['get']);

        $tetYears =array();
        $tetYears[] =array('id'=>2020, 'name'=>'2020');       
        $tetYears[] =array('id'=>2021, 'name'=>'2021');
        $tetYears[] =array('id'=>2022, 'name'=>'2022');       
        $tetYears[] =array('id'=>2023, 'name'=>'2023');
        $tetYears[] =array('id'=>2024, 'name'=>'2024');
       

        return $this->respond([
            'tetYears' => $tetYears
        ]);
    }

    public function tetExamPapers()
    {
        $this->request->allowMethod(['get']);

        $tetExamPapers =array();
        $tetExamPapers[] =array('id'=>1, 'name'=>'Paper I (Std. 1st to 5th)');       
        $tetExamPapers[] =array('id'=>2, 'name'=>'Paper II (Std. 6th to 8th)');
       

        return $this->respond([
            'tetExamPapers' => $tetExamPapers
        ]);
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
            return $this->error('No data found', 401);
        } 

        /*echo "<pre>";
        print_r($subjects);
        exit;*/

        return $this->respond([
            'school' => $school,
            'aidedTypes' => $aidedTypesDetails,
            'posts' => $postDetails,
            'schoolCategories' => $schoolCategories,
        ]);

    
    }

    public function trainingTypes()
    {        
        $this->request->allowMethod(['get']);
        $trainingTypeTable = TableRegistry::getTableLocator()->get('TrainingType');                   
        $trainingTypes = $trainingTypeTable->find()->order(['name' => 'ASC'])->all();
        if (!$trainingTypes) {
            return $this->error('No data found', 401);
        } 
        return $this->respond([
            'trainingTypes' => $trainingTypes
        ]);
    }

    public function trainingCategories()
    {        
        $this->request->allowMethod(['get']);
        $trainingCategoryTable = TableRegistry::getTableLocator()->get('TrainingCategory');                   
        $trainingCategories = $trainingCategoryTable->find()->order(['name' => 'ASC'])->all();
        if (!$trainingCategories) {
            return $this->error('No data found', 401);
        } 
        return $this->respond([
            'trainingCategories' => $trainingCategories
        ]);
    }

    public function trainingInstitutes()
    {        
        $this->request->allowMethod(['get']);
        $trainingInstituteTable = TableRegistry::getTableLocator()->get('TrainingInstitute');                   
        $trainingInstitutes = $trainingInstituteTable->find()->order(['name' => 'ASC'])->all();
        if (!$trainingInstitutes) {
            return $this->error('No data found', 401);
        } 
        return $this->respond([
            'trainingInstitutes' => $trainingInstitutes
        ]);
    }

    public function trainingLevels()
    {        
        $this->request->allowMethod(['get']);
        $trainingLevelTable = TableRegistry::getTableLocator()->get('TrainingLevel');                   
        $trainingLevels = $trainingLevelTable->find()->order(['name' => 'ASC'])->all();
        if (!$trainingLevels) {
            return $this->error('No data found', 401);
        } 
        return $this->respond([
            'trainingLevels' => $trainingLevels
        ]);
    }
}