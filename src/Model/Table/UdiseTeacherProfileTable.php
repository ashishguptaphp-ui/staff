<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UdiseTeacherProfileTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('udise_staff_profile');
        $this->setPrimaryKey('staff_id');
        $this->addBehavior('Timestamp');

        $schema = $this->getSchema();
        
        $schema->setColumnType('qualification_academic', 'integer');
        $schema->setColumnType('qualification_professional', 'integer');
        
        $schema->setColumnType('modified_time', 'timestamp');
        $schema->setColumnType('created_at', 'timestamp');
        $schema->setColumnType('updated_at', 'timestamp');
    }

}