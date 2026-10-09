<?php

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Http\Client;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use DateTime;
use stdClass;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Laminas\Diactoros\UploadedFile;
use App\Service\EsdlStorageService;

//App\Controller\stdClass


class ImportController extends AppController
{
    private $user_id;
    private $username;
    private $UD;

    private $errorMsg;
    
    public function initialize(): void
    {
        parent::initialize();
        //$this->loadComponent('RequestHandler');

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }



    

    public function updateUdiseDataByEmpId()
    {

        /*$staffsTable = TableRegistry::getTableLocator()->get('Staffs');

        $staffIds = $staffsTable->find()
            ->select(['Staffs.emp_staff_id'])
            ->join([
                'tp' => [
                    'table' => 'udise_teacher_servce_run_status', 
                    'type' => 'LEFT',
                    'conditions' => 'tp.employee_code = Staffs.emp_staff_id',
                ]
            ])
            ->where(['tp.employee_code IS' => null])
            ->limit(3333)
            ->enableHydration(false)
            ->all();*/


        $staffIds = TableRegistry::getTableLocator()->get('UdiseTeacherServceRunStatus')->find()
             ->select(['employee_code'])
             ->where(['status' => 0])
              ->limit(3333)
             ->enableHydration(false)
             ->all();

            foreach ($staffIds as $staffId) {
               /// $empID = $staffId['emp_staff_id'];
                $empID = $staffId['employee_code'];
                $udiseDataStatus = $this->fetchEmpUdiseDetails($empID);
                echo "<pre>" . print_r($staffId, true) . "</pre>";
            }
        
       
            $this->disableAutoRender(); 
    
            $this->response = $this->response->withStringBody('Success');
            return $this->response;
        
    }

    private function fetchEmpUdiseDetails($empId)
    {
        ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
        set_time_limit(300); 
        $this->UD = $this->initUdise();
        /*$udise->clientId = 'maharashtra-prod';
        $udise->clientSecret = 'mrshtra-prod@6839!~';
        $udise->apiEndpoint = "https://api.udiseplus.gov.in/public-api"; 
        $udise->apiVersion = "v1.3";
        $udise->apiActionTeachingByModified = "teaching-staff/by-national-teacher-id/public";
        $udise->apiActionNonTeachingByModified = "non-teaching-staff/by-modified-time/public";
        $udise->baseDir = "'".$this->Url->build('/', ['fullBase' => true])."'";
        $udise->certificatePath = $udise->baseDir. "udise/documents/";*/


       $apiURL=$this->UD->apiEndpoint.'/v1.1/'.$this->UD->apiActionTeachingByEmpId;
        
        
        $requestPayload = [ 
                    'empStaffId' => $empId, //100000010
                    "stateId" =>'127'
                ];

                //print_r( $requestPayload);
        $response = $this->callingAPIs($requestPayload, $apiURL);

        /*echo "<pre>".print_r($response['data'],true)."</prde>";
        print_r($response);
        exit;*/


        $status = 2;
        if(isset($response['status'])){
            $status = $response['status'];
        }

        
        $statusTable = TableRegistry::getTableLocator()->get('UdiseTeacherServceRunStatus');

        $newStatus = $statusTable->find()
                ->where([
                    'employee_code' => $empId
                ])
                ->first();

        if (!$newStatus) {
            $newStatus = $statusTable->newEmptyEntity();
            $newStatus->employee_code = $empId; 
        }       
        $newStatus->status = $status;                 
        $statusTable->save($newStatus);

        

       
        /* *
        
        //Array ( [status] => 1 [metaData] => Array ( [apiCode] => 3112 [apiVersion] => 1.1 [requestTimestamp] => 16-06-2026 19:45:15.738 [responseTimestamp] => 16-06-2026 19:45:15.750 [transactionId] => [pageNo] => 0 [totalPages] => 1 [recordsPerPage] => 1 [totalRecords] => 1 ) [data] => Array ( [empStaffId] => 100000001 [schoolName] => HEERALAL LOYA VIDYALAYA WARORA [udiseSchCode] => 27130302215 [stateCd] => 27 [districtCd] => 2713 [blockCd] => 271303 [villageCd] => [clusterCd] => 2713030015 [schCategoryId] => 3 [schMgmtId] => 4 [schType] => 3 [empType] => 1 [empName] => PARASHRAM KASHIRAM PAWAR [gender] => 1 [dob] => 15-06-1969 [empCodeState] => 030221541 [socialCat] => 4 [qualAcad] => 5 [trade] => 1 [qualProf] => 3 [mobile] => 9403816216 [email] => parshram_pawar@rediffmail.com [mathUpto] => 2 [scienceUpto] => 2 [englishUpto] => 5 [socStudyUpto] => 4 [langStudyUpto] => 4 [natureOfAppt] => 1 [disabilityType] => 1 [crrNo] => [dojService] => 24-09-2002 [empNamePerUid] => PARASHRAM KASHIRAM PAWAR [tchType] => 7 [yojPresSch] => 24-09-2002 [classTaught] => 6 [appointedLevel] => 6 [apptSub] => 81 [subTaught1] => 81 [subTaught2] => 8 [tchDeputation] => 2 [tchFromOtherSchool] => 2 [trainedCwsn] => 2 [trainedComp] => 2 [trngRcvd] => 1 [trngNeeded] => 1 [trgNishtha] => 2 [nontchDays] => 0 [mainLang1] => 10 [mainLang2] => 4 [mainLang3] => 19 [trSsaYn] => 2 [cyPsySocAspectYn] => 2 [receTrainingSupportCwsnYn] => 2 [isCtetStet] => 2 [ctetStet] => 0 [isCapableVc] => 2 [isUidVerified] => 1 [natTchId] => TP18783226 [formFlag] => 4 [empStatus1] => 1 [empStatus2] => 0 [modifiedTime] => 2025-08-07 19:23:41.519 ) [errorDetails] => ) 
        // 
        // */

       // echo "<pre>122".print_r($response['data'],true)."</pre>";

        if(isset($response['data']) && is_array($response['data']) && count($response['data'])>0){
           /* $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
            $staffOtherDetailsTable = TableRegistry::getTableLocator()->get('StaffOtherDetails');
            $staffUdiseQualificationsTable = TableRegistry::getTableLocator()->get('StaffUdiseQualifications');
            $staffUdiseTainingTable = TableRegistry::getTableLocator()->get('StaffUdiseTaining');*/
           // foreach($response['data'] as $row){   
                
                $this->importTeacher($response['data'], $empId);
                    
                            
           // }
        }
        //exit;
        return true;
    }




