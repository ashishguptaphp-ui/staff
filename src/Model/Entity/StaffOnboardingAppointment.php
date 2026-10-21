<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class StaffOnboardingAppointment extends Entity
{
    protected array $_accessible = [
        'staff_id' => true,
        'candidate_name' => true,
        'appointment_date' => true,
        'pan_number' => true,
        'aadhar_number' => true,
        'original_category' => true,
        'appointment_category' => true,
        'horizontal_category' => true,
        'status' => true,
        'roster' => true,
        'court_order' => true,
        'court_order_petition_number' => true,
        'court_order_date' => true,
        'created_at' => true,
        'updated_at' => true,
        'staff_onboarding_documents' => true,
        'headmastername' => true,
        'heademail' => true,
        'headmobilenumber' => true,
        'gender' => true,
        'dob_date' => true,
        'matrimonial_status' => true,
        'candidateemail' => true,
        'candidatemobile' => true,
        'graduate_degree' => true,
        'post_graduate_degree' => true,
        'period' => true,
        'period2324' => true,
        'period2324_file' => true,
        'period_file'=> true,
    ];
}