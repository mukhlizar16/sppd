<x-guest-layout>
    <div class="row">
        <div class="card smooth-shadow-md">
            <!-- Card body -->
            <div class="card-body p-6">
                <div class="mb-4">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="{{ asset('images/logo/logo.png') }}" class="img-fluid mb-6" alt="logo"
                             style="width: 100px">
                    </a>
                    <div class="mb-5">
                        <h3>Selamat Datang di Layanan SPPD</h3>
                        <h4 class="mb-2">Dinas PUPR Aceh Barat</h4>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
