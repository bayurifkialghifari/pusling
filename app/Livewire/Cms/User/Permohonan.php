<?php

namespace App\Livewire\Cms\User;

use App\Livewire\Forms\Cms\User\FormPermohonan;
use App\Models\Permohonan as PermohonanModel;
use Livewire\WithFileUploads;
use BaseComponent;

class Permohonan extends BaseComponent
{
    use WithFileUploads;

    public FormPermohonan $form;
    public $title = 'Permohonan';

    public $searchBy = [
            [
                'name' => 'Institusi',
                'field' => 'institusi',
            ],
            [
                'name' => 'Alamat Institusi',
                'field' => 'institusi_address',
            ],
            [
                'name' => 'Tanggal Permohonan',
                'field' => 'permohonan_at',
            ],
            [
                'name' => 'Tanggal Kunjungan',
                'field' => 'kunjungan_at',
            ],
            [
                'name' => 'Status',
                'field' => 'status',
            ],
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'permohonan_at',
        $order = 'desc';

    public function render()
    {
        $get = $this->getDataWithFilter(
            model: PermohonanModel::with('media')->where('user_id', auth()->id()),
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.user.permohonan', compact('get'))->title($this->title);
    }

    public function customCreate() {
        $this->create();
        $this->form->user_id = auth()->id();
        $this->form->permohonan_at = now()->format('Y-m-d');
        $this->form->kunjungan_at = now()->format('Y-m-d');
    }
}
