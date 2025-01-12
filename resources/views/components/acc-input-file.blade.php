@props([
    'model' => null,
    'class' => 'form-control',
    'imageIttr' => 1,
    'multiple' => false,
])
<x-acc-upload-progress>
    <input type="file" wire:model="{{ $model }}" class="{{ $class }}" id="{{ $imageIttr }}" {{ $multiple ? 'multiple' : '' }}>
</x-acc-upload-progress>