    /**
     * 
     * 
     * *
    */

    public function importTeacher(array $row, string $emp_staff_id): bool
    {
                
       
        $schoolsTable = TableRegistry::getTableLocator()->get('UdiseSchoolMaster');
        $teachersTable = TableRegistry::getTableLocator()->get('UdiseTeacherProfile');

        $connection = ConnectionManager::get('default');

        return $connection->transactional(function () use (
            $row,
            $schoolsTable,
            $teachersTable,
            $emp_staff_id
        ) {

       
       
            /*
            * School Create If Not Exists
            */
            $school = $schoolsTable->find()
                ->where([
                    'udise_school_code' => trim((string)$row['udiseSchCode'])
                ])
                ->first();

            if (!$school) {

                $school = $schoolsTable->newEmptyEntity();

                $school->udise_school_code = trim((string)$row['udiseSchCode']);
                $school->state_code = $this->nullInt($row['stateCd'] ?? null);
                $school->district_code = $this->nullInt($row['districtCd'] ?? null);
                $school->block_code = $this->nullInt($row['blockCd'] ?? null);
                $school->village_code = $this->nullInt($row['villageCd'] ?? 0);
                $school->cluster_code = $this->nullInt($row['clusterCd'] ?? null);

                $school->school_category_id =
                    $this->nullInt($row['schCategoryId'] ?? null);

                $school->school_management_id =
                    $this->nullInt($row['schMgmtId'] ?? null);

                $school->school_type_id =
                    $this->nullInt($row['schType'] ?? null);
                    //print_r($school);
                    /*echo "<pre>";
                    print_r($school);
                    exit;*/
                   
                if (!$schoolsTable->save($school)) {
                    
                    throw new \RuntimeException(
                        json_encode($school->getErrors())
                    );
                }
               
             
            }

            /*
            * Skip if teacher already exists
            */
            $teacher = $teachersTable->find()
                ->where([
                    'employee_code' => $emp_staff_id
                ])
                ->first();

            if (!$teacher) {
                $teacher = $teachersTable->newEmptyEntity();
            }

            $teacher->school_id = $school->school_id;

            /*
            * Basic Details
            */
            $teacher->employee_code = $emp_staff_id;

            $teacher->employee_name =
                $this->nullString($row['empName'] ?? null);

            $teacher->gender_id =
                $this->nullInt($row['gender'] ?? null);

            $teacher->social_category_id =
                $this->nullInt($row['socialCat'] ?? null);

            $teacher->employee_type_id =
                $this->nullInt($row['empType'] ?? null);

              //  echo "<pre>teacherdob-".print_r($row['dob'] )."</pre>";
            /*
            * DOB
            */
            $teacher->dob =
                $this->parseDate($row['dob'] ?? null);

                //echo $teacher->dob ;
               // exit;
            /*
            * Joining Dates
            */
            $teacher->joining_service_date =
                $this->parseDate($row['dojService'] ?? null);

            $teacher->joining_department_date =
                $this->parseDate($row['empNamePstnEdu'] ?? null);

            $teacher->joining_present_school_date =
                $this->parseDate($row['yojPresSch'] ?? null);

            /*
            * Contact
            */
            $teacher->mobile =
                $this->nullString($row['mobile'] ?? null);

            $teacher->email =
                $this->validateEmail($row['email'] ?? null);

            /*
            * Status
            */
            $teacher->form_status_id =
                $this->nullInt($row['formFlag'] ?? null);

            $teacher->emp_status1_id =
                $this->nullInt($row['empStatus1'] ?? null);

            $teacher->emp_status2_id =
                $this->nullInt($row['empStatus2'] ?? null);

            /*
            * Qualification
            */
            $teacher->qualification_academic =
                $this->nullInt($row['qualAcad'] ?? null);

            $teacher->qualification_professional =
                $this->nullInt($row['qualProf'] ?? null);

            $teacher->trade_id =
                $this->nullInt($row['trade'] ?? null);

            /*
            * Teaching Profile
            */
            $teacher->class_taught_id =
                $this->nullInt($row['classTaught'] ?? null);

            $teacher->appointed_level_id =
                $this->nullInt($row['appointedLevel'] ?? null);

            $teacher->appointed_subject_id =
                $this->nullInt($row['apptSub'] ?? null);

            $teacher->main_subject_taught1 =
                $this->nullInt($row['subTaught1'] ?? null);

            $teacher->main_subject_taught2 =
                $this->nullInt($row['subTaught2'] ?? null);

            /*
            * Flags
            */
            $teacher->aadhaar_verified =
                $this->toBool($row['isUidVerified'] ?? null);

            $teacher->trained_cwsn =
                $this->toBool($row['trainedCwsn'] ?? null);

            $teacher->trained_computer =
                $this->toBool($row['trainedComp'] ?? null);

            $teacher->nishtha_trained =
                $this->toBool($row['trgNishtha'] ?? null);

            $teacher->school_safety_audit_trained =
                $this->toBool($row['trgSaYn'] ?? null);

            $teacher->cyber_psychosocial_trained =
                $this->toBool($row['cyPsySocAspectYn'] ?? null);

            $teacher->cwsn_support_training =
                $this->toBool($row['recvTrainingSupportCwsnYn'] ?? null);

            $teacher->ctet_stet_qualified =
                $this->toBool($row['isCtetStet'] ?? null);

            $teacher->digital_device_capable =
                $this->toBool($row['isCapableVc'] ?? null);

            /*
            * Last Modified
            */
            if (!empty($row['modifiedTime'])) {
                $teacher->modified_time =
                    FrozenTime::parse($row['modifiedTime']);
            }

            //echo "<pre>teacher".print_r($teacher,true)."</pre>";
           // exit;
           // try {
            if (!$teachersTable->save($teacher)) {
                throw new \RuntimeException(
                    json_encode($teacher->getErrors())
                );
            }
           /* } catch (\Throwable $e) {
                // 🔍 एररचा संपूर्ण मेसेज आणि तो कोणत्या ओळीमुळे आला ते पाहण्यासाठी:
                echo "Error Message: " . $e->getMessage() . "\n";
                echo "File: " . $e->getFile() . " on line " . $e->getLine() . "\n";
                
                // एंटिटीमध्ये सध्या काय डेटा आहे तो प्रिंट करा
                debug($teacher->toArray());
                
                die('Stop Execution');
            }*/

            return true;
        });
    }

