<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class HeaderFilesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('header_files');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp', [
            'created' => 'created_at',
            'modified' => 'updated_at',
        ]);
    }
}
