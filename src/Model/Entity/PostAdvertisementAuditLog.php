<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class PostAdvertisementAuditLog extends Entity
{
    protected array $_accessible = [
        'post_advertisement_id' => true,
        'user_id' => true,
        'user_name' => true,
        'action' => true,
        'previous_status' => true,
        'new_status' => true,
        'remarks' => true,
        'ip_address' => true,
        'user_agent' => true,
        'version' => true,
        'metadata' => true,
        'created_at' => true,
        'stage_doc' => true,
        'post_advertisement' => true,
    ];
}