    private function nullString($value): ?string
    {
        $value = trim((string)$value);

        return $value === '' ? null : $value;
    }

    private function nullInt($value): ?int
    {
        if ($value === '' || $value === null) {
            return null;
        }

        return (int)$value;
    }

    private function toBool($value): ?bool
    {
        if ($value === '' || $value === null) {
            return null;
        }

        return (int)$value === 1;
    }

    private function validateEmail($email): ?string
    {
        $email = trim((string)$email);

        if ($email === '') {
            return null;
        }

        return filter_var($email, FILTER_VALIDATE_EMAIL)
            ? $email
            : null;
    }

    private function parseDate($date): ?FrozenTime
    {
        if (empty($date)) {
            return null;
        }
      /*  echo "dddd-".$date;
        return new FrozenTime(\DateTime::createFromFormat('d/m/Y', $date));
        */              
        $formats = [
            'd/m/Y',
            'd-m-Y',
            'Y-m-d'
        ];

        foreach ($formats as $format) {


            $dt = \DateTime::createFromFormat($format, $date);


            


            if ($dt !== false) {
                return new FrozenTime( \DateTime::createFromFormat('Y-m-d',$dt->format('Y-m-d')
                ));
            }
        }

        return null;
    }
    /**
     * 
     * 
     */

