<?php
declare(strict_types=1);

namespace App\Config;

class JwtConfig
{
    public const SECRET_KEY = 'TWFoYUVkdVN0YWZmUmVzaWxpZW50MjAyNTAxMDctQkdHMjU2LVNFQ1JFVC1LRVktR09WTUFIQQ==';
    public const ALGORITHM = 'HS256';
    public const ACCESS_TOKEN_EXPIRY = 3600; 
    public const REFRESH_TOKEN_EXPIRY = 86400 * 7; 
    public const CLIENT_ID = 'saral-portal';
    public const DASHBOARD_SERVICE_ID = '1001';
    public const CLIENT_SECRET = '374a8c5f2d9b1e6a0f8c7d3b5a9e2f4c7d8a1b3e5f9a2c4d6b8e0f1a3c5d7e9b2f4d6a8c0e1f3a5b7d9c2e4f6a8b0d2'; 
    
    public const USER_ID = '303';    
    public const USER_NAME = 'saral_api_agent';
    public const USER_PASSWORD = 'PDGMEDSP@2026@sp';    
    public const USER_ROLE = 'api_agent';
}
