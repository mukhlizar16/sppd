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
            <a class="btn btn-primary" href="{{ route('pegawai.create') }}">
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
                                <th>Nip</th>
                                <th>Jenis Asn</th>
                                <th>Golongan</th>
                                <th>Telp</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawais as $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->nip_baru }}</td>
                                    <td>{{ $pegawai->Asn->name }}</td>
                                    <td>{{ $pegawai->Golongan->name }}</td>
                                    <td>{{ $pegawai->telp }}</td>
                                    <td>{{ $pegawai->jabatan }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('pegawai.show', $loop->iteration) }}">
                                            <i class="fa-regular fa-scroll"></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('pegawai.edit', $loop->iteration) }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus{{ $loop->iteration }}">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- Modal Hapus pegawai --}}
                                <x-form_modal>
                                    @slot('id', "modalHapus$loop->iteration")
                                    @slot('title', 'Hapus Data Pegawai')
                                    @slot('route', route('pegawai.destroy', $pegawai->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data pegawai
                                        <b>{{ $pegawai->nama }}</b>?
                                    </p>

                                </x-form_modal>
                                {{-- / Modal Hapus pegawai  --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
