<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Security;
use Cake\Routing\Router;

class StaffQualificationsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
         $this->FormProtection->setConfig('unlockedActions', [
            'levelDegreeSubjects','levelDegreeStateUnivercities','levelDegrees',
            'addAcademic','listAcademic','deleteAcademic','updateAcademic','editAcademic',
            'deleteProfessional','updateProfessional','editProfessional',
            'professionalevelDegreeSubjects','professionalLevelDegreeStateUnivercities',
            'professionalLevelDegrees',
            'addProfessional','listProfessional ']);
        $this->viewBuilder()->setOption('serialize', true);        
    }

    
    public function updateAcademic($id)
    {
       $this->request->allowMethod(['post', 'ajax']);

        
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);

        if (empty($data)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid request data'
                ]));
        }

        // Extract staff_id and remove unnecessary keys
       
        unset($data['_Token']);

        if($data['academic_degree_from_maharashtra'] == 1){
            $data['academic_state_id'] = 27;
        }
        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['academic_result_date'] = !empty($data['academic_result_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['academic_result_date']))
                : null;
                

        $staffAcademicTable = TableRegistry::getTableLocator()->get('StaffAcademic');
        
        $academicDetails = $staffAcademicTable->find()
        ->where(['id' => $id])
        ->first();
        $academicDetails = $staffAcademicTable->patchEntity($academicDetails, $data);

        if ($staffAcademicTable->save($academicDetails)) {
            $response = ['status' => 'success', 'message' => 'Updated successfully'];
        } else {
            $response = ['status' => 'error', 'errors' => $academicDetails->getErrors()];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

   
    public function deleteAcademic($id)
    {       

       // $this->request->allowMethod(['DELETE', 'ajax']);
        $this->request->allowMethod(['delete']);

        $staffAcademicTable = TableRegistry::getTableLocator()->get('StaffAcademic');
        
        $academicDetails = $staffAcademicTable->find()
        ->where(['StaffAcademic.id' => $id])
        ->first();



        if ($staffAcademicTable->delete($academicDetails)) {
           $response = ['status' => 'success', 'message' => 'Deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Delete failed'];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
    
    public function editAcademic($id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $staffAcademicTable = TableRegistry::getTableLocator()->get('StaffAcademic');
        
        $academicDetails = $staffAcademicTable->find()
       ->contain(['AcademicQualificationLevels'])
        ->contain(['AcademicQualificationDegrees'])
        ->contain(['Universities'])
        ->contain(['Mediums'])
        ->contain(['PavitraStates'])
        ->contain(['Subjects'])
        ->where(['StaffAcademic.id' => $id])
        ->first();


         if (empty($academicDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No academic records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $academicDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function addAcademic()
    {
        $this->request->allowMethod(['post', 'ajax']);

        // Read and decode JSON payload
        // $rawBody = $this->getRequest()->getBody()->getContents();
        //$data = json_decode($rawBody, true);
        //$staff_id = $this->input->post('staff_id');
        $data = $this->request->getData();//$this->input->post(); 
        //print_r($data);
        //exit;
        $staffId = $this->request->getData('staff_id', 0);
        if (empty($data)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid request data'
                ]));
        }

        // Extract staff_id and remove unnecessary keys
       
        unset($data['_Token']);

        $file = $this->request->getData('academic_certificate_file');
            
        if ($file && $file->getError() === UPLOAD_ERR_OK) {
            // Validate file
           /* if (!$this->validateFile($file)) {
                $response['message'] = 'Invalid file type or size';
                echo json_encode($response);
                return;
            }*/
            
            // Generate secure filename
            $originalName = $file->getClientFilename();
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $newFilename = Security::randomString(32) . '.' . $extension;
            
            // Create upload directory if it doesn't exist
            $uploadDir = WWW_ROOT . 'uploads' . DS . 'documents' . DS. $staffId. DS;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Move uploaded file
            $filePath = 'uploads/documents/' .$staffId .'/'. $newFilename;
            $absolutePath = WWW_ROOT . $filePath;
            
            try {
                $file->moveTo($absolutePath);
                $staffOtherDetails = TableRegistry::getTableLocator()->get('StaffOtherDetails');

                $record = $staffOtherDetails->find()
                    ->where(['staff_id' => $staffId])
                    ->first();

                //$fieldNameWithPath = $fieldName . '_file_path';                   

                
            } catch (\Exception $e) {
                $response['message'] = 'Upload failed: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'File upload error';
        }

        
        if($data['academic_degree_from_maharashtra'] == 1){
            $data['academic_state_id'] = 27;
        }

        $data['academic_certificate_file'] = $filePath;

        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['academic_result_date'] = !empty($data['academic_result_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['academic_result_date']))
                : null;

        // Load table (make sure model name matches your actual table)
        $staffAcademicTable = TableRegistry::getTableLocator()->get('StaffAcademic');

        // Create new entity
        $academicTableEntity = $staffAcademicTable->newEntity($data);

        // Save record
        if ($staffAcademicTable->save($academicTableEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Academic qualification added successfully'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save Academic qualification',
                'errors' => $academicTableEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    
    public function listAcademic($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffAcademicTable = TableRegistry::getTableLocator()->get('StaffAcademic');

        $academicQualificationLevelsTable = TableRegistry::getTableLocator()->get('AcademicQualificationLevels');
        //$academicQualificationDegreesTable = TableRegistry::getTableLocator()->get('AcademicQualificationDegrees');
        $statesTable = TableRegistry::getTableLocator()->get('PavitraStates');
        $universitiesTable = TableRegistry::getTableLocator()->get('Universities');
        $mediumsTable = TableRegistry::getTableLocator()->get('Mediums');

        $levelsDetails = $academicQualificationLevelsTable->find()->all();
        //$degreesDetails = $academicQualificationDegreesTable->find()->all();
        $stateDetails = $statesTable->find()->all();
        $universitiesDetails = $universitiesTable->find()->all();
        $mediumsDetails = $mediumsTable->find()->all();


        
        $academicDetails = $staffAcademicTable->find()
        ->contain(['AcademicQualificationLevels'])
        ->contain(['AcademicQualificationDegrees'])
        ->contain(['Universities'])
        ->contain(['Mediums'])
        ->contain(['PavitraStates'])
        ->contain(['Subjects'])
        ->where(['staff_id' => $staffId])
        ->all();
        //'degrees' => $degreesDetails,
        if (empty($academicDetails)) {
            $response = [
                'status' => 'empty',
                'levels' => $levelsDetails,
                'states' => $stateDetails,
                'universities' => $universitiesDetails,
                'mediums' => $mediumsDetails,
                'message' => 'No Academic records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $academicDetails,
                'levels' => $levelsDetails,
                'states' => $stateDetails,
                'universities' => $universitiesDetails,
                'mediums' => $mediumsDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function levelDegrees($levelId)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $degreesTable = $this->fetchTable('AcademicQualificationDegrees');

        $degrees = $degreesTable->find()
            ->where(['qualification_level_id' => $levelId])
            ->order(['name' => 'ASC'])
            ->all();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'data' => $degrees
            ]));
    }

    
    public function levelDegreeStateUnivercities($levelId,$stateId)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $universitiesTable = $this->fetchTable('Universities');
        if(($levelId == 8) ||  ($levelId == 7) || ($levelId == 6)){
            $type = 'X';
        }else if(($levelId == 5) ||  ($levelId == 4)){
             $type = 'U';
        } else if(($levelId == 3) ||  ($levelId == 2)){
             $type = 'B';
        }else{
            $type = 'N';
        }
        
        $universities = $universitiesTable->find()
            ->where(['type' => $type])
              ->where(['state_id' => $stateId])
            ->order(['name' => 'ASC'])
            ->all();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'data' => $universities
            ]));
    }

    public function levelDegreeSubjects($levelId,$degreeId)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $subjectsTable = $this->fetchTable('Subjects');

        $subjects = $subjectsTable->find()
            ->select(['id', 'name'])
            ->contain(['AcademicQualificationsSubjects' => [
                'conditions' => [
                    'AcademicQualificationsSubjects.degree_id' =>  $degreeId,
                    'AcademicQualificationsSubjects.level_id' =>  $levelId
                ]
            ]])           
            ->all();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'data' => $subjects
            ]));
    }


    
 /********************* Professional Start */

    
    public function updateProfessional($id)
    {
       $this->request->allowMethod(['post', 'ajax']);

       $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);

        if (empty($data)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid request data'
                ]));
        }

        // Extract staff_id and remove unnecessary keys
       
        unset($data['_Token']);

        if($data['professional_degree_from_maharashtra'] == 1){
            $data['professional_state_id'] = 27;
        }
        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['professional_result_date'] = !empty($data['professional_result_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['professional_result_date']))
                : null;
                

        $staffProfessionalTable = TableRegistry::getTableLocator()->get('StaffProfessional');
        
        $academicDetails = $staffProfessionalTable->find()
        ->where(['id' => $id])
        ->first();
        $academicDetails = $staffProfessionalTable->patchEntity($academicDetails, $data);

        if ($staffProfessionalTable->save($academicDetails)) {
            $response = ['status' => 'success', 'message' => 'Updated successfully'];
        } else {
            $response = ['status' => 'error', 'errors' => $academicDetails->getErrors()];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

   
    public function deleteProfessional($id)
    {       

       // $this->request->allowMethod(['DELETE', 'ajax']);
        $this->request->allowMethod(['delete']);

        $staffProfessionalTable = TableRegistry::getTableLocator()->get('StaffProfessional');
        
        $academicDetails = $staffProfessionalTable->find()
        ->where(['StaffProfessional.id' => $id])
        ->first();



        if ($staffProfessionalTable->delete($academicDetails)) {
           $response = ['status' => 'success', 'message' => 'Deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Delete failed'];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
    
    public function editProfessional($id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $staffProfessionalTable = TableRegistry::getTableLocator()->get('StaffProfessional');
        
        $academicDetails = $staffProfessionalTable->find()
       ->contain(['ProfessionalQualificationLevels'])
        ->contain(['ProfessionalQualificationDegrees'])
        ->contain(['Universities'])
        ->contain(['Mediums'])
        ->contain(['PavitraStates'])
        ->contain(['Subjects'])
        ->where(['StaffProfessional.id' => $id])
        ->first();


         if (empty($academicDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No academic records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $academicDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function addProfessional()
    {
        $this->request->allowMethod(['post', 'ajax']);

        // Read and decode JSON payload
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);
        if (empty($data)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid request data'
                ]));
        }

        // Extract staff_id and remove unnecessary keys
       
        unset($data['_Token']);

        
        if($data['professional_degree_from_maharashtra'] == 1){
            $data['professional_state_id'] = 27;
        }
        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['professional_result_date'] = !empty($data['professional_result_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['professional_result_date']))
                : null;

        // Load table (make sure model name matches your actual table)
        $staffProfessionalTable = TableRegistry::getTableLocator()->get('StaffProfessional');

        // Create new entity
        $professionalTableEntity = $staffProfessionalTable->newEntity($data);

        // Save record
        if ($staffProfessionalTable->save($professionalTableEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Professional qualification added successfully'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save Professional qualification',
                'errors' => $professionalTableEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
    public function listProfessional($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffProfessionalTable = TableRegistry::getTableLocator()->get('StaffProfessional');

        $professionalQualificationLevelsTable = TableRegistry::getTableLocator()->get('ProfessionalQualificationLevels');
        //$professionalQualificationDegreesTable = TableRegistry::getTableLocator()->get('ProfessionalQualificationDegrees');
        $statesTable = TableRegistry::getTableLocator()->get('PavitraStates');
        $universitiesTable = TableRegistry::getTableLocator()->get('Universities');
        $mediumsTable = TableRegistry::getTableLocator()->get('Mediums');

        $levelsDetails = $professionalQualificationLevelsTable->find()->all();
        //$degreesDetails = $professionalQualificationDegreesTable->find()->all();
        $stateDetails = $statesTable->find()->all();
        $universitiesDetails = $universitiesTable->find()->all();
        $mediumsDetails = $mediumsTable->find()->all();


        
        $professionalDetails = $staffProfessionalTable->find()
        ->contain(['ProfessionalQualificationLevels'])
        ->contain(['ProfessionalQualificationDegrees'])
        ->contain(['Universities'])
        ->contain(['Mediums'])
        ->contain(['PavitraStates'])
        ->contain(['Subjects'])
        ->where(['staff_id' => $staffId])
        ->all();
        //'degrees' => $degreesDetails,
        if (empty($professionalDetails)) {
            $response = [
                'status' => 'empty',
                'levels' => $levelsDetails,
                'states' => $stateDetails,
                'universities' => $universitiesDetails,
                'mediums' => $mediumsDetails,
                'message' => 'No Professional records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $professionalDetails,
                'levels' => $levelsDetails,
                'states' => $stateDetails,
                'universities' => $universitiesDetails,
                'mediums' => $mediumsDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
        
    public function professionalLevelDegrees($levelId)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $degreesTable = $this->fetchTable('ProfessionalQualificationDegrees');

        $degrees = $degreesTable->find()
            ->where(['qualification_level_id' => $levelId])
            ->order(['name' => 'ASC'])
            ->all();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'data' => $degrees
            ]));
    }
    
    public function professionalLevelDegreeStateUnivercities($levelId,$stateId)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $universitiesTable = $this->fetchTable('Universities');
        if(($levelId == 8) ||  ($levelId == 7) || ($levelId == 6)){
            $type = 'X';
        }else if(($levelId == 5) ||  ($levelId == 4)){
             $type = 'U';
        } else if(($levelId == 3) ||  ($levelId == 2)){
             $type = 'B';
        }else{
            $type = 'N';
        }
        
        $universities = $universitiesTable->find()
            ->where(['type' => $type])
              ->where(['state_id' => $stateId])
            ->order(['name' => 'ASC'])
            ->all();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'data' => $universities
            ]));
    }

    public function professionalLevelDegreeSubjects($levelId,$degreeId)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $subjectsTable = $this->fetchTable('Subjects');

        $subjects = $subjectsTable->find()
            ->select(['id', 'name'])
            ->contain(['ProfessionalQualificationsSubjects' => [
                'conditions' => [
                    'ProfessionalQualificationsSubjects.degree_id' =>  $degreeId,
                    'ProfessionalQualificationsSubjects.level_id' =>  $levelId
                ]
            ]])           
            ->all();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'data' => $subjects
            ]));
    }


}
