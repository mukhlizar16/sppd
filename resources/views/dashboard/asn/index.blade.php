@extends('dashboard.layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambahAsn"><i
            class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah</button>
    <div class="row mt-3">
        <div class="col">
            <div class="card mt-2">
                <div class="card-body">

                    {{-- Tabel Data asn --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asns as $asn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $asn->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editAsn{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusAsn{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Edit asn --}}
                                <x-form_modal>
                                    @slot('id', "editAsn$loop->iteration")
                                    @slot('title', 'Edit Data Asn')
                                    @slot('route', route('asn.update', $asn->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $asn->name) }}" autofocus
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </x-form_modal>
                                {{-- / Modal Edit asn --}}

                                {{-- Modal Hapus asn --}}
                                <x-form_modal>
                                    @slot('id', "hapusAsn$loop->iteration")
                                    @slot('title', 'Hapus Data Asn')
                                    @slot('route', route('asn.destroy', $asn->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Asn
                                        <b>{{ $asn->name }}</b>?
                                    </p>

                                </x-form_modal>
                                {{-- / Modal Hapus asn  --}}

                            @endforeach
                        </tbody>
                    </table>
                    {{-- / Tabel Data ... --}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah asn -->
    <x-form_modal>
        @slot('id', 'tambahAsn')
        @slot('title', 'Tambah Data Asn')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('asn.store'))

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
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah asn -->
@endsection
