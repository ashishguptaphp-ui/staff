<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class PostAdvertisementTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('post_advertisement');
        $this->setPrimaryKey('id');


        $this->hasMany('PostAdvertisementVacancies', [
            'foreignKey' => 'post_advertisement_id',
        ]);

        $this->hasMany('PostAdvertisementAuditLogs', [
            'foreignKey' => 'post_advertisement_id',
            'dependent' => false,
        ]);

    }

     public function getAdvertisementList($isPrimary = null,$isSecondary = null,$isHigherSecondary = null)
    {

        return $this->find()
            ->select([
                'PostAdvertisement.id',
                'PostAdvertisement.institution_name',
                'PostAdvertisement.institution_code',
                'PostAdvertisement.created_at',
                'PostAdvertisement.status',
                'vacancy_count' => $this->find()
                    ->func()
                    ->count('PostAdvertisementVacancies.id'),
            ])
            ->leftJoinWith('PostAdvertisementVacancies')
            ->group([
                'PostAdvertisement.id',
            ])
            ->order([
                'PostAdvertisement.created_at' => 'DESC',
            ])  
             ->where([
                'is_direct_approved' => 0
            ])
            ->where(function ($exp) {
                    return $exp->or([
                        'PostAdvertisement.is_primary' => 1,
                        'PostAdvertisement.secondary' => 1,
                    ]);
                })      
            ->all();
    }


     public function getAdvertisementHSList($isPrimary = null,$isSecondary = null,$isHigherSecondary = null)
    {

        return $this->find()
            ->select([
                'PostAdvertisement.id',
                'PostAdvertisement.institution_name',
                'PostAdvertisement.institution_code',
                'PostAdvertisement.created_at',
                'PostAdvertisement.status',
                'vacancy_count' => $this->find()
                    ->func()
                    ->count('PostAdvertisementVacancies.id'),
            ])
            ->leftJoinWith('PostAdvertisementVacancies')
            ->group([
                'PostAdvertisement.id',
            ])
            ->order([
                'PostAdvertisement.created_at' => 'DESC',
            ])  
             ->where([
                'is_direct_approved' => 0
            ])
            ->where(function ($exp) {
                    return $exp->or([
                        'PostAdvertisement.higher_secondary' => 1,
                    ]);
                })      
            ->all();
    }

    public function getAdvertisementListWithSansthaCode(string $institutionCode)
    {

        return $this->find()
            ->select([
                'PostAdvertisement.id',
                'PostAdvertisement.institution_code',
                'PostAdvertisement.created_at',
                'PostAdvertisement.status',
                'vacancy_count' => $this->find()
                    ->func()
                    ->count('PostAdvertisementVacancies.id'),
            ])
            ->leftJoinWith('PostAdvertisementVacancies')
            ->group([
                'PostAdvertisement.id',
            ])
            ->order([
                'PostAdvertisement.created_at' => 'DESC',
            ])
            ->where([
                'PostAdvertisement.institution_code' => $institutionCode,
                'is_direct_approved' => 0
            ])
            ->all();
    }

    public function getAdvertisementDetails(int $id)
    {
        return $this->find()
            ->select([
                'PostAdvertisement.id',
                'PostAdvertisement.institution_code',
                'PostAdvertisement.institution_name',
                'PostAdvertisement.created_at',
                'PostAdvertisement.status',
                'PostAdvertisement.approval_letter',
                'PostAdvertisement.resolutionfile',
                'PostAdvertisement.sanch_manyata',
                'PostAdvertisement.period',
                'PostAdvertisement.period2324',
                'PostAdvertisement.period2324_file',
                'PostAdvertisement.period_file',
                'PostAdvertisement.cadetails',
                'PostAdvertisement.cadetails_file',
                'PostAdvertisement.sm_details',
            ])
            ->where([
                'PostAdvertisement.id' => $id
            ])
            ->first();
    }
}