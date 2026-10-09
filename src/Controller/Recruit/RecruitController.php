<?php
declare(strict_types=1);

namespace App\Controller\Recruit;

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
class RecruitController extends AppController
{
     public function initialize(): void
    {
        parent::initialize();

       $this->Users = $this->fetchTable('Users');
        
    }
    

   
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'otp', 'verifyOtp', 'logout']);
        
    }

   
    public function login()
    {
        $this->viewBuilder()->setLayout('recruit-pre-login');
        $this->request->allowMethod(['get', 'post']);

        if ($this->request->is('post')) {
            $username = trim((string)$this->request->getData('username'));
            if ($username === '' || preg_match('/^[A-Za-z0-9._-]{3,50}$/D', $username) !== 1) {
                $this->Flash->error('Please enter a valid username.');
                return;
            }

            //$hashedPassword = (new DefaultPasswordHasher())->hash('hm123');
            //echo $hashedPassword;
            //exit;

            $user = $this->Users->find()
                ->where(['username' => $username])
                ->first();
                /*echo "<pre>";
                print_r( $user);
                exit;*/
            //if ($user && (new DefaultPasswordHasher())->check($password, $user->password)) {
            if ($user && ($user->id > 0)) {
                
                if($user->role ==  'school'){
                    /*echo "<pre>";
                    print_r($user); //CLERKPRI CLERKSEC CLERKHIE 27DIRP
                    //2702DDCLR
                    exit; */
                    $loggedInMobile = '9356797958';
                    
                   // $this->Flash->error('The School Login is currently disabled. We will inform you as soon as it is reactivated. Thank you for your patience.');
                  //  return;
                }elseif($user->role == 'sanstha'){
                    if(('272301SC048' == $username) || ('270605SC031' == $username) || ('272518SC037' == $username) || ('271515SC007' == $username)){
                        //$sansthaData = $this->fetchSansthaDetails($username);

                        $loggedInMobile = '9356797958';
                    }else{
                        $sansthaData = $this->fetchSansthaDetails($username);
                        
                       
                        if($sansthaData == -1){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Sanstha portal before login.');
                            return;
                        }else if(!is_array($sansthaData)){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Sanstha portal before login.');
                            return;
                        }else if(!is_array($sansthaData[0])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Sanstha portal before login.');
                            return;
                        }else if(!is_array($sansthaData[0][0])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Sanstha portal before login.');
                            return;
                        }else if(!isset($sansthaData[0][0]['mobile'])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Sanstha portal before login.');
                            return;
                        }else{                        
                            $mobile = (string) $sansthaData[0][0]['mobile'];
                            $sansthasTable = $this->fetchTable('Sansthas');
                            $sansthaCode = trim($sansthaData[0][0]['sanstha_code']);
                            $sansthaId = 0;
                            $sanstha = $sansthasTable
                                ->find()
                                ->where([
                                    'code' => $sansthaCode
                                ])
                                ->first();

                               
                            if ($sanstha) {
                                $sansthaId = $sanstha->id;
                                $sanstha->name = $sansthaData[0][0]['sanstha_name'];
                                $sanstha->minority_sanstha = $sansthaData[0][0]['minority_sanstha'];
                                $sanstha->sanstha_minority_name = $sansthaData[0][0]['sanstha_minority_name'];
                                $sanstha->district_code = $sansthaData[0][0]['distcd'];
                                $sanstha->district_name = $sansthaData[0][0]['distname'];
                                $sanstha->mobile = $sansthaData[0][0]['mobile'];

                                $sansthasTable->save($sanstha);
                            }

                            $schoolsTable = $this->fetchTable('Schools');
                            if(isset($sansthaData[0][0]['schools'])){
                                foreach ($sansthaData[0][0]['schools'] as $school) {
                                    $udise_code = trim($school['schcd']);
                                    $entity = $schoolsTable
                                        ->find()
                                        ->where([
                                            'udise_code' => $udise_code
                                        ])
                                        ->first();

                                    if ($entity) {
                                        $entity->udise_code = $udise_code;
                                        $entity->school_name = $school['school_name'];
                                        $entity->sanstha_id = $sansthaId;
                                        $entity->sanstha_code = $sansthaCode;
                                    } else {
                                        $entity = $schoolsTable->newEntity([
                                            'udise_code' => $udise_code,
                                            'school_name' => $school['school_name'],
                                            'sanstha_id' => $sansthaId,
                                            'sanstha_code' => $sansthaCode
                                        ]);
                                    }
                                    $schoolsTable->save($entity);
                                }
                            }

                            
                            $loggedInMobile =  $this->validateIndianMobile($mobile);

                        }
                    }                   
                }elseif($user->role == 'director'){

                    if(('271806SC002---' == $username) || ('270605SC031---' == $username) || ('271515SC007--ddddd' == $username)){
                        $loggedInMobile = '9356797958';
                    }else{
                        //$sansthaData = $this->fetchSchoolUserDetails($username);
                        /*echo "<pre>";
                        print_r($sansthaData);
                        print_r( $sansthaData[0][0]['mobile']);
                        exit;*/
                        /*if($sansthaData == -1){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Saral portal before login.');
                            return;
                        }else if(!is_array($sansthaData)){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Saral portal before login.');
                            return;
                        }else if(!is_array($sansthaData[0])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Saral portal before login.');
                            return;
                        }else if(!is_array($sansthaData[0][0])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Saral portal before login.');
                            return;
                        }else if(!isset($sansthaData[0][0]['operator_mobile'])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on Saral portal before login.');
                            return;
                        }else{                        
                            $mobile = (string) $sansthaData[0][0]['operator_mobile'];
                            $loggedInMobile =  $this->validateIndianMobile($mobile);
                        }*/
                            $loggedInMobile = '9356797958'; 
                            
                    } 
                }else{  
                    /*echo "<pre>";
                    print_r($user); //CLERKPRI CLERKSEC CLERKHIE 27DIRP
                    //2702DDCLR
                    exit;   */     
                    //if('27EDUCOM' == $username || '27DIRP' == $username || '27DIRS' == $username ||  'SUPTPRI' == $username ||   'SUPTSEC' == $username ||  '2725EO02' == $username || '2725EO01' == $username){
                    
                   
                   
                    if('27DDS' == $username ){
                        
                        //$loggedInMobile = '9356797958';
                       $loggedInMobile = $this->validateIndianMobile($user->mobile);                        
                    //else if('2725EO02' == $username || 'superadmin' == $username || '2714EO01CLR---' == $username || '2702DD---' == $username || '27DDP' == $username || 'SUPTPRI' == $username ||  '2702DD--' == $username ||  '2725EO01' == $username || 'CLERKPRI' == $username){
                    }else if('2734EO02--' == $username || 'superadmin' == $username || '2714EO01CLR---' == $username || '2702DD---' == $username ){
                        $loggedInMobile = '9356797958'; 
                    }elseif(($user->role == 'district') && (str_ends_with($username, 'CLR') || str_ends_with($username, 'SUP'))){
                         //$loggedInMobile =  $this->validateIndianMobile($user->mobile);
                         $loggedInMobile = '9356797958'; 
                    }else{
                        //echo $user->role;
                       // exit;
                        $formattedUsername =  $username;
                        /*if(($user->role == 'district') && (preg_match('/^\d{4}EO/', $username))){
                             $formattedUsername =  $username."SU";
                        }*/
                        
                        //$schoolUserData = $this->fetchSchoolUserDetails($formattedUsername);
                        /*echo "<pre>";
                        print_r($schoolUserData);
                        print_r( $schoolUserData[0][0]['operator_mobile']);
                        exit;*/
                        /*if($schoolUserData == -1){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on School portal before login.');
                            return;
                        }else if(!is_array($schoolUserData)){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on School portal before login.');
                            return;
                        }else if(!is_array($schoolUserData[0])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on School portal before login.');
                            return;
                        }else if(!is_array($schoolUserData[0][0])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on School portal before login.');
                            return;
                        }else if(!isset($schoolUserData[0][0]['operator_mobile'])){
                            $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on School portal before login.');
                            return;
                        }else{                        
                            $mobile = (string) $schoolUserData[0][0]['operator_mobile'];
                            $loggedInMobile =  $this->validateIndianMobile($mobile);
                        }*/

                        $loggedInMobile = '9356797958'; 
                    }
                }

                //$loggedInMobile = '9356797958'; // $this->validateIndianMobile($user->mobile);
                // $loggedInMobile =  $this->validateIndianMobile($user->mobile);
                //echo $loggedInMobile;
                //exit;
                if($loggedInMobile){
                    $user_id = $user->id;
                    $userOtpsTable = TableRegistry::getTableLocator()->get('UserOtps');

                    $otp = 123456;//random_int(100000, 999999);
                    //$otp = random_int(100000, 999999);
                    $data = $userOtpsTable->newEmptyEntity();

                    $data->user_id = $user_id;
                    $data->otp = $otp;
                    $data->expires_at = date('Y-m-d H:i:s', strtotime('+16 minutes'));
                    $data->is_used = 0;

                    if ($userOtpsTable->save($data)) {
                        $message = "OTP for Staff Portal is ".$otp.". Valid for next 15 minutes. -Sch Edu and Sports dept";                    
                        $this->request->getSession()->write('loggedInUserID',$user_id);
                        $this->request->getSession()->write('loggedInUser',$username);
                        $this->request->getSession()->write('loggedInMobile',$loggedInMobile);
                        return $this->redirect(['action' => 'otp']);
                        /*$smsService = new SmsService();
                        $result = $smsService->sendSMS('otp',$loggedInMobile, $message);
                        if($result=='Y'){
                            $this->request->getSession()->write('loggedInUserID',$user_id);
                            $this->request->getSession()->write('loggedInUser',$username);
                            $this->request->getSession()->write('loggedInMobile',$loggedInMobile);
                            return $this->redirect(['action' => 'otp']);
                        }else{
                            $this->Flash->error('Enable to send SMS. '.$result);
                        } */     
                    } else {
                        $this->Flash->error('Enable to generate OTP.');
                    }                                 
                } else {
                    $this->Flash->error('The mobile number linked to this username is invalid. Kindly get it corrected on main portal before login.');
                }

            } else {
                $this->Flash->error('Invalid username or password.');
            }
        }
    }

   
    
    
    public function otp()
    {
        $this->viewBuilder()->setLayout('recruit-pre-login');
       
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

                $redirectToController='';
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
                        $Jurisdiction = 1;
                        $role_name ='Education Officer';
                        if (strlen($loggedInUser) == 7) {
                            $district_code = substr($loggedInUser, 0, 4);
                            $role_level    = substr($loggedInUser, 4, 3);
                            if($role_level == 'MDM'){
                                $Jurisdiction = 3;
                                 $role_name ='Education Officer MDM';
                            }

                            $school_level  = substr($loggedInUser, -2);
                           
                        } else  if (strlen($loggedInUser) == 8) {
                            $district_code = substr($loggedInUser, 0, 4);
                            $role_level    = substr($loggedInUser, 4, 2);
                            $school_level  = substr($loggedInUser, -2);
                            if($school_level == '02'){
                                $Jurisdiction = 2;
                                $role_name ='Education Officer Secondary';
                            }else{
                                $Jurisdiction = 1;
                                $role_name ='Education Officer Primary'; 
                            }                           
                        }else if (strlen($loggedInUser) == 10) {
                            $user_level  = substr($loggedInUser, -2);                            
                            if($user_level == 'SU'){
                                $district_code = substr($loggedInUser, 0, 4);
                                $role_level    = substr($loggedInUser, 4, 2);
                                $school_level  = substr($loggedInUser, 6, 2);
                                if($school_level == '02'){
                                    $Jurisdiction = 2;
                                    $role_name ='Education Officer Secondary';
                                }else{
                                    $Jurisdiction = 1;
                                    $role_name ='Education Officer Primary'; 
                                }
                            }
                            
                           
                        }else if (strlen($loggedInUser) == 11) {
                            $user_level  = substr($loggedInUser, -3);
                            if($user_level == 'SUP'){
                                $district_code = substr($loggedInUser, 0, 4);
                                $role_level    = substr($loggedInUser, 4, 2);
                                $school_level  = substr($loggedInUser, 6, 2);
                                if($school_level == '02'){
                                    $Jurisdiction = 2;
                                    $role_name ='EO Superintendent Secondary';
                                }else{
                                    $Jurisdiction = 1;
                                    $role_name ='EO Superintendent Primary'; 
                                }
                                $redirectToController='DistrictSuperintendent';
                            }elseif($user_level == 'CLR'){
                                $district_code = substr($loggedInUser, 0, 4);
                                $role_level    = substr($loggedInUser, 4, 2);
                                $school_level  = substr($loggedInUser, 6, 2);
                                if($school_level == '02'){
                                    $Jurisdiction = 2;
                                    $role_name ='EO Clerk Secondary';
                                }else{
                                    $Jurisdiction = 1;
                                    $role_name ='EO Clerk Primary'; 
                                }
                                $redirectToController='DistrictClerk';
                            }
                            
                           
                        }
                        $districtDetails = $districtTable->find()
                            ->where(['code' => $district_code])
                            ->first();

                        $districtDetails->role_name = $role_name;
                        $districtDetails->Jurisdiction = $Jurisdiction;


                        $this->request->getSession()->write('Auth.District',$districtDetails);
                    }else if($user->role == 'division'){ 
                        $divisionTable = TableRegistry::getTableLocator()->get('Regions');
                        $role_name ='Deputy Director';
                        $division_code = substr($loggedInUser, 0, 4);
                        $role_level    = substr($loggedInUser, 4, 2);
                        $Jurisdiction = 1;
                        if (strlen($loggedInUser) == 9) {
                            $user_level  = substr($loggedInUser, -3);                            
                            if($user_level == 'ADH'){                                
                                $role_name ='Assistant Director Higher Secondary';                               
                                $redirectToController='DivisionAssistantDirector'; 
                                $Jurisdiction = 4;  
                            }
                        }else if (strlen($loggedInUser) == 10) {
                            $user_level  = substr($loggedInUser, -4);                        
                            if($user_level == 'CLRP'){                                
                                $role_name ='Clerk Primary';                               
                                $redirectToController='DivisionClerk'; 
                                $Jurisdiction = 1;  
                            }elseif($user_level == 'CLRS'){                                
                                $role_name ='Clerk Secondary';                               
                                $redirectToController='DivisionClerk';   
                                $Jurisdiction = 2;
                            }elseif($user_level == 'CLRH'){                                
                                $role_name ='Clerk Higher Secondary';                               
                                $redirectToController='DivisionClerk';   
                                $Jurisdiction = 4;
                            }elseif($user_level == 'DEIP'){                                
                                $role_name ='Deputy Education Inspector Primary';                               
                                $redirectToController='DivisionDeputyEducationInspector';   
                                $Jurisdiction = 1;
                            }elseif($user_level == 'DEIS'){                                
                                $role_name ='Deputy Education Inspector Secondary';                               
                                $redirectToController='DivisionDeputyEducationInspector';   
                                $Jurisdiction = 2;
                            }elseif($user_level == 'ADIH'){                                
                                $role_name ='Assistant Deputy Inspector Higher Secondary';                               
                                $redirectToController='DivisionAssistantDeputyInspector';   
                                $Jurisdiction = 4;
                            }                           
                        }
                        $divisionDetails = $divisionTable->find()
                            ->where(['code' => $division_code])
                            ->first();

                        $divisionDetails->role_name = $role_name;
                        $divisionDetails->Jurisdiction = $Jurisdiction;


                        $this->request->getSession()->write('Auth.Division',$divisionDetails);
                    }
               

                    // Store user in session (optional)
                    $this->request->getSession()->write('Auth.User', [
                        'id' => $user->id,
                        'username' => $user->username,
                        'role' => $user->role,
                        'full_name' => $user->full_name
                    ]);
                    //$role = $this->request->getSession()->read('Auth.User.role');
                    if(!empty($redirectToController)){
                        return $this->redirect(['prefix' => 'Recruit','controller' => $redirectToController,'action' => 'dashboard']);
                    }
                    return $this->redirect(['prefix' => 'Recruit','controller' => $user->role,'action' => 'dashboard']);
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
    

   

    public function logout()
    {
        $this->Authentication->logout();
        $this->request->getSession()->destroy();
        return $this->redirect(['action' => 'login']);
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



    private function fetchSansthaDetails($sansthaCode){
        $sansthaCode = $sansthaCode;
        $acYear = "2025-26";
        $password = "SchoolData#@APISTAFF$!2345";
        $client = "STAFF";
        $sansthaAPI = 'https://education.maharashtra.gov.in/school/reports/sharesansthadata';
        // Initialize CakePHP HTTP client
        $http = new Client([
            'timeout'         => 60.0, // Total timeout for the request
            'connect_timeout' => 10.0, // Timeout specifically for establishing the connection
        ]);

        // Prepare API request payload
        $payload = ['sanstha_code' => $sansthaCode,"ac_year" => $acYear,"password" => $password,"client" => $client];  
        
        /** Sanctioned API Call */ 
        $response = $http->post($sansthaAPI,
            json_encode($payload),
            [
                'type' => 'json',
                'headers' => [                    
                    'Content-Type' => 'application/json'
                ],
            ]
        );
        $body = $response->getJson();  
       
       /*echo "<pre>";
       print_r( $body['data'][0][0]['mobile']);
       exit;*/
        // Handle API response
        if ((!is_array($body['data'])) || (count($body['data'])<=0)) {
            return -1;
        }
       return $body['data'];
    }
    /** */

    private function fetchSchoolUserDetails($username){
       // $username = '2706EO02SU';
        $data = ["user_id" => $username,"client" => "STAFFUSERMOBILE","timestamp" => time()];

        /*echo "<pre>";
        print_r($data);*/

        $secretKey ='STAFFUSERMOBILE_Wc3Af6Zu0Je2Tp7Er4Uyf9Gh3Jk6Lq2Bw8Y7qRt2Vm8Lp4Xn1Ks5Hd9Oi1As5D';
        //$encrypted = "axNq3SNt4vL5/EbHnRMYke0CiB4uaNfzqI+GWXWb2uI+me0EmZqnfpMtnPyKDmgHB/vBUKDzmZ6y6Ujq7sVNFY4kmkPvD8P5ixwPkspZCc4="; 
         //Encrypted: HDT4bT+ZB3Xi6vVfPX6IRfRDFFTdMT6yGFR4TUhGPD6AYriPajRbnH61PKLdiTlM5ABauLnzrobti+exHNNCoOU4+IJ9us/OMU8rLoArBDQ=
        $encrypted = $this->encryptNic($data,$secretKey);
        //echo "<pre>Encrypted: " . $encrypted . PHP_EOL;


        $sansthaAPI = 'https://education.maharashtra.gov.in/school/reports/datasharestaffusermobile';
        // Initialize CakePHP HTTP client
        $http = new Client([
            'timeout'         => 60.0, // Total timeout for the request
            'connect_timeout' => 10.0, // Timeout specifically for establishing the connection
        ]);

        // Prepare API request payload
         $payload["payload"] = $encrypted;
        /* $decryptNic = $this->decryptNic($encrypted,$secretKey);
        echo "<pre>Decrypted: " . print_r($decryptNic,true) . PHP_EOL;

       exit;*/

        
        /** Sanctioned API Call */ 
        $response = $http->post($sansthaAPI,
            json_encode($payload),
            [
                'type' => 'json',
                'headers' => [                    
                    'Content-Type' => 'application/json'
                ],
            ]
        );
        $body = $response->getJson();  
       
      /* echo "<pre>";
       print_r($body);
       exit;*/
        // Handle API response
        if ((!is_array($body['data'])) || (count($body['data'])<=0)) {
            return -1;
        }
       return $body['data'];
    }

    

 
 public function encryptNic($data,$secretKey){

        $method = "AES-256-CBC";

        $key = hash('sha256',$secretKey,true);
        $iv = substr(hash('sha256',$secretKey),0,16);

        $encrypted = openssl_encrypt(json_encode($data),$method,$key,OPENSSL_RAW_DATA,$iv);

        return base64_encode($encrypted);
    }

    public function decryptNic($encrypted,$secretKey){

        $method = "AES-256-CBC";

        $key = hash('sha256',$secretKey,true);
        $iv = substr(hash('sha256',$secretKey),0,16);

        $decrypted = openssl_decrypt(base64_decode($encrypted),$method,$key,OPENSSL_RAW_DATA,$iv);

        return json_decode($decrypted,true);
    }
   

}
