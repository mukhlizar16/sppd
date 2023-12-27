<x-app-layout :$title>
    <div class="row">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a class="text-white btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSppd">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </a>

            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jenis Tugas</th>
                                <th>Total Biaya</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sppds as $sppd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sppd->pegawai->nama_lengkap }}</td>
                                    <td>{{ $sppd->JenisTugas->name }}</td>
                                    <td>Rp. {{ number_format($sppd->total_biaya, 0, ',', '.') }}</td>
                                    <td>
                                        <a class="text-white btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#detailSppd{{ $loop->iteration }}">
                                            <i class="fa-regular fa-plus"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editSppd{{ $loop->iteration }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusSppd{{ $loop->iteration }}">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- Modal Edit sppd --}}
                                <x-form_modal>
                                    @slot('id', "editSppd$loop->iteration")
                                    @slot('title', 'Edit Data Sppd')
                                    @slot('route', route('sppd.update', $sppd->id))
                                    @slot('method')
                                        @method('put')
                                    @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <select class="form-select @error('name') is-invalid @enderror" id="name"
                                            name="name" value="{{ old('name', $sppd->name) }}" required>
                                            <option value="">-- pilih pegawai --</option>
                                        </select>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_tugas_id" class="form-label">Jenis Tugas</label>
                                        <select class="form-select @error('jenis_tugas_id') is-invalid @enderror"
                                            id="jenis_tugas_id" name="jenis_tugas_id">
                                            @foreach ($jenises as $jenis)
                                                <option value="{{ $jenis->id }}">
                                                    {{ $jenis->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_tugas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_biaya" class="form-label">Total Biaya</label>
                                        <input type="total_biaya"
                                            class="form-control @error('total_biaya') is-invalid @enderror"
                                            id="total_biaya" name="total_biaya"
                                            value="{{ old('total_biaay', $sppd->total_biaya) }}">
                                        @error('total_biaya')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-text" id="basic-addon4">Kosongkan jika belum mempunyai total
                                        </div>
                                    </div>
                                </x-form_modal>
                                {{-- / Modal Edit sppd --}}

                                {{-- Modal Hapus sppd --}}
                                <x-form_modal>
                                    @slot('id', "hapusSppd$loop->iteration")
                                    @slot('title', 'Hapus Data Sppd')
                                    @slot('route', route('sppd.destroy', $sppd->id))
                                    @slot('method')
                                        @method('delete')
                                    @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Sppd
                                        <b>{{ $sppd->name }}</b>?
                                    </p>

                                </x-form_modal>
                                {{-- / Modal Hapus sppd  --}}

                                <!-- Modal -->
                                <div class="modal fade" id="detailSppd{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Detail Sppd
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="fs-3">
                                                    <b>{{ $sppd->name }}</b>
                                                </p>
                                                <div class="row d-flex justify-content-center align-items-center">
                                                    <div class="mb-2 col-lg-4">
                                                        <a class="text-white btn btn-primary"
                                                            href="{{ route('surat.detail', $sppd->id) }}">Surat
                                                            Tugas</a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a class="text-white btn btn-primary"
                                                            href="{{ route('akomodasi.detail', $sppd->id) }}">Akomodasi</a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a class="text-white btn btn-primary"
                                                            href="{{ route('uang.detail', $sppd->id) }}">Uang
                                                            Harian</a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a class="text-white btn btn-primary"
                                                            href="{{ route('pergi.detail', $sppd->id) }}">Tiket
                                                            Pergi</a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a class="text-white btn btn-primary"
                                                            href="{{ route('pulang.detail', $sppd->id) }}">Tiket
                                                            Pulang</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah jenis -->
    <x-form_modal>
        @slot('id', 'tambahSppd')
        @slot('title', 'Tambah Data Sppd')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('sppd.store'))

        @csrf
        <div class="row">
            <div class="mb-3">
                <label for="pegawai" class="form-label">Nama</label>
                <select style="width: 100%" class="form-control form-select @error('pegawai') is-invalid @enderror"
                    id="pegawai" name="pegawai" required>
                    <option value="">-- pilih pegawai --</option>
                    @foreach ($users as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('pegawai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jenis_tugas_id" class="form-label">Jenis Tugas</label>
                <select class="form-select @error('jenis_tugas_id') is-invalid @enderror" id="jenis_tugas_id"
                    name="jenis_tugas_id">
                    <option value="">-- pilih --</option>
                    @foreach ($jenises as $jenis)
                        <option value="{{ $jenis->id }}">
                            {{ $jenis->name }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_tugas_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total_biaya" class="form-label">Total Biaya</label>
                <div class="input-group">
                    <div class="input-group-text">
                        Rp.
                    </div>
                    <input type="text" class="form-control @error('total_biaya') is-invalid @enderror"
                        id="total_biaya" name="total_biaya">
                </div>
                @error('total_biaya')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text" id="basic-addon4">Kosongkan jika belum mempunyai total</div>
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah jenis -->

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('script')
        <script src="{{ asset('libs/mask-money/jquery.maskMoney.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('#pegawai').select2({
                dropdownParent: $('#tambahSppd')
            });
            $('#total_biaya').maskMoney({
                thousands: '.',
                decimal: ',',
                precision: 0,
                allowZero: true
            })
        </script>
    @endpush
</x-app-layout>
