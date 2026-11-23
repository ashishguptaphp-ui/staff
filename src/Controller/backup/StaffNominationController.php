<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffNominationController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['add','lists']);
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
        $data['date_of_nomination'] = !empty($data['date_of_nomination'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['date_of_nomination']))
                : null;

        // Load table (make sure model name matches your actual table)
        $staffNominationTable = TableRegistry::getTableLocator()->get('StaffNomination');

        // Create new entity
        $nominationEntity = $staffNominationTable->newEntity($data);

        // Save record
        if ($staffNominationTable->save($nominationEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Nomination member added successfully',
                'data' => $nominationEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save nomination member',
                'errors' => $nominationEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function lists($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
       // $staffNominationTable = TableRegistry::getTableLocator()->get('StaffNomination');
        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');
        
        $nominationDetails = $staffFamilyTable->find()  
        ->where(['StaffFamily.staff_id' => $staffId])
        ->where(['StaffFamily.covered_under_family' => true])
        ->order(['StaffFamily.id' => 'ASC'])
        ->all();
        
        $response = [
            'status' => 'success',
            'data' => $nominationDetails
        ];
        

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
