<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class TetController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['examPepers','examResults','addStaffExamDetails','staffExamDetails','delete']);
        $this->viewBuilder()->setOption('serialize', true);
    }

   

   
    public function delete($id)
    {       

        $this->request->allowMethod(['get', 'ajax']);

        $staffTetResultsTable = TableRegistry::getTableLocator()->get('StaffTetResults');
        
        $tetDetails = $staffTetResultsTable->find()
        ->where(['id' => $id])
        ->first();



        if ($staffTetResultsTable->delete($tetDetails)) {
           $response = ['status' => 'success', 'message' => 'Deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Delete failed'];
        }

         return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
    

    public function staffExamDetails($staff_id)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffTetResultsTable = TableRegistry::getTableLocator()->get('StaffTetResults');
        
        


        $tetDetails = $staffTetResultsTable->find()
            ->where(['staff_id' => $staff_id])
            ->orderBy(['year' => 'DESC'])  
            ->all();
       

        if (empty($tetDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No Exam records found for this year.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $tetDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function addStaffExamDetails($staff_id,$tet_id)
    {
        $this->request->allowMethod(['get', 'ajax']);
       

        $tetResultsTable = TableRegistry::getTableLocator()->get('TetResults');

        $tetDetails = $tetResultsTable->find()
            ->where(['id' => $tet_id])
            ->firstOrFail();

        $staffTetResultsTable = TableRegistry::getTableLocator()->get('StaffTetResults');

        $entity = $staffTetResultsTable->newEntity([
            'staff_id' => $staff_id,  
            'tet_result_id' => $tetDetails->id,            
            'year' => $tetDetails->year,
            'roll_no' => $tetDetails->roll_no,
            'paper_name' => $tetDetails->paper_name,
            'candidate_name' => $tetDetails->candidate_name,
            'exam_medium' => $tetDetails->exam_medium,
            'category' => $tetDetails->category,
            'is_handicapped' => $tetDetails->is_handicapped,
            'is_ex_serviceman_wife_or_sibling' => $tetDetails->is_ex_serviceman_wife_or_sibling,
            'language2_name' => $tetDetails->language2_name,
            'total_marks' => $tetDetails->total_marks,
            'min_marks_required' => $tetDetails->min_marks_required,
            'obtained_marks' => $tetDetails->obtained_marks,
            'obtained_percentage' => $tetDetails->obtained_percentage,
            'required_percentage' => $tetDetails->required_percentage,
            'eligibility' => $tetDetails->eligibility,
            'result_date' => $tetDetails->result_date,
            'certificate_no' => $tetDetails->certificate_no,
        ]);

        if ($staffTetResultsTable->save($entity)) {
            $response = [
                'status' => 'success'
            ];
        } else {
             $response = [
                'status' => 'fail'
            ];
        }       

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));


    }

    public function examResults()
    {
        $this->request->allowMethod(['post', 'ajax']);

        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);


        $year = $data['exam_year'];
        $paper_name = $data['exam_paper'];
        $roll_no = $data['roll_number'];

        $tetResultsTable = TableRegistry::getTableLocator()->get('TetResults');  
        $tetDetails = $tetResultsTable->find()       
                ->where(['year' => $year])
                ->where(['paper_name' => $paper_name])
                ->where(['roll_no' => $roll_no])
                ->first();


        if (empty($tetDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No work records found for this provided details.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $tetDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    

    public function examPepers($year = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $tetResultsTable = TableRegistry::getTableLocator()->get('TetResults');
        
        


        $tetDetails = $tetResultsTable->find()
            ->select(['paper_name'])
            ->distinct()  
            ->where(['year' => $year])
            ->orderBy(['paper_name' => 'ASC'])  
            ->all();
       

        if (empty($tetDetails)) {
            $response = [
                'status' => 'empty',
                'message' => 'No Exam records found for this year.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $tetDetails
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
