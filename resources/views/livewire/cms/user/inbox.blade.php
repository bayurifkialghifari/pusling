<x-acc-with-alert>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-header :$originRoute :isCreate="false" :isSearch="false" />
            <div class="table-responsive">
                <x-acc-table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Subject</th>
                            <th>Isi Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($get as $d)
                            <tr>
                                <td>{{ $d->created_at->format('d F Y H:i') }}</td>
                                <td>
                                    @switch($d->type)
                                        @case(\App\Notifications\Permohonan\Created::class)
                                            <a href="{{ route('cms.user.permohonan') }}">
                                                Permohonan Baru
                                            </a>
                                            @break
                                        @case(\App\Notifications\Permohonan\Approved::class)
                                            <a href="{{ route('cms.user.permohonan') }}">
                                                Permohonan Disetujui
                                            </a>
                                            @break
                                        @default
                                    @endswitch
                                </td>
                                <td>
                                    -
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
