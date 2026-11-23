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

use Dompdf\Dompdf;
use Dompdf\Options;

class StaffsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['updatePersonalDetails','updateAddressDetails','updateOtherPersonalDetails','addFamily','familyDetails',
    'uploadDocument','validateFile','deleteDocument','udiseQualDetails','bankAccountDetails','updateLeaveDetails','leaveDetails']);
        $this->viewBuilder()->setOption('serialize', true);
    }

    // GET /api/staffs
    public function index()
    {
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
        $staffs = $staffsTable->find()->limit(100)->all();
       

         $response = [
            'status' => 'success',
            'data' => $staffs,
            '_serialize' => ['status', 'data'],
        ];
        return $this->response->withType('application/json')->withStringBody(json_encode($response));
       
    }

    // GET /api/staffs/{id}
    public function view($id = null)
    {
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
        $staff = $staffsTable->find()->contain(['AcademicQualificationLevels'])
        ->contain(['AcademicQualificationDegrees'])
        ->contain(['Universities'])->where(['id' => $id])->first();

        if (!$staff) {
            throw new NotFoundException(__('Staff not found'));
        }
        $response = [
            'status' => 'success',
            'data' => $staff,
            '_serialize' => ['status', 'data'],
        ];
        return $this->response->withType('application/json')->withStringBody(json_encode($response));

    
    }

    // POST /api/staffs
    public function add()
    {
        $staff = $this->Staffs->newEmptyEntity();
        $staff = $this->Staffs->patchEntity($staff, $this->request->getData());

        if ($this->Staffs->save($staff)) {
            $this->set([
                'status' => 'success',
                'message' => 'Staff added successfully',
                'data' => $staff,
                '_serialize' => ['status', 'message', 'data']
            ]);
        } else {
            $this->set([
                'status' => 'error',
                'message' => 'Unable to add staff',
                'errors' => $staff->getErrors(),
                '_serialize' => ['status', 'message', 'errors']
            ]);
        }
    }

    public function updatePersonalDetails($id = null)
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $staffId = $data['staff_id'];

    
        // Find by emp_staff_id (or staff_id if that’s your column name)
        $staff = $staffsTable->find()
            ->where(['id' => $staffId])
            ->first();

        if(!empty($data['joining_district'])){
            $data['joining_district_date'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_district']));
        }

        if(!empty($data['joining_block'])){
            $data['joining_block_date'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_block']));
        }

        if(!empty($data['joining_mgmt'])){
            $data['joining_mgmt'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_mgmt']));
        }

        if(!empty($data['joining_designation'])){
            $data['joining_designation_date'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_designation']));
        }
        $data['modified_at'] =  date('Y-m-d H:i:s');

        

        $staff = $staffsTable->patchEntity($staff, $data);

        if ($staffsTable->save($staff)) {
            $response = [
                'status' => 'success',
                'statusCode' => 1,
                'message' => 'Staff updated successfully',
                'data' => $staff,
            ];
        } else {
            $response = [
                'status' => 'error',
                'statusCode' => -1,
                'message' => 'Unable to update staff',
                'errors' => $staff->getErrors(),
            ];
        }
        return $this->response->withType('application/json')->withStringBody(json_encode($response));

    }



    public function updateAddressDetails()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $staffId = $data['staff_id'];
        
        $staffAddressesTable = TableRegistry::getTableLocator()->get('StaffAddresses');
        // Check if address record already exists for staff_id
        $existing = $staffAddressesTable->find()
                    ->where(['staff_id' => $staffId])
                    ->first();

        $now = date('Y-m-d H:i:s');

        // Normalize inputs
        $addressData = [
            'permanent_address_line1'   => $data['permanent_address_line1'] ?? null,
            'permanent_address_line2'   => $data['permanent_address_line2'] ?? null,
            'permanent_landmark'        => $data['permanent_landmark'] ?? null,
            'permanent_village_id'      => $data['permanent_village_id'] ?? null,
            'permanent_block_id'        => $data['permanent_block_id'] ?? null,
            'permanent_district_id'     => $data['permanent_district_id'] ?? null,
            'permanent_state_id'        => $data['permanent_state_id'] ?? null,
            'permanent_pincode'         => $data['permanent_pincode'] ?? null,
            'current_address_line1'     => $data['current_address_line1'] ?? null,
            'current_address_line2'     => $data['current_address_line2'] ?? null,
            'current_landmark'          => $data['current_landmark'] ?? null,
            'current_village_id'        => $data['current_village_id'] ?? null,
            'current_block_id'          => $data['current_block_id'] ?? null,
            'current_district_id'       => $data['current_district_id'] ?? null,
            'current_state_id'          => $data['current_state_id'] ?? null,
            'current_pincode'           => $data['current_pincode'] ?? null
        ];

        if ($existing) {
            // Update existing address
            $staffAddress = $staffAddressesTable->patchEntity($existing, $addressData);
            $message = 'Address updated successfully';
        } else {
            // Insert new address
            $addressData['staff_id'] = $staffId;
            $addressData['created_at'] = new FrozenTime();           
            $staffAddress = $staffAddressesTable->newEntity($addressData);
            $message = 'Address added successfully';
        }

        // Save record
        if ($staffAddressesTable->save($staffAddress)) {
            $response = [
                'status' => 'success',
                'message' => $message
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save address',
                'errors' => $staffAddress->getErrors(),
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
            
        

       
    }

    public function updateOtherPersonalDetails()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);
        $staffId = $data['staff_id'];
        $staffOtherDetails = TableRegistry::getTableLocator()->get('StaffOtherDetails');

        $record = $staffOtherDetails->find()
            ->where(['staff_id' => $staffId])
            ->first();
        if ($record) {
            $record = $staffOtherDetails->patchEntity($record, [
                /*'domicile' => (int) $data['domicile'], 
                'border_village' => (int) $data['border_village'],
                'suicide_farmer_child' => (int) $data['suicide_farmer_child'],
                'non_vremy' => (int) $data['non_vremy'],
                'freedom_fighter_ward' => (int) $data['freedom_fighter_ward'],
                'election_1991' => (int) $data['election_1991'],
                'election_1994' => (int) $data['election_1994'],*/
                'mother_tongue' => (int) $data['mother_tongue'],
                'blood_group' => $data['blood_group'],
                'election_card' => $data['election_card'],
                //'ex_servicemen' => (int) $data['ex_servicemen'],
                'height' => $data['height'],
                'weight' => $data['weight'],
                'lang1' => (int) $data['lang1'],
                'lang2' => (int) $data['lang2'],
                'lang3' => (int) $data['lang3'],
                'identification_mark1' => $data['identification_mark1'],
                'identification_mark2' => $data['identification_mark2'],
                'days_spent_non_teaching_assignments' => $data['no_of_non_teaching_working_days'],
                'digital_devices' =>  $data['capable_handling_digital'],
                'deputation_from_other_school' =>  $data['teacher_deputation_school'],
                'teaching_at_other_school_as_guest' =>  $data['teaching_other_school'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $record = $staffOtherDetails->newEntity([
                'staff_id' => $staffId,
                /*'domicile' => (int) $data['domicile'], 
                'border_village' => (int) $data['border_village'],
                'suicide_farmer_child' => (int) $data['suicide_farmer_child'],
                'non_vremy' => (int) $data['non_vremy'],
                'freedom_fighter_ward' => (int) $data['freedom_fighter_ward'],
                'election_1991' => (int) $data['election_1991'],
                'election_1994' => (int) $data['election_1994'],*/
                'mother_tongue' => (int) $data['mother_tongue'],
                'blood_group' => $data['blood_group'],
                'election_card' => $data['election_card'],
                //'ex_servicemen' => (int) $data['ex_servicemen'],
                'height' => $data['height'],
                'weight' => $data['weight'],
                'lang1' => (int) $data['lang1'],
                'lang2' => (int) $data['lang2'],
                'lang3' => (int) $data['lang3'],
                'identification_mark1' => $data['identification_mark1'],
                'identification_mark2' => $data['identification_mark2'],
                'days_spent_non_teaching_assignments' => $data['no_of_non_teaching_working_days'],
                'digital_devices' =>  $data['capable_handling_digital'],
                'deputation_from_other_school' =>  $data['teacher_deputation_school'],
                'teaching_at_other_school_as_guest' =>  $data['teaching_other_school']
            ]);
        }
        
        if ($staffOtherDetails->save($record)) {
            $message = 'Other data updated successfully';
            $response = [
                'status' => 'success',
                'message' => $message
            ];
        } else {
            
                $response = [
                'status' => 'error',
                'message' => 'Unable to save Other details',
                'errors' => $staffOtherDetails->getErrors(),
            ];
        }
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
            
        

       
    }

    
    public function updateLeaveDetails()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);

        $staffId = $data['staff_id'];
        
        $staffLeavesTable = TableRegistry::getTableLocator()->get('StaffLeaves');
        // Check if address record already exists for staff_id
        $existing = $staffLeavesTable->find()
                    ->where(['staff_id' => $staffId])
                    ->first();
       
        if ($existing) {
            // Update existing address
            $staffLeaves = $staffLeavesTable->patchEntity($existing, $data);
            $message = 'Leaves details updated successfully';
        } else {
            // Insert new address
            $addressData['staff_id'] = $staffId;
            $addressData['created_at'] = new FrozenTime();           
            $staffLeaves = $staffLeavesTable->newEntity($data);
            $message = 'Leaves details added successfully';
        }

        // Save record
        if ($staffLeavesTable->save($staffLeaves)) {
            $response = [
                'status' => 'success',
                'message' => $message
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save address',
                'errors' => $staffLeaves->getErrors(),
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
       
    }

    public function leaveDetails($id = null)
    {
        //$leaveable = TableRegistry::getTableLocator()->get('StaffLeaves')->where(['id' => $id])->first();
        $leaveable = TableRegistry::getTableLocator()
            ->get('StaffLeaves')
            ->find()
            ->where(['staff_id' => $id])
            ->first();
       
        $response = [
            'status' => 'success',
            'data' => $leaveable,
            '_serialize' => ['status', 'data'],
        ];
        return $this->response->withType('application/json')->withStringBody(json_encode($response));

    
    }

    public function addFamily1()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $rawBody = $this->getRequest()->getBody()->getContents();
        $data = json_decode($rawBody, true);
        $staffId = $data['staff_id'];
        //unset($data['staff_id']);
        unset($data['_Token']);

        
        $staffFamilyTable = TableRegistry::getTableLocator()->get('staffFamily');

       

        $data['created_at'] = new FrozenTime();   

        

                 
        $staffFamilyTable->newEntity($data);
        $message = 'Address added successfully';
       

        // Save record
        if ($staffFamilyTable->save($data)) {
            $response = [
                'status' => 'success',
                'message' => $message
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to save address',
                'errors' => $staffAddress->getErrors(),
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
            
        

       
    }


    public function addFamily()
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
        $staffId = $data['staff_id'] ?? null;
        unset($data['_Token']);

        // Add timestamps
        $data['created_at'] = new FrozenTime();
        $data['staff_id'] = $staffId;

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

    public function familyDetails($staffId = null)
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



    //family_member_name=&relation_id=&date_of_birth=&aadhar_card_no=&covered_under_family=true
    // DELETE /api/staffs/{id}
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $staff = $this->Staffs->findById($id)->first();

        if (!$staff) {
            throw new NotFoundException('Staff not found');
        }

        if ($this->Staffs->delete($staff)) {
            $this->set([
                'status' => 'success',
                'message' => 'Staff deleted successfully',
                '_serialize' => ['status', 'message']
            ]);
        } else {
            $this->set([
                'status' => 'error',
                'message' => 'Unable to delete staff',
                '_serialize' => ['status', 'message']
            ]);
        }
    }

    public function payDetails($staffId = null)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        
        // Enable CORS if needed
        $this->response = $this->response->withDisabledCache();
        
        $response = ['success' => false, 'message' => 'No data found'];
        
        if ($this->request->is('get')) {
            $staffPayDetails = TableRegistry::getTableLocator()->get('StaffPayDetails');
            $record = $staffPayDetails->find()->where(['staff_id' => $staffId])->first(); 


            if ($record) {
                 $response = [
                    'success' => true,
                    'data' => $record
                ];
            } 
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }

    public function udiseQualDetails($staffId = null)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        
        // Enable CORS if needed
        $this->response = $this->response->withDisabledCache();
        
        $response = ['success' => false, 'message' => 'No data found'];
        
        if ($this->request->is('get')) {
            $staffUdiseQualifications = TableRegistry::getTableLocator()->get('StaffUdiseQualifications');         
            $record = $staffUdiseQualifications->find()->where(['staff_id' => $staffId])->first(); 


            if ($record) {
                 $response = [
                    'success' => true,
                    'data' => $record
                ];
            } 
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }

    public function udiseTrainDetails($staffId = null)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        
        // Enable CORS if needed
        $this->response = $this->response->withDisabledCache();
        
        $response = ['success' => false, 'message' => 'No data found'];
        
        if ($this->request->is('get')) {
            $staffUdiseTrainings = TableRegistry::getTableLocator()->get('StaffUdiseTaining');         
            $record = $staffUdiseTrainings->find()->where(['staff_id' => $staffId])->first(); 


            if ($record) {
                 $response = [
                    'success' => true,
                    'data' => $record
                ];
            } 
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }

    public function bankAccountDetails($staffId = null)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        
        // Enable CORS if needed
        $this->response = $this->response->withDisabledCache();
        
        $response = ['success' => false, 'message' => 'No data found'];
        
        if ($this->request->is('get')) {
            $staffBankDetails = TableRegistry::getTableLocator()->get('StaffBankDetails');
            $record = $staffBankDetails->find()->where(['staff_id' => $staffId])->first(); 


            if ($record) {
                 $response = [
                    'success' => true,
                    'data' => $record
                ];
            } 
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }

    public function bankPfGpfDetails($staffId = null)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        
        // Enable CORS if needed
        $this->response = $this->response->withDisabledCache();
        
        $response = ['success' => false, 'message' => 'No data found'];
        
        if ($this->request->is('get')) {
            $staffPfGpfDetails = TableRegistry::getTableLocator()->get('StaffPfGpfDetails');
            $record = $staffPfGpfDetails->find()->where(['staff_id' => $staffId])->first(); 


            if ($record) {
                 $response = [
                    'success' => true,
                    'data' => $record
                ];
            } 
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }


    /** File Upload start */
    public function otherDetails($staffId = null)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        
        // Enable CORS if needed
        $this->response = $this->response->withDisabledCache();
        
        $response = ['success' => false, 'message' => 'No data found'];
        
        if ($this->request->is('get')) {
            $staffOtherDetails = TableRegistry::getTableLocator()->get('StaffOtherDetails');
            $record = $staffOtherDetails->find()->where(['staff_id' => $staffId])->first(); 


            if ($record) {
                $baseUrl = Router::url('/', true);
                $data = $record->toArray();
                $fileFields = [
                    'domicile_file_path',
                    'border_village_file_path',
                    'suicide_farmer_child_file_path',
                    'non_vremy_file_path',
                    'freedom_fighter_ward_file_path',
                    'election_1991_file_path',
                    'election_1994_file_path'
                ];
                foreach ($fileFields as $field) {
                    if (!empty($data[$field])) {
                        $data[$field] = $baseUrl . $data[$field];
                    }
                }

                $response = [
                    'success' => true,
                    'data' => $data
                ];
                
               
            } 
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }

    public function uploadDocument()
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        
        // Enable CORS if needed
        $this->response = $this->response->withDisabledCache();
        
        $response = ['success' => false, 'message' => 'No file uploaded'];
        
        if ($this->request->is('post')) {
            $fieldName = $this->request->getData('field_name');
            $staffId = $this->request->getData('staff_id', 0);
            
            // Validate field name to prevent SQL injection
            $allowedFields = [
                'domicile', 'border_village', 'suicide_farmer_child',
                'non_vremy', 'freedom_fighter_ward', 'election_1994', 'election_1991'
            ];
            
            if (!in_array($fieldName, $allowedFields)) {
                $response['message'] = 'Invalid field name';
                echo json_encode($response);
                return;
            }
            
            $file = $this->request->getData('file');
            
            if ($file && $file->getError() === UPLOAD_ERR_OK) {
                // Validate file
                if (!$this->validateFile($file)) {
                    $response['message'] = 'Invalid file type or size';
                    echo json_encode($response);
                    return;
                }
                
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

                    $fieldNameWithPath = $fieldName . '_file_path';                   

                    if ($record) {
                        $record = $staffOtherDetails->patchEntity($record, [
                            $fieldNameWithPath => $filePath,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    } else {
                        $record = $staffOtherDetails->newEntity([
                            'staff_id' => $staffId,
                            $fieldNameWithPath => $filePath,
                        ]);
                    }
                   
                    if ($staffOtherDetails->save($record)) {
                        $response = [
                            'success' => true,
                            'file_path' =>  Router::url('/', true). $filePath,
                            'original_name' => $originalName
                        ];
                    } else {
                        // If save fails, delete the uploaded file
                        unlink($absolutePath);
                        $response['message'] = 'Failed to save to database';
                    }
                } catch (\Exception $e) {
                    $response['message'] = 'Upload failed: ' . $e->getMessage();
                }
            } else {
                $response['message'] = 'File upload error';
            }
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }

    private function validateFile($file)
    {
        // Validate file size (5MB max)
        $maxSize = 5 * 1024 * 1024;
        if ($file->getSize() > $maxSize) {
            return false;
        }
        
        // Validate file type
        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        $clientMime = $file->getClientMediaType();
        
        // Also check extension for extra security
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
        $extension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
        
        return in_array($clientMime, $allowedMimeTypes) && 
               in_array($extension, $allowedExtensions);
    }

    public function deleteDocument()
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        
        $response = ['success' => false, 'message' => 'Invalid request'];
        
        if ($this->request->is('post')) {
            $filePath = $this->request->getData('file_path');
            $fieldName = $this->request->getData('field_name');
            $staffId = $this->request->getData('staff_id', 0);
            
            // Validate field name
            $allowedFields = [
                'domicile', 'border_village', 'suicide_farmer_child',
                'non_vremy', 'freedom_fighter_ward', 'election_1994', 'election_1991'
            ];
            
            if (!in_array($fieldName, $allowedFields)) {
                $response['message'] = 'Invalid field name';
                echo json_encode($response);
                return;
            }
            
            try {
                // Delete file from server
                if ($filePath && file_exists(WWW_ROOT . $filePath)) {
                    unlink(WWW_ROOT . $filePath);
                }
                
                // Update database to remove file path
                $staffOtherDetailsTable = TableRegistry::getTableLocator()->get('StaffOtherDetails');
                $staffOtherDetails = $staffOtherDetailsTable->find()->where(['staff_id' => $staffId])->first();

                $fieldNameWithPath = $fieldName . '_file_path';
                $staffOtherDetails->$fieldNameWithPath = null;
                
                if ($staffOtherDetailsTable->save($staffOtherDetails)) {
                    $response = ['success' => true];
                } else {
                    $response['message'] = 'Failed to update database';
                }
            } catch (\Exception $e) {
                $response['message'] = 'Error: ' . $e->getMessage();
            }
        }
        
        $this->response = $this->response->withType('application/json');
        echo json_encode($response);
    }

    public function profilePdf($staffId = null)
    {
        ini_set('memory_limit', '512M');
        $this->viewBuilder()->disableAutoLayout();

        //$this->viewBuilder()->setLayout('school');

        /*if (!$staffId) {
            $this->Flash->error('Teacher not found.');
            return $this->redirect(['action' => 'teachingStaff']);
        }*/

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
        $staffAddressesTable = TableRegistry::getTableLocator()->get('StaffAddresses');
                   
        $staffDetails = $staffsTable->find()       
                                    ->contain(['CasteCategories'])
                                    ->contain(['Posts'])
                                    ->contain(['StaffsTypes'])
                                    ->contain(['Genders'])
                                    ->where(['Staffs.id' => $staffId])
                                    ->first();
                                 
        $staffDetails->address = $staffAddressesTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();
                                            
        /*echo "<pre>";
        print_r($staffDetails);
        exit;*/
        $staffUpdateModeTable = TableRegistry::getTableLocator()->get('StaffUpdateMode');
        


        $relationshipsTable = TableRegistry::getTableLocator()->get('Relationships');
        $nominationTypesTable = TableRegistry::getTableLocator()->get('NominationTypes');
        $districtTable = TableRegistry::getTableLocator()->get('LgdDistricts');
        $languagesTable = TableRegistry::getTableLocator()->get('Languages');
        $subjectsTable = TableRegistry::getTableLocator()->get('Subjects');
        $postsTable = TableRegistry::getTableLocator()->get('Posts');
        $staffsDesignationsTable = TableRegistry::getTableLocator()->get('StaffsDesignations');

        
        $appointmentTypesTable = TableRegistry::getTableLocator()->get('AppointmentTypes');
        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $disabilityTypesTable = TableRegistry::getTableLocator()->get('DisabilityTypes');
        $mediumsTable = TableRegistry::getTableLocator()->get('Mediums');


        
        $casteValidAuthorityTable = TableRegistry::getTableLocator()->get('CasteValidAuthority');


                   
        $staffUPDetails = $staffUpdateModeTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();


        

     
        
 
        $relationships = $relationshipsTable->find()
                        ->all();

        $nominations = $nominationTypesTable->find()
                        ->all();

        $districts = $districtTable->find()
                        ->all();
        $languages = $languagesTable->find()
                        ->all();
        $casteValidAuthority = $casteValidAuthorityTable->find()
                        ->all();

        $subjects = $subjectsTable->find()
                        ->all();
        $appointment_types = $appointmentTypesTable->find()
                        ->all();
        $posts = $postsTable->find()->all();
        
        $staffsDesignations = $staffsDesignationsTable->find()->all();


        $castes = $casteCategoriesTable->find()
                        ->all();

        $horizontalCategories = $horizontalCategoriesTable->find()->where(['active' => 1])
                        ->all();

                      

        $disabilityTypes = $disabilityTypesTable->find()
                        ->all();

                        
                        
        $mediums = $mediumsTable->find()
                        ->all();
                        
                        
            /*echo "<pre>";
        print_r($relationships);  
        exit;*/
      
        /*
        if (!$staff) {
            $this->Flash->error('Teacher record not found.');
            return $this->redirect(['action' => 'teachingStaff']);
        }*/

           
        $this->set('staff', $staffDetails);
       // $this->set('updateMode', $staffUPDetails->mode);
        $this->set('relationships', $relationships);
        $this->set('nominations', $nominations);
        $this->set('districts', $districts);
        $this->set('languages', $languages);
        $this->set('subjects', $subjects);
        $this->set('appointment_types', $appointment_types);
        $this->set('posts', $posts);  
        $this->set('staffsDesignations', $staffsDesignations);  

        
        $this->set('castes', $castes); 

        $this->set('horizontalCategories', $horizontalCategories); 
        $this->set('disabilityTypes', $disabilityTypes);
        $this->set('mediums', $mediums);

        

        

        

        
        $this->set('casteValidAuthority', $casteValidAuthority);

        
        
        
        $html = (string) $this->render()->getBody();
        
        $htmlFile = TMP . 'staff_profile_'.$staffId.'.html';
        

        $outputPath = WWW_ROOT.'uploads/profiles/staff_profile_'.$staffId.'.pdf';
        file_put_contents($htmlFile, $html);


         $cmd = sprintf(
            'wkhtmltopdf --enable-local-file-access --encoding UTF-8 --page-size A4 %s %s',
            escapeshellarg($htmlFile),
            escapeshellarg($outputPath)
        );

       // exec($cmd, $output, $status);


        exec($cmd . ' 2>&1', $output, $status);

        if ($status !== 0) {
            throw new \RuntimeException(
                "wkhtmltopdf failed:\n" . implode("\n", $output)
            );
        }


        if ($status !== 0) {
            throw new \RuntimeException('PDF generation failed');
        }

        echo $outputPath;
        exit;


        // Dompdf config
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Stream PDF
        return $this->response
            ->withType('application/pdf')
            ->withStringBody($dompdf->output())
            ->withHeader(
                'Content-Disposition',
                'inline; filename="Work_Experience_'.$staffId.'.pdf"'
            );
    }

    public function profile($staffId = null)
    {

        $this->viewBuilder()->disableAutoLayout();

        //$this->viewBuilder()->setLayout('school');

        /*if (!$staffId) {
            $this->Flash->error('Teacher not found.');
            return $this->redirect(['action' => 'teachingStaff']);
        }*/

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
        $staffAddressesTable = TableRegistry::getTableLocator()->get('StaffAddresses');
                   
        $staffDetails = $staffsTable->find()       
                                    ->contain(['CasteCategories'])
                                    ->contain(['Posts'])
                                    ->contain(['StaffsTypes'])
                                    ->contain(['Genders'])
                                    ->where(['Staffs.id' => $staffId])
                                    ->first();
                                 
        $staffDetails->address = $staffAddressesTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();
                                            
        /*echo "<pre>";
        print_r($staffDetails);
        exit;*/
        $staffUpdateModeTable = TableRegistry::getTableLocator()->get('StaffUpdateMode');
        


        $relationshipsTable = TableRegistry::getTableLocator()->get('Relationships');
        $nominationTypesTable = TableRegistry::getTableLocator()->get('NominationTypes');
        $districtTable = TableRegistry::getTableLocator()->get('LgdDistricts');
        $languagesTable = TableRegistry::getTableLocator()->get('Languages');
        $subjectsTable = TableRegistry::getTableLocator()->get('Subjects');
        $postsTable = TableRegistry::getTableLocator()->get('Posts');
        $staffsDesignationsTable = TableRegistry::getTableLocator()->get('StaffsDesignations');

        
        $appointmentTypesTable = TableRegistry::getTableLocator()->get('AppointmentTypes');
        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $disabilityTypesTable = TableRegistry::getTableLocator()->get('DisabilityTypes');
        $mediumsTable = TableRegistry::getTableLocator()->get('Mediums');


        
        $casteValidAuthorityTable = TableRegistry::getTableLocator()->get('CasteValidAuthority');


                   
        $staffUPDetails = $staffUpdateModeTable->find()
                        ->where(['staff_id' => $staffId])
                        ->first();


        

     
        
 
        $relationships = $relationshipsTable->find()
                        ->all();

        $nominations = $nominationTypesTable->find()
                        ->all();

        $districts = $districtTable->find()
                        ->all();
        $languages = $languagesTable->find()
                        ->all();
        $casteValidAuthority = $casteValidAuthorityTable->find()
                        ->all();

        $subjects = $subjectsTable->find()
                        ->all();
        $appointment_types = $appointmentTypesTable->find()
                        ->all();
        $posts = $postsTable->find()->all();
        
        $staffsDesignations = $staffsDesignationsTable->find()->all();


        $castes = $casteCategoriesTable->find()
                        ->all();

        $horizontalCategories = $horizontalCategoriesTable->find()->where(['active' => 1])
                        ->all();

                      

        $disabilityTypes = $disabilityTypesTable->find()
                        ->all();

                        
                        
        $mediums = $mediumsTable->find()
                        ->all();
                        
                        
            /*echo "<pre>";
        print_r($relationships);  
        exit;*/
      
        /*
        if (!$staff) {
            $this->Flash->error('Teacher record not found.');
            return $this->redirect(['action' => 'teachingStaff']);
        }*/

           
        $this->set('staff', $staffDetails);
       // $this->set('updateMode', $staffUPDetails->mode);
        $this->set('relationships', $relationships);
        $this->set('nominations', $nominations);
        $this->set('districts', $districts);
        $this->set('languages', $languages);
        $this->set('subjects', $subjects);
        $this->set('appointment_types', $appointment_types);
        $this->set('posts', $posts);  
        $this->set('staffsDesignations', $staffsDesignations);  

        
        $this->set('castes', $castes); 

        $this->set('horizontalCategories', $horizontalCategories); 
        $this->set('disabilityTypes', $disabilityTypes);
        $this->set('mediums', $mediums);

        

        

        

        
        $this->set('casteValidAuthority', $casteValidAuthority);

    }
}