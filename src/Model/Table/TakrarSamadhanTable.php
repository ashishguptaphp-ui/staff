<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TakrarSamadhanTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('takrar_samadhan');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        
        $validator
            ->allowEmptyString('contact_name')
            //->notEmptyString('contact_name', 'Name is required')
           // ->minLength('contact_name', 3)

            ->notEmptyString('contact_mobile')
            ->add('contact_mobile', 'validFormat', [
                'rule' => ['custom', '/^[0-9]{10}$/'],
                'message' => 'Enter valid 10-digit mobile number'
            ])

            ->notEmptyString('user_type')
            ->notEmptyString('username')

            ->notEmptyString('issue_type')
            ->allowEmptyString('sub_issue')

            ->notEmptyString('remark')
            ->maxLength('remark', 300)

            ->allowEmptyString('priority')
            ->allowEmptyString('department')
            ->allowEmptyDateTime('issue_datetime')

            ->allowEmptyFile('attachment');

        return $validator;
    }
}