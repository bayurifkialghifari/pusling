<?php

namespace App\Livewire\Cms;

use App\Enums\StatusEnum;
use App\Models\Jadwal;
use Carbon\Carbon;
use Omnia\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;

class Calendar extends LivewireCalendar
{
    public function events() : Collection {
        $events = [];
        $userId = auth()->user()->id;

        $model = Jadwal::with('permohonan');

        if(auth()->user()->hasRole('petugas')) {
            $model = $model->where("petugas_id", $userId);
            $model = $model->orWhere("petugas_2_id", $userId);
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
