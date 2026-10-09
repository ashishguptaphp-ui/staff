<?php
// src/Service/FileUploadService.php

namespace App\Service;

use Cake\Filesystem\File;
use Cake\Utility\Security;

class FileUploadService
{
    private $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
    
    private $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
    
    public function upload($file, $fieldName, $staffId = null)
    {
        // Implementation similar to controller action
    }
    
    public function delete($filePath)
    {
        // Implementation
    }
}