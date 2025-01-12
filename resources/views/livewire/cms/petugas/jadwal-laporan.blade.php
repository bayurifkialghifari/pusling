<x-acc-with-alert>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">{{ $title ?? '' }} Data</h5>
                    </div>
                    <x-acc-form submit="customSave">
                        @php
                            $disabled = $originRoute == 'cms.petugas.laporan.show' ? true : false;
                        @endphp
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Petugas</label>
                                <input type="text" class="form-control" disabled value="{{ $jadwal->petugas->name }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kegiatan</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->format('d F Y') }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Institusi</label>
                                <input type="text" class="form-control" disabled value="{{ $jadwal->permohonan->institusi }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat Institusi</label>
                                <input type="text" class="form-control" disabled value="{{ $jadwal->permohonan->institusi_address }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pengunjung Laki - Laki </label>
                                <x-acc-input type="number" :$disabled model="form.jumlah_pengunjung_laki" placeholder="Jumlah Pengunjung Laki - Laki" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pengunjung Perempuan </label>
                                <x-acc-input type="number" :$disabled model="form.jumlah_pengunjung_perempuan" placeholder="Jumlah Pengunjung Perempuan" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Masukan</label>
                                <x-acc-input type="textarea" :$disabled model="form.masukan" placeholder="Masukan" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kendala</label>
                                <x-acc-input type="textarea" :$disabled model="form.kendala" placeholder="Kendala" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Foto Kegiatan</label>
                                @if($originRoute != 'cms.petugas.laporan.show')
                                    <livewire:dropzone
                                        wire:model="form.foto_kegiatan"
                                        :rules="['image','mimes:png,jpeg','max:10420']"
                                        :multiple="true" />
                                    <x-acc-input-error for="form.foto_kegiatan.*" />
                                @else
                                    <div class="row">
                                    @foreach ($form->old_data->getMedia('images') as $image)
                                        <div class="col-md-3 border">
                                            <img src="{{ $image->getUrl() }}" alt="Foto Kegiatan" class="img-fluid mb-3" width="100%">
                                        </div>
                                    @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($originRoute == 'cms.petugas.laporan.show')
                            <x-slot:actions></x-slot:actions>
                        @endif
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</x-acc-with-alert>
