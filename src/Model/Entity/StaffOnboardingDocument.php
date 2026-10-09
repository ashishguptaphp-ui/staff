<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class StaffOnboardingDocument extends Entity
{
    protected array $_accessible = [
        'staff_appointment_id' => true,
        'document_type' => true,
        'file_name' => true,
        'original_name' => true,
        'file_path' => true,
        'file_size' => true,
        'mime_type' => true,
        'created_at' => true,
        'staff_onboarding_appointment' => true,
    ];
}