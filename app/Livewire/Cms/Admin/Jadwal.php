<?php

namespace App\Livewire\Cms\Admin;

use App\Livewire\Forms\Cms\Admin\FormJadwal;
use App\Models\Jadwal as JadwalModel;
use App\Models\User;
use BaseComponent;

class Jadwal extends BaseComponent
{
    public FormJadwal $form;
    public $title = 'Data Jadwal';

    public $searchBy = [
            [
                'name' => 'Institusi',
                'field' => 'permohonans.institusi',
            ],
            [
                'name' => 'Alamat Institusi',
                'field' => 'permohonans.institusi_address',
            ],
            [
                'name' => 'Lokasi',
                'field' => 'jadwals.location',
            ],
            [
                'name' => 'Tanggal Permohonan',
                'field' => 'permohonans.permohonan_at',
            ],
            [
                'name' => 'Tanggal Kunjungan',
                'field' => 'jadwals.jadwal',
            ],
            [
                'name' => 'Petugas',
                'field' => 'petugas.name',
            ],
            [
                'name' => 'Petugas 2',
                'field' => 'petugas_2.name',
            ],
            [
                'name' => 'Status',
                'field' => 'jadwals.status',
            ],
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'jadwals.jadwal',
        $order = 'desc';

    public $status = 'all';
    public $petugas = [];

    public function mount() {
        $this->petugas = User::whereHas('roles', function ($q) {
            $q->where('name', 'petugas');
        })->get();
    }

    public function render()
    {
        $model = JadwalModel::join('permohonans', 'jadwals.permohonan_id', '=', 'permohonans.id')
            ->join('users as petugas', 'jadwals.petugas_id', '=', 'petugas.id')
            ->leftJoin('users as petugas_2', 'jadwals.petugas_2_id', '=', 'petugas_2.id')
            ->select(
                'jadwals.*',
                'petugas.name as petugas',
                'petugas_2.name as petugas_2',
                'permohonans.institusi',
                'permohonans.institusi_address',
                'permohonans.permohonan_at'
            );

        if ($this->status != 'all') {
            $model = $model->where('jadwals.status', $this->status);
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

        return view('livewire.cms.admin.jadwal', compact('get'))->title($this->title);
    }
}
