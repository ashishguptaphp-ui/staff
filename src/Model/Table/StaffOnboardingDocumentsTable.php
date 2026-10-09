<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class StaffOnboardingDocumentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staff_onboarding_documents');
        $this->setDisplayField('document_type');
        $this->setPrimaryKey('id');

        $this->belongsTo('StaffOnboardingAppointments', [
            'foreignKey' => 'staff_appointment_id',
            'joinType' => 'INNER',
        ]);
    }
}