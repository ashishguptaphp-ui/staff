<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UdiseTeacherApiAuditTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('udise_teacher_api_audit');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }

}