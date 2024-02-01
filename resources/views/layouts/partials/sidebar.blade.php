<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand">
        <a class="navbar-brand fs-5 fw-bold" href="/">
            SPPD
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        {{-- @role('admin') --}}
            <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class="menu-link">
                    <i class="fa-duotone fa-grid-2 me-3"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
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
        {{-- @else
            <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class="menu-link">
                    <i class="fa-duotone fa-grid-2 me-3"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>

            <li class="menu-item {{ Request::is('dashboard/sppd*') ? 'active' : '' }}">
                <a href="/dashboard/sppd" class="menu-link">
                    <i class="fa-duotone fa-note-sticky fa-sm me-3"></i>
                    <div data-i18n="Analytics">SPPD</div>
                </a>
            </li>
        @endrole --}}
    </ul>
</aside>
