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
                                <th>Harian</th>
                                <th>Total Harian</th>
                                <th>Konsumsi</th>
                                <th>Total Konsumsi</th>
                                <th>Transportasi</th>
                                <th>Total Transportasi</th>
                                <th>Representasi</th>
                                <th>Total Representasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($uangs as $uang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $uang->harian }}</td>
                                    <td>{{ $uang->total_harian }}</td>
                                    <td>{{ $uang->konsumsi }}</td>
                                    <td>{{ $uang->total_konsumsi }}</td>
                                    <td>{{ $uang->transportasi }}</td>
                                    <td>{{ $uang->total_transportasi }}</td>
                                    <td>{{ $uang->representasi }}</td>
                                    <td>{{ $uang->total_representasi }}</td>
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
                                    @slot('title', 'Edit Data Uang')
                                    @slot('route', route('uang.update', $uang->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    @csrf
                                    <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
                                    <div class="mb-3">
                                        <label for="harian" class="form-label">Harian</label>
                                        <input type="number" class="form-control @error('harian') is-invalid @enderror"
                                            name="harian" id="harian" value="{{ old('harian', $uang->harian) }}" autofocus required>
                                        @error('harian')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_harian" class="form-label">Total Harian</label>
                                        <input type="number" class="form-control @error('total_harian') is-invalid @enderror"
                                            name="total_harian" id="total_harian" value="{{ old('total_harian', $uang->total_harian) }}" autofocus required>
                                        @error('total_harian')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="konsumsi" class="form-label">Konsumsi</label>
                                        <input type="number" class="form-control @error('konsumsi') is-invalid @enderror"
                                            name="konsumsi" id="konsumsi" value="{{ old('konsumsi', $uang->konsumsi) }}" autofocus required>
                                        @error('konsumsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_konsumsi" class="form-label">Total Konsumsi</label>
                                        <input type="number" class="form-control @error('total_konsumsi') is-invalid @enderror"
                                            name="total_konsumsi" id="total_konsumsi" value="{{ old('total_konsumsi', $uang->total_konsumsi) }}" autofocus required>
                                        @error('total_konsumsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="transportasi" class="form-label">Transportasi</label>
                                        <input type="number" class="form-control @error('transportasi') is-invalid @enderror"
                                            name="transportasi" id="transportasi" value="{{ old('transportasi', $uang->transportasi) }}" autofocus required>
                                        @error('transportasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_transportasi" class="form-label">Total Transportasi</label>
                                        <input type="number" class="form-control @error('total_transportasi') is-invalid @enderror"
                                            name="total_transportasi" id="total_transportasi" value="{{ old('total_transportasi', $uang->total_transportasi) }}" autofocus required>
                                        @error('total_transportasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="representasi" class="form-label">Representasi</label>
                                        <input type="number" class="form-control @error('representasi') is-invalid @enderror"
                                            name="representasi" id="representasi" value="{{ old('representasi', $uang->representasi) }}" autofocus required>
                                        @error('representasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_representasi" class="form-label">Total Representasi</label>
                                        <input type="number" class="form-control @error('total_representasi') is-invalid @enderror"
                                            name="total_representasi" id="total_representasi" value="{{ old('total_representasi', $uang->total_representasi) }}" autofocus required>
                                        @error('total_representasi')
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
                                    @slot('title', 'Hapus Data Uang')
                                    @slot('route', route('uang.destroy', $uang->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Uang
                                        <b>{{ $uang->harian }}</b>?
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
        @slot('title', 'Tambah Data Uang')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('uang.detailStore'))

        @csrf

            <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
            <div class="mb-3">
                <label for="harian" class="form-label">Harian</label>
                <input type="number" class="form-control @error('harian') is-invalid @enderror"
                    name="harian" id="harian" value="{{ old('harian') }}" autofocus required>
                @error('harian')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_harian" class="form-label">Total Harian</label>
                <input type="number" class="form-control @error('total_harian') is-invalid @enderror"
                    name="total_harian" id="total_harian" value="{{ old('total_harian') }}" autofocus required>
                @error('total_harian')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="konsumsi" class="form-label">Konsumsi</label>
                <input type="number" class="form-control @error('konsumsi') is-invalid @enderror"
                    name="konsumsi" id="konsumsi" value="{{ old('konsumsi') }}" autofocus required>
                @error('konsumsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_konsumsi" class="form-label">Total Konsumsi</label>
                <input type="number" class="form-control @error('total_konsumsi') is-invalid @enderror"
                    name="total_konsumsi" id="total_konsumsi" value="{{ old('total_konsumsi') }}" autofocus required>
                @error('total_konsumsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="transportasi" class="form-label">Transportasi</label>
                <input type="number" class="form-control @error('transportasi') is-invalid @enderror"
                    name="transportasi" id="transportasi" value="{{ old('transportasi') }}" autofocus required>
                @error('transportasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_transportasi" class="form-label">Total Transportasi</label>
                <input type="number" class="form-control @error('total_transportasi') is-invalid @enderror"
                    name="total_transportasi" id="total_transportasi" value="{{ old('total_transportasi') }}" autofocus required>
                @error('total_transportasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="representasi" class="form-label">Representasi</label>
                <input type="number" class="form-control @error('representasi') is-invalid @enderror"
                    name="representasi" id="representasi" value="{{ old('representasi') }}" autofocus required>
                @error('representasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_representasi" class="form-label">Total Representasi</label>
                <input type="number" class="form-control @error('total_representasi') is-invalid @enderror"
                    name="total_representasi" id="total_representasi" value="{{ old('total_representasi') }}" autofocus required>
                @error('total_representasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah surat -->
@endsection
