<x-app-layout :$title>
    <div class="row">
        <div class="col-12">
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
        <div class="col col-md-12">
            <a class="btn btn-outline-secondary" href="{{ route('pegawai.index') }}">
                <i class="fa-regular fa-chevron-left me-2"></i>
                Kembali
            </a>

            <div class="card mt-3">
                <div class="card-body">
                    {{-- Form Berita --}}
                    <form action="{{ route('pegawai.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="nama" id="name" value="{{ old('nama') }}" autofocus required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_asn_id" class="form-label">Jenis Asn</label>
                                    <select class="form-select @error('jenis_asn_id') is-invalid @enderror"
                                        id="jenis_asn_id" name="jenis_asn_id">
                                        @foreach ($asns as $asn)
                                            <option value="{{ $asn->id }}">
                                                {{ $asn->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_asn_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gelar_depan" class="form-label">Gelar Depan</label>
                                    <input type="text"
                                        class="form-control @error('gelar_depan') is-invalid @enderror"
                                        name="gelar_depan" id="gelar_depan" value="{{ old('gelar_depan') }}" autofocus
                                        required>
                                    @error('gelar_depan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                                    <input type="text"
                                        class="form-control @error('gelar_belakang') is-invalid @enderror"
                                        name="gelar_belakang" id="gelar_belakang" value="{{ old('gelar_belakang') }}"
                                        autofocus required>
                                    @error('gelar_belakang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                        autofocus required>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                        autofocus required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nip_lama" class="form-label">Nip Lama</label>
                                    <input type="text" class="form-control @error('nip_lama') is-invalid @enderror"
                                        name="nip_lama" id="nip_lama" value="{{ old('nip_lama') }}" autofocus
                                        required>
                                    @error('nip_lama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nip_baru" class="form-label">Nip Baru</label>
                                    <input type="text" class="form-control @error('nip_baru') is-invalid @enderror"
                                        name="nip_baru" id="nip_baru" value="{{ old('nip_baru') }}" autofocus
                                        required>
                                    @error('nip_baru')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="universitas" class="form-label">Universitas</label>
                                    <input type="text"
                                        class="form-control @error('universitas') is-invalid @enderror"
                                        name="universitas" id="universitas" value="{{ old('universitas') }}"
                                        autofocus required>
                                    @error('universitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                        name="jurusan" id="jurusan" value="{{ old('jurusan') }}" autofocus
                                        required>
                                    @error('jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tingkat_ijazah" class="form-label">Tingkat Ijazah</label>
                                    <input type="text"
                                        class="form-control @error('tingkat_ijazah') is-invalid @enderror"
                                        name="tingkat_ijazah" id="tingkat_ijazah"
                                        value="{{ old('tingkat_ijazah') }}" autofocus required>
                                    @error('tingkat_ijazah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                    <input type="number" min="1900" max="2099" step="1"
                                        value="2016"
                                        class="form-control @error('tahun_lulus') is-invalid @enderror"
                                        name="tahun_lulus" id="tahun_lulus" autofocus required>
                                    @error('tahun_lulus')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="golongan_id" class="form-label">Golongan</label>
                                    <select class="form-select @error('golongan_id') is-invalid @enderror"
                                        id="golongan_id" name="golongan_id">
                                        @foreach ($golongans as $golongan)
                                            <option value="{{ $golongan->id }}">
                                                {{ $golongan->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('golongan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="tmt_cpns" class="form-label">TMT CPNS</label>
                                    <input type="date"
                                        class="form-control @error('tmt_cpns') is-invalid @enderror" name="tmt_cpns"
                                        id="tmt_cpns" value="{{ old('tmt_cpns') }}" autofocus required>
                                    @error('tmt_cpns')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tmt_pangkat_terakhir" class="form-label">TMT Pangkat
                                        Terakhir</label>
                                    <input type="date"
                                        class="form-control @error('tmt_pangkat_terakhir') is-invalid @enderror"
                                        name="tmt_pangkat_terakhir" id="tmt_pangkat_terakhir"
                                        value="{{ old('tmt_pangkat_terakhir') }}" autofocus required>
                                    @error('tmt_pangkat_terakhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                        name="jabatan" id="jabatan" value="{{ old('jabatan') }}" autofocus
                                        required>
                                    @error('jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tmt_jabatan" class="form-label">TMT Jabatan</label>
                                    <input type="date"
                                        class="form-control @error('tmt_jabatan') is-invalid @enderror"
                                        name="tmt_jabatan" id="tmt_jabatan" value="{{ old('tmt_jabatan') }}"
                                        autofocus required>
                                    @error('tmt_jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="masa_kerja_tahun" class="form-label">Masa Kerja Tahun</label>
                                    <input type="number"
                                        class="form-control @error('masa_kerja_tahun') is-invalid @enderror"
                                        name="masa_kerja_tahun" id="masa_kerja_tahun"
                                        value="{{ old('masa_kerja_tahun') }}" autofocus required>
                                    @error('masa_kerja_tahun')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="masa_kerja_bulan" class="form-label">Masa Kerja Bulan</label>
                                    <input type="number"
                                        class="form-control @error('masa_kerja_bulan') is-invalid @enderror"
                                        name="masa_kerja_bulan" id="masa_kerja_bulan"
                                        value="{{ old('masa_kerja_bulan') }}" autofocus required>
                                    @error('masa_kerja_bulan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                    <input type="text"
                                        class="form-control @error('unit_kerja') is-invalid @enderror"
                                        name="unit_kerja" id="unit_kerja" value="{{ old('unit_kerja') }}" autofocus
                                        required>
                                    @error('unit_kerja')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="instansi_induk" class="form-label">Instansi Induk</label>
                                    <input type="text"
                                        class="form-control @error('instansi_induk') is-invalid @enderror"
                                        name="instansi_induk" id="instansi_induk"
                                        value="{{ old('instansi_induk') }}" autofocus required>
                                    @error('instansi_induk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" id="alamat" value="{{ old('alamat') }}" autofocus
                                        required>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="telp" class="form-label">No Telp</label>
                                    <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                        name="telp" id="telp" value="{{ old('telp') }}" autofocus
                                        required>
                                    @error('telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="rencana_naik_pangkat" class="form-label">Rencana Naik Pangkat</label>
                                    <input type="date"
                                        class="form-control @error('rencana_naik_pangkat') is-invalid @enderror"
                                        name="rencana_naik_pangkat" id="rencana_naik_pangkat"
                                        value="{{ old('rencana_naik_pangkat') }}" autofocus required>
                                    @error('rencana_naik_pangkat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="rencana_naik_gaji" class="form-label">Rencana Naik Gaji</label>
                                    <input type="date"
                                        class="form-control @error('rencana_naik_gaji') is-invalid @enderror"
                                        name="rencana_naik_gaji" id="rencana_naik_gaji"
                                        value="{{ old('rencana_naik_gaji') }}" autofocus required>
                                    @error('rencana_naik_gaji')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
                        </div>
                    </form>
                    {{-- End Form Berita --}}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/show-hide-password.js') }}"></script>
</x-app-layout>
