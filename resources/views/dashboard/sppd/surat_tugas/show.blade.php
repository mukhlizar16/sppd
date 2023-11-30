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
                                <th>Nomor Sp2d</th>
                                <th>Nama Petugas</th>
                                <th>Nomor ST</th>
                                <th>Kegiatan</th>
                                <th>Lama Tugas</th>
                                <th>Tanggal</th>
                                <th>Tanggal Berangkat</th>
                                <th>Tanggal Kembali</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surats as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_sp2d }}</td>
                                    <td>{{ $surat->Pegawai->nama }}</td>
                                    <td>{{ $surat->nomor_st }}</td>
                                    <td>{{ $surat->kegiatan }}</td>
                                    <td>{{ $surat->lama_tugas }}</td>
                                    <td>{{ $surat->tanggal }}</td>
                                    <td>{{ $surat->tanggal_berangkat }}</td>
                                    <td>{{ $surat->tanggal_kembali }}</td>
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
                                    @slot('title', 'Edit Data Surat')
                                    @slot('route', route('surat.update', $surat->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    <div class="mb-3">
                                        <label for="nomor_sp2d" class="form-label">Nomor Sp2d</label>
                                        <input type="number" class="form-control @error('nomor_sp2d') is-invalid @enderror"
                                            name="nomor_sp2d" id="nomor_sp2d"
                                            value="{{ old('nomor_sp2d', $surat->nomor_sp2d) }}" autofocus required>
                                        @error('nomor_sp2d')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="pegawai_id" class="form-label">Pegawai</label>
                                        <select class="form-select @error('pegawai_id') is-invalid @enderror"
                                            id="pegawai_id" name="pegawai_id">
                                            @foreach ($pegawais as $pegawai)
                                                <option value="{{ $pegawai->id }}">
                                                    {{ $pegawai->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pegawai_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nomor_st" class="form-label">Nomor ST/SPT</label>
                                        <input type="number" class="form-control @error('nomor_st') is-invalid @enderror"
                                            name="nomor_st" id="nomor_st" value="{{ old('nomor_st', $surat->nomor_st) }}"
                                            autofocus required>
                                        @error('nomor_st')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="kegiatan" class="form-label">Kegiatan</label>
                                        <input type="text" class="form-control @error('kegiatan') is-invalid @enderror"
                                            name="kegiatan" id="kegiatan" value="{{ old('kegiatan', $surat->kegiatan) }}"
                                            required>
                                        @error('kegiatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="lama_tugas" class="form-label">Lama Tugas</label>
                                        <input type="number" class="form-control @error('lama_tugas') is-invalid @enderror"
                                            name="lama_tugas" id="lama_tugas"
                                            value="{{ old('lama_tugas', $surat->lama_tugas) }}" required>
                                        @error('lama_tugas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            name="tanggal" id="tanggal" value="{{ old('tanggal', $surat->tanggal) }}"
                                            required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_berangkat') is-invalid @enderror"
                                            name="tanggal_berangkat" id="tanggal_berangkat"
                                            value="{{ old('tanggal_berangkat', $surat->tanggal_berangkat) }}" required>
                                        @error('tanggal_berangkat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                            name="tanggal_kembali" id="tanggal_kembali"
                                            value="{{ old('tanggal_kembali', $surat->tanggal_kembali) }}" required>
                                        @error('tanggal_berangkat')
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
                                    @slot('title', 'Hapus Data Surat Tugas')
                                    @slot('route', route('surat.destroy', $surat->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Surat
                                        <b>{{ $surat->nomor_sp2d }}</b>?
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
        @slot('route', route('surat.detailStore'))

        @csrf
        <div class="row">
            <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
            <div class="mb-3">
                <label for="nomor_sp2d" class="form-label">Nomor Sp2d</label>
                <input type="number" class="form-control @error('nomor_sp2d') is-invalid @enderror" name="nomor_sp2d"
                    id="nomor_sp2d" value="{{ old('nomor_sp2d') }}" autofocus required>
                @error('nomor_sp2d')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pegawai_id" class="form-label">Pegawai</label>
                <select class="form-select @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id">
                    @foreach ($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}">
                            {{ $pegawai->nama }}
                        </option>
                    @endforeach
                </select>
                @error('pegawai_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nomor_st" class="form-label">Nomor ST/SPT</label>
                <input type="number" class="form-control @error('nomor_st') is-invalid @enderror" name="nomor_st"
                    id="nomor_st" value="{{ old('nomor_st') }}" autofocus required>
                @error('nomor_st')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan"
                    id="kegiatan" value="{{ old('kegiatan') }}" required>
                @error('kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lama_tugas" class="form-label">Lama Tugas</label>
                <input type="number" class="form-control @error('lama_tugas') is-invalid @enderror" name="lama_tugas"
                    id="lama_tugas" value="{{ old('lama_tugas') }}" required>
                @error('lama_tugas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                    id="tanggal" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror"
                    name="tanggal_berangkat" id="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                @error('tanggal_berangkat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                    name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                @error('tanggal_berangkat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah surat -->
@endsection
