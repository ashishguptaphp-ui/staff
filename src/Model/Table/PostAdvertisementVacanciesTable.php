<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostAdvertisementVacanciesTable extends Table
{
    public const GRAND_OPTIONS = [
        100 => '100% अनुदानित (Fully Aided)',
        80 => '80% अंशतः अनुदानित',
        60 => '60% अंशतः अनुदानित',
        40 => '40% अंशतः अनुदानित',
        20 => '20% अंशतः अनुदानित',
        0 => 'विनाअनुदानित (Partially Aided)',
    ];

    public const VACANT_REASON_OPTIONS = [
        1 => 'सेवानिवृत्ती (Retirement)',
        2 => 'बदली (Transfer)',
        3 => 'सेवासमाप्ती / बडतर्फी',
        4 => 'नवीन पदनिर्मिती',
        5 => 'मृत्यू (Death)',
        6 => 'पदोन्नती (Promotion)',
    ];

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('post_advertisement_vacancies');
        $this->setPrimaryKey('id');

         $this->belongsTo('PostAdvertisement', [
            'foreignKey' => 'post_advertisement_id',
        ]);
        
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('grand')
            ->inList('grand', array_keys(self::GRAND_OPTIONS))
            ->allowEmptyString('grand');

        $validator
            ->scalar('grand_text')
            ->inList('grand_text', array_values(self::GRAND_OPTIONS))
            ->maxLength('grand_text', 100)
            ->allowEmptyString('grand_text');

        $validator
            ->scalar('vacant_reason')
            ->inList('vacant_reason', array_values(self::VACANT_REASON_OPTIONS))
            ->maxLength('vacant_reason', 100)
            ->allowEmptyString('vacant_reason');

        return $validator;
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
                'PostAdvertisementVacancies.grand',
                'PostAdvertisementVacancies.grand_text',
                'PostAdvertisementVacancies.vacant_reason',
            ])
            ->where([
                'PostAdvertisementVacancies.post_advertisement_id' =>
                    $postAdvertisementId
            ])
            ->all();
    }


}