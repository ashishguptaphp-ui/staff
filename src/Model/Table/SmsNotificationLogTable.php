<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SmsNotificationLogTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('sms_notification_log');
        $this->setPrimaryKey('id');
        $this->setDisplayField('id');
        $this->setEntityClass(
            \Cake\ORM\Entity::class
        );
    }

    public function validationDefault(
        Validator $validator
    ): Validator {
        $validator
            ->scalar('text')
            ->requirePresence('text', 'create')
            ->notEmptyString('text');

        $validator
            ->scalar('status')
            ->maxLength('status', 30);

        return $validator;
    }
}