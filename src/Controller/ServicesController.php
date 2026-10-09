<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Cake\ORM\TableRegistry;
use Cake\Http\Response;
use App\Config\JwtConfig;

class ServicesController extends AppController
{
   
    public function initialize(): void
    {
        parent::initialize();
        
        // Don't load security components for API
        // Enable CORS
        if ($this->request->is('options')) {
            $this->response = $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            return;
        }
    }
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['connect', 'dashboard','getTeachers']);

    }
    /**
     * Connect API - Generates JWT tokens
     */
    public function connect(): Response
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        
        // Get request data
        $data = $this->request->getData();
        //$rawBody = $this->getRequest()->getBody()->getContents();
        //$data = json_decode($rawBody, true);

        /*echo "<pre>";
        print_r($data );
        exit;*/
         
        // Validate required fields
        $requiredFields = ['username', 'password', 'client_id', 'client_secret','service_id'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return $this->response
                    ->withStatus(400)
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'error',
                        'message' => "Missing required field: {$field}"
                    ]));
            }
        }
        
        // Validate client credentials
        if ($data['client_id'] !==  JwtConfig::CLIENT_ID  || 
            $data['client_secret'] !==  JwtConfig::CLIENT_SECRET) {
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid client credentials'
                ]));
        }

        if ($data['password'] !==  JwtConfig::USER_PASSWORD || 
            $data['username'] !==  JwtConfig::USER_NAME) {
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid username or password.'
                ]));
        }
        
        // Authenticate user
        $user = $this->authenticateUser($data['username'], $data['password']);
        
        if (!$user) {
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid username or password.'
                ]));
        }
        
        // Check if user is active
        if (isset($user['status']) && $user['status'] !== 'active') {
            return $this->response
                ->withStatus(403)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'User account is disabled. Contact administrator.'
                ]));
        }
        
        /*$user['id'] = JwtConfig::USER_ID;
        $user['username'] = JwtConfig::USER_NAME;
        $user['role'] = JwtConfig::USER_ROLE;*/
        // Generate tokens
        $tokens = $this->generateTokens($user);
        
        return $this->response
            ->withStatus(200)
            ->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'access_token' => $tokens['access_token'],
                'refresh_token' => $tokens['refresh_token'],
                'expires_in' => 3600,
                'token_type' => 'Bearer',
                'issued_at' => date('c')
            ]));
    }
    
    private function authenticateUser(string $username, string $password): ?array
    {
        //$hashedPassword = '$2y$10$K4b6k9s2m7p1q3t5v7x9z.BcDfGhJkLnMoPqRsTuVwXyZ0b2d4f6h8j0l2n4p6r8t0v';
        $hashedPassword = '$2y$12$jkL.kbEj2z1SVjGxIy0ZQ.xD7OAkGSaytwP5ycAgBeXSDYm73ulHi';
        $users = [
            'saral_api_agent' => [
                'id' => '27STADMIN',
                'username' => 'saral_api_agent',
                'password' => $hashedPassword,
                'role' => 'api_agent',
                'status' => 'active'
            ]
        ];
      
        
        if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
            return $users[$username];
        }
        
        return null;
    }
    
    private function generateTokens(array $user): array
    {
        $issuedAt = time();
        
        $accessTokenPayload = [
            'iss' => 'saral-portal',
            'aud' => 'saral-portal',
            'iat' => $issuedAt,
            'exp' => $issuedAt + 3600,
            'sub' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'] ?? 'user',
            'type' => 'access'
        ];
        
        $refreshTokenPayload = [
            'iss' => 'saral-portal',
            'aud' => 'saral-portal',
            'iat' => $issuedAt,
            'exp' => $issuedAt + 86400 * 7,
            'sub' => $user['id'],
            'username' => $user['username'],
            'type' => 'refresh'
        ];     
       

        $accessToken = JWT::encode($accessTokenPayload, JwtConfig::SECRET_KEY, JwtConfig::ALGORITHM);
        $refreshToken = JWT::encode($refreshTokenPayload, JwtConfig::SECRET_KEY, JwtConfig::ALGORITHM);
        
        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ];
    }



    public function getTeachers(string $udise_code): Response
    {
        $this->request->allowMethod(['get']);
        $token = $this->getBearerToken();
        
        if (!$token) {
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Missing or invalid Authorization header'
                ]));
        }
        
        try {          

          

            $schoolsTable = TableRegistry::getTableLocator()->get('UdiseSchoolMaster');
            $school = $schoolsTable->find()
                                ->where(['udise_school_code' => $udise_code])
                                ->first();

            if ($school) {
                $teachersTable = TableRegistry::getTableLocator()->get('UdiseTeacherProfile');
                $teachers = $teachersTable->find()
                                ->where(['school_id' => $school->school_id])
                                ->all();
               

                    /*
                    echo "<pre>";
print_r($school);
exit;
                    */
                if ($teachers) {
                    $school->teachers = $teachers;
                    return $this->response
                      ->withStatus(200)
                      ->withType('application/json')
                      ->withStringBody(json_encode([
                          'status' => 'success',
                          'data' => $school
                      ]));

                }
                return $this->response
                    ->withStatus(401)
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'error',
                        'message' => 'No Teacher found'
                    ]));
            }
            return $this->response
                    ->withStatus(401)
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'error',
                        'message' => 'Invalid UDISE Code'
                    ]));
                    
            
          
                
        } catch (\Exception $e) {
          
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid or expired token'
                ]));
        }
    }

    /**
     * Dashboard API - Returns HTML dashboard based on user role
     * 
     * @param string $userId User ID
     * @return \Cake\Http\Response
     */
    public function dashboard(string $userId): Response
    {
       

        if('27STADMIN' != $userId){
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid UserID'
                ]));
        }
        $this->request->allowMethod(['get']);
        
        // Verify JWT token
        $token = $this->getBearerToken();
        if (!$token) {
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Missing or invalid Authorization header'
                ]));
        }
        
        try {
            $payload = $this->validateToken($token);
           
            // Check if user has access to this dashboard
            if ($payload->sub != $userId) {
                return $this->response
                    ->withStatus(403)
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'error',
                        'message' => 'Access denied'
                    ]));
            }
            
            // Get user role and data
            $userData = $this->getUserData($userId);
            $html = $this->generateDashboardHtml($userData);
            
            return $this->response
                ->withStatus(200)
                ->withType('text/html')
                ->withStringBody($html);
                
        } catch (\Exception $e) {
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid or expired token'
                ]));
        }
    }

    /**
     * Refresh Token API
     */
    public function refresh(): Response
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        
        $data = $this->request->getData();
        
        if (empty($data['refresh_token'])) {
            return $this->response
                ->withStatus(400)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Refresh token is required'
                ]));
        }
        
        try {
            $payload = JWT::decode(
                $data['refresh_token'],
                new Key(JwtConfig::SECRET_KEY, JwtConfig::ALGORITHM)
            );
            
            // Generate new access token
            $user = ['id' => $payload->sub, 'username' => $payload->username];
            $tokens = $this->generateTokens($user);
            
            return $this->response
                ->withStatus(200)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'success',
                    'access_token' => $tokens['access_token'],
                    'expires_in' => JwtConfig::ACCESS_TOKEN_EXPIRY,
                    'token_type' => 'Bearer',
                    'issued_at' => date('c')
                ]));
                
        } catch (\Exception $e) {
            return $this->response
                ->withStatus(401)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Invalid refresh token'
                ]));
        }
    }

    
    private function getBearerToken(): ?string
    {
        $header = $this->request->getHeaderLine('Authorization');
        
        if (empty($header)) {
            return null;
        }
        
        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return $matches[1];
        }
        
        return null;
    }
    
    private function validateToken(string $token): object
    {
        return JWT::decode($token, new Key(JwtConfig::SECRET_KEY, JwtConfig::ALGORITHM));
    }
    
    private function getUserData(string $userId): array
    {
        $usersData = [
            '1' => [
                'id' => '1',
                'name' => 'SARAL API Agent',
                'role' => 'api_agent',
                'stats' => [
                    'total_schools' => 18324,
                    'total_staff' => 256890,
                    'pending_verifications' => 1289
                ]
            ],
            '2' => [
                'id' => '2',
                'name' => 'Administrator',
                'role' => 'admin',
                'stats' => [
                    'total_schools' => 18324,
                    'total_staff' => 256890,
                    'pending_verifications' => 1289
                ]
            ]
        ];
        
        return $usersData[$userId] ?? [
            'id' => $userId,
            'name' => 'User',
            'role' => 'user',
            'stats' => [
                'total_schools' => 0,
                'total_staff' => 0,
                'pending_verifications' => 0
            ]
        ];
    }
    
    private function generateDashboardHtml(array $userData): string
    {
        $title = '';
        $welcome = '';
        $stats = '';
        
        switch ($userData['role']) {
            case 'api_agent':
                $title = 'API Agent Dashboard';
                $welcome = '<h1>Welcome to the API Agent Dashboard</h1>';
                break;
            case 'admin':
                $title = 'Administrator Dashboard';
                $welcome = '<h1>Welcome to the Administrator Dashboard</h1>';
                break;
            default:
                $title = 'User Dashboard';
                $welcome = sprintf('<h1>Welcome, %s</h1>', htmlspecialchars($userData['name']));
                break;
        }
        
        $stats = sprintf(
            '<div class="stat-card"><h3>Total Schools</h3><p>%s</p></div>' .
            '<div class="stat-card"><h3>Total Staff</h3><p>%s</p></div>' .
            '<div class="stat-card"><h3>Pending Verifications</h3><p>%s</p></div>',
            number_format($userData['stats']['total_schools']),
            number_format($userData['stats']['total_staff']),
            number_format($userData['stats']['pending_verifications'])
        );
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Education & Sports — Interactive Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <style>
    body { background: linear-gradient(180deg,#f7fbff 0%, #ffffff 60%); }
    .card-hero { border-radius: 14px; box-shadow: 0 6px 18px rgba(25,40,60,0.08); }
    .progress-sm { height: 10px; border-radius: 10px; }
    .badge-round { border-radius: 999px; padding: .4rem .7rem; }
    @media (max-width: 991px){ .sidebar{display:none} } 
    body {
      font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, Arial;
      background:#f9fafb;
      
      color:#0f172a;
    }

    .stats-wrap { max-width:1200px; margin:0 auto; }

    .hero {
      background:#fff;
      border-radius:12px;
      padding:14px 20px;
      margin-bottom:20px;
      border:1px solid #e5e7eb;
      box-shadow:0 2px 6px rgba(0,0,0,0.04);
    }
    .hero .title { font-weight:600; font-size:1.2rem; color:#1e293b; }

    .card-stat {
      background:#fff;
      border-radius:14px;
      padding:3px;
      text-align:center;
      border:1px solid #e5e7eb;
      box-shadow:0 4px 12px rgba(0,0,0,0.06);
      transition:transform .2s ease, box-shadow .2s ease;
    }
    .card-stat:hover {
      transform:translateY(-4px);
      box-shadow:0 8px 20px rgba(0,0,0,0.08);
    }
    .card-stat .icon {
      font-size:2rem;
      margin-bottom:8px;
      color:#64748b;
    }
    .card-stat .label {
      font-size:0.8rem;
      font-weight:500;
      color:#475569;
    }
    .card-stat .value {
      font-size:1.2rem;
      font-weight:700;
      color:#0f172a;
      margin-top:4px;
    }

    .bg-totalSchools { background:linear-gradient(135deg,#9fd3d9,#e0e7ff); }

    .bg-total { background:linear-gradient(135deg,#eef2ff,#e0e7ff); }
    .bg-teaching { background:linear-gradient(135deg,#ecfdf5,#d1fae5); }
    .bg-nonteaching { background:linear-gradient(135deg,#fff7ed,#ffedd5); }

    .bg-1 { background:linear-gradient(135deg,#eff6ff,#dbeafe); }
    .bg-2 { background:linear-gradient(135deg,#ecfdf5,#d1fae5); }
    .bg-3 { background:linear-gradient(135deg,#fefce8,#fef9c3); }
    .bg-4 { background:linear-gradient(135deg,#fef2f2,#fee2e2); }
    .bg-5 { background:linear-gradient(135deg,#f5f3ff,#ede9fe); }
    .bg-6 { background:linear-gradient(135deg,#fdf2f8,#fce7f3); }
    .bg-7 { background:linear-gradient(135deg,#f0fdfa,#ccfbf1); }
    .bg-8 { background:linear-gradient(135deg,#fff7ed,#ffedd5); }
    .bg-9 { background:linear-gradient(135deg,#f9fafb,#f3f4f6); }
    .bg-10{ background:linear-gradient(135deg,#f0fdf4,#dcfce7); }

    @media(max-width:767px){
      .card-stat { padding:16px; }
      .card-stat .value { font-size:1.4rem; }
    }
   

    h2 {
      text-align: center;
      color: #004080;
      margin-bottom: 20px;
    }

    .table-container {
      overflow-x: auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 15px;
    }

    thead {
      background: linear-gradient(90deg, #004080, #0066cc);
      color: #fff;
    }

    thead th {
      padding: 14px 10px;
      font-weight: 600;
      text-align: center;
    }

    tbody td {
      padding: 12px 10px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    tbody tr:nth-child(even) {
      background: #f9fbfd;
    }

    tbody tr:hover {
      background: #eef5ff;
      transition: 0.3s;
    }

    .category {
      text-align: left;
      font-weight: 600;
      color: #004080;
    }

    .teaching {
      color: #007b3c;
      font-weight: 600;
    }
    .nonteaching {
      color: #cc0000;
      font-weight: 600;
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tbody tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        background: #fff;
      }
      tbody td {
        text-align: right;
        padding: 8px 5px;
        position: relative;
      }
      tbody td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
        color: #004080;
      }
    }
    

    .tables-container {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .table-box {
      flex: 1 1 400px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 20px;
    }

    .table-box h3 {
      text-align: center;
      color: #0066cc;
      margin-bottom: 15px;
    }

    .table-box table {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
    }

    .table-box thead {
      background: linear-gradient(90deg, #004080, #0066cc);
      color: #fff;
    }

    .table-box thead th {
      padding: 12px;
      font-weight: 600;
      text-align: center;
    }

    .table-box tbody td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    .table-box tbody tr:nth-child(even) {
      background: #f9fbfd;
    }

    .table-box tbody tr:hover {
      background: #eef5ff;
      transition: 0.3s;
    }

    .category {
      text-align: left;
      font-weight: 600;
      color: #004080;
    }

    .teaching {
      color: #007b3c;
      font-weight: 600;
    }

    .nonteaching {
      color: #cc0000;
      font-weight: 600;
    }

    @media (max-width: 900px) {
      .tables-container {
        flex-direction: column;
      }
    }

    .contentchart {
      display:grid;
      grid-template-columns: 1fr 320px;
      gap:18px;
      align-items:start;
    }
    @media (max-width:920px){
      .content{ grid-template-columns: 1fr; }
    }

    .summary {
      background:linear-gradient(180deg,#fff,#fbfdff);
      border-radius:10px;
      border:1px solid #eef2ff;
      padding:3px;
      box-shadow:0 4px 12px rgba(11,36,71,0.04);
      font-size:0.92rem;
    }
    .summary .row{ display:flex; justify-content:space-between; padding:2px 3px; border-bottom:1px dashed #eef2ff; }
    .summary .row:last-child{ border-bottom:0; font-weight:700; }

    .muted { color:var(--muted); font-size:0.85rem; }
    .value { color:#0b2b4a; font-weight:700; }
    
    #language table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 40px;
      box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
    }
    #language th, td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ddd;
    }
    #language th {
      background: linear-gradient(to right, #1e90ff, #00c6ff);
      color: white;
    }
    #language tr:nth-child(even) {
      background: #f9f9f9;
    }    
   
    .chart-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: nowrap;
      margin-top:0px;
      gap: 5px;
      padding:2px;
      border-radius: 0px 0px 14px 14px;
      background: #e2e9d1;
    }
    .chart-box {
      width: 19%;
      text-align: center;
    }
    .chart-box-1 {
      width: 24%;
      text-align: center;
    }
    .chart-box-2 {
      width: 48%;
      text-align: center;
    }
    canvas {
      max-width: 100%;
      height: auto;
    }

    
    #credit-badge {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background: #1a237e;
    color: #fff;
    padding: 10px 16px;
    border-radius: 30px;
    font-family: Poppins, sans-serif;
    font-size: 0.9rem;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: transform 0.3s;
    z-index: 1000;
    }
    #credit-badge:hover { transform: scale(1.1); }

    #credit-popup {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1001;
    }

    .credit-content {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(50px);
    border: 1px solid rgba(255,255,255,0.50);
    border-radius: 20px;
    padding: 20px;
    width: 400px;
    text-align: center;
    color: #fff;
    font-family: Poppins, sans-serif;
    animation: fadeIn 0.4s ease;
    }
    .credit-content h2 {
    margin-top: 0;
    margin-bottom: 12px;
    font-size: 1.3rem;
    }
    .credit-content ul {
    list-style: none;
    padding: 0;
    margin: 0 0 15px;
    }
    .credit-content li {
    margin: 6px 0;
    font-size: 1rem;
    }
    .dev-credit {
    font-size: 0.95rem;
    margin-bottom: 20px;
    }
    .close-btn {
    background: #4caf50;
    border: none;
    color: #fff;
    padding: 8px 18px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.3s;
    }
    .tech-logo {
    
    height: 50px;
    object-fit: contain;
    }

    .close-btn:hover { background: #43a047; }

    @keyframes fadeIn {
    from {opacity: 0; transform: scale(0.9);}
    to   {opacity: 1; transform: scale(1);}
    }

    .footer {
        background: linear-gradient(90deg, #0f172a, #1e293b);
        color: #e2e8f0;
        padding: 25px 20px;
        margin-top: 40px;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    .footer-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-left {
        font-size: 14px;
        line-height: 1.6;
    }

    .footer-left p {
        margin: 0;
    }

    .footer-left .data-source {
        font-size: 13px;
        color: #cbd5e1;
        margin-top: 4px;
    }

    .footer-right {
        text-align: right;
    }

    .footer-right .tech-label {
        display: block;
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 6px;
    }

    .tech-logos {
        display: flex;
        gap: 12px;
        align-items: center;
        justify-content: flex-end;
    }

    .tech-logos img {
        height: 50px;
        filter: brightness(1) invert(0);
        transition: transform 0.3s ease;
    }

    .tech-logos img:hover {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .footer-container {
        flex-direction: column;
        text-align: center;
        }
        .footer-right {
        text-align: center;
        }
        .tech-logos {
        justify-content: center;
        }
    }
  </style>
</head>
<body>
<div id="main-content">
  <div class="container-fluid" >
     
   

    <div class="row">
     

      <!-- Main content -->
      <main class="col-lg-12">
        <div class="hero">
                <div class="title" style="width: fit-content; margin: 0 auto;">
                        Welcome to Staff Portal - Dashboard
                </div>
        </div>
        <section id="overview" class="row g-3 align-items-stretch">
          <div class="col-12">
            <div class="stats-wrap mb-2">             
              <div class="row g-2">
                

                <div class="col-md-4">
                  <div class="card-stat bg-total">
                    <div class="icon">👥<span class="label">Total Staff - </span><span class="value"><span id="countTotal">0</span></span></div>                    
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card-stat bg-teaching">
                    <div class="icon">📘<span class="label">Teaching Staff - </span><span class="value"><span id="countTeaching">0</span></span></div>                    

                    
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card-stat bg-nonteaching">
                    <div class="icon">💼 <span class="label">Non-Teaching Staff - </span><span class="value"><span id="countNonTeaching">0</span></span></div>                                        
                  </div>
                </div>
              </div>
            </div>

            
          </div>
          



          <div class="col-lg-6 col-md-12">
            <div class="card card-hero p-2">
              <div class="small text-muted">Gender Ratio (Staff)</div>
              <canvas id="genderChart" height="400"></canvas>
            </div>
          </div>
          
          <div class="col-lg-6 col-md-12">
            <div class="card card-hero p-2">
              <canvas id="socialLine" height="420"></canvas>
            </div>
          </div>
          
          <div class="col-lg-12 col-md-12">
            <div class="card card-hero">
                <canvas id="chartStaffType" height="420"></canvas>
            </div>
          </div>
           <div class="col-lg-12 col-md-12">

            <div class="card card-hero">
              <div class="small text-muted">Class Allocation of Teachers</div>
             
              <div>
                    <canvas id="classChart" height="420"></canvas>

               
                </div>
            </div>
          </div>

          
          
          <h3 style="text-align: center; background: #e2e9d1; margin: 10px 0px 0px 0px; border-radius: 14px 14px 0px 0px; padding: 10px 0px; font-size: 22px;">Teacher Training & Deployment Insights</h3>
          <div class="chart-container">
            
            <div class="chart-box-1">
              <div class="small text-muted">On Deputation from Another School</div>             
              <canvas id="chart1"></canvas>
            </div>
           
            
          
            
           
            <div class="chart-box-1">
              <div class="small text-muted">CWSN Training</div>
              <canvas id="chart3"></canvas>
            </div>
            <div class="chart-box-1">
              <div class="small text-muted">Computer Training</div>
              <canvas id="chart4"></canvas>
            </div>
            <div class="chart-box-1">
              <div class="small text-muted">NISHTHA Training</div>
              <canvas id="chart5"></canvas>
            </div>
          </div>


         


          
          
          
          <div class="col-lg-4 col-md-6">
            <div class="card card-hero p-2">
              <div class="small text-muted">Disability Distribution</div>
              <canvas id="multiRingChart"></canvas>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
             <div class="card card-hero p-3 h-100">
              <canvas id="teachingPie" ></canvas>
            </div>
           
          </div>
          <div class="col-lg-4 col-md-6">
             <div class="card card-hero p-3 h-100">
              <canvas id="nonTeachingPie" height="200"></canvas>
            </div>
           
          </div>    
          
          <div class="col-lg-12 col-md-12">
            <div class="hero">
                <div class="title">Teacher Language Proficiency (Working Knowledge)</div>  
           
              <div class="row">
              
                <div class="col-lg-5 col-md-12" style1="padding:0px;">
                  <table>
                    <thead>
                      <tr>
                        <th>Medium</th>
                        <th>Language 1</th>
                        <th>Language 2</th>
                        <th>Language 3</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr><td>Bengali</td><td>303</td><td>217</td><td>918</td></tr>
                        <tr><td>English</td><td>211033</td><td>101608</td><td>378216</td></tr>
                        <tr><td>Gujarati</td><td>1127</td><td>802</td><td>1468</td></tr>
                        <tr><td>Hindi</td><td>44474</td><td>467015</td><td>123416</td></tr>
                        <tr><td>Kannada</td><td>1781</td><td>554</td><td>704</td></tr>
                        <tr><td>Malayalam</td><td>0</td><td>1</td><td>0</td></tr>
                        <tr><td>Marathi</td><td>439014</td><td>104770</td><td>118650</td></tr>
                        <tr><td>Odia</td><td>0</td><td>0</td><td>1</td></tr>
                        <tr><td>Other</td><td>350</td><td>53250</td><td>104618</td></tr>
                        <tr><td>Rajasthani</td><td>0</td><td>0</td><td>1</td></tr>
                        <tr><td>Sanskrit</td><td>0</td><td>1</td><td>5</td></tr>
                        <tr><td>Sindhi</td><td>157</td><td>193</td><td>657</td></tr>
                        <tr><td>Tamil</td><td>244</td><td>355</td><td>801</td></tr>
                        <tr><td>Telugu</td><td>319</td><td>229</td><td>599</td></tr>
                        <tr><td>Urdu</td><td>34544</td><td>4351</td><td>3292</td></tr>

                    </tbody>
                  </table>             
                </div> 
                 <div class="col-lg-7 col-md-12" style1="padding:0px;">
                    <canvas id="radarLanguageChart"></canvas>
                            
                </div> 
                </div>
            </div>           
          </div>   
          
          


          

        </section>

        <section id="demographics" class="row g-3 mt-2">
            <div class="tables-container">
                <div class="table-box">
                <h3>By Years In-Service</h3>
                <table>
                    <thead>
                    <tr>
                        <th>Years In-Service</th>
                        <th>Teaching</th>
                        <th>Non-Teaching</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="category">Below 5</td>
                        <td class="teaching">145291</td>
                        <td class="nonteaching">20069</td>
                    </tr>
                    <tr>
                        <td class="category">5–15</td>
                        <td class="teaching">224481</td>
                        <td class="nonteaching">26606</td>
                    </tr>
                    <tr>
                        <td class="category">15–30</td>
                        <td class="teaching">302091</td>
                        <td class="nonteaching">46613</td>
                    </tr>
                    <tr>
                        <td class="category">30-40</td>
                        <td class="teaching">61432</td>
                        <td class="nonteaching">10888</td>
                    </tr>
                    <tr>
                        <td class="category">Above 40</td>
                        <td class="teaching">51</td>
                        <td class="nonteaching">134</td>
                    </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-box">
                <h3>By Age</h3>
                <table>
                    <thead>
                    <tr>
                        <th>Age Group</th>
                        <th>Teaching</th>
                        <th>Non-Teaching</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="category">Below 25</td>
                        <td class="teaching">12924</td>
                        <td class="nonteaching">2691</td>
                    </tr>
                    <tr>
                        <td class="category">25–35</td>
                        <td class="teaching">124309</td>
                        <td class="nonteaching">17709</td>
                    </tr>
                    <tr>
                        <td class="category">35–50</td>
                        <td class="teaching">413340</td>
                        <td class="nonteaching">48868</td>
                    </tr>
                    <tr>
                        <td class="category">50–60</td>
                        <td class="teaching">181262</td>
                        <td class="nonteaching">34584</td>
                    </tr>
                    <tr>
                        <td class="category">Above 60</td>
                        <td class="teaching">1511</td>
                        <td class="nonteaching">458</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </section>

      
         
        <div id="credit-popup">
            <div class="credit-content">
                
                    <h2><strong>Build with:</strong></h2>
                    
                    <ul class="list-unstyled fs-6">
                    <li class="mb-2 d-flex align-items-center justify-content-center">
                        <img src="ux4g.png" alt="UX4G" class="tech-logo me-2" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="bootstrap.png" alt="Bootstrap 5" class="tech-logo me-2" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="jquery.png" alt="jQuery 5" class="tech-logo me-2" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="chartjs.png" alt="Chart.js" class="tech-logo me-2" />
                    </li>
                    </ul>
                    <hr/>
                    <h2><strong>Developed by:</strong></h2>
                
                    
                    
                    <img src="resilientlab.png" alt="Resilient Lab" class="tech-logo me-1" />  
                    Resilient Lab, 2025
                

                    
                    <hr/>
                    <h6 style="color:red;">Data Source: <strong>UDISE+ (as on 25/08/2025)</strong></h6>
                    <hr/>
                    <h6>© School Education and Sports Department, Government of Maharashtra</h6>

            
                <button class="close-btn" onclick="toggleCredit()">Close ✖</button>
            </div>
            </div>


            <footer class="small text-muted">
                    <footer class="footer">
            <div class="footer-container">
                <div class="footer-left">
                <p>&copy; School Education and Sports Department, Government of Maharashtra</p>
                <p class="data-source">Data Source: <strong>UDISE+ (as on 25/08/2025)</strong></p>
                </div>

                <!--<div class="footer-right">     
                <div id="credit-badge" onclick="toggleCredit()">
                ⚙️ Development Credit
                </div>
                </div>-->
            </div>


                </main>
                </div>
            </div>

            </div>
            
              <script src="http://edustaff.resilient-lab.com/js/saral-dashboard.js"></script>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
HTML;
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            border-left: 5px solid #667eea;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card h3 {
            margin: 0 0 10px 0;
            color: #555;
            font-size: 18px;
        }
        .stat-card p {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
        }
        .user-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            {$welcome}
            <div class="user-info">
                <p>User ID: {$userData['id']} | Role: {$userData['role']} | Name: {$userData['name']}</p>
            </div>
        </div>
        
        <div class="stats-grid">
            {$stats}
        </div>
        
        <div style="margin-top: 40px; text-align: center; color: #777;">
            <p>Last Updated: {date('Y-m-d H:i:s')}</p>
            <p>SARAL Portal &copy; 2024</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
}