    private function initUdise()
    {
        $udise = new stdClass();
        $udise->clientId = 'maharashtra-prod';
        $udise->clientSecret = 'mrshtra-prod@6839!~';
        $udise->apiEndpoint = "https://api.udiseplus.gov.in/public-api"; 
        $udise->apiVersion = "v1.3";
        $udise->apiActionTeachingByModified = "teaching-staff/by-national-teacher-id/public";
        $udise->apiActionTeachingByModifiedBySchool = "teaching-staff/by-udise-code-and-modified-date/public";
        $udise->apiActionTeachingByEmpId = "teaching-staff/by-emp-staff-id/public";
        
        $udise->apiActionNonTeachingByModified = "non-teaching-staff/by-modified-time/public";
        $udise->baseDir = WWW_ROOT ;//Router::url('/', true);
        $udise->certificatePath = $udise->baseDir. "imp_files".DS."udise".DS."documents";
        //$udise->certificatePath = $udise->baseDir. "udise/documents/udiseplusapi261024.cer";
        return $udise;

    }

    
    private function createAuthenticationToken($authenticateRequest) {
        

        $authenticateUrl = $this->UD->apiEndpoint . "/".$this->UD->apiVersion .'/authenticate';
      
        $apiCertPath = $this->UD->certificatePath . DS.'udiseplusapi261024.cer';
        $caCertPath = $this->UD->certificatePath .DS. 'cacert.pem';
      

       $requestJson = json_encode($authenticateRequest);
       $base64EncodedJson = base64_encode($requestJson);

       $publicKeyPem = $this->getPublicKeyFromCert($apiCertPath);

       $cipherText = $this->encryptRsa($base64EncodedJson, $publicKeyPem);
       $encryptedTextHex = $this->bytesToHex($cipherText);

       $encryptedRequestBody = json_encode(["data" => $encryptedTextHex]);

        $headers = [
            "Content-Type: application/json"
        ];

        $ch = curl_init($authenticateUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encryptedRequestBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Add this line pointing to your CA bundle file:
        curl_setopt($ch, CURLOPT_CAINFO, $caCertPath);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch) . "\n";
            curl_close($ch);
            return null;
        }
        curl_close($ch);

