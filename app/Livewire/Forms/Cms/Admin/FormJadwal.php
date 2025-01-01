<?php

namespace App\Livewire\Forms\Cms\Admin;

use App\Livewire\Contracts\FormCrudInterface;
use App\Models\Jadwal;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormJadwal extends Form implements FormCrudInterface
{
    #[Validate('nullable|numeric')]
    public $id;

    #[Validate('required')]
    public $permohonan_id;

    #[Validate('nullable')]
    public $petugas_id;

    #[Validate('required')]
    public $jadwal;

    #[Validate('required')]
    public $location;

    // Get the data
    public function getDetail($id) {
        $data = Jadwal::find($id);

        $this->id = $id;
        $this->permohonan_id = $data->permohonan_id;
        $this->petugas_id = $data->petugas_id;
        $this->jadwal = $data->jadwal;
        $this->location = $data->location;
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
        Jadwal::create($this->all());
    }

    // Update data
    public function update() {
        Jadwal::find($this->id)->update($this->all());
    }

    // Delete data
    public function delete($id) {
        Jadwal::find($id)->delete();
    }
}
