<?php

namespace App\Livewire\Forms\Cms\Admin;

use App\Livewire\Contracts\FormCrudInterface;
use App\Models\Jadwal;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormJadwal extends Form implements FormCrudInterface
{
    #[Validate('nullable|numeric')]
    public $id;

    #[Validate('required')]
    public $permohonan_id;

    #[Validate('required')]
    public $petugas_id;

    #[Validate('required')]
    public $petugas_2_id;

    #[Validate('required')]
    public $jadwal;

    #[Validate('required')]
    public $location;

    #[Validate('required')]
    public $week;

    // Get the data
    public function getDetail($id) {
        $data = Jadwal::find($id);

        $this->id = $id;
        $this->permohonan_id = $data->permohonan_id;
        $this->petugas_id = $data->petugas_id;
        $this->petugas_2_id = $data->petugas_2_id;
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
        // Foreac week
        for ($i = 0; $i < (int)$this->week; $i++) {
            $this->jadwal = Carbon::parse($this->jadwal)->addWeeks(1);
            Jadwal::create([
                'permohonan_id' => $this->permohonan_id,
                'petugas_id' => $this->petugas_id,
                'petugas_2_id' => $this->petugas_2_id,
                'jadwal' => $this->jadwal,
                'location' => $this->location,
            ]);
        }
    }

    // Update data
    public function update() {
        Jadwal::where('permohonan_id', $this->permohonan_id)->delete();
        // Foreac week
        for ($i = 0; $i < (int)$this->week; $i++) {
            $this->jadwal = Carbon::parse($this->jadwal)->addWeeks(1);
            Jadwal::create([
                'permohonan_id' => $this->permohonan_id,
                'petugas_id' => $this->petugas_id,
                'petugas_2_id' => $this->petugas_2_id,
                'jadwal' => $this->jadwal,
                'location' => $this->location,
            ]);
        }
    }

    // Delete data
    public function delete($id) {
        Jadwal::find($id)->delete();
    }
}
