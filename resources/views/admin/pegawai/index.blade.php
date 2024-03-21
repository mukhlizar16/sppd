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
            <div class="mt-3 card">
                <div class="card-body">
                    <div class="mb-2 text-end">
                        <button class="btn btn-primary"><i class="fa fa-sync me-2"></i> Sinkron Database</button>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                               style="width:100%">
                            <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Nip</th>
                                <th>Jabatan</th>
                                <th>Golongan</th>
                                <th>Jabatan</th>
                                <th>Instansi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pegawais as $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pegawai->nama_lengkap }}</td>
                                    <td>{{ $pegawai->nip_baru }}</td>
                                    <td>{{ $pegawai->jabatan }}</td>
                                    <td>{{ $pegawai->Golongan->nama }}</td>
                                    <td>{{ $pegawai->jabatan }}</td>
                                    <td>{{ $pegawai->unit_kerja }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
