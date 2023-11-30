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
                                    <td>{{ $sppd->name }}</td>
                                    <td>{{ $sppd->JenisTugas->name }}</td>
                                    <td>{{ $sppd->total_biaya }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info">
                                            <i class="fa-regular fa-plus"></i>
                                        </button>
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
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $sppd->name) }}" autofocus
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_tugas_id" class="form-label">Jenis Tugas</label>
                                        <select class="form-select @error('jenis_tugas_id') is-invalid @enderror" id="jenis_tugas_id"
                                            name="jenis_tugas_id">
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
                                        <input type="total_biaya" class="form-control @error('total_biaya') is-invalid @enderror" id="total_biaya"
                                            name="total_biaya" value="{{ old('total_biaay', $sppd->total_biaya) }}">
                                        @error('total_biaya')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-text" id="basic-addon4">Kosongkan jika belum mempunyai total</div>
                                    </div>
                                </x-form_modal>
                                {{-- / Modal Edit sppd --}}

                                {{-- Modal Hapus sppd --}}
                                <x-form_modal>
                                    @slot('id', "hapusSppd$loop->iteration")
                                    @slot('title', 'Hapus Data Sppd')
                                    @slot('route', route('sppd.destroy', $sppd->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Sppd
                                        <b>{{ $sppd->name }}</b>?
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
    <!-- Modal Tambah jenis -->
    <x-form_modal>
        @slot('id', 'tambahSppd')
        @slot('title', 'Tambah Data Sppd')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('sppd.store'))

        @csrf
        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jenis_tugas_id" class="form-label">Jenis Tugas</label>
                <select class="form-select @error('jenis_tugas_id') is-invalid @enderror" id="jenis_tugas_id"
                    name="jenis_tugas_id">
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
                <input type="total_biaya" class="form-control @error('total_biaya') is-invalid @enderror" id="total_biaya"
                    name="total_biaya" >
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
@endsection
