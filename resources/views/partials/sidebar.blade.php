<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-calculator"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK SAW ARAS</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Master
    </div>

    <li class="nav-item {{ request()->routeIs('kriteria.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kriteria.index') }}">
            <i class="fas fa-fw fa-cube"></i>
            <span>Data Kriteria</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('alternatif.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('alternatif.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Alternatif</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Proses SPK
    </div>

    <li class="nav-item {{ request()->routeIs('penilaian.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('penilaian.index') }}">
            <i class="fas fa-fw fa-edit"></i>
            <span>Input Penilaian</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('perhitungan.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePerhitungan"
            aria-expanded="true" aria-controls="collapsePerhitungan">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Perhitungan</span>
        </a>
        <div id="collapsePerhitungan" class="collapse {{ request()->routeIs('perhitungan.*') ? 'show' : '' }}" aria-labelledby="headingPerhitungan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Detail Metode:</h6>
                <a class="collapse-item {{ request()->routeIs('perhitungan.saw') ? 'active' : '' }}" href="{{ route('perhitungan.saw') }}">Perhitungan SAW</a>
                <a class="collapse-item {{ request()->routeIs('perhitungan.aras') ? 'active' : '' }}" href="{{ route('perhitungan.aras') }}">Perhitungan ARAS</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('hasil.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('hasil.index') }}">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Hasil Akhir</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>