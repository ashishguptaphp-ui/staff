<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class PostWorkingTable extends Table
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

        //$this->setTable('staffs_designations');
        $this->setTable('post_working');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        
         // Relation with master table
        $this->belongsTo('StaffsTypes', [
            'foreignKey' => 'post_type',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

         // Relation with master table
        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('AidMaster', [
            'foreignKey' => 'aid_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);


        $this->belongsTo('Posts', [
            'className' => 'Posts',
            'foreignKey' => false,
            'joinType' => 'LEFT',
            'conditions' => [
                'Posts.code = PostWorking.post_id',
                'Posts.staff_type = PostWorking.post_type'
            ]
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
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);

        return $rules;
    }
    
}
