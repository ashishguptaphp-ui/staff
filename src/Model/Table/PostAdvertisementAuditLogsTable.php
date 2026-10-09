<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class PostAdvertisementAuditLogsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('post_advertisement_audit_logs');

        $this->setDisplayField('id');

        $this->setPrimaryKey('id');

        $this->setEntityClass(
            \App\Model\Entity\PostAdvertisementAuditLog::class
        );

        $this->belongsTo('PostAdvertisement', [
            'foreignKey' => 'post_advertisement_id',
            'joinType' => 'INNER',
        ]);
    }
}