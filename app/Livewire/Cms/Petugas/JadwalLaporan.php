<?php

namespace App\Livewire\Cms\Petugas;

use App\Enums\Alert;
use App\Livewire\Forms\Cms\Petugas\FormLaporan;
use App\Models\Jadwal;
use Livewire\WithFileUploads;
use BaseComponent;
use Illuminate\Support\Facades\Crypt;

class JadwalLaporan extends BaseComponent
{
    use WithFileUploads;

    public FormLaporan $form;
    public $title = 'Laporan Kegiatan';
    public $isUpdate = false;
    public $jadwal;

    public function mount($id) {
        $id = Crypt::decryptString($id);

        // Check jadwal
        $this->jadwal = Jadwal::with('petugas', 'permohonan', 'laporan')->find($id);

        if(!$this->jadwal) {
            session()->flash(Alert::error->value, 'Data tidak ditemukan');
            return $this->redirectRoute('cms.petugas.jadwal');
        }

        // Check laporan
        if($this->jadwal->laporan) {
            $this->isUpdate = true;
            $this->edit($this->jadwal->laporan->id);
        }
    }

    public function render()
    {
        return view('livewire.cms.petugas.jadwal-laporan')->title($this->title);
    }

    public function customSave() {
        $this->form->jadwal_id = $this->jadwal->id;
        $this->save();

        return $this->redirectRoute('cms.petugas.jadwal', navigate: true);
    }
}
