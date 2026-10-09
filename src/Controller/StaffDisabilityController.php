<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffDisabilityController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['add','lists','details','update']);
        $this->viewBuilder()->setOption('serialize', true);
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

        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['date_of_caste'] = !empty($data['date_of_caste'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['date_of_caste']))
                : null;

        // Load table (make sure model name matches your actual table)
        $staffDisabilityTable = TableRegistry::getTableLocator()->get('StaffDisability');

        // Create new entity
        $casteEntity = $staffDisabilityTable->newEntity($data);

        // Save record
        if ($staffDisabilityTable->save($casteEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Disability member added successfully',
                'data' => $casteEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save disability member',
                'errors' => $casteEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function details($staffId = null)
    {

       
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffDisabilityTable = TableRegistry::getTableLocator()->get('StaffDisability');

       
      


        
        $staffDisabilityDetails = $staffDisabilityTable->find()                              
                        ->where(['StaffDisability.staff_id' => $staffId])
                        ->order(['StaffDisability.id' => 'ASC'])
                        ->first();

        
        

       
       



        if (empty($staffDisabilityDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No disability records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $staffDisabilityDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }



    public function update()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);

        

        $staffId = $data['staff_id'];
        unset($data['staff_id'], $data['_Token']);

        $staffDisabilityTable = TableRegistry::getTableLocator()->get('StaffDisability');

        // Check if record exists
        $disability = $staffDisabilityTable->find()
            ->where(['staff_id' => $staffId])
            ->first();

        // If not exists, create new record
        if (!$disability) {
            $disability = $staffDisabilityTable->newEmptyEntity();
            $disability->staff_id = $staffId;
            $message = 'New Staff Disability record created successfully';
        } else {
            $message = 'Staff Disability data updated successfully';
        }

        // Merge (update/insert) new data
        $disability = $staffDisabilityTable->patchEntity($disability, $data);

        // Save record
        if ($staffDisabilityTable->save($disability)) {
            $response = [
                'status' => 'success',
                'message' => $message
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save staff record.',
                'errors' => $disability->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    
    public function listReligions()
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $religionsTable = TableRegistry::getTableLocator()->get('Religions');
               
        $religionDetails = $religionsTable->find()->all();

       
        $response = [
            'status' => 'success',
            'data' => $religionDetails
        ];
       

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
