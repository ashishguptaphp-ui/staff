<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffRewardController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['delete','update','edit','add','lists']);
        $this->viewBuilder()->setOption('serialize', true);
    }

    public function update($id){
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
       
        unset($data['_Token']);

        $data['yoa'] = $data['reward_year'];
        $data['award'] = $data['reward'];
        
        $staffRewardTable = TableRegistry::getTableLocator()->get('StaffReward');
        
        $rewardDetails = $staffRewardTable->find()
        ->where(['id' => $id])
        ->first();
        $rewardDetails = $staffRewardTable->patchEntity($rewardDetails, $data);

        

        if ($staffRewardTable->save($rewardDetails)) {
            $response = ['status' => 'success', 'message' => 'Updated successfully'];
        } else {
            $response = ['status' => 'error', 'errors' => $rewardDetails->getErrors()];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

   
    public function delete($id){       

        $this->request->allowMethod(['get', 'ajax']);

        $staffRewardTable = TableRegistry::getTableLocator()->get('StaffReward');
        
        $rewardDetails = $staffRewardTable->find()
        ->where(['StaffReward.id' => $id])
        ->first();



        if ($staffRewardTable->delete($rewardDetails)) {
           $response = ['status' => 'success', 'message' => 'Deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Delete failed'];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
    
    public function edit($id){
        $this->request->allowMethod(['get', 'ajax']);

        $staffRewardTable = TableRegistry::getTableLocator()->get('StaffReward');
        
        $rewardDetails = $staffRewardTable->find()
        ->where(['id' => $id])
        ->first();


         if (empty($rewardDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No reward records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $rewardDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function add(){
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
        
        $data['yoa'] = $data['reward_year'];
        $data['award'] = $data['reward'];
        // Load table (make sure model name matches your actual table)
        $staffRewardTable = TableRegistry::getTableLocator()->get('StaffReward');

        // Create new entity
        $rewardEntity = $staffRewardTable->newEntity($data);

        // Save record
        if ($staffRewardTable->save($rewardEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Reward member added successfully',
                'data' => $rewardEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save reward member',
                'errors' => $rewardEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function lists($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffRewardTable = TableRegistry::getTableLocator()->get('StaffReward');

       
        
        $rewardDetails = $staffRewardTable->find()
        ->where(['staff_id' => $staffId])
        ->order(['id' => 'ASC'])
        ->all();

       

        if (empty($rewardDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No reward records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $rewardDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
