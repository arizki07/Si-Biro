<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'dashboard') ? 'active' : '' ?>" href="/dashboard">
                    <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                </a>

            </li> <!-- end Dashboard Menu -->


            <li class="menu-title"><i class="ri-more-fill"></i> <span>Data Users</span>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'users') ? 'active' : '' ?>" href="/data-users">
                    <i class="ri-account-circle-line"></i> <span>Data Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'verif') ? 'active' : '' ?>" href="#">
                    <i class="ri-rotate-lock-line"></i> <span>Verifikasi</span>
                </a>
            </li>

            <li class="menu-title"><i class="ri-more-fill"></i> <span>Data Master</span></li>

            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'role') ? 'active' : '' ?>" href="/data-role">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'biodata') ? 'active' : '' ?>" href="/data-biodata">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Biodata</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'transaksi') ? 'active' : '' ?>" href="/data-transaksi">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Transaksi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'jadwal') ? 'active' : '' ?>" href="/data-jadwal">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Jadwal</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'arsip') ? 'active' : '' ?>" href="#">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Arsip</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'keuangan') ? 'active' : '' ?>" href="#">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Keuangan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link <?= ($act == 'layanan') ? 'active' : '' ?>" href="#">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Layanan</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link menu-link" href="#">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Uraian Layanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="/data-jadwal">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Uraian Jadwal</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
