<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Manajemen Keuangan</div>
    </a>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <hr class="sidebar-divider">

    <!-- Heading -->

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('anggaran.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Anggaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Kategori</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pemasukan.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pemasukan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengeluaran.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pengeluaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tabungan.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tabungan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
