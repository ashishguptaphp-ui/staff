<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class StaffsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Staffs');
        $this->RequestHandler->renderAs($this, 'json');
        $this->response = $this->response->withType('application/json');
        $this->viewBuilder()->setOption('serialize', true);
    }

    // GET /api/staffs
    public function index()
    {
        $staffs = $this->Staffs->find()->all();
        $this->set([
            'status' => 'success',
            'data' => $staffs,
            '_serialize' => ['status', 'data']
        ]);
    }

    // GET /api/staffs/{id}
    public function view($id = null)
    {
        $staff = $this->Staffs->findById($id)->first();
        if (!$staff) {
            throw new NotFoundException('Staff not found');
        }

        $this->set([
            'status' => 'success',
            'data' => $staff,
            '_serialize' => ['status', 'data']
        ]);
    }

    // POST /api/staffs
    public function add()
    {
        $staff = $this->Staffs->newEmptyEntity();
        $staff = $this->Staffs->patchEntity($staff, $this->request->getData());

        if ($this->Staffs->save($staff)) {
            $this->set([
                'status' => 'success',
                'message' => 'Staff added successfully',
                'data' => $staff,
                '_serialize' => ['status', 'message', 'data']
            ]);
        } else {
            $this->set([
                'status' => 'error',
                'message' => 'Unable to add staff',
                'errors' => $staff->getErrors(),
                '_serialize' => ['status', 'message', 'errors']
            ]);
        }
    }

    // PUT /api/staffs/{id}
    public function edit($id = null)
    {
        $staff = $this->Staffs->findById($id)->first();
        if (!$staff) {
            throw new NotFoundException('Staff not found');
        }

        $staff = $this->Staffs->patchEntity($staff, $this->request->getData());

        if ($this->Staffs->save($staff)) {
            $this->set([
                'status' => 'success',
                'message' => 'Staff updated successfully',
                'data' => $staff,
                '_serialize' => ['status', 'message', 'data']
            ]);
        } else {
            $this->set([
                'status' => 'error',
                'message' => 'Unable to update staff',
                'errors' => $staff->getErrors(),
                '_serialize' => ['status', 'message', 'errors']
            ]);
        }
    }

    // DELETE /api/staffs/{id}
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $staff = $this->Staffs->findById($id)->first();

        if (!$staff) {
            throw new NotFoundException('Staff not found');
        }

        if ($this->Staffs->delete($staff)) {
            $this->set([
                'status' => 'success',
                'message' => 'Staff deleted successfully',
                '_serialize' => ['status', 'message']
            ]);
        } else {
            $this->set([
                'status' => 'error',
                'message' => 'Unable to delete staff',
                '_serialize' => ['status', 'message']
            ]);
        }
    }
}
