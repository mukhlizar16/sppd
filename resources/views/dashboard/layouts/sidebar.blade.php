<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand">
        <a class="navbar-brand fs-5 fw-bold" href="/">
            SPPD
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="fa-duotone fa-grid-2 me-3"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        {{-- Perangkat Gampong --}}
        {{-- <li class="menu-item {{ Request::is('dashboard/struktur*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-duotone fa-list-tree me-3"></i>
                <div data-i18n="Layouts">Struktur Pengurus</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('dashboard/struktur/perangkat-gampong*') ? 'active' : '' }}">
                    <a href="/dashboard/struktur/perangkat-gampong" class="menu-link">
                        <div data-i18n="Analytics">Perangkat Gampong</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('dashboard/struktur/jabatan*') ? 'active' : '' }}">
                    <a href="/dashboard/struktur/jabatan" class="menu-link">
                        <div data-i18n="data surat">Kelola Jabatan</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- User --}}

        <li class="menu-item {{ Request::is('dashboard/sppd*') ? 'active' : '' }}">
            <a href="/dashboard/sppd" class="menu-link">
                <i class="fa-duotone fa-note-sticky fa-sm me-3"></i>
                <div data-i18n="Analytics">SPPD</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/pegawai*') ? 'active' : '' }}">
            <a href="/dashboard/pegawai" class="menu-link">
                <i class="fa-duotone fa-user-tie fa-sm me-3"></i>
                <div data-i18n="Analytics">Pegawai</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/asn*') ? 'active' : '' }}">
            <a href="/dashboard/asn" class="menu-link">
                <i class="fa-duotone fa-school fa-sm me-3"></i>
                <div data-i18n="Analytics">Asn</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/golongan*') ? 'active' : '' }}">
            <a href="/dashboard/golongan" class="menu-link">
                <i class="fa-duotone fa-stairs fa-sm me-3"></i>
                <div data-i18n="Analytics">Golongan</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/jenis*') ? 'active' : '' }}">
            <a href="/dashboard/jenis" class="menu-link">
                <i class="fa-duotone fa-list fa-sm me-3"></i>
                <div data-i18n="Analytics">Jenis Tugas</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/user*') ? 'active' : '' }}">
            <a href="/dashboard/user" class="menu-link">
                <i class="fa-duotone fa-users fa-sm me-3"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>

    </ul>
</aside>