<?php

namespace App\Livewire\Cms\User;

use App\Livewire\Forms\Cms\User\FormPermohonan;
use App\Models\Permohonan as PermohonanModel;
use Livewire\WithFileUploads;
use BaseComponent;

class Inbox extends BaseComponent
{
    use WithFileUploads;

    public FormPermohonan $form;
    public $title = 'Permohonan';

    public $searchBy = [
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'created_at',
        $order = 'desc';

    public function mount() {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        $get = $this->getDataWithFilter(
            model: auth()->user()->notifications(),
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.user.inbox', compact('get'))->title($this->title);
    }
}
