<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class StaffAddressesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        //$this->getEventManager()->off($this->Security);
        $this->FormProtection->setConfig('unlockedActions', ['lists','districtsByState','blocksByDistrict']);
        $this->viewBuilder()->setOption('serialize', true);
    }

    

    public function lists($staffId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $staffAddressesTable = TableRegistry::getTableLocator()->get('StaffAddresses');

       
        $adressDetails = $staffAddressesTable->find()
                ->where(['staff_id' => $staffId])
                ->all();
        
        $response = [
            'status' => 'success',
            'data' => $adressDetails
        ];
     

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }


    public function districtsByState($stateId = null)
    {
        $this->request->allowMethod(['get', 'ajax']);
        
        $districtTable = TableRegistry::getTableLocator()->get('Districts');

        $districtDetails = $districtTable->find()
                                        ->where(['state_id' => $stateId])
                                        ->all();

        
        
        $response = [
            'status' => 'success',
            'data' => $districtDetails,
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function blocksByDistrict($districtId = null)
    {
        $this->request->allowMethod(['get']);
        
        $blockTable = TableRegistry::getTableLocator()->get('LgdBlocks');

        $blockDetails = $blockTable->find()
                                        ->where(['district_id' => $districtId])
                                        ->all();

        
        
        $response = [
            'status' => 'success',
            'data' => $blockDetails,
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    

    public function villagesByBlock($blockId = null)
    {
        $this->request->allowMethod(['get']);
        
        $villageTable = TableRegistry::getTableLocator()->get('LgdVillages');

        $villagesDetails = $villageTable->find()
                                        ->where(['block_id' => $blockId])
                                        ->all();

        
        
        $response = [
            'status' => 'success',
            'data' => $villagesDetails,
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    
    public function bothBlocksByDistrict($districtId1 = null,$districtId2 = null)
    {
        $this->request->allowMethod(['get']);
        
        $blockTable = TableRegistry::getTableLocator()->get('LgdBlocks');

        $blocks1 = $blockTable->find()->where(['district_id' => $districtId1])->all();
        $blocks2 = $blockTable->find()->where(['district_id' => $districtId2])->all();
        
        $response = [
            'status' => 'success',
            'data1' => $blocks1,
            'data2' => $blocks2,
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    

    public function bothVillagesByBlock($blockId1 = null, $blockId2= null)
    {
        $this->request->allowMethod(['get']);
        
        $villageTable = TableRegistry::getTableLocator()->get('LgdVillages');

        $villages1 = $villageTable->find()
                                        ->where(['block_id' => $blockId1])
                                        ->all();

        $villages2 = $villageTable->find()
                                        ->where(['block_id' => $blockId2])
                                        ->all();

        
        
        $response = [
            'status' => 'success',
            'data1' => $villages1,
            'data2' => $villages2,
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }



}
