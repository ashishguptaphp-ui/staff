<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffCasteController extends AppController
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
        $staffCasteTable = TableRegistry::getTableLocator()->get('StaffCaste');

        // Create new entity
        $casteEntity = $staffCasteTable->newEntity($data);

        // Save record
        if ($staffCasteTable->save($casteEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Caste member added successfully',
                'data' => $casteEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save caste member',
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
        
        $staffCasteTable = TableRegistry::getTableLocator()->get('StaffCaste');
        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');

        $castesTable = TableRegistry::getTableLocator()->get('Castes');
               
        $casteDetails = $castesTable->find()->all();

        $religionsTable = TableRegistry::getTableLocator()->get('Religions');
               
        $religionDetails = $religionsTable->find()->all();

       
      


        
        $staffCasteDetails = $staffCasteTable->find()                              
                        ->where(['StaffCaste.staff_id' => $staffId])
                        ->order(['StaffCaste.id' => 'ASC'])
                        ->first();

        
        

       
       



        if (empty($staffCasteDetails)) {
            $response = [
                'status' => 'empty',
                'religions' => $religionDetails,
                'castes' => $casteDetails,
                
                'message' => 'No caste records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'religions' => $religionDetails,
                'castes' => $casteDetails,
                'data' => $staffCasteDetails
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

        $staffCasteTable = TableRegistry::getTableLocator()->get('StaffCaste');

        // Check if record exists
        $caste = $staffCasteTable->find()
            ->where(['staff_id' => $staffId])
            ->first();

        // If not exists, create new record
        if (!$caste) {
            $caste = $staffCasteTable->newEmptyEntity();
            $caste->staff_id = $staffId;
            $message = 'New staff record created successfully';
        } else {
            $message = 'Staff data updated successfully';
        }

        $data['certificate_date'] = (!empty($data['certificate_date']) && $data['certificate_date']!='-')
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['certificate_date']))
                : null;

        $data['certificate_validation_date'] = (!empty($data['certificate_validation_date']) && $data['certificate_validation_date']!='-')
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['certificate_validation_date']))
                : null;
        // Merge (update/insert) new data
        $caste = $staffCasteTable->patchEntity($caste, $data);

        // Save record
        if ($staffCasteTable->save($caste)) {
            $response = [
                'status' => 'success',
                'message' => $message
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save staff record.',
                'errors' => $caste->getErrors()
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
