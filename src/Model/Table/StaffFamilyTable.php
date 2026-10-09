<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class StaffFamilyTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staff_family_details');
        $this->setDisplayField('family_member_name ');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        // Relation with master table
        $this->belongsTo('Relationships', [
            'foreignKey' => 'relation_id',
            'bindingKey' => 'id', // because in master, relation code is stored
            'joinType' => 'LEFT'
        ]);
    }

    

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['id ']), ['errorField' => 'family_member_name ']);

        return $rules;
    }
    
}
