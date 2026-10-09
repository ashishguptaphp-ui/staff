<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class StaffAcademicTable extends Table
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

        $this->setTable('staff_academic_qualifications');
        $this->setDisplayField('academic_level_id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

       
        // Relation with master table
        $this->belongsTo('AcademicQualificationLevels', [
            'foreignKey' => 'academic_level_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('AcademicQualificationDegrees', [
            'foreignKey' => 'academic_degree_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

        
        $this->belongsTo('Mediums', [
            'foreignKey' => 'academic_medium',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Universities', [
            'foreignKey' => 'academic_board_university_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('PavitraStates', [
            'foreignKey' => 'academic_state_id',
            'bindingKey' => 'id', 
            'joinType' => 'LEFT'
        ]);

         $this->belongsTo('Subjects', [
            'foreignKey' => 'academic_main_subject_1',
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
        $rules->add($rules->isUnique(['id ']), ['errorField' => 'academic_level_code']);

        return $rules;
    }
    
}
