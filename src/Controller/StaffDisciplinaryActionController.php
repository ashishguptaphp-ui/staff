<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffDisciplinaryActionController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['add','lists','delete']);
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
        // Load table (make sure model name matches your actual table)
        $staffDisciplinaryActionTable = TableRegistry::getTableLocator()->get('StaffDisciplinaryAction');

        // Create new entity
        $actionEntity = $staffDisciplinaryActionTable->newEntity($data);

        // Save record
        if ($staffDisciplinaryActionTable->save($actionEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Disability member added successfully',
                'data' => $actionEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save disability member',
                'errors' => $actionEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function lists($staffId)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffDisciplinaryActionTable = TableRegistry::getTableLocator()->get('StaffDisciplinaryAction');
               
        $details = $staffDisciplinaryActionTable->find()->where(['staff_id' => $staffId])->all();

       
        $response = [
            'status' => 'success',
            'data' => $details
        ];
       

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);

        $staffDisciplinaryActionTable = TableRegistry::getTableLocator()->get('StaffDisciplinaryAction');
               
        $action = $staffDisciplinaryActionTable->find()->where(['id' => $id])->first();




        if (!$action) {
            throw new NotFoundException('Daction not found');
        }

        if ($staffDisciplinaryActionTable->delete($action)) {
              $response =[
                'status' => 'success',
                'message' => 'Action deleted successfully',
                '_serialize' => ['status', 'message']
            ];
        } else {
            $response =[
                'status' => 'error',
                'message' => 'Unable to delete Action',
                '_serialize' => ['status', 'message']
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
