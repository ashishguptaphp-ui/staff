<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class StaffOnboardApplicationLogsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staff_onboard_application_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                ],
            ],
            'timestamps' => false,
        ]);
    }
}