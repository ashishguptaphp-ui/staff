<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class PostAdvertisementUploadTokensTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('post_advertisement_upload_tokens');
        $this->setPrimaryKey('id');
    }
}
