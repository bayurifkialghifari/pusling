<x-acc-with-alert>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-header :$originRoute createClick="customCreate" />
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
                                <x-acc-update-delete :id="$d->id" :$originRoute />
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
                <div class="text-center">
                    <h6 class="fw-bolder">
                        Sebelum mengisi permohonan diharap membaca prosedur !
                    </h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Nama Institusi</label>
                    <x-acc-input type="text" model="form.institusi" placeholder="Nama" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Alamat Institusi</label>
                    <x-acc-input type="textarea" model="form.institusi_address" placeholder="Alamat" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <x-acc-input type="email" model="form.email" placeholder="Email" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">WhatsApp</label>
                    <x-acc-input type="number" model="form.whatsapp" placeholder="WhatsApp" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Tanggal Kunjungan</label>
                    <x-acc-input type="date" model="form.kunjungan_at" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Dokumen Permohonan</label>
                    <x-acc-input-file  model="form.document_permohonan" />
                    <x-acc-input-error for="form.document_permohonan" />
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</x-acc-with-alert>
