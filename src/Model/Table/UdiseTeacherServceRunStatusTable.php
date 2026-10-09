<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UdiseTeacherServceRunStatusTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('udise_teacher_servce_run_status');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

       
    }

}