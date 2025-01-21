<?php

namespace App\Livewire\Cms;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = 'Dashboard';
    public $view;
    public $currentDate;

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

        $this->currentDate = now();
    }

    public function render()
    {
        return view('livewire.cms.dashboard')->title($this->title);
    }

    public function nextMonth() {
        $this->currentDate = $this->currentDate->addMonth();
        $this->dispatch('goToNextMonth');
    }

    public function prevMonth() {
        $this->currentDate = $this->currentDate->subMonth();
        $this->dispatch('goToPreviousMonth');
    }

    public function today() {
        $this->currentDate = now();
        $this->dispatch('goToCurrentMonth');
    }
}
