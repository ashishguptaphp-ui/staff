<?php
declare(strict_types=1);

namespace App\Controller;
use App\Controller\AppController;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use App\Service\EsdlStorageService;
use Cake\Http\Client;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Response;
use App\Service\SmsService;
use Cake\I18n\FrozenTime;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 */
class UsersController extends AppController
{
     public function initialize(): void
    {
        parent::initialize();
        
    }
    

   
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'otp','verifyOtp','register','upload','download','shalarthLogin','shalarthOtp']);
        
    }
    

    function encryptData($plainText)
    {
        $method = 'AES-128-CBC'; // AES/CBC/PKCS5Padding equivalent
        $secretKey = "EduGoMStaffResil";

        // generate 16 byte IV
        $iv = openssl_random_pseudo_bytes(16);

        // encrypt
        $cipherText = openssl_encrypt(
            $plainText,
            $method,
            $secretKey,
            OPENSSL_RAW_DATA,
            $iv
        );

        // encode
        $ivBase64 = base64_encode($iv);
        $cipherBase64 = base64_encode($cipherText);

        return $ivBase64 . ":" . $cipherBase64;
    }

    function decryptData($encryptedText)
    {
        $method = 'AES-128-CBC';
        $secretKey = "ShalarthAPIKey01";

        list($ivBase64, $cipherBase64) = explode(':', $encryptedText);

        $iv = base64_decode($ivBase64);
        $cipherText = base64_decode($cipherBase64);

        $plainText = openssl_decrypt(
            $cipherText,
            $method,
            $secretKey,
            OPENSSL_RAW_DATA,
            $iv
        );

        return $plainText;
    }



    /*file upload*/ 
    public function upload()
    {
        $data = "04DEDPDBM8403";

        $encrypted = $this->encryptData($data);
        echo "Encrypted: " . $encrypted . PHP_EOL;

        $decrypted = $this->decryptData($encrypted);
        echo "Decrypted: " . $decrypted;


    echo "<hr/>04DEDPDBM8403->".$this->encryptData('04DEDPDBM8403');
    echo "<hr/>Pankaj@20098637->".$this->encryptData('Pankaj@20098637');
     echo "<hr/>04DEDRTJM7807->".$this->encryptData('04DEDRTJM7807');
    echo "<hr/>Ravindra@2602240->".$this->encryptData('Ravindra@2602240');    
     echo "<hr/>02DEDGVBF9101->".$this->encryptData('02DEDGVBF9101');
    echo "<hr/>Gauri@23071137->".$this->encryptData('Gauri@23071137');
    
     echo "<hr/>04DEDDBPM7201->".$this->encryptData('04DEDDBPM7201');
    echo "<hr/>Dilip@08055652->".$this->encryptData('Dilip@08055652');
    exit;
        if ($this->request->is('post')) {

            $file = $this->request->getData('document');

            if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                $this->Flash->error('Invalid file');
                return;
            }

            $storage = new EsdlStorageService();

            $key = $storage->upload($file, 'documents');

            echo "==".$key."==";
            // Save only object key in DB
           /* $this->Documents->save(
                $this->Documents->newEntity([
                    'file_key' => $key,
                    'uploaded_by' => $this->request->getAttribute('identity')->id,
                ])
            );

            $this->Flash->success('File uploaded successfully');
            return $this->redirect(['action' => 'index']);*/
        }
    }

    public function download()
    {
        $doc_file_key = 'documents/1770057651_GR_AITool_Terms_of_Reference_Final.pdf';

        $storage = new EsdlStorageService();
        echo $url = $storage->signedUrl($doc_file_key);
        exit;
            echo '<object
                data="'.$url.'"
                type="application/pdf"
                width="100%"
                height="700px">

                <p>
                    PDF preview not supported.
                    <a href="'.$url.'" target="_blank">
                        Download PDF
                    </a>
                </p>

            </object>';
        //return $this->redirect($url);
        
    }

    

    function validateIndianMobile($mobile)
    {
        if(!empty($mobile)){

            // Step 1: Remove all non-digits
            $mobile = preg_replace('/\D/', '', trim($mobile));

            // Step 2: Take last 10 digits
            $mobile = substr($mobile, -10);

            // Step 3: Validate (starts with 6–9)
            if (preg_match('/^[6-9]\d{9}$/', $mobile)) {
                return $mobile; // valid normalized number
            }
        }

        return false;
    }


    /** */
    public function login()
    {
        $this->viewBuilder()->setLayout('pre-login');
        $this->request->allowMethod(['get', 'post']);

        if ($this->request->is('post')) {
            $username = $this->request->getData('username');
            $password = 'hm123';//$this->request->getData('password');
            //$hashedPassword = (new DefaultPasswordHasher())->hash('hm123');
            //echo $hashedPassword;
            //exit;



            $user = $this->Users->find()
                ->where(['username' => $username])
                ->first();

            
            if ($user && (new DefaultPasswordHasher())->check($password, $user->password)) {
                
                if('270101SC040' == $username){
                    $loggedInMobile = '9356797958';//'9518994640';
                }else if('333270605SC013' == $username){
                    /*echo "<pre>";
                    print_r($user);
                    exit;*/
                    $loggedInMobile = '9356797958';//'9518994640';
                }else{
                    $loggedInMobile =  $this->validateIndianMobile($user->mobile);
                }

                //$loggedInMobile = '9356797958'; // $this->validateIndianMobile($user->mobile);
                // $loggedInMobile =  $this->validateIndianMobile($user->mobile);
                
                if($loggedInMobile){
                    $user_id = $user->id;
                    $userOtpsTable = TableRegistry::getTableLocator()->get('UserOtps');

                    $otp = '123456';//random_int(100000, 999999);

                    $data = $userOtpsTable->newEmptyEntity();

                    $data->user_id = $user_id;
                    $data->otp = $otp;
                    $data->expires_at = date('Y-m-d H:i:s', strtotime('+16 minutes'));
                    $data->is_used = 0;

                    if ($userOtpsTable->save($data)) {
                        $message = "OTP for Staff Portal is ".$otp.". Valid for next 15 minutes. -Sch Edu and Sports dept";                    
                        $smsService = new SmsService();
                        $result = 'Y';// $smsService->sendSMS('otp',$loggedInMobile, $message);
                        if($result=='Y'){
                            $this->request->getSession()->write('loggedInUserID',$user_id);
                            $this->request->getSession()->write('loggedInUser',$username);
                            $this->request->getSession()->write('loggedInMobile',$loggedInMobile);
                            return $this->redirect(['action' => 'otp']);
                        }else{
                            $this->Flash->error('Enable to send SMS. '.$result);
                        }      
                    } else {
                        $this->Flash->error('Enable to generate OTP.');
                    }                                 
                } else {
                    $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected before login.');
                }

            } else {
                $this->Flash->error('Invalid username or password.');
            }
        }
    }

     /** */
    public function shalarthLogin()
    {
        $this->viewBuilder()->setLayout('pre-login');
        $this->request->allowMethod(['get', 'post']);

        if ($this->request->is('post')) {
           
            $username = $this->request->getData('username');
            $password = $this->request->getData('password');
           
            $http = new Client();

            // API endpoint
            //$url = 'http://115.124.116.194:8083/ShalarthAPI/shalarth/api/v1/passwords/login';
            $url = 'https://shalarth.maharashtra.gov.in/ShalarthAPI/shalarth/api/v2/passwords/login';
            // Headers as required
            $headers = [
                'X-API-KEY' => 'd2VsY29tZSB0byByZWcgYXBp',
                'Content-Type' => 'application/json'
            ];
            //04DEDBBGM7304
            // Request body data
            $data = [
                'username' => $username,
                'password' => $password
            ];
            /*
            $data = [
                'username' => '4071480',
                'password' => 'ifms123'
            ];*/
            
            // Send POST request with JSON body
            try {
                
                $isSkipLogin = true;
                $response = $http->post($url, json_encode($data), [
                    'headers' => $headers,
                    'type' => 'json' // This ensures Content-Type is set and body is encoded as JSON
                ]);

                $statuscode = $response->getstatuscode();
                 $body = $response->getStringBody();
                // Decode JSON response
                $result = json_decode($body, true);
               
                if (!$isSkipLogin){
                // Check if the API returned an HTTP error status
                if ($statuscode < 200 || $statuscode >= 300) {
                    // Non-success HTTP status – use generic message or extract from body if available
                    $message = $result['message'] ?? 'Authentication service error.';
                    $this->Flash->error( $message);
                    return $this->redirect(['action' => 'shalarthLogin']);
                }

                // HTTP status is 2xx, now examine the business logic response
                if (!isset($result['code'])) {
                    $this->Flash->error('Invalid response structure from authentication service.');
                    return $this->redirect(['action' => 'shalarthLogin']);
                }
                }

                if (($isSkipLogin) || ($result['success'] === true && isset($result['code']) && $result['code'] === 'LOGIN_SUCCESS')) {
                    // Successful login – return the whole response or relevant data
                    $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
                    $staff = $staffsTable->find()
                                    ->where(['shalarth_code' => $username])
                                    ->first();
                  
                                    /*echo "<pre>123";
                                    print_r($staff);
                                    exit;*/
                   
                    $this->request->getSession()->write('loggedInUser',$username);
                    $this->request->getSession()->write('loggedInMobile',$staff->mobile);
                    // ✅ Set the identity for Authentication plugin
                                    
                    return $this->redirect(['action' => 'shalarthOtp']);
                                    
                    
                } else {
                   
                    // Login failed – extract message and return appropriate error
                    $code = $result['code'] ?? 'UNKNOWN_ERROR';
                    $message = $result['message'] ?? 'Login failed.';

                    // Map to appropriate HTTP status code if needed
                    $httpstatus = 401; // Unauthorized for invalid credentials
                    if ($code === 'INVALID_CREDENTIALS') {
                        $httpstatus = 401;
                    } else {
                        // Could be other codes like ACCOUNT_LOCKED, etc.
                        $httpstatus = 400; // Bad request for other business errors
                    }

                    // Check for maintenance message (if API returns such)
                    if (stripos($message, 'maintenance') !== false ||
                        stripos($message, 'under maintainance') !== false) {
                        $httpstatus = 503; // Service Unavailable
                    }
                    $this->Flash->error($message);
                    return $this->redirect(['action' => 'shalarthLogin']);

                }
            } catch (\Cake\Http\Client\Exception\NetworkException $e) {
                $this->Flash->error('Authentication service is currently unreachable. Please try again later.');
                    return $this->redirect(['action' => 'shalarthLogin']);
            } catch (\Exception $e) {
                $this->Flash->error('Authentication service is currently unreachable. Please try again later.');
                return $this->redirect(['action' => 'shalarthLogin']);
            }

           
            
           
        }
    }
    //shalarth
    public function shalarthOtp()
    {
        $this->viewBuilder()->setLayout('pre-login');
       
        $mobile = $this->request->getSession()->read('loggedInMobile');        
        $formattedMobile = "";
        if(!empty($mobile)){
            $formattedMobile =  str_repeat('*', strlen($mobile) - 4) . substr($mobile, -4);
        }
        $this->set([
            'mobile' => $formattedMobile 
        ]);
        if ($this->request->is('post')) {
            $otp = '';
            for ($i = 1; $i <= 6; $i++) {
                $otp .= $this->request->getData("otp_$i");
            }

            if ($otp === '123456') { 
                $loggedInUser = $this->request->getSession()->read('loggedInUser');

                $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
                $staff = $staffsTable->find()
                                    ->where(['shalarth_code' => $loggedInUser])
                                    ->first();
                  
              
                

                if ($staff) {  
                    $staff->role = 'staff';
                    $this->Authentication->setIdentity($staff);
               

                    // Store user in session (optional)
                    $this->request->getSession()->write('Auth.User', $staff);
                    //$role = $this->request->getSession()->read('Auth.User.role');
                    return $this->redirect(['controller' => $staff->role,'action' => 'dashboard']);
                }else{
                    $this->Flash->error('Invalid Details. Please try again.');
                    return $this->redirect(['action' => 'otp']);
                }                
            } else {
                $this->Flash->error('Invalid OTP. Please try again.');
                return $this->redirect(['action' => 'otp']);
            }
        }
    }
    
    public function otp()
    {
        $this->viewBuilder()->setLayout('pre-login');
       
        $mobile = $this->request->getSession()->read('loggedInMobile'); 
        $user_id = $this->request->getSession()->read('loggedInUserID'); 

               
        $formattedMobile = "";
        if(!empty($mobile)){
            $formattedMobile =  str_repeat('*', strlen($mobile) - 4) . substr($mobile, -4);
        }
        $this->set([
            'mobile' => $formattedMobile 
        ]);
        if ($this->request->is('post')) {
            $otp = '';
            for ($i = 1; $i <= 6; $i++) {
                $otp .= $this->request->getData("otp_$i");
            }
             $userOtpsTable = TableRegistry::getTableLocator()->get('UserOtps');



            // Step 1: Get latest active OTP for user
            $otpRecord = $userOtpsTable->find()
                ->where([
                    'user_id' => $user_id,
                    'is_used' => 0
                ])
                ->order(['created' => 'DESC'])
                ->first();

                
            $isValid = true;

            if (!$otpRecord) {
                $isValid = false;
                $this->Flash->error('No OTP found. Please request a new OTP.');
                return $this->redirect(['action' => 'otp']);
            }

            // Step 2: Check attempts
            if ($otpRecord->attempts >= 3) {
                $isValid = false;
                $this->Flash->error('Maximum OTP attempts exceeded. Please request a new OTP.');
                return $this->redirect(['action' => 'otp']);
            }

            // Step 3: Check expiry
            $currentTime = FrozenTime::now();
            if ($otpRecord->expires_at < $currentTime) {
                $isValid = false;
                $this->Flash->error('OTP has expired. Please request a new OTP.');
                return $this->redirect(['action' => 'otp']);
            }

            // Step 4: Validate OTP
            if ($otpRecord->otp != $otp) {
                $isValid = false;
                // Increment attempts
                $otpRecord->attempts += 1;
                $userOtpsTable->save($otpRecord);
                $this->Flash->error('Invalid OTP.');
                return $this->redirect(['action' => 'otp']);
            }

            if($isValid){
                // ✅ Step 5: Success
                $otpRecord->is_used = 1;
                $otpRecord->attempts += 1;

                // Capture IP & User Agent
                $otpRecord->ip_address = $this->request->clientIp();
                $otpRecord->user_agent = $this->request->getHeaderLine('User-Agent');

                $userOtpsTable->save($otpRecord);
                 $loggedInUser = $this->request->getSession()->read('loggedInUser');
              
                $user = $this->Users->find()
                    ->where(['username' => $loggedInUser])
                    ->first();

                if ($user) {  
                    $this->Authentication->setIdentity($user);
                    if($user->role == 'school'){
                        // Fetch the Schools table
                        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

                        // Find the school record by UDISE code (username)
                        $schoolDetails = $schoolsTable->find()
                            ->where(['udise_code' => $loggedInUser])
                            ->first();

                        $this->request->getSession()->write('Auth.School',$schoolDetails);
                    }else if($user->role == 'sanstha'){
                        $sansthasTable = TableRegistry::getTableLocator()->get('Sansthas');

                        $sansthaDetails = $sansthasTable->find()
                            ->where(['code' => $loggedInUser])
                            ->first();

                        $this->request->getSession()->write('Auth.Sanstha',$sansthaDetails);
                    }else if($user->role == 'district'){
                        $districtTable = TableRegistry::getTableLocator()->get('Districts');

                              
                       
                            $role_name ='Education Officer';
                        if (strlen($loggedInUser) == 7) {
                            $district_code = substr($loggedInUser, 0, 4);
                            $role_level    = substr($loggedInUser, 4, 3);
                            if($role_level == 'MDM'){
                                 $role_name ='Education Officer MDM';
                            }

                            $school_level  = substr($loggedInUser, -2);
                           
                        } else  if (strlen($loggedInUser) == 8) {
                            $district_code = substr($loggedInUser, 0, 4);
                            $role_level    = substr($loggedInUser, 4, 2);
                            $school_level  = substr($loggedInUser, -2);
                            if($school_level == '02'){
                                $role_name ='Education Officer Secondary';
                            }else{
                                $role_name ='Education Officer Primary'; 
                            }

                            
                           
                        }
                        $districtDetails = $districtTable->find()
                            ->where(['code' => $district_code])
                            ->first();

                        $districtDetails->role_name = $role_name;


                        $this->request->getSession()->write('Auth.District',$districtDetails);
                    }
               

                    // Store user in session (optional)
                    $this->request->getSession()->write('Auth.User', [
                        'id' => $user->id,
                        'username' => $user->username,
                        'role' => $user->role,
                        'full_name' => $user->full_name
                    ]);
                    //$role = $this->request->getSession()->read('Auth.User.role');
                    return $this->redirect(['controller' => $user->role,'action' => 'dashboard']);
                }else{
                    $this->Flash->error('Invalid Details. Please try again.');
                    return $this->redirect(['action' => 'otp']);
                } 

            }else{
                $this->Flash->error('Invalid Details. Please try again.');
                return $this->redirect(['action' => 'otp']);
            }            

        }
    }
    

    public function verifyOtp()
    {
        if ($this->request->is('post')) {
            $otp = '';
            for ($i = 1; $i <= 6; $i++) {
                $otp .= $this->request->getData("otp_$i");
            }

            if ($otp === '123456') { // Replace with your validation logic
                $this->Flash->success('OTP Verified Successfully');
                return $this->redirect(['action' => 'dashboard']);
            } else {
                $this->Flash->error('Invalid OTP. Please try again.');
                return $this->redirect(['action' => 'otp']);
            }
        }
    }

    public function logout()
    {

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
        }
        $this->request->getSession()->destroy();
        return $this->redirect(['action' => 'login']);
    }

}
