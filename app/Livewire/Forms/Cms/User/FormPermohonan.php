<?php

namespace App\Livewire\Forms\Cms\User;

use App\Livewire\Contracts\FormCrudInterface;
use App\Models\Permohonan;
use App\Models\User;
use App\Traits\WithGenerateReference;
use App\Traits\WithMediaCollection;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class FormPermohonan extends Form implements FormCrudInterface
{
    use WithGenerateReference, WithMediaCollection;

    #[Validate('nullable|numeric')]
    public $id;

    #[Validate('required')]
    public $reference;

    #[Validate('required')]
    public $ref_number;

    #[Validate('required')]
    public $user_id;

    #[Validate('required')]
    public $institusi;

    #[Validate('required')]
    public $institusi_address;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|numeric')]
    public $whatsapp;

    #[Validate('required|date')]
    public $permohonan_at;

    #[Validate('required|date')]
    public $kunjungan_at;

    // 10 mb max
    #[Validate('nullable|file|mimes:pdf,doc,docx|max:10240')]
    public $document_permohonan;

    public $old_data;

    // Get the data
    public function getDetail($id) {
        $data = Permohonan::find($id);

        $this->id = $id;
        $this->old_data = $data;
        $this->user_id = $data->user_id;
        $this->reference = $data->reference;
        $this->ref_number = $data->ref_number;
        $this->institusi = $data->institusi;
        $this->institusi_address = $data->institusi_address;
        $this->email = $data->email;
        $this->whatsapp = $data->whatsapp;
        $this->permohonan_at = $data->permohonan_at;
        $this->kunjungan_at = $data->kunjungan_at;
    }

    // Save the data
    public function save() {
        if ($this->id) {
            $this->update();
        } else {
            $this->store();
        }

        $this->reset();
    }

    // Store data
    public function store() {
        $reference = $this->generateReference(model: new Permohonan, prefix: 'KNJ');
        $this->reference = $reference['code'];
        $this->ref_number = $reference['number'];

        $this->validate();

        $model = Permohonan::create($this->all());

        // Save document
        if($this->document_permohonan instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $model,
                file: $this->document_permohonan,
                collection: 'document',
            );
        }

        // Send notification to user it self
        auth()->user()->notify(new \App\Notifications\Permohonan\Created($model->toArray()));
        // And user with role petugas
        Notification::send(User::whereHas('roles', function($query) {
            $query->where('name', 'petugas');
        })->get(), new \App\Notifications\Permohonan\Created($model->toArray()));
    }

    // Update data
    public function update() {
        $model = Permohonan::find($this->id);

        // Save document
        if($this->document_permohonan instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $model,
                file: $this->document_permohonan,
                collection: 'document',
            );
        }

        $model->update($this->all());
    }

    // Delete data
    public function delete($id) {
        Permohonan::find($id)->delete();
    }
}
