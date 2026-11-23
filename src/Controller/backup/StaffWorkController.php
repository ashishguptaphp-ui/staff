<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffWorkController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['delete','update','edit','add','lists','addWork','workDetails']);
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

        $data['school_udise'] = $data['work_udise'];
        $data['school_name'] = $data['work_school'];
        $data['school_aid_type_id'] = $data['work_school_aid_type'];
        $data['school_category_id'] = $data['work_school_category'];
        $data['post_id'] = $data['work_school_post'];
        $data['work_in_pesa'] = $data['work_school_is_pesa'];
        $data['work_in_diff_area'] = $data['work_school_is_difficult_area'];
        $data['school_leving_mode'] = $data['work_school_change_reason'];
        
        // Add timestamps
        $data['updated_at'] = new FrozenTime();
        $data['start_date'] = !empty($data['work_school_from_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['work_school_from_date']))
                : null;

        $data['end_date'] = !empty($data['work_school_to_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['work_school_to_date']))
                : null;


        
        $staffWorkTable = TableRegistry::getTableLocator()->get('StaffWork');
        
        $workDetails = $staffWorkTable->find()
        ->where(['id' => $id])
        ->first();
        $workDetails = $staffWorkTable->patchEntity($workDetails, $data);

        

        if ($staffWorkTable->save($workDetails)) {
            $response = ['status' => 'success', 'message' => 'Updated successfully'];
        } else {
            $response = ['status' => 'error', 'errors' => $workDetails->getErrors()];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

   
    public function delete($id)
    {       

        $this->request->allowMethod(['get', 'ajax']);

        $staffWorkTable = TableRegistry::getTableLocator()->get('StaffWork');
        
        $workDetails = $staffWorkTable->find()
        ->where(['StaffWork.id' => $id])
        ->first();



        if ($staffWorkTable->delete($workDetails)) {
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

        $staffWorkTable = TableRegistry::getTableLocator()->get('StaffWork');

        $aidedTypesTable = TableRegistry::getTableLocator()->get('AidedTypes');                   
        $aidedTypesDetails = $aidedTypesTable->find()->order(['name' => 'ASC'])->all();

        $postsTable = TableRegistry::getTableLocator()->get('Posts');                   
        $postDetails = $postsTable->find()->order(['seq_no' => 'ASC'])->all();

        $schoolCategoryTable = TableRegistry::getTableLocator()->get('SchoolCategories');                   
        $schoolCategories = $schoolCategoryTable->find()->order(['code' => 'ASC'])->all();

        


        
        $workDetails = $staffWorkTable->find()
        ->contain(['AidedTypes'])
        ->contain(['SchoolCategories'])
        ->contain(['Posts'])
        ->where(['StaffWork.id' => $id])
        ->first();


         if (empty($workDetails)) {
            $response = [
                'status' => 'empty',
                'aidedTypes' => $aidedTypesDetails,
                'posts' => $postDetails,
                'schoolCategories' => $schoolCategories,
                'message' => 'No work records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $workDetails,
                'aidedTypes' => $aidedTypesDetails,
                'posts' => $postDetails,
                'schoolCategories' => $schoolCategories
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

        $data['school_udise'] = $data['work_udise'];
        $data['school_name'] = $data['work_school'];
        $data['school_aid_type_id'] = $data['work_school_aid_type'];
        $data['school_category_id'] = $data['work_school_category'];
        $data['post_id'] = $data['work_school_post'];
        $data['work_in_pesa'] = $data['work_school_is_pesa'];
        $data['work_in_diff_area'] = $data['work_school_is_difficult_area'];
        $data['school_leving_mode'] = $data['work_school_change_reason'];
        
        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['start_date'] = !empty($data['work_school_from_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['work_school_from_date']))
                : null;

        $data['end_date'] = !empty($data['work_school_to_date'])
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['work_school_to_date']))
                : null;

                
        // Load table (make sure model name matches your actual table)
        $staffWorkTable = TableRegistry::getTableLocator()->get('StaffWork');

        // Create new entity
        $workEntity = $staffWorkTable->newEntity($data);

        // Save record
        if ($staffWorkTable->save($workEntity)) {
            $response = [
                'status' => 'success',
                'message' => 'Work member added successfully',
                'data' => $workEntity
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save work member',
                'errors' => $workEntity->getErrors()
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function lists($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffWorkTable = TableRegistry::getTableLocator()->get('StaffWork');
        
        $workDetails = $staffWorkTable->find()
        ->contain(['AidedTypes'])
        ->contain(['SchoolCategories'])
        ->contain(['Posts'])
        ->where(['staff_id' => $staffId])
        ->order(['StaffWork.id' => 'ASC'])
        ->all();

       

        if (empty($workDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No work records found for this staff member.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $workDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
