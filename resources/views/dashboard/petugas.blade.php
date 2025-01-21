<div class="row">
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
