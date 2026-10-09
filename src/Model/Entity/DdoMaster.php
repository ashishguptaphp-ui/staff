<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class DdoMaster extends Entity
{
    protected array $_accessible = [
        'school_udise_code' => true,
        'loc_id' => true,
        'ddo_code' => true,
        'off_name' => true,
        'state_code' => true,
        'district_code' => true,
        'taluka_code' => true,
        'dice_code' => true,
        'dise_prefix' => true,
        'ddo_type' => true,
        'created_date' => true,
    ];
}