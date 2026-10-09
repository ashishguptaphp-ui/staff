<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    private $secretKeyStaff,$secretKeyShalarth,$encMenthod;

    public function initialize(): void
    {
        parent::initialize();

        // Disable view rendering
        $this->viewBuilder()->disableAutoLayout();
        $this->autoRender = false;
        $this->encMenthod='AES-128-CBC'; 
        $this->secretKeyStaff = "EduGoMStaffResil";
        $this->secretKeyShalarth = "ShalarthAPIKey01";
    }

    protected function respond($data, int $status = 200)
    {

        $pau = [
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
       // print_r($data);
      //  $this->response = $this->response->withStatus($status);

        $response = [
                'success' => $status < 400,
                'status' => $status,
                'timestamp' => time(),
                'data' =>$data,
                'pau' => $this->encryptData(json_encode($pau)),
                'payload' => $this->encryptData(json_encode($data))
            ];
            /*echo "<pre>";
            print_r($data );
            exit; */
         return $this->response
            ->withType('application/json')
            ->withStatus($status)
            ->withStringBody(json_encode($response));
            /*
        $this->set([
            'success' => $status < 400,
            'data' => $data,//$this->encryptData($data),
            '_serialize' => ['success', 'data']
        ]);*/
    }

    protected function error($message, int $status = 400)
    {
        
        
        $response = [
                'success' => false,
                'status' => $status,
                'timestamp' => time(),
                'payload' => $this->encryptData(json_encode($message))
            ]; 
         return $this->response
            ->withType('application/json')
            ->withStatus($status)
            ->withStringBody(json_encode($response));

        /*$this->response = $this->response->withStatus($status);

        $this->set([
            'success' => false,
            'message' => $message,
            '_serialize' => ['success', 'message']
        ]);*/
    }

    function encryptData($plainText,$app_id=1)
    {
        $method = $this->encMenthod; 
        if($app_id == 2){
            $secretKey = $this->secretKeyShalarth;
        }else{
            $secretKey = $this->secretKeyStaff;
        }       

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

    function decryptData($encryptedText,$app_id=1)
    {
        $method = $this->encMenthod; 
        if($app_id == 2){
            $secretKey = $this->secretKeyShalarth;
        }else{
            $secretKey = $this->secretKeyStaff;
        }

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

    function isValidEncryptedField(string $value): bool
    {
        // must contain IV and cipher separated by colon
        if (!str_contains($value, ':')) {
            return false;
        }

        [$ivBase64, $cipherBase64] = explode(':', $value, 2);

        // base64 decode
        $iv = base64_decode($ivBase64, true);
        $cipher = base64_decode($cipherBase64, true);

        // check decoding success
        if ($iv === false || $cipher === false) {
            return false;
        }

        // IV must be 16 bytes for AES-128-CBC
        if (strlen($iv) !== 16) {
            return false;
        }

        // cipher should not be empty
        if (strlen($cipher) === 0) {
            return false;
        }

        return true;
    }
}