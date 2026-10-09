<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffFamilyController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['delete','update','edit','add','lists','updateOtherPersonalDetails','addFamily','familyDetails']);
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

        /*echo "<pre>";
        print_r($data);
        exit;*/
        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['date_of_birth'] = !empty($data['date_of_birth'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['date_of_birth']))
                : null;

        $data['date_of_nominaton'] = !empty($data['date_of_nominaton'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['date_of_nominaton']))
                : null;


        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');
        
        $familyDetails = $staffFamilyTable->find()
        ->where(['id' => $id])
        ->first();
        $familyDetails = $staffFamilyTable->patchEntity($familyDetails, $data);

        

        if ($staffFamilyTable->save($familyDetails)) {
            $response = ['status' => 'success', 'message' => 'Updated successfully'];
        } else {
            $response = ['status' => 'error', 'errors' => $familyDetails->getErrors()];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

   
    public function delete($id)
    {       

        $this->request->allowMethod(['get', 'ajax']);

        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');
        
        $familyDetails = $staffFamilyTable->find()
        ->where(['StaffFamily.id' => $id])
        ->first();



        if ($staffFamilyTable->delete($familyDetails)) {
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

        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');
        
        $familyDetails = $staffFamilyTable->find()
        ->contain(['Relationships'])
        ->where(['StaffFamily.id' => $id])
        ->first();


         if (empty($familyDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No family records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $familyDetails
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

        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['date_of_birth'] = !empty($data['date_of_birth'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['date_of_birth']))
                : null;

        $data['date_of_nominaton'] = !empty($data['date_of_nominaton'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['date_of_nominaton']))
                : null;

                
        // Load table (make sure model name matches your actual table)
        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');

        // Create new entity
        $familyEntity = $staffFamilyTable->newEntity($data);

        // Save record
        if ($staffFamilyTable->save($familyEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Family member added successfully',
                'data' => $familyEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save family member',
                'errors' => $familyEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function lists($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');
        
        $familyDetails = $staffFamilyTable->find()
        ->contain(['Relationships'])
        ->where(['staff_id' => $staffId])
        ->order(['StaffFamily.id' => 'ASC'])
        ->all();

       

        if (empty($familyDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No family records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $familyDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
