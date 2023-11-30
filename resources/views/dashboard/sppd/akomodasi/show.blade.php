@extends('dashboard.layouts.main')

@section('content')
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
            <a class="btn btn-outline-secondary" href="{{ route('sppd.index') }}">
                <i class="fa-regular fa-chevron-left me-2"></i>
                Kembali
            </a>
            <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambahSppd">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </a>

            <div class="card mt-3">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Hotel</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>No Invoice</th>
                                <th>No Kamar</th>
                                <th>Lama Inap</th>
                                <th>Nama Kwitansi</th>
                                <th>Harga Permalam</th>
                                <th>Harga Permalam (30%)</th>
                                <th>Total Uang</th>
                                <th>BBM</th>
                                <th>Dari</th>
                                <th>Ke</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akomodasis as $akomodasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $akomodasi->name_hotel }}</td>
                                    <td>{{ $akomodasi->tgl_masuk }}</td>
                                    <td>{{ $akomodasi->tgl_keluar }}</td>
                                    <td>{{ $akomodasi->no_invoice }}</td>
                                    <td>{{ $akomodasi->no_kamar }}</td>
                                    <td>{{ $akomodasi->lama_inap }}</td>
                                    <td>{{ $akomodasi->nama_kwitansi }}</td>
                                    <td>{{ $akomodasi->harga_permalam }}</td>
                                    <td>{{ $akomodasi->harga_permalam2 }}</td>
                                    <td>{{ $akomodasi->total_uang }}</td>
                                    <td>{{ $akomodasi->bbm }}</td>
                                    <td>{{ $akomodasi->dari }}</td>
                                    <td>{{ $akomodasi->ke }}</td>
                                    <td>
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
                                    @slot('title', 'Edit Data Akomodasi')
                                    @slot('route', route('akomodasi.update', $akomodasi->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    @csrf
                                    <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
                                    <div class="mb-3">
                                        <label for="name_hotel" class="form-label">Nama Hotel</label>
                                        <input type="text" class="form-control @error('name_hotel') is-invalid @enderror"
                                            name="name_hotel" id="name_hotel"
                                            value="{{ old('name_hotel', $akomodasi->name_hotel) }}" autofocus required>
                                        @error('name_hotel')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                                        <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                            name="tgl_masuk" id="tgl_masuk"
                                            value="{{ old('tgl_masuk', $akomodasi->tgl_masuk) }}" autofocus required>
                                        @error('tgl_masuk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                                        <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror"
                                            name="tgl_keluar" id="tgl_keluar"
                                            value="{{ old('tgl_keluar', $akomodasi->tgl_keluar) }}" autofocus required>
                                        @error('tgl_keluar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_invoice" class="form-label">No Invoice</label>
                                        <input type="text" class="form-control @error('no_invoice') is-invalid @enderror"
                                            name="no_invoice" id="no_invoice"
                                            value="{{ old('no_invoice', $akomodasi->no_invoice) }}" required>
                                        @error('no_invoice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_kamar" class="form-label">No Kamar</label>
                                        <input type="text" class="form-control @error('no_kamar') is-invalid @enderror"
                                            name="no_kamar" id="no_kamar"
                                            value="{{ old('no_kamar', $akomodasi->no_kamar) }}" required>
                                        @error('no_kamar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="lama_inap" class="form-label">Lama Inap</label>
                                        <input type="number" max="50"
                                            class="form-control @error('lama_inap') is-invalid @enderror" name="lama_inap"
                                            id="lama_inap" value="{{ old('lama_inap', $akomodasi->lama_inap) }}" required>
                                        @error('lama_inap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_kwitansi" class="form-label">Nama Kwitansi</label>
                                        <input type="text"
                                            class="form-control @error('nama_kwitansi') is-invalid @enderror"
                                            name="nama_kwitansi" id="nama_kwitansi"
                                            value="{{ old('nama_kwitansi', $akomodasi->nama_kwitansi) }}" required>
                                        @error('nama_kwitansi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="harga_permalam" class="form-label">Harga Permalam</label>
                                        <input type="number"
                                            class="form-control @error('harga_permalam') is-invalid @enderror"
                                            name="harga_permalam" id="harga_permalam"
                                            value="{{ old('harga_permalam', $akomodasi->harga_permalam) }}" required>
                                        @error('harga_permalam')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="harga_permalam2" class="form-label">Harga Permalam (30%)</label>
                                        <input type="number"
                                            class="form-control @error('harga_permalam2') is-invalid @enderror"
                                            name="harga_permalam2" id="harga_permalam2"
                                            value="{{ old('harga_permalam2', $akomodasi->harga_permalam2) }}" required>
                                        @error('harga_permalam2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_uang" class="form-label">Total Uang</label>
                                        <input type="number"
                                            class="form-control @error('total_uang') is-invalid @enderror"
                                            name="total_uang" id="total_uang"
                                            value="{{ old('total_uang', $akomodasi->total_uang) }}" required>
                                        @error('total_uang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="bbm" class="form-label">BBM</label>
                                        <input type="number" class="form-control @error('bbm') is-invalid @enderror"
                                            name="bbm" id="bbm" value="{{ old('bbm', $akomodasi->bbm) }}"
                                            required>
                                        @error('bbm')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="dari" class="form-label">Dari</label>
                                        <input type="text" class="form-control @error('dari') is-invalid @enderror"
                                            name="dari" id="dari" value="{{ old('dari', $akomodasi->dari) }}"
                                            required>
                                        @error('dari')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="ke" class="form-label">Ke</label>
                                        <input type="text" class="form-control @error('ke') is-invalid @enderror"
                                            name="ke" id="ke" value="{{ old('ke', $akomodasi->ke) }}"
                                            required>
                                        @error('ke')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </x-form_modal>
                                {{-- / Modal Edit sppd --}}

                                {{-- Modal Hapus sppd --}}
                                <x-form_modal>
                                    @slot('id', "hapusSppd$loop->iteration")
                                    @slot('title', 'Hapus Data Akomodasi')
                                    @slot('route', route('akomodasi.destroy', $akomodasi->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Akomodasi
                                        <b>{{ $akomodasi->name_hotel }}</b>?
                                    </p>

                                </x-form_modal>
                                {{-- / Modal Hapus sppd  --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah surat -->
    <x-form_modal>
        @slot('id', 'tambahSppd')
        @slot('title', 'Tambah Data Sppd')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('akomodasi.detailStore'))

        @csrf

            <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
            <div class="mb-3">
                <label for="name_hotel" class="form-label">Nama Hotel</label>
                <input type="text" class="form-control @error('name_hotel') is-invalid @enderror" name="name_hotel"
                    id="name_hotel" value="{{ old('name_hotel') }}" autofocus required>
                @error('name_hotel')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk"
                    id="tgl_masuk" value="{{ old('tgl_masuk') }}" autofocus required>
                @error('tgl_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar"
                    id="tgl_keluar" value="{{ old('tgl_keluar') }}" autofocus required>
                @error('tgl_keluar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_invoice" class="form-label">No Invoice</label>
                <input type="text" class="form-control @error('no_invoice') is-invalid @enderror" name="no_invoice"
                    id="no_invoice" value="{{ old('no_invoice') }}" required>
                @error('no_invoice')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_kamar" class="form-label">No Kamar</label>
                <input type="text" class="form-control @error('no_kamar') is-invalid @enderror" name="no_kamar"
                    id="no_kamar" value="{{ old('no_kamar') }}" required>
                @error('no_kamar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lama_inap" class="form-label">Lama Inap</label>
                <input type="number" max="50" class="form-control @error('lama_inap') is-invalid @enderror"
                    name="lama_inap" id="lama_inap" value="{{ old('lama_inap') }}" required>
                @error('lama_inap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_kwitansi" class="form-label">Nama Kwitansi</label>
                <input type="text" class="form-control @error('nama_kwitansi') is-invalid @enderror"
                    name="nama_kwitansi" id="nama_kwitansi" value="{{ old('nama_kwitansi') }}" required>
                @error('nama_kwitansi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga_permalam" class="form-label">Harga Permalam</label>
                <input type="number" class="form-control @error('harga_permalam') is-invalid @enderror"
                    name="harga_permalam" id="harga_permalam" value="{{ old('harga_permalam') }}" required>
                @error('harga_permalam')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga_permalam2" class="form-label">Harga Permalam (30%)</label>
                <input type="number" class="form-control @error('harga_permalam2') is-invalid @enderror"
                    name="harga_permalam2" id="harga_permalam2" value="{{ old('harga_permalam2') }}" required>
                @error('harga_permalam2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_uang" class="form-label">Total Uang</label>
                <input type="number" class="form-control @error('total_uang') is-invalid @enderror" name="total_uang"
                    id="total_uang" value="{{ old('total_uang') }}" required>
                @error('total_uang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bbm" class="form-label">BBM</label>
                <input type="number" class="form-control @error('bbm') is-invalid @enderror" name="bbm"
                    id="bbm" value="{{ old('bbm') }}" required>
                @error('bbm')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dari" class="form-label">Dari</label>
                <input type="text" class="form-control @error('dari') is-invalid @enderror" name="dari"
                    id="dari" value="{{ old('dari') }}" required>
                @error('dari')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ke" class="form-label">Ke</label>
                <input type="text" class="form-control @error('ke') is-invalid @enderror" name="ke"
                    id="ke" value="{{ old('ke') }}" required>
                @error('ke')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah surat -->
@endsection
