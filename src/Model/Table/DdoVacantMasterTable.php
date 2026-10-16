<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class DdoVacantMasterTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('ddo_vacant_master');
        $this->setPrimaryKey('id');
    }


    public function getAvailableVacancies($usedPostIds = null, $sanstha_code = null)
    {
        
        
        $query = $this->find()
            ->select([
                'DdoVacantMaster.id',
                'DdoVacantMaster.post_name',
                'DdoVacantMaster.post_id',
                'school_name' => 'Schools.school_name',
                'udise_code' => 'Schools.udise_code',
                'highest_class' => 'Schools.highest_class',
            ])
           ->distinct([
            'DdoVacantMaster.id',
            'DdoVacantMaster.post_name',
            'DdoVacantMaster.post_id',
            'Schools.school_name',
            'Schools.udise_code',
            'Schools.highest_class'
             ])
            
            ->innerJoin(
                ['Schools' => 'schools'],
                'CAST(Schools.udise_code AS VARCHAR) = DdoVacantMaster.school_udise_code'
            )
            ->innerJoin(
                ['Sansthas' => 'sansthas'],
                'Schools.sanstha_code = Sansthas.code'
            );

        if (!empty($usedPostIds)) {
            $query->where([
                'DdoVacantMaster.id NOT IN' => $usedPostIds,
            ]);
        }
        if (!empty($sanstha_code)) {
            $query->where([
                'Sansthas.code' => $sanstha_code,
            ]);
        }

        $query->where([
                'Schools.school_close' => 'NO',
            ]);
        return $query->all();
    }


}