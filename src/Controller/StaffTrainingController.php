<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffTrainingController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['delete','update','edit','add','lists']);
        $this->viewBuilder()->setOption('serialize', true);
    }

    public function update($id)
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

        $data['training_type_id'] = $data['training_type'];
        $data['category_id'] = $data['training_category'];
        $data['institute_id'] = $data['training_institute'];
        $data['level_id'] = $data['training_level'];
        $data['training_title'] = $data['training_title'];

        $data['attended'] = $data['training_attended'];
        $data['certificate_awarded'] = $data['training_certificate_awarded'];

        // Add timestamps
        //$data['updated_at'] = new FrozenTime();
        $data['from_date'] = !empty($data['training_from_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['training_from_date']))
                : null;

        $data['to_date'] = !empty($data['training_to_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['training_to_date']))
                : null;


        
        $staffTrainingTable = TableRegistry::getTableLocator()->get('StaffTraining');
        
        $trainingDetails = $staffTrainingTable->find()
        ->where(['id' => $id])
        ->first();
        $trainingDetails = $staffTrainingTable->patchEntity($trainingDetails, $data);

        

        if ($staffTrainingTable->save($trainingDetails)) {
            $response = ['status' => 'success', 'message' => 'Updated successfully'];
        } else {
            $response = ['status' => 'error', 'errors' => $trainingDetails->getErrors()];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

   
    public function delete($id)
    {       

        $this->request->allowMethod(['get', 'ajax']);

        $staffTrainingTable = TableRegistry::getTableLocator()->get('StaffTraining');
        
        $trainingDetails = $staffTrainingTable->find()
        ->where(['StaffTraining.id' => $id])
        ->first();



        if ($staffTrainingTable->delete($trainingDetails)) {
           $response = ['status' => 'success', 'message' => 'Deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Delete failed'];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
    
    public function edit($id)
    {
        $this->request->allowMethod(['get', 'ajax']);

        $staffTrainingTable = TableRegistry::getTableLocator()->get('StaffTraining');

        $trainingCategoryTable = TableRegistry::getTableLocator()->get('TrainingCategory');                   
        $trainingCategoryDetails = $trainingCategoryTable->find()->order(['name' => 'ASC'])->all();

        $trainingInstituteTable = TableRegistry::getTableLocator()->get('TrainingInstitute');                   
        $trainingInstituteDetails = $trainingInstituteTable->find()->order(['name' => 'ASC'])->all();

        $trainingLevelTable = TableRegistry::getTableLocator()->get('TrainingLevel');                   
        $trainingLevelDetails = $trainingLevelTable->find()->order(['name' => 'ASC'])->all();
        $trainingTypeTable = TableRegistry::getTableLocator()->get('TrainingType');                   
        $trainingTypeDetails = $trainingTypeTable->find()->order(['name' => 'ASC'])->all();

        
        $trainingDetails = $staffTrainingTable->find()
        ->contain(['TrainingCategory'])
        ->contain(['TrainingInstitute'])
        ->contain(['TrainingLevel'])
        ->contain(['TrainingType'])
        ->where(['StaffTraining.id' => $id])
        ->first();


         if (empty($trainingDetails)) {
            $response = [
                'status' => 'empty',
                'trainingCategory' => $trainingCategoryDetails,
                'trainingInstitute' => $trainingInstituteDetails,
                'trainingLevel' => $trainingLevelDetails,
                'trainingType' => $trainingTypeDetails,
                'message' => 'No training records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $trainingDetails,
                'trainingCategory' => $trainingCategoryDetails,
                'trainingInstitute' => $trainingInstituteDetails,
                'trainingLevel' => $trainingLevelDetails,
                'trainingType' => $trainingTypeDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function add()
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

        
        $data['training_type_id'] = $data['training_type'];
        $data['category_id'] = $data['training_category'];
        $data['institute_id'] = $data['training_institute'];
        $data['level_id'] = $data['training_level'];
        $data['training_title'] = $data['training_title'];

        $data['attended'] = $data['training_attended'];
        $data['certificate_awarded'] = $data['training_certificate_awarded'];

        // Add timestamps
        $data['from_date'] = !empty($data['training_from_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['training_from_date']))
                : null;

        $data['to_date'] = !empty($data['training_to_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['training_to_date']))
                : null;

                
        // Load table (make sure model name matches your actual table)
        $staffTrainingTable = TableRegistry::getTableLocator()->get('StaffTraining');

        // Create new entity
        $trainingEntity = $staffTrainingTable->newEntity($data);

        // Save record
        if ($staffTrainingTable->save($trainingEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Training member added successfully',
                'data' => $trainingEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save training member',
                'errors' => $trainingEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function lists($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffTrainingTable = TableRegistry::getTableLocator()->get('StaffTraining');

        $trainingCategoryTable = TableRegistry::getTableLocator()->get('TrainingCategory');                   
        $trainingCategoryDetails = $trainingCategoryTable->find()->order(['name' => 'ASC'])->all();

        $trainingInstituteTable = TableRegistry::getTableLocator()->get('TrainingInstitute');                   
        $trainingInstituteDetails = $trainingInstituteTable->find()->order(['name' => 'ASC'])->all();

        $trainingLevelTable = TableRegistry::getTableLocator()->get('TrainingLevel');                   
        $trainingLevelDetails = $trainingLevelTable->find()->order(['name' => 'ASC'])->all();
        $trainingTypeTable = TableRegistry::getTableLocator()->get('TrainingType');                   
        $trainingTypeDetails = $trainingTypeTable->find()->order(['name' => 'ASC'])->all();
        
        $trainingDetails = $staffTrainingTable->find()
        ->contain(['TrainingCategory'])
        ->contain(['TrainingInstitute'])
        ->contain(['TrainingLevel'])
        ->contain(['TrainingType'])
        ->where(['staff_id' => $staffId])
        ->order(['StaffTraining.id' => 'ASC'])
        ->all();

       

        if (empty($trainingDetails)) {
            $response = [
                'status' => 'empty',
                'trainingCategory' => $trainingCategoryDetails,
                'trainingInstitute' => $trainingInstituteDetails,
                'trainingLevel' => $trainingLevelDetails,
                'trainingType' => $trainingTypeDetails,
                'message' => 'No training records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $trainingDetails,
                'trainingCategory' => $trainingCategoryDetails,
                'trainingInstitute' => $trainingInstituteDetails,
                'trainingLevel' => $trainingLevelDetails,
                'trainingType' => $trainingTypeDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
