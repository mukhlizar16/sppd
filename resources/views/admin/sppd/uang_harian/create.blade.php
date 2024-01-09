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
                        <a href="{{ route('uang.index', request('id') ) }}" class="btn btn-primary">
                            <i class="fa-regular fa-money-bill me-2"></i>
                            Uang Harian
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('akomodasi.index', request('id') ) }}" class="btn btn-outline-secondary" >
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
                    <form action="{{ route('uang.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="sppd_id" value="{{ request('id') }}">
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
                                name="total_harian" id="total_harian" value="{{ old('total_harian') }}" autofocus
                                required>
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
                                name="total_konsumsi" id="total_konsumsi" value="{{ old('total_konsumsi') }}" autofocus
                                required>
                            @error('total_konsumsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="transportasi" class="form-label">Transportasi</label>
                            <input type="number" class="form-control @error('transportasi') is-invalid @enderror"
                                name="transportasi" id="transportasi" value="{{ old('transportasi') }}" autofocus
                                required>
                            @error('transportasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_transportasi" class="form-label">Total Transportasi</label>
                            <input type="number" class="form-control @error('total_transportasi') is-invalid @enderror"
                                name="total_transportasi" id="total_transportasi"
                                value="{{ old('total_transportasi') }}" autofocus required>
                            @error('total_transportasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="representasi" class="form-label">Representasi</label>
                            <input type="number" class="form-control @error('representasi') is-invalid @enderror"
                                name="representasi" id="representasi" value="{{ old('representasi') }}" autofocus
                                required>
                            @error('representasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_representasi" class="form-label">Total Representasi</label>
                            <input type="number"
                                class="form-control @error('total_representasi') is-invalid @enderror"
                                name="total_representasi" id="total_representasi"
                                value="{{ old('total_representasi') }}" autofocus required>
                            @error('total_representasi')
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
