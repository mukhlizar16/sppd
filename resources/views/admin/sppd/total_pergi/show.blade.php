<x-app-layout :$title>
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

            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asal</th>
                                <th>Tujuan</th>
                                <th>Tanggal Penerbangan</th>
                                <th>Maskapai</th>
                                <th>Booking Reference</th>
                                <th>No Eticket</th>
                                <th>No Penerbangan</th>
                                <th>Total Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pergis as $pergi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pergi->asal }}</td>
                                    <td>{{ $pergi->tujuan }}</td>
                                    <td>{{ $pergi->tgl_penerbangan }}</td>
                                    <td>{{ $pergi->maskapai }}</td>
                                    <td>{{ $pergi->booking_reference }}</td>
                                    <td>{{ $pergi->no_eticket }}</td>
                                    <td>{{ $pergi->no_penerbangan }}</td>
                                    <td>{{ $pergi->total_harga }}</td>
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
                                    @slot('title', 'Edit Data Tiket Pergi')
                                    @slot('route', route('pergi.update', $pergi->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    @csrf
                                    <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
                                    <div class="mb-3">
                                        <label for="asal" class="form-label">Asal</label>
                                        <input type="text" class="form-control @error('asal') is-invalid @enderror"
                                            name="asal" id="asal" value="{{ old('asal', $pergi->asal) }}"
                                            autofocus required>
                                        @error('asal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tujuan" class="form-label">Tujuan</label>
                                        <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                            name="tujuan" id="tujuan" value="{{ old('tujuan', $pergi->tujuan) }}"
                                            autofocus required>
                                        @error('tujuan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tgl_penerbangan" class="form-label">Tanggal Penerbangan</label>
                                        <input type="date"
                                            class="form-control @error('tgl_penerbangan') is-invalid @enderror"
                                            name="tgl_penerbangan" id="tgl_penerbangan"
                                            value="{{ old('tgl_penerbangan', $pergi->tgl_penerbangan) }}" required>
                                        @error('tgl_penerbangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="maskapai" class="form-label">Maskapai</label>
                                        <input type="text"
                                            class="form-control @error('maskapai') is-invalid @enderror" name="maskapai"
                                            id="maskapai" value="{{ old('maskapai', $pergi->maskapai) }}" required>
                                        @error('maskapai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="booking_reference" class="form-label">Booking Reference</label>
                                        <input type="text"
                                            class="form-control @error('booking_reference') is-invalid @enderror"
                                            name="booking_reference" id="booking_reference"
                                            value="{{ old('booking_reference', $pergi->booking_reference) }}" required>
                                        @error('booking_reference')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_eticket" class="form-label">No Eticket</label>
                                        <input type="text"
                                            class="form-control @error('no_eticket') is-invalid @enderror"
                                            name="no_eticket" id="no_eticket"
                                            value="{{ old('no_eticket', $pergi->no_eticket) }}" required>
                                        @error('no_eticket')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_penerbangan" class="form-label">No Penerbangan</label>
                                        <input type="text"
                                            class="form-control @error('no_penerbangan') is-invalid @enderror"
                                            name="no_penerbangan" id="no_penerbangan"
                                            value="{{ old('no_penerbangan', $pergi->no_penerbangan) }}" required>
                                        @error('no_penerbangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_harga" class="form-label">Total Harga</label>
                                        <input type="number"
                                            class="form-control @error('total_harga') is-invalid @enderror"
                                            name="total_harga" id="total_harga"
                                            value="{{ old('total_harga', $pergi->total_harga) }}" required>
                                        @error('total_harga')
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
                                    @slot('title', 'Hapus Data Tiket Pergi')
                                    @slot('route', route('pergi.destroy', $pergi->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Tiket Pergi
                                        <b>{{ $pergi->asal }}</b>?
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

</x-app-layout>
