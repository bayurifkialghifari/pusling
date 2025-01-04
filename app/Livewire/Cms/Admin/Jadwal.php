<?php

namespace App\Livewire\Cms\Admin;

use App\Livewire\Forms\Cms\Admin\FormJadwal;
use App\Models\Jadwal as JadwalModel;
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

    public function render()
    {
        $model = JadwalModel::join('permohonans', 'jadwals.permohonan_id', '=', 'permohonans.id')
            ->join('users as petugas', 'jadwals.petugas_id', '=', 'petugas.id')
            ->select(
                'jadwals.*',
                'petugas.name as petugas',
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
