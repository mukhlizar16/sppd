<x-app-layout :$title>
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
                        <button class="btn btn-outline-secondary">
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
                        <button class="btn btn-primary" disabled>
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

                <div class="mt-4 progress">
                    <div class="progress-bar" role="progressbar" style="width: 54%;" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100">
                        60%
                    </div>
                </div>
            </div>


            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Form Berita --}}
                    <form action="{{ route('akomodasi.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="sppd_id" value="{{ request('id') }}">
                        <div class="mb-3">
                            <label for="name_hotel" class="form-label">Nama Hotel</label>
                            <input type="text" class="form-control @error('name_hotel') is-invalid @enderror"
                                name="name_hotel" id="name_hotel" value="{{ old('name_hotel') }}" autofocus required>
                            @error('name_hotel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk') }}" autofocus required>
                            @error('tgl_masuk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                            <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror"
                                name="tgl_keluar" id="tgl_keluar" value="{{ old('tgl_keluar') }}" autofocus required>
                            @error('tgl_keluar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_invoice" class="form-label">No Invoice</label>
                            <input type="text" class="form-control @error('no_invoice') is-invalid @enderror"
                                name="no_invoice" id="no_invoice" value="{{ old('no_invoice') }}" required>
                            @error('no_invoice')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_kamar" class="form-label">No Kamar</label>
                            <input type="text" class="form-control @error('no_kamar') is-invalid @enderror"
                                name="no_kamar" id="no_kamar" value="{{ old('no_kamar') }}" required>
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
                                id="lama_inap" value="{{ old('lama_inap') }}" required>
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
                                name="harga_permalam" id="harga_permalam" value="{{ old('harga_permalam') }}"
                                required>
                            @error('harga_permalam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga_permalam2" class="form-label">Harga Permalam (30%)</label>
                            <input type="number" class="form-control @error('harga_permalam2') is-invalid @enderror"
                                name="harga_permalam2" id="harga_permalam2" value="{{ old('harga_permalam2') }}"
                                required>
                            @error('harga_permalam2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_uang" class="form-label">Total Uang</label>
                            <input type="number" class="form-control @error('total_uang') is-invalid @enderror"
                                name="total_uang" id="total_uang" value="{{ old('total_uang') }}" required>
                            @error('total_uang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bbm" class="form-label">BBM</label>
                            <input type="number" class="form-control @error('bbm') is-invalid @enderror"
                                name="bbm" id="bbm" value="{{ old('bbm') }}" required>
                            @error('bbm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dari" class="form-label">Dari</label>
                            <input type="text" class="form-control @error('dari') is-invalid @enderror"
                                name="dari" id="dari" value="{{ old('dari') }}" required>
                            @error('dari')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ke" class="form-label">Ke</label>
                            <input type="text" class="form-control @error('ke') is-invalid @enderror"
                                name="ke" id="ke" value="{{ old('ke') }}" required>
                            @error('ke')
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
</x-app-layout>
