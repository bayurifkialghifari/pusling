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
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-group list-group-horizontal mb-2" x-data="{status: $wire.entangle('status').live}">
                            <button class="list-group-item"
                                :class="status == 'all' ? 'active' : ''"
                                x-on:click="status = 'all'">
                                Semua
                            </button>
                            @foreach(\App\Enums\StatusEnum::getValues() as $status)
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
                                Document
                            </th>
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
                                <td>{{ $d->permohonan_at }}</td>
                                <td>{{ $d->kunjungan_at }}</td>
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
                                <td>
                                    <a href="{{ $d->getFirstMediaUrl('document') }}"
                                        class="btn btn-primary btn-sm"
                                        target="_blank">
                                        <i class="fa fa-file"></i>
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm"
                                        wire:click="show({{ $d->id }})">
                                        <i class="fa fa-eye"></i> Show
                                    </button>
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
    {{-- Show Modal --}}
    <x-acc-modal title="{{ $title }}" :isModaOpen="$modals['defaultModal']">
        <x-acc-form submit="save">
            <div class="col-md-12">
                @if($form->old_data?->status == 0)
                    <div class="text-center">
                        <button class="btn btn-success btn-sm"
                            type="button"
                            wire:click="approve({{ $form?->id }})">
                            <i class="fa fa-edit"></i> Approve
                        </button>
                        <button class="btn btn-danger btn-sm"
                            type="button"
                            wire:click="reject({{ $form?->id }})">
                            <i class="fa fa-trash"></i> Reject
                        </button>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Nama Institusi</label>
                    <x-acc-input type="text" model="form.institusi" placeholder="Nama" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Alamat Institusi</label>
                    <x-acc-input type="textarea" model="form.institusi_address" placeholder="Alamat" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <x-acc-input type="email" model="form.email" placeholder="Email" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">WhatsApp</label>
                    <x-acc-input type="number" model="form.whatsapp" placeholder="WhatsApp" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Tanggal Kunjungan</label>
                    <x-acc-input type="date" model="form.kunjungan_at" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Dokumen Permohonan</label>
                    <iframe src="{{ $form->old_data?->getFirstMediaUrl('document') }}"
                        width="100%"
                        height="300px"
                        frameborder="0"></iframe>
                </div>
            </div>
            <x-slot:actions>

            </x-slot:actions>
        </x-acc-form>
    </x-acc-modal>

    {{-- Approve  Modal --}}
    <x-acc-modal title="Approve Kunjungan" :isModaOpen="$modals['approveModal']" closeModalFunction="closeApproveModal">
        <x-acc-form submit="saveJadwal">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Institusi</label>
                    <x-acc-input type="date" model="form.institusi" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Alamat Institusi</label>
                    <x-acc-input type="textarea" model="form.institusi_address" placeholder="Alamat" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Tanggal Kunjungan</label>
                    <x-acc-input type="date" model="form.kunjungan_at" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Petugas</label>
                    <x-acc-input type="select" model="formJadwal.petugas_id">
                        <option value="">Pilih Petugas</option>
                        @foreach($petugas as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <x-acc-input type="date" model="formJadwal.jadwal" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <x-acc-input type="text" model="formJadwal.location" placeholder="Lokasi" />
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</x-acc-with-alert>
