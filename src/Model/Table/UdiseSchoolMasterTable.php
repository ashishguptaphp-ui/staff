<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UdiseSchoolMasterTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('udise_school_master');
        $this->setPrimaryKey('school_id');
        $this->addBehavior('Timestamp');

        $schema = $this->getSchema();
        $schema->setColumnType('udise_school_code', 'string'); // किंवा डेटाबेसमध्ये bigint असेल तर 'biginteger'
        $schema->setColumnType('state_code', 'biginteger');
        $schema->setColumnType('district_code', 'biginteger');
        $schema->setColumnType('block_code', 'biginteger');
        $schema->setColumnType('village_code', 'biginteger');
        $schema->setColumnType('cluster_code', 'biginteger');
    }

}