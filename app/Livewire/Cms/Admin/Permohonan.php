<?php

namespace App\Livewire\Cms\Admin;

use App\Enums\StatusEnum;
use App\Livewire\Forms\Cms\Admin\FormJadwal;
use App\Livewire\Forms\Cms\User\FormPermohonan;
use App\Models\Permohonan as PermohonanModel;
use App\Models\User;
use BaseComponent;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\On;

class Permohonan extends BaseComponent
{
    public FormPermohonan $form;
    public FormJadwal $formJadwal;
    public $title = 'Permohonan';
    public $titleModalApproveReject;

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

    public $status = 'all';
    public $petugas = [];

    public function mount() {
        $this->addModal('approveModal');
        $this->petugas = User::whereHas('roles', function($q) {
            $q->where('name', 'petugas');
        })->get();
    }

    public function render()
    {
        $model = PermohonanModel::with('media');

        if ($this->status != 'all') {
            $model = $model->where('status', $this->status);
        }

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

        return view('livewire.cms.admin.permohonan', compact('get'))->title($this->title);
    }

    public function show($id) {
        $this->edit($id);
    }

    public function approve($id) {
        $this->formJadwal->permohonan_id = $id;
        $this->formJadwal->jadwal = null;

        $this->closeModal();
        $this->openModal('approveModal');
    }

    public function confirmReject($id) {
        $this->dispatch('confirm', function: 'reject', id: $id);
    }

    #[On('reject')]
    public function reject($id) {
        // Set status permohonan to approved
        $permohonan = PermohonanModel::where('id', $id)->first();

        // Send Notification
        Notification::send(User::find($permohonan->user_id), new \App\Notifications\Permohonan\Rejected($permohonan->toArray()));

        $permohonan->update([
            'status' => StatusEnum::REJECTED->value,
        ]);

        session()->flash('success', 'Permohonan berhasil ditolak');
        $this->closeModal();
    }

    public function closeApproveModal() {
        $this->closeModal('approveModal');
    }

    public function saveJadwal() {
        // Set status permohonan to approved
        $permohonan = PermohonanModel::where('id', $this->formJadwal->permohonan_id)->first();
        $this->formJadwal->location = $permohonan->institusi_address;

        // Send Notification
        Notification::send(User::find($permohonan->user_id), new \App\Notifications\Permohonan\Approved($permohonan->toArray()));

        $permohonan->update([
            'status' => StatusEnum::APPROVED->value,
        ]);

        $this->formJadwal->save();

        session()->flash('success', 'Permohonan berhasil disetujui');
        $this->closeApproveModal();
    }
}
