@php
    $userRole = Auth::user()->id_role;
@endphp
@include('layout.partials.modal-import')
@if ($userRole === 1)
    {{-- Admin --}}
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>

                </li>


                <li class="menu-title"><i class="ri-more-fill"></i> <span>Users Report</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'users' ? 'active' : '' ?>" href="/data-users">
                        <i class="ri-account-circle-line"></i> <span>Data Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'verifikasi' ? 'active' : '' ?>" href="/data-verifikasi">
                        <i class="ri-rotate-lock-line"></i> <span>Verifikasi</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Master Report</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'role' ? 'active' : '' ?>" href="/data-role">
                        <i class="ri-user-settings-line"></i><span>Data Role</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'biodata' ? 'active' : '' ?>" href="/data-biodata">
                        <i class="ri-git-repository-commits-fill"></i> <span>Data Biodata</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Financial Statements</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'layanan' ? 'active' : '' ?>" href="/data-layanan">
                        <i class="ri-cellphone-fill"></i><span>Data Layanan</span>
                    </a>
                </li>

                <li class="nav-item open">
                    <a class="nav-link menu-link {{ $act == 'jadwal-mcu' || $act == 'jadwal-passport' || $act == 'jadwal-manasik' || $act == 'jadwal-bimbingan' ? 'active' : '' }}"
                        href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="ri-database-fill"></i></i> <span>Data jadwal</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $act == 'jadwal-mcu' || $act == 'jadwal-manasik' || $act == 'jadwal-passport' || $act == 'jadwal-bimbingan' ? 'show' : '' }}"
                        id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/data-jadwal?action=mcu"
                                    class="nav-link {{ $act == 'jadwal-mcu' ? 'active' : '' }}"> MCU </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-jadwal?action=passport"
                                    class="nav-link {{ $act == 'jadwal-passport' ? 'active' : '' }}"> PASSPORT </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-jadwal?action=bimbingan"
                                    class="nav-link {{ $act == 'jadwal-bimbingan' ? 'active' : '' }}"> BIMBINGAN </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-jadwal?action=manasik"
                                    class="nav-link {{ $act == 'jadwal-manasik' ? 'active' : '' }}"> MANASIK HAJI </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#importExcel">
                                    UPLOAD JADWAL </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'transaksi' ? 'active' : '' ?>" href="/data-transaksi">
                        <i class="ri-pencil-ruler-2-line"></i> <span>Data Transaksi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'keuangan' ? 'active' : '' ?>" href="/data-keuangan">
                        <i class="ri-pencil-ruler-2-line"></i> <span>Data Keuangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'AdminArsip' ? 'active' : '' ?>"
                        href="{{ route('arsip.index') }}">
                        <i class="ri-pencil-ruler-2-line"></i> <span>Data Arsip</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Schedule Report </span></li>

                {{-- <li class="nav-item open">
                    <a class="nav-link menu-link {{ $act == 'report-mcu' || $act == 'report-passport' || $act == 'report-bimbingan' ? 'active' : '' }}"
                        href="#sidebarReport" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarReport">
                        <i class="ri-pencil-ruler-2-line"></i> <span>Report Hasil</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $act == 'report-mcu' || $act == 'report-passport' || $act == 'report-bimbingan' ? 'show' : '' }}"
                        id="sidebarReport">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/data-report?action=mcu"
                                    class="nav-link {{ $act == 'jadwal-mcu' ? 'active' : '' }}"> MCU </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-report?action=passport"
                                    class="nav-link {{ $act == 'jadwal-passport' ? 'active' : '' }}"> PASSPORT </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-report?action=bimbingan"
                                    class="nav-link {{ $act == 'jadwal-bimbingan' ? 'active' : '' }}"> BIMBINGAN </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-report?action=manasik"
                                    class="nav-link {{ $act == 'jadwal-manasik' ? 'active' : '' }}"> MANASIK HAJI </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'report' ? 'active' : '' ?>" href="/data-report">
                        <i class="ri-pencil-ruler-2-line"></i> <span>Report</span>
                    </a>
                </li>

                {{-- TESTING WHATSAPP HIDE --}}
                <li class="nav-item" style="display: none;">
                    <a class="nav-link menu-link <?= $act == 'wa' ? 'active' : '' ?>" href="/whatsapp">
                        <i class="ri-pencil-ruler-2-line"></i> <span>Testing Whatsapp</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
