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



class AuthController extends ApiAppController
{

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
        $this->Authentication->addUnauthenticatedActions(['login','userDetails']);
        $action = $this->request->getParam('action');
        $notRequired = Array('login');
        if(!in_array($action,$notRequired)){
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
        
        }
    }
    public function login()
    {

    

       /* $http = new Client();

        $response = $http->post(
            'http://115.124.116.194:8083/ShalarthAPI/shalarth/api/v2/passwords/login',
            [
                'username' => 'S0c72z/Z9KofkRYaoxRjuw==:vPj+NSAIoDSY3tf2Z3dIcA==',
                'password' => 'XIXjSdFeS2KNhax/9JXHvQ==:IOASZObrGd0QHNrk2YGdyA=='
            ],
            [
                'headers' => [
                    'X-API-KEY' => 'd2VsY29tZSB0byByZWcgYXBp',
                    'Content-Type' => 'application/json'
                ],
                'type' => 'json'
            ]
        );

        echo $response->getStringBody();

        exit;*/
        //echo $this->request->getBody()->getContents();
        //exit;
        $this->request->allowMethod(['post']);

        $data = $this->request->getData();

        
        if (
            empty($data['shalarth_code']) ||
            empty($data['secret_key']) ||
            !$this->isValidEncryptedField($data['shalarth_code']) ||
            !$this->isValidEncryptedField($data['secret_key'])
        ) {
            return $this->error('Invalid encryption format', 422);
        }
        //echo $data['shalarth_code'];
        $username = $this->decryptData($data['shalarth_code']);
        $password = $this->decryptData($data['secret_key']);
        /*echo "<pre>";
        print_r($data);
        exit;*/

        


        /*$user = $this->fetchTable('Users')
            ->find()
            ->where(['username' => $data['username']])
            ->first();

        if (!$user || !password_verify($data['password'], $user->password)) {
            return $this->error('Invalid username or password', 401);
        }

        // generate API token
        $token = Security::hash(Security::randomBytes(32), 'sha256');

        $user->api_token = $token;
        $this->fetchTable('Users')->save($user);*/
        //$username = '04DEDSMBM9501';
        $token = Security::hash(Security::randomBytes(32), 'sha256');
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
        $staff = $staffsTable->find()
        ->select( ['id','udise_code','shalarth_code','emp_staff_id','emp_type','emp_name','mobile','email','gender_id','photo_base64'] )
                            ->where(['shalarth_code' => $username])
                            ->first();
        if (!$staff) {
            return $this->error('Invalid username or password', 401);
        }

        /*echo "<pre>";
        print_r( $staff);
        exit;*/

        $tokenHash = hash('sha256', $token);

        $staffMobileAppLoginAudit = TableRegistry::getTableLocator()->get('StaffMobileAppLoginAudit');    

        $audit = $staffMobileAppLoginAudit->newEmptyEntity();
        $audit = $staffMobileAppLoginAudit->patchEntity($audit, [
            'staff_id' => $staff['id'],
            'username' => $username,
            'token_hash' => $tokenHash,
            'token_expiry' => date('Y-m-d H:i:s', time() + 3600),
            'status' => 'SUCCESS',
            'ip_address' => '000.000.000.000',
            'user_agent' => 'TBI'
        ]);

        

        $staffMobileAppLoginAudit->save($audit);


        return $this->respond([
            'token' => $token,
            'user' => $staff
        ]);
    }

    public function userDetails()
    {

        $user_id = $this->request->getHeaderLine('staff-id');
        //echo "dd---".$token = $this->request->getHeaderLine('Authorization');

        $this->request->allowMethod(['get']);
        $staffsTable = TableRegistry::getTableLocator()->get('Staffs');
        $staff = $staffsTable->find()
                            ->where(['id' => $user_id])
                            ->first();
        if (!$staff) {
            return $this->error('No data found', 401);
        }


        return $this->respond([
            'user' => $staff
        ]);
    }
    /*
    public function logout()
    {
        $token = $this->request->getHeaderLine('Authorization');

        if (!$token) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Token missing'
                ]));
        }

        $token = str_replace('Bearer ', '', $token);
        $tokenHash = hash('sha256', $token);

        $audit = $this->StaffMobileAppLoginAudit
            ->find()
            ->where(['token_hash' => $tokenHash, 'is_active' => 1])
            ->first();

        if ($audit) {
            $audit->logged_out_at = date('Y-m-d H:i:s');
            $audit->is_active = 0;
            $audit->status = 'LOGOUT';

            $this->StaffMobileAppLoginAudit->save($audit);
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'message' => 'Logged out successfully'
            ]));
    }*/
}