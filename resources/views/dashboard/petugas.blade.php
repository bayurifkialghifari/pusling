<div class="row">
    <div class="col-md-12">
        <script src="https://cdn.tailwindcss.com"></script>
        <h2 class="text-2xl font-semibold text-gray-800">
            {{ now()->format('F Y') }}
        </h2>
        <livewire:cms.calendar
            initialYear="{{ now()->year }}"
            initialMonth="{{ now()->month }}"
            :day-click-enabled="false"
            :event-click-enabled="false"
            :drag-and-drop-enabled="false"
        />
    </div>
</div>
