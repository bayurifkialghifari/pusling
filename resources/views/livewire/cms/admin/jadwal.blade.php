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
                            <th>
                                Action
                            </th>
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
                                <td>{{ $d->petugas }}</td>
                                <td>{{ $d->petugas_2 }}</td>
                                <td>
                                    @switch($d->status)
                                        @case(\App\Enums\StatusKunjunganEnum::PENDING->value)
                                            {!! '<span class="badge bg-warning">Pending</span>' !!}
                                        @break
                                        @case(\App\Enums\StatusKunjunganEnum::DONE->value)
                                            {!! '<span class="badge bg-success">Selesai</span>' !!}
                                        @break
                                        @case(\App\Enums\StatusKunjunganEnum::ONGOING->value)
                                            {!! '<span class="badge bg-info">Ongoing</span>' !!}
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    @if($d->status == \App\Enums\StatusKunjunganEnum::PENDING->value)
                                        <button class="btn btn-primary btn-sm" wire:click="edit({{ $d->id }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    @endif
                                    <a class="btn btn-info btn-sm" href="{{ route('cms.petugas.laporan.show', [
                                        'id' => Crypt::encryptString($d->id),
                                    ]) }}" wire:navigate>
                                        <i class="fa fa-eye"></i>
                                        Lihat Laporan
                                    </a>
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

    {{-- Create / Update Modal --}}
    <x-acc-modal title="{{ $isUpdate ? 'Update' : 'Create' }} {{ $title }}" :isModaOpen="$modals['defaultModal']">
        <x-acc-form submit="save">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Petugas</label>
                    <x-acc-input type="select" model="form.petugas_id">
                        <option value="">Pilih Petugas</option>
                        @foreach($petugas as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Petugas 2</label>
                    <x-acc-input type="select" model="form.petugas_2_id">
                        <option value="">Pilih Petugas</option>
                        @foreach($petugas as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</x-acc-with-alert>
