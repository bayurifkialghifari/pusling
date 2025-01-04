<x-acc-with-alert>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-header :$originRoute :isCreate="false">
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="list-group list-group-horizontal mb-2" x-data="{status: $wire.entangle('status').live}">
                            <button class="list-group-item"
                                :class="status == 'all' ? 'active' : ''"
                                x-on:click="status = 'all'">
                                Semua
                            </button>
                            @foreach(\App\Enums\StatusKunjunganEnum::getValues() as $status)
                                <button class="list-group-item"
                                    :class="status == '{{ $status->value }}' ? 'active' : ''"
                                    x-on:click="status = '{{ $status->value }}'">
                                    {{ $status->label() }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </x-acc-header>
            <div class="table-responsive">
                <x-acc-table>
                    <thead>
                        <tr>
                            <x-acc-loop-th :$searchBy :$orderBy :$order />
                            {{-- <th>
                                Action
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($get as $d)
                            <tr>
                                <td>{{ $d->institusi }}</td>
                                <td>{{ $d->institusi_address }}</td>
                                <td>{{ $d->location }}</td>
                                <td>{{ $d->permohonan_at }}</td>
                                <td>{{ $d->jadwal }}</td>
                                <td>
                                    @switch($d->status)
                                        @case(\App\Enums\StatusEnum::PENDING->value)
                                            {!! '<span class="badge bg-warning">Pending</span>' !!}
                                        @break
                                        @case(\App\Enums\StatusEnum::APPROVED->value)
                                            {!! '<span class="badge bg-success">Approved</span>' !!}
                                        @break
                                        @case(\App\Enums\StatusEnum::REJECTED->value)
                                            {!! '<span class="badge bg-danger">Rejected</span>' !!}
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100" class="text-center">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-acc-table>
            </div>
            <div class="float-end">
                {{ $get->links() }}
            </div>
        </div>
    </div>
</x-acc-with-alert>
