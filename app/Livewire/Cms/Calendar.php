<?php

namespace App\Livewire\Cms;

use App\Enums\StatusEnum;
use App\Models\Jadwal;
use Carbon\Carbon;
use Omnia\LivewireCalendar\LivewireCalendar;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

class Calendar extends LivewireCalendar
{
    #[On('goToNextMonth')]
    public function next() {
        $this->goToNextMonth();
    }

    #[On('goToPreviousMonth')]
    public function previous() {
        $this->goToPreviousMonth();
    }

    #[On('goToCurrentMonth')]
    public function today() {
        $this->goToCurrentMonth();
    }

    public function events() : Collection {
        $events = [];
        $userId = auth()->user()->id;

        $model = Jadwal::with('permohonan');

        // If petugas
        if(auth()->user()->hasRole('petugas')) {
            $model = $model->where("petugas_id", $userId);
            $model = $model->orWhere("petugas_2_id", $userId);
        }

        // If user
        if(auth()->user()->hasRole('user')) {
            $model = $model->whereHas('permohonan', function($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        }

        $model = $model->get();

        foreach($model as $jadwal) {
            $events[] = [
                'id' => $jadwal->id,
                'title' => $jadwal->permohonan->institusi . ' - ' . $jadwal->permohonan->email,
                'description' => $jadwal->location,
                'date' => Carbon::parse($jadwal->jadwal),
            ];
        }

        return collect($events);
    }
}
