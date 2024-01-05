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
                    <div class="d-flex justify-content-center align-items-center flex-column mb-5">
                        <h2>Welcome to</h2>
                        <h4 class="mb-2 fw-bold text-primary">SIJADIN</h4>
                        <p>Sistem Informasi Data Perjalanan Dinas</p>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-success d-block">Login</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
