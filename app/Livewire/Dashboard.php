<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = 'Dashboard';
    public $view;

    public function mount() {
        // Check role name
        switch (auth()->user()->roles[0]->name) {
            case 'admin':
                $this->view = 'admin';
                break;
            case 'petugas':
                $this->view = 'petugas';
                break;
            case 'user':
                $this->view = 'user';
                break;
            default:
                $this->view = 'default';
                break;
        }
    }

    public function render()
    {
        return view('livewire.dashboard')->title($this->title);
    }
}
