<?php
declare(strict_types=1);
namespace App\Controller\Api;

use App\Controller\Api\AppController as ApiAppController;
use Cake\Event\EventInterface;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Http\Response;
use Cake\Http\CallbackStream;
use Cake\Utility\Security;
use Cake\Http\Exception\BadRequestException;
use Cake\Routing\Router;
use Cake\Http\Client;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

use Cake\Core\Configure;
use Laminas\Diactoros\UploadedFile;
use App\Service\EsdlStorageService;


class StaffController extends ApiAppController
{

    private $user_id=0;
    private $username='';
    public function initialize(): void
    {
        parent::initialize();

        // Load Authentication component explicitly (if not globally loaded in AppController)
        $this->loadComponent('Authentication.Authentication');
        $this->getEventManager()->off($this->FormProtection);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Allow unauthenticated users to access login and register
        $this->Authentication->addUnauthenticatedActions(['updatePersonalDetails','updateAddressDetails','updateOtherPersonalDetails',
            'familyLists','addFamily','updateFamily','removeFamily','updateCaste'
        ]);
        
        $token = $this->request->getHeaderLine('Authorization');
        $staff_id = $this->request->getHeaderLine('staff-id');
        $username = $this->request->getHeaderLine('username');

        if (!$token) {
                return $this->error('Token missing', 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $tokenHash = hash('sha256', $token);
        $staffMobileAppLoginAudit = TableRegistry::getTableLocator()->get('StaffMobileAppLoginAudit');  

        $audit = $staffMobileAppLoginAudit->find()
                ->where(['token_hash' => $tokenHash, 'is_active' => 1])
                ->first();
        
            /*echo "<pre>dfdfdf";
            print_r( $audit);
            exit;*/
        if (!$audit) {
            return $this->error('Invalid username session', 401);
        }else if ($username != $audit->username) {
            return $this->error('Invalid username', 401);
        }else if ($staff_id != $audit->staff_id) {
            return $this->error('Invalid staff id', 401);
        }

        $this->user_id = $staff_id;
        $this->username = $username;
    
    
    }

    public function updatePersonalDetails()
    {
        
        $this->request->allowMethod(['patch']);

        $body = $this->request->getData();

        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        $payloadEncrypted = $body['payload'] ?? null;
        $data = (array) json_decode($this->decryptData($payloadEncrypted));

        $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        /*echo "<pre>123";
        //print_r($body);
        print_r($data);
        exit;*/

        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $staffId = $this->user_id;
    
        // Find by emp_staff_id (or staff_id if that’s your column name)
        $staff = $staffsTable->find()
            ->where(['id' => $staffId])
            ->first();

        if(!empty($data['joining_district_date'])){
            $data['joining_district_date'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_district_date']));
        }

        if(!empty($data['joining_block_date'])){
            $data['joining_block_date'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_block_date']));
        }

        if(!empty($data['joining_mgmt'])){
            $data['joining_mgmt'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_mgmt']));
        }

        if(!empty($data['joining_designation_date'])){
            $data['joining_designation_date'] = new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['joining_designation_date']));
        }
        $data['modified_at'] =  date('Y-m-d H:i:s');

        

        $staff = $staffsTable->patchEntity($staff, $data);

        if ($staffsTable->save($staff)) {
            return $this->respond([
                'message' => "Data updated successfully"
            ]);
        } else {
            return $this->error('Unable to update data', 422);
        }

    }

    public function updateAddressDetails()
    {
        $this->request->allowMethod(['patch']);   
        $body = $this->request->getData();
        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        //echo $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        //exit;
        $payloadEncrypted = $body['payload'] ?? null;
        $data = (array) json_decode($this->decryptData($payloadEncrypted));
        /*echo "<pre>123";
       // print_r($body['dataFormatDoNotUseThisProperty']);
        print_r($data);
        exit;*/
        $staffId = $this->user_id;      
        
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
            $addressData['updated_at'] = new FrozenTime();
            $staffAddress = $staffAddressesTable->patchEntity($existing, $addressData);
        } else {
            // Insert new address
            $addressData['staff_id'] = $staffId;
            $addressData['created_at'] = new FrozenTime();           
            $staffAddress = $staffAddressesTable->newEntity($addressData);
        }

        // Save record
        if ($staffAddressesTable->save($staffAddress)) {
            return $this->respond([
                'message' => "Data updated successfully"
            ]);
        } else {
            return $this->error('Unable to update data', 422);
        }    
    }

    public function updateOtherPersonalDetails()
    {
        
        $this->request->allowMethod(['patch']);   
        $body = $this->request->getData();
        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        //echo $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        //exit;
        $payloadEncrypted = $body['payload'] ?? null;
        $data = (array) json_decode($this->decryptData($payloadEncrypted));
        /*echo "<pre>123";
        print_r($body['dataFormatDoNotUseThisProperty']);
        print_r($data);
        exit;*/

        $staffId = $this->user_id;              
        $staffOtherDetails = TableRegistry::getTableLocator()->get('StaffOtherDetails');
        $existing = $staffOtherDetails->find()
                    ->where(['staff_id' => $staffId])
                    ->first();

        $now = date('Y-m-d H:i:s');

        // Normalize inputs
        $otherData = [
            'mother_tongue' => (int) $data['mother_tongue'],
            'blood_group' => $data['blood_group'] ?? null,
            'election_card' => $data['election_card'] ?? null,
            'height' => $data['height'] ?? null,
            'weight' => $data['weight'] ?? null,
            'lang1' => (int) $data['lang1'] ?? null,
            'lang2' => (int) $data['lang2'] ?? null,
            'lang3' => (int) $data['lang3'] ?? null,
            'identification_mark1' => $data['identification_mark1'] ?? null,
            'identification_mark2' => $data['identification_mark2'] ?? null,
            'days_spent_non_teaching_assignments' => $data['no_of_non_teaching_working_days'] ?? null,
            'digital_devices' =>  $data['capable_handling_digital'] ?? null,
            'deputation_from_other_school' =>  $data['teacher_deputation_school'] ?? null,
            'teaching_at_other_school_as_guest' =>  $data['teaching_other_school'] ?? null
        ];
        

        if ($existing) {
            $otherData['updated_at'] = new FrozenTime();
            $staffOther = $staffOtherDetails->patchEntity($existing, $otherData);
        } else {
            // Insert new address
            $otherData['staff_id'] = $staffId;
            $otherData['created_at'] = new FrozenTime();           
            $staffOther = $staffOtherDetails->newEntity($otherData);
        }

        // Save record
        if ($staffOtherDetails->save($staffOther)) {
            return $this->respond([
                'message' => "Data updated successfully"
            ]);
        } else {
            return $this->error('Unable to update data', 422);
        }   
    }

    public function familyLists()
    {
        $this->request->allowMethod(['get']);
        $staffId = $this->user_id;         
        $staffFamilyTable = TableRegistry::getTableLocator()->get('StaffFamily');
        
        $familyDetails = $staffFamilyTable->find()
        ->contain(['Relationships'])
        ->where(['staff_id' => $staffId])
        ->order(['StaffFamily.id' => 'ASC'])
        ->all();

        if (!$familyDetails) {
            return $this->error('No data found', 401);
        }
        return $this->respond([
            'familyList' => $familyDetails
        ]);
    }
    

    public function addFamily()
    {        
        $this->request->allowMethod(['post']);   
        $body = $this->request->getData();
        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        //echo $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        //exit;
        $payloadEncrypted = $body['payload'] ?? null;
        $data = (array) json_decode($this->decryptData($payloadEncrypted));
        /*echo "<pre>123";
        print_r($body['dataFormatDoNotUseThisProperty']);
        print_r($data);
        exit;*/

        $staffId = $this->user_id; 
        $tableName = 'StaffFamily';             
         // Normalize inputs
        $newData = [
            'staff_id' => $staffId,
            'created_at' => new FrozenTime(),
            'family_member_name' => $data['family_member_name'] ?? null,
            'relation_id' => (int) $data['relation_id'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'aadhar_card_no' => $data['aadhar_card_no'] ?? null,
            'covered_under_family' => (int) $data['covered_under_family'] ?? null,
            'date_of_nomination' => $data['date_of_nomination'] ?? null,
            'nomination_percentage' =>  $data['nomination_percentage'] ?? null
        ];        

        $tableObject = TableRegistry::getTableLocator()->get($tableName);              
        $tableRecord = $tableObject->newEntity($newData);        

        // Save record
        if ($tableObject->save($tableRecord)) {
            return $this->respond([
                'message' => "Data updated successfully"
            ]);
        } else {
            return $this->error('Unable to update data', 422);
        }   
    }

    public function updateFamily()
    {        
        $this->request->allowMethod(['put']);   
        $body = $this->request->getData();
        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        //echo $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        //exit;
        $payloadEncrypted = $body['payload'] ?? null;
        $data = (array) json_decode($this->decryptData($payloadEncrypted));
        /*echo "<pre>123";
        print_r($body['dataFormatDoNotUseThisProperty']);
        print_r($data);
        exit;*/

        $staffId = $this->user_id; 
        $tableName = 'StaffFamily';             
         // Normalize inputs
        $newData = [
            'staff_id' => $staffId,
            'updated_at' => new FrozenTime(),
            'family_member_name' => $data['family_member_name'] ?? null,
            'relation_id' => (int) $data['relation_id'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'aadhar_card_no' => $data['aadhar_card_no'] ?? null,
            'covered_under_family' => (int) $data['covered_under_family'] ?? null,
            'date_of_nomination' => $data['date_of_nomination'] ?? null,
            'nomination_percentage' =>  $data['nomination_percentage'] ?? null
        ];        

        $tableObject = TableRegistry::getTableLocator()->get($tableName);  

        $existing = $tableObject->find()
                    ->where(['id' => $data['family_id']])
                    ->first();

        if(!$existing){
            return $this->error('Unable to update data', 422);
        }
        $tableRecord = $tableObject->patchEntity($existing, $newData);  
        // Save record
        if ($tableObject->save($tableRecord)) {
            return $this->respond([
                'message' => "Data updated successfully"
            ]);
        } else {
            return $this->error('Unable to update data', 422);
        }   
    }

    public function removeFamily()
    {
        $this->request->allowMethod(['delete']);

        $body = $this->request->getData();

        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        //echo $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        //exit;

        // 🔓 Decrypt payload
        $payloadEncrypted = $body['payload'] ?? null;        
        $data = (array) json_decode($this->decryptData($payloadEncrypted));

        $staffId = $this->user_id;
        $tableName = 'StaffFamily';

        $tableObject = TableRegistry::getTableLocator()->get($tableName);

        // 🔍 Find record (ensure ownership)
        $existing = $tableObject->find()
            ->where([
                'id' => $data['family_id'],
                'staff_id' => $staffId
            ])
            ->first();

        if (!$existing) {
            return $this->error('Record not found', 404);
        }

        // ❌ Delete record
        if ($tableObject->delete($existing)) {
            return $this->respond([
                'message' => 'Record deleted successfully'
            ]);
        }

        return $this->error('Unable to delete data', 500);
    }

    
    public function updateCaste()
    {
        /*$pau = [
             "religion"=> "1",
            "caste" => 2,
            "certificate_issuing_authority" => 3,
            "certificate_place" => "Mumbai",
            "certificate_file" => "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO7Z0WQAAAAASUVORK5CYII=",
            "certificate_remarks" => 29,
            "certificate_validation_no" => 27,
            "certificate_validation_authority" => "416003",
            "certificate_validation_place" => "Plot No 22, Sai Nagar",
            "certificate_validation_file" => "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO7Z0WQAAAAASUVORK5CYII=",
            "certificate_validation_remarks" => 12345
        ];
       $data = $this->encryptData(json_encode($pau));
        print_r($data);
        exit;*/
        
        $this->request->allowMethod(['patch']);   
        $body = $this->request->getData();
        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        //echo $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        //exit;
        $payloadEncrypted = $body['payload'] ?? null;
        $data = (array) json_decode($this->decryptData($payloadEncrypted));
        /*echo "<pre>12345";
       // print_r($body['dataFormatDoNotUseThisProperty']);
        print_r($data);
        exit;*/
        $staffId = $this->user_id;      
        ///


        $staffCasteTable = TableRegistry::getTableLocator()->get('StaffCaste');

        // Check if record exists
        $caste = $staffCasteTable->find()
            ->where(['staff_id' => $staffId])
            ->first();

        // If not exists, create new record
        if (!$caste) {
            $caste = $staffCasteTable->newEmptyEntity();
            $caste->staff_id = $staffId;
            $caste->created_at = new FrozenTime();
            $message = 'New staff record created successfully';
        } else {
            $message = 'Staff data updated successfully';
            $caste->updated_at = new FrozenTime();
        }      


        $caste->certificate_date = (!empty($data['certificate_date']) && $data['certificate_date']!='-')
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['certificate_date']))
                : null;

        $caste->certificate_validation_date = (!empty($data['certificate_validation_date']) && $data['certificate_validation_date']!='-')
                ? new FrozenTime(\DateTime::createFromFormat('d/m/Y', $data['certificate_validation_date']))
                : null;


        $caste->religion =  $data['religion'] ?? null;
        $caste->caste =  $data['caste'] ?? null;
        $caste->certificate_issuing_authority =  $data['certificate_issuing_authority'] ?? null;
        $caste->certificate_place =  $data['certificate_place'] ?? null;
       // $caste->certificate_file =  $data['certificate_file'] ?? null;
        $caste->certificate_remarks =  $data['certificate_remarks'] ?? null;
        $caste->certificate_validation_no =  $data['certificate_validation_no'] ?? null;
        $caste->certificate_validation_authority =  $data['certificate_validation_authority'] ?? null;
        $caste->certificate_validation_place =  $data['certificate_validation_place'] ?? null;
       // $caste->certificate_validation_file =  $data['certificate_validation_file'] ?? null;
        $caste->certificate_validation_remarks =  $data['certificate_validation_remarks'] ?? null;

        
        $config = Configure::read('ESDL');
           
        $bucketPath = $config['mode'].'/staff/'.$staffId.'/profile';

            $fileFields = array(
                'certificate_file' => 'certificate_file',
                'certificate_validation_file' => 'certificate_validation_file'
            );

            
            foreach ($fileFields as $key => $field) {

                $base64 = $data[$key];
                // Decode base64
                $fileContent = base64_decode($base64);
                if ($fileContent === false) {
                    throw new \Exception('Invalid base64 string');
                }
                // Create temp file
                $tmpFile = tempnam(sys_get_temp_dir(), 'img_');

                // Write content
                file_put_contents($tmpFile, $fileContent);
                // File details
                $fileName = $key.'.png';
                $mimeType = 'image/png';
                $fileSize = filesize($tmpFile);

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $tmpFile);
                finfo_close($finfo);
                
                // Validate mime
                /*if ($mimeType !== 'application/pdf') {

                    unlink($tmpFile);

                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be PDF File - ' . $field
                        ]));
                }*/

                // Validate size
                $fileSize = filesize($tmpFile);

                if ($fileSize > (2 * 1024 * 1024)) {

                    unlink($tmpFile);

                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit - ' . $field
                        ]));
                }                
                // Create UploadedFile object
                $uploadedFile = new UploadedFile(
                    $tmpFile,
                    $fileSize,
                    UPLOAD_ERR_OK,
                    $fileName,
                    $mimeType
                );
                /*
                if (!empty($data[$field]) && $data[$field]->getError() === UPLOAD_ERR_OK) {
                    $file = $data[$field];
                    if ($file->getClientMediaType() !== 'application/pdf') {
                        //throw new BadRequestException("$field must be a PDF");
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Must be a PDF File - '.$field
                            ]));
                    }

                    if ($file->getSize() > (2 * 1024 * 1024)) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Exceeds 2MB limit File - '.$field
                            ]));
                        //throw new BadRequestException("$field exceeds 2MB limit");
                    }

                    if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid File - '.$field
                            ]));
                        //$this->Flash->error('Invalid file');
                    }


                    // Get temp path safely
                    $tmpPath = $file->getStream()->getMetadata('uri');

                    // Extract extension (safe)
                    $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                    // New filename
                    $newFileName = $key . '.' . $extension;

                    // Create NEW UploadedFile object
                    $renamedFile = new UploadedFile(
                        $tmpPath,
                        $file->getSize(),
                        $file->getError(),
                        $newFileName,
                        $file->getClientMediaType()
                    );

                    $storage = new EsdlStorageService();
                    $fileName = $storage->upload($renamedFile, $bucketPath);

                    $staffData[$key] = $fileName;
                }*/ 
            }

        echo "<pre>dfdfdf";
        print_r($caste);
        exit;
                

        // Merge (update/insert) new data
        $casteObj = $staffCasteTable->patchEntity($caste, $data);
        // Save record
        if ($staffCasteTable->save($casteObj)) {           
             return $this->respond([
                'message' =>  $message
            ]);
        } else {
            return $this->error('Unable to update data', 422);
        }

    }
    public function updateOtherPersonalDetails1()
    {
        
        $this->request->allowMethod(['patch']);   
        $body = $this->request->getData();
        if (empty($body['payload'])) {
            return $this->error('Invalid payload: data missing', 422);
        }

        //echo $this->encryptData(json_encode($body['dataFormatDoNotUseThisProperty']));
        //exit;
        $payloadEncrypted = $body['payload'] ?? null;
        $data = (array) json_decode($this->decryptData($payloadEncrypted));
        /*echo "<pre>123";
        print_r($body['dataFormatDoNotUseThisProperty']);
        print_r($data);
        exit;*/

        $staffId = $this->user_id; 
        $tableName = '';             
         // Normalize inputs
        $newData = [
            'mother_tongue' => (int) $data['mother_tongue'],
            'blood_group' => $data['blood_group'] ?? null,
            'election_card' => $data['election_card'] ?? null,
            'height' => $data['height'] ?? null,
            'weight' => $data['weight'] ?? null,
            'lang1' => (int) $data['lang1'] ?? null,
            'lang2' => (int) $data['lang2'] ?? null,
            'lang3' => (int) $data['lang3'] ?? null,
            'identification_mark1' => $data['identification_mark1'] ?? null,
            'identification_mark2' => $data['identification_mark2'] ?? null,
            'days_spent_non_teaching_assignments' => $data['no_of_non_teaching_working_days'] ?? null,
            'digital_devices' =>  $data['capable_handling_digital'] ?? null,
            'deputation_from_other_school' =>  $data['teacher_deputation_school'] ?? null,
            'teaching_at_other_school_as_guest' =>  $data['teaching_other_school'] ?? null
        ];
         
        $tableObject = TableRegistry::getTableLocator()->get($tableName);
        $existing = $tableObject->find()
                    ->where(['staff_id' => $staffId])
                    ->first();
        

        if ($existing) {
            $newData['updated_at'] = new FrozenTime();
            $tableRecord = $tableObject->patchEntity($existing, $newData);
        } else {
            // Insert new address
            $newData['staff_id'] = $staffId;
            $newData['created_at'] = new FrozenTime();           
            $tableRecord = $tableObject->newEntity($newData);
        }

        // Save record
        if ($tableObject->save($tableRecord)) {
            return $this->respond([
                'message' => "Data updated successfully"
            ]);
        } else {
            return $this->error('Unable to update data', 422);
        }   
    }
    

}