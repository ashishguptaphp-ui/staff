<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class StaffOnboardApplicationReturn extends Entity
{
    protected array $_accessible = [
        'app_id'             => true,
        'rtn_field_name'     => true,
        'rtn_field_reason'   => true,
        'rtn_user_id'        => true,
        'rtn_created_at'     => true,
        'rtn_fwd_to'         => true,
        'rtn_fwd_to_target'  => true,
        'sanstha_fwd_info'   => true,
        'status'             => true,
        'transaction_id'     => true,
    ];
}