@elseif ($userRole === 2)
    {{-- Jamaah --}}
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                @if ($biodataStatus == 'kosong')
                    <!-- Tampilkan sidebar lengkap -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'dashboard' ? 'active' : '' }}" href="/dashboard">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'Jamaah' ? 'active' : '' }}" href="/data-jamaah">
                            <i class="ri-git-repository-commits-fill"></i> <span>Data Biodata</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'JamaahLayanan' ? 'active' : '' }}"
                            href="/layanan-jamaah">
                            <i class="ri-cellphone-fill"></i> <span>Data Layanan</span>
                        </a>
                    </li>
                @elseif ($biodataStatus == 'pending')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'dashboard' ? 'active' : '' }}" href="/dashboard">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'Jamaah' ? 'active' : '' }}" href="/data-jamaah">
                            <i class="ri-git-repository-commits-fill"></i> <span>Data Biodata</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'JamaahLayanan' ? 'active' : '' }}"
                            href="/layanan-jamaah">
                            <i class="ri-cellphone-fill"></i> <span>Data Layanan</span>
                        </a>
                    </li>
                @elseif ($biodataStatus == 'approved')
                    <!-- Tampilkan sidebar lengkap -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'dashboard' ? 'active' : '' }}" href="/dashboard">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'Jamaah' ? 'active' : '' }}" href="/data-jamaah">
                            <i class="ri-git-repository-commits-fill"></i> <span>Data Biodata</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'TransJamaah' ? 'active' : '' }}"
                            href="/jamaah-transaksi">
                            <i class="ri-wallet-2-line"></i> <span>Data Transaksi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'JamaahLayanan' ? 'active' : '' }}"
                            href="/layanan-jamaah">
                            <i class="ri-cellphone-fill"></i> <span>Data Layanan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $act == 'KeuanganJam' ? 'active' : '' }}"
                            href="/jamaah-keuangan">
                            <i class="ri-money-dollar-circle-line"></i> <span>Data Keuangan</span>
                        </a>
                    </li>
                    <li class="nav-item open">
                        <a class="nav-link menu-link {{ $act == 'jadwal-mcu' || $act == 'jadwal-passport' || $act == 'jadwal-manasik' || $act == 'jadwal-bimbingan' ? 'active' : '' }}"
                            href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarDashboards">
                            <i class="ri-database-fill"></i></i> <span>Data jadwal</span>
                        </a>
                        <div class="collapse menu-dropdown {{ $act == 'jadwal-mcu' || $act == 'jadwal-manasik' || $act == 'jadwal-passport' || $act == 'jadwal-bimbingan' ? 'show' : '' }}"
                            id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="/jamaah-jadwal?action=mcu"
                                        class="nav-link {{ $act == 'jadwal-mcu' ? 'active' : '' }}"> MCU </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jamaah-jadwal?action=passport"
                                        class="nav-link {{ $act == 'jadwal-passport' ? 'active' : '' }}"> PASSPORT
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jamaah-jadwal?action=bimbingan"
                                        class="nav-link {{ $act == 'jadwal-bimbingan' ? 'active' : '' }}"> BIMBINGAN
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jamaah-jadwal?action=manasik"
                                        class="nav-link {{ $act == 'jadwal-manasik' ? 'active' : '' }}"> MANASIK HAJI
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

            </ul>
        </div>
    </div>
