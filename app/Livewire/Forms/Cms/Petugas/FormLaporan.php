<?php

namespace App\Livewire\Forms\Cms\Petugas;

use App\Enums\StatusKunjunganEnum;
use App\Livewire\Contracts\FormCrudInterface;
use App\Models\Jadwal;
use App\Models\Laporan;
use App\Traits\WithMediaCollection;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class FormLaporan extends Form implements FormCrudInterface
{
    use WithMediaCollection;

    #[Validate('nullable|numeric')]
    public $id;

    #[Validate('required')]
    public $jadwal_id;

    #[Validate('required')]
    public $jumlah_pengunjung_laki;

    #[Validate('required')]
    public $jumlah_pengunjung_perempuan;

    #[Validate('required')]
    public $masukan;

    #[Validate('required')]
    public $kendala;

    #[Validate('nullable|image:jpeg,png,jpg,svg')]
    public $foto_kegiatan;

    public $old_data;

    // Get the data
    public function getDetail($id) {
        $data = Laporan::find($id);

        $this->id = $id;
        $this->old_data = $data;
        $this->jadwal_id = $data->jadwal_id;
        $this->jumlah_pengunjung_laki = $data->jumlah_pengunjung_laki;
        $this->jumlah_pengunjung_perempuan = $data->jumlah_pengunjung_perempuan;
        $this->masukan = $data->masukan;
        $this->kendala = $data->kendala;
    }

    // Save the data
    public function save() {
        $this->validate();

        if ($this->id) {
            $this->update();
        } else {
            $this->store();
        }

        $this->reset();
    }

    // Store data
    public function store() {
        // Check jadwal id laporan
        $check = Laporan::where('jadwal_id', $this->jadwal_id)->first();
        if($check) return $this->update($check->id);

        $model = Laporan::create($this->all());

        $this->setStatusJadwalDone($model->jadwal_id);

        // Save foto
        if($this->foto_kegiatan instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $model,
                file: $this->foto_kegiatan,
            );
        }
    }

    // Update data
    public function update() {
        $model = Laporan::find($this->id);

        // Save foto
        if($this->foto_kegiatan instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $model,
                file: $this->foto_kegiatan,
            );
        }

        $this->setStatusJadwalDone($model->jadwal_id);

        $model->update($this->all());
    }

    // Delete data
    public function delete($id) {
        Laporan::find($id)->delete();
    }

    public function setStatusJadwalDone($jadwal_id) {
        Jadwal::find($jadwal_id)->update(['status' => StatusKunjunganEnum::DONE->value]);
    }
}
