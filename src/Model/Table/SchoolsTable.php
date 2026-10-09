<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use ArrayObject;

class SchoolsTable extends Table
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

        $this->setTable('schools');
        $this->setDisplayField('school_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->belongsTo('SchoolManagements', [
            'foreignKey' => 'management_id',
            'bindingKey' => 'code', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('SchoolSubManagements', [
            'foreignKey' => 'management_details',
            'bindingKey' => 'code', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('SchoolCategories', [
            'foreignKey' => 'school_category',
            'bindingKey' => 'code', 
            'propertyName' => 'school_category_details',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Clusters', [
            'foreignKey' => 'cluster_code',
            'bindingKey' => 'code', 
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
        $rules->add($rules->isUnique(['school_name']), ['errorField' => 'school_name']);

        return $rules;
    }

    

    public function beforeSave(EventInterface $event, $entity, ArrayObject $options)
    {
        
    }
}
