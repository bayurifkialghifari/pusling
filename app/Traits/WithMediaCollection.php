<?php

namespace App\Traits;

use Illuminate\Http\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use function Livewire\store;

trait WithMediaCollection {
    public function saveFile(Model $model, $file, $collection = 'images', $deleteOlderMedia = true) {
        if($deleteOlderMedia) {
            $model->clearMediaCollection($collection);
        }

        // Handle Dropzone
        if(isset($file['path'])) {
            // Move the file to the storage
            $file = Storage::putFileAs('public/dropzones', new File($file['path']), uniqid() . '.' . $file['extension']);
            $file = storage_path('app/' . $file);
        }

        $model->addMedia($file)->toMediaCollection($collection);
    }
}
