<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class StaffsTable extends Table
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

        $this->setTable('staffs');
        $this->setDisplayField('emp_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

         // Relation with master table
        $this->belongsTo('CasteCategories', [
            'foreignKey' => 'social_category_id',
            'bindingKey' => 'code', 
            'joinType' => 'LEFT'
        ]);

         // Relation with master table
        $this->belongsTo('StaffsTypes', [
            'foreignKey' => 'emp_type',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

         // Relation with master table
        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

         $this->belongsTo('StaffTransfers', [
            'foreignKey' => 'staff_id',
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
        $rules->add($rules->isUnique(['emp_staff_id']), ['errorField' => 'emp_staff_id']);

        return $rules;
    }

    

    /*public function beforeSave(EventInterface $event, $entity, ArrayObject $options)
    {
        
    }*/
}
