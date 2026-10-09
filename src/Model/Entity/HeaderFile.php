<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class HeaderFile extends Entity
{
    protected array $_accessible = [
        'user_id' => true,
        'title' => true,
        'original_name' => true,
        'stored_name' => true,
        'storage_path' => true,
        'mime_type' => true,
        'file_extension' => true,
        'file_size' => true,
        'file_checksum' => true,
        'is_active' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
