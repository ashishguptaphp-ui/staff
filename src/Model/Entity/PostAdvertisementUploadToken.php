<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class PostAdvertisementUploadToken extends Entity
{
    protected array $_accessible = [
        'token' => true,
        'client_upload_id' => true,
        'user_id' => true,
        'sanstha_code' => true,
        'document_type' => true,
        'udise_code' => true,
        'storage_key' => true,
        'file_size' => true,
        'content_sha256' => true,
        'status' => true,
        'created_at' => true,
        'expires_at' => true,
        'consumed_at' => true,
        'post_advertisement_id' => true,
    ];
}
