<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class StaffOnboardApplicationReturnsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staff_onboard_application_returns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }
}