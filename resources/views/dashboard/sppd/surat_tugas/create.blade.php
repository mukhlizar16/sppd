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
    <div class="row">
        <div class="col col-md-12">
            <div class="container mt-4">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary" disabled>
                            <i class="fa-regular fa-envelopes-bulk me-2"></i>
                            Surat Tugas
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary">
                            <i class="fa-regular fa-money-bill me-2"></i>
                            Uang Harian
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary">
                            <i class="fa-regular fa-cars me-2"></i>
                            Akomodasi
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary">
                            <i class="fa-regular fa-plane-departure me-2"></i>
                            Tiket Pergi
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary">
                            <i class="fa-regular fa-plane-arrival me-2"></i>
                            Tiket Pulang
                        </button>
                    </div>
                </div>

                <div class="progress mt-4">
                    <div class="progress-bar" role="progressbar" style="width: 14%;" aria-valuenow="20" aria-valuemin="0"
                        aria-valuemax="100">
                        20%
                    </div>
                </div>
            </div>


            <div class="card mt-3">
                <div class="card-body">
                    {{-- Form Berita --}}
                    <form action="{{ route('surat.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="sppd_id" value="{{ request('id') }}">
                        <div class="mb-3">
                            <label for="nomor_sp2d" class="form-label">Nomor Sp2d</label>
                            <input type="number" class="form-control @error('nomor_sp2d') is-invalid @enderror"
                                name="nomor_sp2d" id="nomor_sp2d" value="{{ old('nomor_sp2d') }}" autofocus required>
                            @error('nomor_sp2d')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label">Pegawai</label>
                            <select class="form-select @error('pegawai_id') is-invalid @enderror" id="pegawai_id"
                                name="pegawai_id">
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
                                name="nomor_st" id="nomor_st" value="{{ old('nomor_st') }}" autofocus required>
                            @error('nomor_st')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <input type="text" class="form-control @error('kegiatan') is-invalid @enderror"
                                name="kegiatan" id="kegiatan" value="{{ old('kegiatan') }}" required>
                            @error('kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lama_tugas" class="form-label">Lama Tugas</label>
                            <input type="number" class="form-control @error('lama_tugas') is-invalid @enderror"
                                name="lama_tugas" id="lama_tugas" value="{{ old('lama_tugas') }}" required>
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
                                name="tanggal_berangkat" id="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}"
                                required>
                            @error('tanggal_berangkat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                                required>
                            @error('tanggal_berangkat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    {{-- End Form Berita --}}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/show-hide-password.js') }}"></script>
@endsection