@elseif ($userRole === 3)
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'FKeuangan' ? 'active' : '' ?>" href="/f-keuangan">
                        <i class="ri-money-dollar-circle-line"></i> <span>Data Keuangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'FTransaksi' ? 'active' : '' ?>" href="/f-transaksi">
                        <i class="ri-wallet-2-line"></i> <span>Data Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'RepostK' ? 'active' : '' ?>" href="/reportK">
                        <i class="ri-file-chart-line"></i> <span>Report</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@elseif ($userRole === 4)
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'OfficeVerif' ? 'active' : '' ?>" href="/Office-verif">
                        <i class="ri-user-follow-line"></i> <span>Data Verifikasi Jamaah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'Officetrans' ? 'active' : '' ?>"
                        href="/Office-transaksi">
                        <i class="ri-chat-follow-up-line"></i> <span>Data Verifikasi Transaksi</span>
                    </a>
                </li>

                <li class="nav-item open">
                    <a class="nav-link menu-link {{ $act == 'jadwal-mcu' || $act == 'jadwal-passport' || $act == 'jadwal-manasik' || $act == 'jadwal-bimbingan' ? 'active' : '' }}"
                        href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="ri-database-fill"></i></i> <span>Data jadwal</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $act == 'jadwal-mcu' || $act == 'jadwal-manasik' || $act == 'jadwal-passport' || $act == 'jadwal-bimbingan' ? 'show' : '' }}"
                        id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/data-jadwal-office?action=mcu"
                                    class="nav-link {{ $act == 'jadwal-mcu' ? 'active' : '' }}"> MCU </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-jadwal-office?action=passport"
                                    class="nav-link {{ $act == 'jadwal-passport' ? 'active' : '' }}"> PASSPORT </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-jadwal-office?action=bimbingan"
                                    class="nav-link {{ $act == 'jadwal-bimbingan' ? 'active' : '' }}"> BIMBINGAN </a>
                            </li>
                            <li class="nav-item">
                                <a href="/data-jadwal-office?action=manasik"
                                    class="nav-link {{ $act == 'jadwal-manasik' ? 'active' : '' }}"> MANASIK HAJI </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-bs-toggle="modal"
                                    data-bs-target="#importExcel">
                                    UPLOAD JADWAL </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'LayananO' ? 'active' : '' ?>" href="/office-layanan">
                        <i class="ri-cellphone-fill"></i> <span>Data Layanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'OfficeTr' ? 'active' : '' ?>" href="/front-transaksi">
                        <i class="ri-wallet-2-line"></i> <span>Data Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'OfficeRe' ? 'active' : '' ?>" href="/office-report">
                        <i class="ri-file-chart-line"></i> <span>Data Report</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
@elseif ($userRole === 5)
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>

                </li> <!-- end Dashboard Menu -->


                <li class="menu-title"><i class="ri-more-fill"></i> <span>Users Report</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBUser' ? 'active' : '' ?>" href="/kb-user">
                        <i class="ri-account-circle-line"></i> <span>Data Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBverif' ? 'active' : '' ?>" href="/kb-verif">
                        <i class="ri-rotate-lock-line"></i> <span>Verifikasi</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Master Report</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBRole' ? 'active' : '' ?>" href="/kb-role">
                        <i class="ri-user-settings-line"></i> <span>Data Role</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBBio' ? 'active' : '' ?>" href="/kb-biodata">
                        <i class="ri-git-repository-commits-fill"></i> <span>Data Biodata</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Financial Statements</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBLayanan' ? 'active' : '' ?>" href="/kb-layanan">
                        <i class="ri-cellphone-fill"></i> <span>Data Layanan</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                <a class="nav-link menu-link " href="/data-jadwal">
                    <i class="ri-pencil-ruler-2-line"></i> <span>Data Jadwal</span>
                </a>
            </li> --}}

                <li class="nav-item open">
                    <a class="nav-link menu-link {{ $act == 'jadwal-mcu' || $act == 'jadwal-passport' || $act == 'jadwal-manasik' || $act == 'jadwal-bimbingan' ? 'active' : '' }}"
                        href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="ri-database-fill"></i></i> <span>Data jadwal</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $act == 'jadwal-mcu' || $act == 'jadwal-manasik' || $act == 'jadwal-passport' || $act == 'jadwal-bimbingan' ? 'show' : '' }}"
                        id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/kb-jadwal?action=mcu"
                                    class="nav-link {{ $act == 'jadwal-mcu' ? 'active' : '' }}"> MCU </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kb-jadwal?action=passport"
                                    class="nav-link {{ $act == 'jadwal-passport' ? 'active' : '' }}"> PASSPORT </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kb-jadwal?action=bimbingan"
                                    class="nav-link {{ $act == 'jadwal-bimbingan' ? 'active' : '' }}"> BIMBINGAN </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kb-jadwal?action=manasik"
                                    class="nav-link {{ $act == 'jadwal-manasik' ? 'active' : '' }}"> MANASIK HAJI </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBTrans' ? 'active' : '' ?>" href="/kb-transaksi">
                        <i class="ri-wallet-2-line"></i> <span>Data Transaksi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBKeuangan' ? 'active' : '' ?>" href="/kb-keuangan">
                        <i class="ri-money-dollar-circle-line"></i> <span>Data Keuangan</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Schedule Report </span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'Kbarsip' ? 'active' : '' ?>" href="/kb-arsip">
                        <i class="ri-file-paper-2-line"></i> <span>Data Arsip</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= $act == 'KBReport' ? 'active' : '' ?>" href="/kb-report">
                        <i class="ri-file-chart-line"></i> <span>Data Report</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
@endif
