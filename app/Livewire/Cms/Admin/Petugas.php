<?php

namespace App\Livewire\Cms\Admin;

use App\Livewire\Forms\Cms\Admin\FormPetugas;
use App\Models\User as PetugasModel;
use BaseComponent;

class Petugas extends BaseComponent
{
    public FormPetugas $form;
    public $title = 'Data Petugas';

    public $searchBy = [
            [
                'name' => 'Name',
                'field' => 'users.name',
            ],
            [
                'name' => 'Email',
                'field' => 'users.email',
            ],
            [
                'name' => 'Role',
                'field' => 'roles.name',
            ],
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'users.name',
        $order = 'asc';

    public $isModalPasswordOpen = false;

    public function mount() {
        // Add modal for update password
        $this->addModal('updatePasswordModal');
    }

    public function render()
    {
        $model = PetugasModel::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', '=', 'petugas')
            ->select('users.*', 'roles.name as role');

        $get = $this->getDataWithFilter(
            model: $model,
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.admin.petugas', compact('get'))->title($this->title);
    }

    public function editPassword($id) {
        $this->form->getDetail($id);
        $this->openModal('updatePasswordModal');
    }

    public function closeModalUpdatePassword() {
        $this->closeModal('updatePasswordModal');
    }

    public function changePassword() {
        $this->form->changePassword();
        $this->closeModalUpdatePassword();

        session()->flash('success', 'Password has been changed');
    }
}
