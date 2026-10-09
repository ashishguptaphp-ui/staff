<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class PostAdvertisementVacanciesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('post_advertisement_vacancies');
        $this->setPrimaryKey('id');

         $this->belongsTo('PostAdvertisement', [
            'foreignKey' => 'post_advertisement_id',
        ]);
        
    }

    public function getVacanciesByAdvertisement(int $postAdvertisementId)
    {
        return $this->find()
            ->select([
                'PostAdvertisementVacancies.school_udise_code',
                'PostAdvertisementVacancies.school_name',
                'PostAdvertisementVacancies.post_code',
                'PostAdvertisementVacancies.post_name',
                'PostAdvertisementVacancies.category',
                'PostAdvertisementVacancies.vacancy_count',
                'PostAdvertisementVacancies.pay_scale',
            ])
            ->where([
                'PostAdvertisementVacancies.post_advertisement_id' =>
                    $postAdvertisementId
            ])
            ->all();
    }


}