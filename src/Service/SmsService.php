<?php
namespace App\Service;
use Cake\Core\Configure;
use Cake\Http\Client;

class SmsService
{
    private string $endpoint,$username,$password,$senderid,$deptSecureKey;
    private array $templateids,$responseArr;


    public function __construct()
    {
        //$config = config('ESDL');
        $config = Configure::read('SMS');

        if (empty($config)) {
            throw new \RuntimeException('SMS configuration not found');
        }

        $this->endpoint = $config['endpoint'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->senderid = $config['senderid'];
        $this->deptSecureKey = $config['deptSecureKey'];
        $this->templateids = $config['templateids'];
        $this->responseArr = $config['responseArr'];

        
    }

    public function sendSMS($smsType,$mobileno, $message)
    {
        $key = hash(
            'sha512',
            trim($this->username) .
            trim($this->senderid) .
            trim($message) .
            trim($this->deptSecureKey)
        );

        $encryp_password = sha1(trim($this->password));
        //echo $smsType;
        $templateid = $this->templateids[$smsType];
       
        $data = [
            "username" => trim($this->username),
            "password" => trim($encryp_password),
            "senderid" => trim($this->senderid),
            "content" => trim($message),
            "smsservicetype" => "singlemsg",
            "mobileno" => trim($mobileno),
            "key" => trim($key),
            "templateid" => trim($templateid)
        ];

        $http = new Client([
            'timeout' => 30
        ]);

        $response = $http->post(
            $this->endpoint,
            $data
        );

        $result = $response->getStringBody();
        $response = explode(',', trim($result));
        $res_no = substr(trim($response[0]), 0, 3);
        if ($res_no === '402') {
            return 'Y';
        }

        return $this->responseArr[$res_no] ?? 'Unknown Error';
       // return $response->getStringBody();
    }
}

