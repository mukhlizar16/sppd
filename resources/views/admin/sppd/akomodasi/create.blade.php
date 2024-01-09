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
            <a class="btn btn-outline-secondary" href="{{ route('sppd.index') }}">
                <i class="fa-regular fa-chevron-left me-2"></i>
                Kembali
            </a>
            <div class="container mt-4">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('surat.index', request('id') ) }}" class="btn btn-outline-secondary">
                            <i class="fa-regular fa-envelopes-bulk me-2"></i>
                            Surat Tugas
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('uang.index', request('id') ) }}" class="btn btn-outline-secondary">
                            <i class="fa-regular fa-money-bill me-2"></i>
                            Uang Harian
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('akomodasi.index', request('id') ) }}" class="btn btn-primary" >
                            <i class="fa-regular fa-cars me-2"></i>
                            Akomodasi
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('pergi.index', request('id') ) }}" class="btn btn-outline-secondary">
                            <i class="fa-regular fa-plane-departure me-2"></i>
                            Tiket Pergi
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('pulang.index', request('id') ) }}" class="btn btn-outline-secondary">
                            <i class="fa-regular fa-plane-arrival me-2"></i>
                            Tiket Pulang
                        </a>
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
                                name="nama_hotel" id="name_hotel" value="{{ old('nama_hotel') }}" autofocus required>
                            @error('name_hotel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="check_in" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control @error('check_in') is-invalid @enderror"
                                name="check_in" id="check_in" value="{{ old('check_in') }}" autofocus required>
                            @error('check_in')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="check_out" class="form-label">Tanggal Keluar</label>
                            <input type="date" class="form-control @error('check_out') is-invalid @enderror"
                                name="check_out" id="check_out" value="{{ old('check_out') }}" autofocus required>
                            @error('check_out')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_invoice" class="form-label">No Invoice</label>
                            <input type="text" class="form-control @error('nomor_invoice') is-invalid @enderror"
                                name="nomor_invoice" id="nomor_invoice" value="{{ old('nomor_invoice') }}" required>
                            @error('nomor_invoice')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_kamar" class="form-label">No Kamar</label>
                            <input type="text" class="form-control @error('nomor_kamar') is-invalid @enderror"
                                name="nomor_kamar" id="nomor_kamar" value="{{ old('nomor_kamar') }}" required>
                            @error('nomor_kamar')
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
                            <label for="harga" class="form-label">Harga Permalam</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                name="harga" id="harga" value="{{ old('harga') }}"
                                required>
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga_diskon" class="form-label">Harga Permalam (30%)</label>
                            <input type="number" class="form-control @error('harga_diskon') is-invalid @enderror"
                                name="harga_diskon" id="harga_diskon" value="{{ old('harga_diskon') }}"
                                required>
                            @error('harga_diskon')
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
