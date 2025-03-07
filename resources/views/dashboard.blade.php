@extends('layout.main')
@section('content')
    @php
        $userRole = Auth::user()->id_role;
    @endphp

    @if ($userRole === 1)
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1" id="greeting"></h4>
                                            <p class="text-muted mb-0">{{ $judul }}.</p>
                                        </div>
                                        <div class="mt-3 mt-lg-0" id="dateTimeSection">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control border-0 dash-filter-picker shadow"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-default-date="<?php echo date('d M Y', strtotime('first day of this month')) . ' to ' . date('d M Y'); ?>">
                                                            <div
                                                                class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function getGreeting() {
                                    const currentDate = new Date();
                                    const currentHour = currentDate.getHours();

                                    if (currentHour >= 5 && currentHour < 12) {
                                        return "Good morning, {{ Auth::user()->nama }}!";
                                    } else if (currentHour >= 12 && currentHour < 18) {
                                        return "Good afternoon, {{ Auth::user()->nama }}!";
                                    } else {
                                        return "Good evening, {{ Auth::user()->nama }}!";
                                    }
                                }

                                function updateGreeting() {
                                    document.getElementById('greeting').innerText = getGreeting();
                                }

                                function updateTime() {
                                    const currentDate = new Date();
                                    const formattedDate = currentDate.toLocaleString('en-US', {
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    });
                                    document.getElementById('currentTime').innerText = formattedDate;
                                }

                                updateGreeting();
                                updateTime();

                                setInterval(updateGreeting, 3600000);
                                setInterval(updateTime, 60000);
                            </script>

                            <div class="card card-sm">

                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/0cd165b0-a1f0-4cec-8165-18a468747d07/xEEwK5PWWA.json"
                                                width="300px" height="300px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h3">Selamat Datang di YAYASAN KBIH WADI FATIMAH,
                                                {{ Auth::user()->nama }} 🎉
                                            </h3>
                                            <div class="text-black">
                                                Yayasan KBIH WADI FATIMAH menyediakan aplikasi Biro Haji ini ditujukan untuk
                                                memudahkan dan menyediakan layanan
                                                terbaik bagi para jamaah yang ingin menjalani ibadah haji/umroh.
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Users</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $user }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Users</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-user-circle text-danger'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Role</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $role }}"></span>
                                                    </h4>
                                                    <a href="/data-role" class="text-decoration-underline">Data
                                                        Role</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class='bx bxs-user-pin text-success'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Biodata</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $jamaah }}"></span>
                                                    </h4>
                                                    <a href="/data-biodata" class="text-decoration-underline">Data
                                                        Biodata</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-user-account text-primary'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Transaksi</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $transaksi }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Transaksi</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-black"></i>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Jadwal</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $jadwal }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Jadwal</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-book text-black'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Keuangan</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $keuangan }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Keuangan</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-badge-dollar text-warning'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Layanan</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $layanan }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Layanan</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class='bx bxs-cart-add text-danger'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-6 col-lg-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Data Jamaah</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body p-0">
                                            <div data-simplebar style="height: 390px;">
                                                <div class="p-3">
                                                    @foreach ($jamaahs as $item)
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs flex-shrink-0">
                                                                <span class="avatar-title bg-light rounded-circle">
                                                                    <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                                        class="card-img-top" alt="Pas Foto"
                                                                        style="max-width: 200px; max-height: 200px;">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-1">{{ $item->nama_lengkap }}</h6>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i
                                                                        class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                                    {{ $item->no_ktp }}
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end">
                                                                <h6 class="mb-1 text-success">
                                                                    LA-{{ $item->id_layanan }}<span
                                                                        class="text-uppercase ms-1"></span></h6>
                                                                <p class="text-muted fs-13 mb-0">
                                                                    {{ $item->tgl_lahir }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- end -->
                                                    @endforeach


                                                    <!-- Additional content here -->
                                                    <div class="mt-3 text-center">
                                                        <a href="javascript:void(0);"
                                                            class="text-muted text-decoration-underline">Load More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xxl-6 col-lg-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Data Transaksi</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body p-0">
                                            <div data-simplebar style="height: 390px;">
                                                <div class="p-3">
                                                    @foreach ($transaksis as $item)
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs flex-shrink-0">
                                                                <span class="avatar-title bg-light rounded-circle">
                                                                    <img src="{{ asset('storage/transaksi/foto-bukti/' . $item->foto_bukti_pembayaran) }}"
                                                                        class="card-img-top" alt="Pas Foto"
                                                                        style="max-width: 90px; max-height: 90px;">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-1">
                                                                    @foreach ($jamaahs as $tr)
                                                                        @if ($tr['id_jamaah'] == $item['id_jamaah'])
                                                                            {{ $tr->nama_lengkap }}
                                                                        @endif
                                                                    @endforeach
                                                                </h6>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i
                                                                        class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                                    {{ $item->tanggal_pembayaran }}
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end">
                                                                <h6 class="mb-1 text-success">
                                                                    LA-{{ $item->id_layanan }}<span
                                                                        class="text-uppercase ms-1"></span></h6>
                                                                <p class="text-muted fs-13 mb-0">
                                                                    {{ $item->jumlah_pembayaran }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <!-- Additional content here -->
                                                    <div class="mt-3 text-center">
                                                        <a href="javascript:void(0);"
                                                            class="text-muted text-decoration-underline">Load More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($userRole === 2)
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1" id="greeting"></h4>
                                            <p class="text-muted mb-0">{{ $judul }}.</p>
                                        </div>
                                        <div class="mt-3 mt-lg-0" id="dateTimeSection">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control border-0 dash-filter-picker shadow"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-default-date="<?php echo date('d M Y', strtotime('first day of this month')) . ' to ' . date('d M Y'); ?>">
                                                            <div
                                                                class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function getGreeting() {
                                    const currentDate = new Date();
                                    const currentHour = currentDate.getHours();

                                    if (currentHour >= 5 && currentHour < 12) {
                                        return "Good morning, {{ Auth::user()->nama }}!";
                                    } else if (currentHour >= 12 && currentHour < 18) {
                                        return "Good afternoon, {{ Auth::user()->nama }}!";
                                    } else {
                                        return "Good evening, {{ Auth::user()->nama }}!";
                                    }
                                }

                                function updateGreeting() {
                                    document.getElementById('greeting').innerText = getGreeting();
                                }

                                function updateTime() {
                                    const currentDate = new Date();
                                    const formattedDate = currentDate.toLocaleString('en-US', {
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    });
                                    document.getElementById('currentTime').innerText = formattedDate;
                                }

                                updateGreeting();
                                updateTime();

                                setInterval(updateGreeting, 3600000);
                                setInterval(updateTime, 60000);
                            </script>
                            @if ($biodataStatus == 'kosong')
                                <div class="alert alert-danger"><i class="ri-error-warning-fill"></i> Silahkan isi biodata
                                    terlebih dahulu</div>
                            @elseif ($biodataStatus == 'pending')
                                <div class="alert alert-danger"><i class="ri-error-warning-fill"></i> Biodata sudah
                                    terisi, silahkan menunggu untuk verifikasi
                                    Administrator</div>
                            @endif

                            <div class="card card-sm">

                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/0cd165b0-a1f0-4cec-8165-18a468747d07/xEEwK5PWWA.json"
                                                width="300px" height="300px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h3">Selamat Datang di YAYASAN KBIH WADI FATIMAH,
                                                {{ Auth::user()->nama }} 🎉
                                            </h3>
                                            <div class="text-black">
                                                Yayasan KBIH WADI FATIMAH menyediakan aplikasi Biro Haji ini ditujukan untuk
                                                memudahkan dan menyediakan layanan
                                                terbaik bagi para jamaah yang ingin menjalani ibadah haji/umroh.
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($userRole === 3)
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1" id="greeting"></h4>
                                            <p class="text-muted mb-0">{{ $judul }}.</p>
                                        </div>
                                        <div class="mt-3 mt-lg-0" id="dateTimeSection">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control border-0 dash-filter-picker shadow"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-default-date="<?php echo date('d M Y', strtotime('first day of this month')) . ' to ' . date('d M Y'); ?>">
                                                            <div
                                                                class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function getGreeting() {
                                    const currentDate = new Date();
                                    const currentHour = currentDate.getHours();

                                    if (currentHour >= 5 && currentHour < 12) {
                                        return "Good morning, {{ Auth::user()->nama }}!";
                                    } else if (currentHour >= 12 && currentHour < 18) {
                                        return "Good afternoon, {{ Auth::user()->nama }}!";
                                    } else {
                                        return "Good evening, {{ Auth::user()->nama }}!";
                                    }
                                }

                                function updateGreeting() {
                                    document.getElementById('greeting').innerText = getGreeting();
                                }

                                function updateTime() {
                                    const currentDate = new Date();
                                    const formattedDate = currentDate.toLocaleString('en-US', {
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    });
                                    document.getElementById('currentTime').innerText = formattedDate;
                                }

                                updateGreeting();
                                updateTime();

                                setInterval(updateGreeting, 3600000);
                                setInterval(updateTime, 60000);
                            </script>

                            <div class="card card-sm">

                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/0cd165b0-a1f0-4cec-8165-18a468747d07/xEEwK5PWWA.json"
                                                width="300px" height="300px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h3">Selamat Datang di YAYASAN KBIH WADI FATIMAH,
                                                {{ Auth::user()->nama }} 🎉
                                            </h3>
                                            <div class="text-black">
                                                Yayasan KBIH WADI FATIMAH menyediakan aplikasi Biro Haji ini ditujukan untuk
                                                memudahkan dan menyediakan layanan
                                                terbaik bagi para jamaah yang ingin menjalani ibadah haji/umroh.
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Transaksi</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $transaksi }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Transaksi</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-black"></i>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Keuangan</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $keuangan }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Keuangan</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-badge-dollar text-warning'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($userRole === 4)
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1" id="greeting"></h4>
                                            <p class="text-muted mb-0">{{ $judul }}.</p>
                                        </div>
                                        <div class="mt-3 mt-lg-0" id="dateTimeSection">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control border-0 dash-filter-picker shadow"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-default-date="<?php echo date('d M Y', strtotime('first day of this month')) . ' to ' . date('d M Y'); ?>">
                                                            <div
                                                                class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function getGreeting() {
                                    const currentDate = new Date();
                                    const currentHour = currentDate.getHours();

                                    if (currentHour >= 5 && currentHour < 12) {
                                        return "Good morning, {{ Auth::user()->nama }}!";
                                    } else if (currentHour >= 12 && currentHour < 18) {
                                        return "Good afternoon, {{ Auth::user()->nama }}!";
                                    } else {
                                        return "Good evening, {{ Auth::user()->nama }}!";
                                    }
                                }

                                function updateGreeting() {
                                    document.getElementById('greeting').innerText = getGreeting();
                                }

                                function updateTime() {
                                    const currentDate = new Date();
                                    const formattedDate = currentDate.toLocaleString('en-US', {
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    });
                                    document.getElementById('currentTime').innerText = formattedDate;
                                }

                                updateGreeting();
                                updateTime();

                                setInterval(updateGreeting, 3600000);
                                setInterval(updateTime, 60000);
                            </script>

                            <div class="card card-sm">

                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/0cd165b0-a1f0-4cec-8165-18a468747d07/xEEwK5PWWA.json"
                                                width="300px" height="300px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h3">Selamat Datang di YAYASAN KBIH WADI FATIMAH,
                                                {{ Auth::user()->nama }} 🎉
                                            </h3>
                                            <div class="text-black">
                                                Yayasan KBIH WADI FATIMAH menyediakan aplikasi Biro Haji ini ditujukan untuk
                                                memudahkan dan menyediakan layanan
                                                terbaik bagi para jamaah yang ingin menjalani ibadah haji/umroh.
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-6 col-lg-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Data Jamaah</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body p-0">
                                            <div data-simplebar style="height: 390px;">
                                                <div class="p-3">
                                                    @foreach ($jamaahs as $item)
                                                        <h6 id="current-date"
                                                            class="text-muted text-uppercase mb-3 fs-11">19
                                                            May 2024</h6>

                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                var dateElement = document.getElementById('current-date');
                                                                var options = {
                                                                    year: 'numeric',
                                                                    month: 'short',
                                                                    day: 'numeric'
                                                                };
                                                                var today = new Date().toLocaleDateString('en-US', options);
                                                                dateElement.textContent = today;
                                                            });
                                                        </script>

                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs flex-shrink-0">
                                                                <span class="avatar-title bg-light rounded-circle">
                                                                    <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                                        class="card-img-top" alt="Pas Foto"
                                                                        style="max-width: 200px; max-height: 200px;">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-1">{{ $item->nama_lengkap }}</h6>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i
                                                                        class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                                    {{ $item->no_ktp }}
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end">
                                                                <h6 class="mb-1 text-success">
                                                                    LA-{{ $item->id_layanan }}<span
                                                                        class="text-uppercase ms-1"></span></h6>
                                                                <p class="text-muted fs-13 mb-0">
                                                                    @if ($item->verifikasi == 'approved')
                                                                        <span class="badge text-bg-success">Approved</span>
                                                                    @elseif($item->verifikasi == 'rejected')
                                                                        <span class="badge text-bg-danger">Rejected</span>
                                                                    @else
                                                                        <span
                                                                            class="badge text-bg-secondary"">Pending</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- end -->
                                                    @endforeach


                                                    <!-- Additional content here -->
                                                    <div class="mt-3 text-center">
                                                        <a href="javascript:void(0);"
                                                            class="text-muted text-decoration-underline">Load More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xxl-6 col-lg-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Data Transaksi</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body p-0">
                                            <div data-simplebar style="height: 390px;">
                                                <div class="p-3">
                                                    @foreach ($transaksis as $item)
                                                        <h6 id="current-date"
                                                            class="text-muted text-uppercase mb-3 fs-11">19
                                                            May 2024</h6>

                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                var dateElement = document.getElementById('current-date');
                                                                var options = {
                                                                    year: 'numeric',
                                                                    month: 'short',
                                                                    day: 'numeric'
                                                                };
                                                                var today = new Date().toLocaleDateString('en-US', options);
                                                                dateElement.textContent = today;
                                                            });
                                                        </script>

                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs flex-shrink-0">
                                                                <span class="avatar-title bg-light rounded-circle">
                                                                    <img src="{{ asset('storage/transaksi/foto-bukti/' . $item->foto_bukti_pembayaran) }}"
                                                                        class="card-img-top" alt="Pas Foto"
                                                                        style="max-width: 90px; max-height: 90px;">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-1">
                                                                    @foreach ($jamaahs as $tr)
                                                                        @if ($tr['id_jamaah'] == $item['id_jamaah'])
                                                                            {{ $tr->nama_lengkap }}
                                                                        @endif
                                                                    @endforeach
                                                                </h6>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i
                                                                        class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                                    {{ $item->tanggal_pembayaran }}
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end">
                                                                <h6 class="mb-1 text-success">
                                                                    LA-{{ $item->id_layanan }}<span
                                                                        class="text-uppercase ms-1"></span></h6>
                                                                <p class="text-muted fs-13 mb-0">
                                                                    {{ $item->jumlah_pembayaran }}-@if ($item->verifikasi == 'approved')
                                                                        <span class="badge text-bg-success">Approved</span>
                                                                    @elseif($item->verifikasi == 'rejected')
                                                                        <span class="badge text-bg-danger">Rejected</span>
                                                                    @else
                                                                        <span
                                                                            class="badge text-bg-secondary"">Pending</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <!-- Additional content here -->
                                                    <div class="mt-3 text-center">
                                                        <a href="javascript:void(0);"
                                                            class="text-muted text-decoration-underline">Load More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($userRole === 5)
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1" id="greeting"></h4>
                                            <p class="text-muted mb-0">{{ $judul }}.</p>
                                        </div>
                                        <div class="mt-3 mt-lg-0" id="dateTimeSection">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control border-0 dash-filter-picker shadow"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-default-date="<?php echo date('d M Y', strtotime('first day of this month')) . ' to ' . date('d M Y'); ?>">
                                                            <div
                                                                class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function getGreeting() {
                                    const currentDate = new Date();
                                    const currentHour = currentDate.getHours();

                                    if (currentHour >= 5 && currentHour < 12) {
                                        return "Good morning, {{ Auth::user()->nama }}!";
                                    } else if (currentHour >= 12 && currentHour < 18) {
                                        return "Good afternoon, {{ Auth::user()->nama }}!";
                                    } else {
                                        return "Good evening, {{ Auth::user()->nama }}!";
                                    }
                                }

                                function updateGreeting() {
                                    document.getElementById('greeting').innerText = getGreeting();
                                }

                                function updateTime() {
                                    const currentDate = new Date();
                                    const formattedDate = currentDate.toLocaleString('en-US', {
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    });
                                    document.getElementById('currentTime').innerText = formattedDate;
                                }

                                updateGreeting();
                                updateTime();

                                setInterval(updateGreeting, 3600000);
                                setInterval(updateTime, 60000);
                            </script>

                            <div class="card card-sm">

                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/0cd165b0-a1f0-4cec-8165-18a468747d07/xEEwK5PWWA.json"
                                                width="300px" height="300px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h3">Selamat Datang di YAYASAN KBIH WADI FATIMAH,
                                                {{ Auth::user()->nama }} 🎉
                                            </h3>
                                            <div class="text-black">
                                                Yayasan KBIH WADI FATIMAH menyediakan aplikasi Biro Haji ini ditujukan untuk
                                                memudahkan dan menyediakan layanan
                                                terbaik bagi para jamaah yang ingin menjalani ibadah haji/umroh.
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Users</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $user }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Users</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-user-circle text-danger'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Role</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $role }}"></span>
                                                    </h4>
                                                    <a href="/data-role" class="text-decoration-underline">Data
                                                        Role</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class='bx bxs-user-pin text-success'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Biodata</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $jamaah }}"></span>
                                                    </h4>
                                                    <a href="/data-biodata" class="text-decoration-underline">Data
                                                        Biodata</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-user-account text-primary'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Transaksi</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $transaksi }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Transaksi</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-black"></i>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Jadwal</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $jadwal }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Jadwal</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-book text-black'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Arsip</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="36894"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Arsip</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class='bx bxl-google-cloud text-black'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Keuangan</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $keuangan }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Keuangan</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                                        <i class='bx bxs-badge-dollar text-warning'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Data Layanan</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value"
                                                            data-target="{{ $layanan }}"></span>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Data
                                                        Layanan</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                                        <i class='bx bxs-cart-add text-danger'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-6 col-lg-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Data Jamaah</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body p-0">
                                            <div data-simplebar style="height: 390px;">
                                                <div class="p-3">
                                                    @foreach ($jamaahs as $item)
                                                        <h6 id="current-date"
                                                            class="text-muted text-uppercase mb-3 fs-11">19
                                                            May 2024</h6>

                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                var dateElement = document.getElementById('current-date');
                                                                var options = {
                                                                    year: 'numeric',
                                                                    month: 'short',
                                                                    day: 'numeric'
                                                                };
                                                                var today = new Date().toLocaleDateString('en-US', options);
                                                                dateElement.textContent = today;
                                                            });
                                                        </script>

                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs flex-shrink-0">
                                                                <span class="avatar-title bg-light rounded-circle">
                                                                    <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                                        class="card-img-top" alt="Pas Foto"
                                                                        style="max-width: 200px; max-height: 200px;">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-1">{{ $item->nama_lengkap }}</h6>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i
                                                                        class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                                    {{ $item->no_ktp }}
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end">
                                                                <h6 class="mb-1 text-success">
                                                                    LA-{{ $item->id_layanan }}<span
                                                                        class="text-uppercase ms-1"></span></h6>
                                                                <p class="text-muted fs-13 mb-0">
                                                                    {{ $item->alamat_lengkap }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- end -->
                                                    @endforeach


                                                    <!-- Additional content here -->
                                                    <div class="mt-3 text-center">
                                                        <a href="javascript:void(0);"
                                                            class="text-muted text-decoration-underline">Load More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xxl-6 col-lg-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Data Transaksi</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body p-0">
                                            <div data-simplebar style="height: 390px;">
                                                <div class="p-3">
                                                    @foreach ($transaksis as $item)
                                                        <h6 id="current-date"
                                                            class="text-muted text-uppercase mb-3 fs-11">19
                                                            May 2024</h6>

                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                var dateElement = document.getElementById('current-date');
                                                                var options = {
                                                                    year: 'numeric',
                                                                    month: 'short',
                                                                    day: 'numeric'
                                                                };
                                                                var today = new Date().toLocaleDateString('en-US', options);
                                                                dateElement.textContent = today;
                                                            });
                                                        </script>

                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs flex-shrink-0">
                                                                <span class="avatar-title bg-light rounded-circle">
                                                                    <img src="{{ asset('storage/transaksi/foto-bukti/' . $item->foto_bukti_pembayaran) }}"
                                                                        class="card-img-top" alt="Pas Foto"
                                                                        style="max-width: 90px; max-height: 90px;">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-1">
                                                                    @foreach ($jamaahs as $tr)
                                                                        @if ($tr['id_jamaah'] == $item['id_jamaah'])
                                                                            {{ $tr->nama_lengkap }}
                                                                        @endif
                                                                    @endforeach
                                                                </h6>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i
                                                                        class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                                    {{ $item->tanggal_pembayaran }}
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-end">
                                                                <h6 class="mb-1 text-success">
                                                                    LA-{{ $item->id_layanan }}<span
                                                                        class="text-uppercase ms-1"></span></h6>
                                                                <p class="text-muted fs-13 mb-0">
                                                                    {{ $item->jumlah_pembayaran }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <!-- Additional content here -->
                                                    <div class="mt-3 text-center">
                                                        <a href="javascript:void(0);"
                                                            class="text-muted text-decoration-underline">Load More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
