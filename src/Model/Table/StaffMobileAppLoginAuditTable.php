<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class StaffMobileAppLoginAuditTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staff_mobile_app_login_audit');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->requirePresence('staff_id')
            ->notEmptyString('staff_id');

        $validator
            ->requirePresence('username')
            ->notEmptyString('username');

        return $validator;
    }
}