<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class StaffNominationTable extends Table
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

        $this->setTable('staff_nomination_details');
        $this->setDisplayField('nomination_type_id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        // Relation with master table
        $this->belongsTo('NominationTypes', [
            'foreignKey' => 'nomination_type_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

         // Relation with master table
        $this->belongsTo('StaffFamily', [
            'foreignKey' => 'nomination_as_id',
            'bindingKey' => 'id', 
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
        $rules->add($rules->isUnique(['id']), ['errorField' => 'nomination_type_id']);

        return $rules;
    }
    
}
