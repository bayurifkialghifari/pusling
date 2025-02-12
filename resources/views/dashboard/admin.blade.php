<div class="container">
    @php
        $permohonan = \App\Models\Permohonan::where('status', '=', \App\Enums\StatusEnum::PENDING->value)->count();
        $jadwal = \App\Models\Jadwal::where('status', '!=', \App\Enums\StatusKunjunganEnum::DONE->value)->count();
    @endphp
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Permohonan Belum Diproses</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fa fa-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        {{ $permohonan }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Jadwal Kunjungan</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fa fa-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        {{ $jadwal }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Rekap Data</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fa fa-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        0
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <script src="https://cdn.tailwindcss.com"></script>
            <div class="float-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" wire:click="prevMonth">
                        <i class="fa fa-arrow-left"></i>
                        Prev Month
                    </button>
                    <button type="button" class="btn btn-success" wire:click="today">
                        Now
                    </button>
                    <button type="button" class="btn btn-primary" wire:click="nextMonth">
                        Next Month
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800">
                {{ $currentDate->format('Y') }} - {{ $currentDate->format('F') }}
            </h2>
            <livewire:cms.calendar
                initialYear="{{ $currentDate->year }}"
                initialMonth="{{ $currentDate->month }}"
                :day-click-enabled="false"
                :event-click-enabled="false"
                :drag-and-drop-enabled="false"
            />
        </div>
    </div>
</div>