        if ($httpCode == 200) {
            $resp = json_decode($response, true);
            return $resp;
        } else {
            echo "Error: HTTP $httpCode\n$response\n";
            return null;
        }

        
    }


    private function loadOrCreateToken($authenticateRequest) {

        $tokenFilename = $this->UD->certificatePath . DS."saved_token.json";
        $existingData = [];

        if (file_exists($tokenFilename)) {
            $jsonContent = file_get_contents($tokenFilename);
            $existingData = json_decode($jsonContent, true) ?? [];

            $expiryStr = $existingData['data']['authTokenExpiryTime'] ?? null;
            if ($expiryStr) {
                // $timezone = new DateTimeZone('Asia/Kolkata');
                // $expiryTime = DateTime::createFromFormat('d-m-Y H:i:s', $expiryStr, $timezone);

                // echo "JSON Expiry :". $expiryStr ."\n";
                $expiryTime = DateTime::createFromFormat('d-m-Y H:i:s', $expiryStr);
                $currentTime = new DateTime('now');

                echo "Current Time: " . $currentTime->format('d-m-Y H:i:s') . "\n";
                echo "Expiry Time: " . $expiryTime->format('d-m-Y H:i:s') . "\n";

                if ($expiryTime && $expiryTime > $currentTime) {
                    echo "Fetched Token from the JSON file\n";
                    return $existingData;
                }

                echo "Token Expired in JSON File\n";
            }
        }

        $authResponse = $this->createAuthenticationToken($authenticateRequest);
        
        $token = $authResponse['data']['authToken'] ?? null;

        if ($authResponse && $token) {
            echo "Generated a new Authentication Token\n";

            $encryptedSek = base64_decode($authResponse['data']['sek']);
            $decryptedSek = $this->decrypt($encryptedSek, $authenticateRequest["appKey"]);

            $authResponse['data']['decryptedSek'] = $decryptedSek;

            file_put_contents($tokenFilename, json_encode($authResponse, JSON_PRETTY_PRINT));
            return $authResponse;

        } else {
            echo "Token Generation Failed\n";
            return null;
        }

    }


    private function callingAPIs($requestPayload, $apiURL){      
        $caCertPath = $this->UD->certificatePath . DS.'cacert.pem';

        $appKey = $this->getAesKey();
        $authenticateRequest = [
            "clientId" => $this->UD->clientId,
            "clientSecret" => $this->UD->clientSecret,
            "appKey" => $appKey
        ];

        $response = $this->loadOrCreateToken($authenticateRequest);

        $authToken = $response['data']['authToken'] ?? null;

        if ($response && $authToken){
            $decryptedSek = $response['data']['decryptedSek'];
            try {
                $objStr = json_encode($requestPayload);
                $encryptedText = $this->encrypt($objStr, $decryptedSek);

                $encryptedRequestBody = json_encode(["data" => $encryptedText]);

                $headers = [
                    "Authorization: Bearer " . $authToken,
                    "Content-Type: application/json"
                ];

                $ch = curl_init($apiURL);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $encryptedRequestBody);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_CAINFO, $caCertPath);
                // curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt($ch, CURLOPT_TIMEOUT, 180); // 3 minutes
                


                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if (curl_errno($ch)) {
                    echo "Curl error: " . curl_error($ch) . "\n";
                    curl_close($ch);
                    return null;
                }
                curl_close($ch);

                if ($httpCode == 200) {
                    $resp = json_decode($response, true);
                    return $resp;
                } else {
                    echo "Request failed: HTTP $httpCode\n$response\n";
                    return null;
                }
            } catch (Exception $e) {
                echo "Exception occurred: " . $e->getMessage() . "\n";
                return null;
            }
        }
        else {
            echo "Token Generation Failed.";
            print_r($response);
            die();
        }
    }
    
    private function getAesKey() {
        $key = random_bytes(32); // 256-bit key
        return base64_encode($key);
    }

    private function encryptRsa(string $text, string $publicKeyPem): string {
        $publicKey = openssl_pkey_get_public($publicKeyPem);
        if ($publicKey === false) {
            throw new Exception("Invalid public key");
        }

        $encrypted = '';
        $success = openssl_public_encrypt($text, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        if (!$success) {
            throw new Exception("RSA encryption failed");
        }

        return $encrypted;
    }

    private function getPublicKeyFromCert($certPath) {
        $certContent = file_get_contents($certPath);
        $cert = openssl_x509_read($certContent);
        $pubKeyResource = openssl_pkey_get_public($cert);

        if ($pubKeyResource === false) {
            throw new Exception("Unable to extract public key from certificate.");
        }

        $keyDetails = openssl_pkey_get_details($pubKeyResource);
        return $keyDetails['key'];
    }

    private function bytesToHex(string $byteString): string {
        return bin2hex($byteString);
    }

    private function hexToBytes(string $hexString): string {
        return hex2bin($hexString);
    }

    private function encrypt($text, $secret_key) {
        $decoded_key = base64_decode($secret_key);
        $cipher = openssl_encrypt($text, 'aes-256-ecb', $decoded_key, OPENSSL_RAW_DATA);
        return base64_encode($cipher);
    }

    private function decrypt($text, $secret_key) {
        $decoded_key = base64_decode($secret_key);
        $decrypted = openssl_decrypt(base64_decode($text), 'aes-256-ecb', $decoded_key, OPENSSL_RAW_DATA);
        return $decrypted;
    }

    private function isGatewayTimeout($response) {
        return strpos($response, '504 Gateway') !== false;
    }

  }
