<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class StaffOnboardingAppointmentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staff_onboarding_appointments');
        $this->setDisplayField('candidate_name');
        $this->setPrimaryKey('id');

        $this->hasMany('StaffOnboardingDocuments', [
            'foreignKey' => 'staff_appointment_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }
}