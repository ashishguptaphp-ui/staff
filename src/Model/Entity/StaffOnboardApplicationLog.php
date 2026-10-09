<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class StaffOnboardApplicationLog extends Entity
{
    protected array $_accessible = [
        'app_id' => true,
        'app_stage' => true,
        'stage_remark' => true,
        'created_by' => true,
        'created_at' => true,
        'transaction_id' => true,
        'stage_doc' => true,
        'app_stage_mode' => true,
    ];
}