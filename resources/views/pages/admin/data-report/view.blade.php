@extends('layout.main')

@section('css')
    <style>
        #scroll-horizontal thead th {
            border-bottom: 1px solid #ddd;
        }

        #scroll-horizontal tbody td {
            border-right: 1px solid #ddd;
        }

        #scroll-horizontal tbody tr:last-child td {
            border-bottom: 1px solid #ddd;
        }
    </style>
@endsection

@section('content')
    @include('components.alerts')
    <div class="page-content">
        <div class="container-fluid">
            <div class="profile-foreground position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg">
                    <img src="{{asset('assets/images/profile-bg.jpg')}}" alt="" class="profile-wid-img" />
                </div>
            </div>
            <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
                <div class="row g-4">
                    <div class="col-auto">
                        <div class="avatar-lg">
                            <img src="{{ asset('storage/biodata/pas-foto/' . $qr->pas_foto) }}" alt="user-img" class="img-thumbnail rounded-circle" />
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col">
                        <div class="p-2">
                            <h3 class="text-white mb-1">{{ $qr->nama_lengkap }}</h3>
                            <p class="text-white text-opacity-75">Jamaah : {{ $qr->judul_layanan }}</p>
                            <div class="hstack text-white-50 gap-1">
                                <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ ucwords(strtolower($qr->kota_kabupaten)) }}, {{ ucwords(strtolower($qr->provinsi)) }}</div>
                                <div>
                                    <i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $qr->warga_negara }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    {{-- <div class="col-12 col-lg-auto order-last order-lg-0">
                        <div class="row text text-white-50 text-center">
                            <div class="col-lg-6 col-4">
                                <div class="p-2">
                                    <h4 class="text-white mb-1">24.3K</h4>
                                    <p class="fs-14 mb-0">Followers</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-4">
                                <div class="p-2">
                                    <h4 class="text-white mb-1">1.3K</h4>
                                    <p class="fs-14 mb-0">Following</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--end col-->

                </div>
                <!--end row-->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="d-flex profile-wrapper">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#biodata" role="tab">
                                        <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Biodata</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#mcu" role="tab">
                                        <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Hasil MCU</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#bimbingan" role="tab">
                                        <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Hasil Bimbingan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#passport" role="tab">
                                        <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Hasil Passport</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#manasik" role="tab">
                                        <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Hasil Manasik</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content pt-4 text-muted">

                            {{-- BIODATA --}}
                            <div class="tab-pane active" id="biodata" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-3">

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Info</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Nama :</th>
                                                                <td class="text-muted">{{ $qr->nama_lengkap }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">No Hp :</th>
                                                                <td class="text-muted">{{ $qr->no_hp }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">No Hp Wali :</th>
                                                                <td class="text-muted">{{ $qr->no_hp_wali }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Tgl Lahir :</th>
                                                                <td class="text-muted">{{ \Carbon\Carbon::parse($qr->tgl_lahir)->format('d M Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Jenis Kelamin :</th>
                                                                <td class="text-muted">{{ $qr->jk }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Umur :</th>
                                                                <td class="text-muted">{{ $qr->umur }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Status :</th>
                                                                <td class="text-muted">{{ $qr->status }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Bank :</th>
                                                                <td class="text-muted">{{ $qr->bank }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Rekening :</th>
                                                                <td class="text-muted">{{ $qr->no_rekening }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">E-mail :</th>
                                                                <td class="text-muted">{{ $qr->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Alamat :</th>
                                                                <td class="text-muted">{{ ucwords(strtolower($qr->kota_kabupaten)) }}, {{ ucwords(strtolower($qr->provinsi)) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Tgl Bergabung :</th>
                                                                <td class="text-muted">{{ \Carbon\Carbon::parse($qr->created_jamaah)->format('d M Y') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-4">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title mb-0">Report Verifikasi</h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown">
                                                            <a href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-2-fill fs-14"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center py-3">
                                                        <div class="avatar-xs flex-shrink-0 me-3">
                                                            <img src="{{ asset('storage/biodata/pas-foto/' . $qr->pas_foto) }}" alt="" class="img-fluid rounded-circle material-shadow" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <h5 class="fs-14 mb-1">Verifikasi Biodata</h5>
                                                                @if ($qr->verif_jamaah == 'pending')
                                                                <span class="badge bg-warning-subtle text-warning badge-border">Pending</span>
                                                                @elseif ($qr->verif_jamaah == 'approved')
                                                                <span class="badge bg-success-subtle text-success badge-border">Approved</span>
                                                                @else ()
                                                                <span class="badge bg-danger-subtle text-danger badge-border">Rejected</span>
                                                                @endif 
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            @if ($qr->verif_jamaah == 'pending')
                                                            <button type="button" class="btn btn-sm btn-outline-warning material-shadow-none"><i class="ri-time-line align-middle"></i></button>
                                                            @elseif ($qr->verif_jamaah == 'approved')
                                                            <button type="button" class="btn btn-sm btn-outline-success material-shadow-none"><i class="ri-check-line align-middle"></i></button>
                                                            @else ()
                                                            <button type="button" class="btn btn-sm btn-outline-danger material-shadow-none"><i class="ri-close-line align-middle"></i></button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-3">
                                                        <div class="avatar-xs flex-shrink-0 me-3">
                                                            <img src="{{ asset('storage/biodata/pas-foto/' . $qr->pas_foto) }}" alt="" class="img-fluid rounded-circle material-shadow" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <h5 class="fs-14 mb-1">Verifikasi Transaksi</h5>
                                                                @if ($qr->verif_transaksi == 'pending')
                                                                <span class="badge bg-warning-subtle text-warning badge-border">Pending</span>
                                                                @elseif ($qr->verif_transaksi == 'approved')
                                                                <span class="badge bg-success-subtle text-success badge-border">Approved</span>
                                                                @else ()
                                                                <span class="badge bg-danger-subtle text-danger badge-border">Rejected</span>
                                                                @endif 
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            @if ($qr->verif_transaksi == 'pending')
                                                            <button type="button" class="btn btn-sm btn-outline-warning material-shadow-none"><i class="ri-time-line align-middle"></i></button>
                                                            @elseif ($qr->verif_transaksi == 'approved')
                                                            <button type="button" class="btn btn-sm btn-outline-success material-shadow-none"><i class="ri-check-line align-middle"></i></button>
                                                            @else ()
                                                            <button type="button" class="btn btn-sm btn-outline-danger material-shadow-none"><i class="ri-close-line align-middle"></i></button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div>
                                        <!--end card-->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Informasi Tambahan</h5>
                                                <div class="row">
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-user-2-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Jenis Layanan :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->judul_layanan }} No LA-{{ $qr->nomor_layanan }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-question-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Pernah Haji/Umroh :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->pernah_haji_umroh }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-eye-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Golongan Darah :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->gol_darah }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-eye-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Nomor KTP :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->no_ktp }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-eye-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Nomor Kartu Keluarga :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->no_kk }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-eye-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Nomor Jamaah :</p>
                                                                <h6 class="text-truncate mb-0">JA-{{ $qr->nomor_jamaah }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-eye-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Berat Badan :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->berat_badan }} kg</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-eye-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Tinggi Badan :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->tinggi_badan }} cm</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-eye-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Warna Kulit :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->warna_kulit }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-global-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Pendaftaran By :</p>
                                                                <h6 class="text-truncate mb-0">KBIH Wadi Fatimah</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-6">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-global-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Alamat Lengkap :</p>
                                                                <h6 class="text-truncate mb-0">{{ $qr->alamat_lengkap }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!--end card-body-->
                                        </div><!-- end card -->

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0  me-2">Notifikasi</h4>
                                                        <div class="flex-shrink-0 ms-auto">
                                                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#today" role="tab">
                                                                        FYI
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="tab-content text-muted">
                                                            <div class="tab-pane active" id="today" role="tabpanel">
                                                                <div class="profile-timeline">
                                                                    <div class="accordion accordion-flush" id="todayExample">
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header" id="headingOne">
                                                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                                            <div class="avatar-title bg-light text-success rounded-circle material-shadow">
                                                                                                A
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="flex-grow-1 ms-3">
                                                                                            <h6 class="fs-14 mb-1">
                                                                                                Admin KBIH Wadi Fatimah
                                                                                            </h6>
                                                                                            <small class="text-muted">Peringatan</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                                                <div class="accordion-body ms-2 ps-5">
                                                                                    "Kepada jamaah yang terhormat, kami ingin mengingatkan akan pentingnya kehadiran Anda di bimbingan haji yang akan segera dilaksanakan. Bimbingan ini tidak hanya menjadi kesempatan untuk memperdalam pengetahuan tentang rukun dan tata cara haji, tetapi juga sebagai waktu untuk mempersiapkan diri secara optimal menjelang perjalanan suci ini."
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header" id="headingTwo">
                                                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                                                                    <div class="d-flex">
                                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                                            <div class="avatar-title bg-light text-success rounded-circle material-shadow">
                                                                                                A
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="flex-grow-1 ms-3">
                                                                                            <h6 class="fs-14 mb-1">
                                                                                                Admin KBIH Wadi Fatimah
                                                                                            </h6>
                                                                                            <small class="text-muted">Aktvitas Pesan Whatsapp</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                                                <div class="accordion-body ms-2 ps-5">
                                                                                    <div class="row g-2">
                                                                                        @foreach ($wa as $w)
                                                                                        <div class="col-auto">
                                                                                            <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                                                                <div class="flex-shrink-0">
                                                                                                    <i class="ri-whatsapp-line fs-17 text-info"></i>
                                                                                                </div>
                                                                                                <div class="flex-grow-1 ms-2">
                                                                                                    <h6>
                                                                                                        <a href="javascript:void(0);" class="stretched-link">{{ $w->action }}</a>
                                                                                                    </h6>
                                                                                                    <small>{{ ucwords(strtolower($w->status)) }}fully send on {{ \Carbon\Carbon::parse($w->created_at)->format('d M Y') }}</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end accordion-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div><!-- end col -->
                                        </div><!-- end row -->

                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>

                            {{-- HASIL MCU --}}
                            <div class="tab-pane fade" id="mcu" role="tabpanel">
                                <div class="row" style="margin-top: 80px;">
                                    <div class="col-lg-12">
                                        <div>
                                            {{-- <h5>Center Timeline</h5> --}}
                                            @foreach ($mcu as $tahap => $keterangans)
                                                @foreach ($keterangans as $ket)
                                                    @php $index = 0; @endphp
                                                    @foreach ($ket as $field => $content)
                                                        <div class="timeline">
                                                            <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                                                                <i class="icon ri-stack-line"></i>
                                                                <div class="date">MCU Tahap {{ $tahap }}</div>
                                                                <div class="content">
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="{{ asset('storage/biodata/pas-foto/' . $qr->pas_foto) }}" alt="" class="avatar-sm rounded material-shadow-none">
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h5 class="fs-15">Pemeriksaan {{ ucwords(strtolower(str_replace('_', ' ', $field))) }}
                                                                                <small class="text-muted fs-13 fw-normal"></small></h5>
                                                                            <p class="text-muted mb-2">{{ $content }}</p>
                                                                            <div class="hstack gap-2">
                                                                                <a class="btn btn-sm btn-light"><span class="me-1">&#128293;</span> Tahap {{ $tahap }}</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php $index++; @endphp 
                                                    @endforeach
                                                @endforeach
                                            @endforeach


                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </div>
                                {{-- <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <h5 class="card-title flex-grow-1 mb-0">Report MCU</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless align-middle mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th scope="col">File Name</th>
                                                                <th scope="col">Type</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($mcu as $tahap => $keterangans)
                                                                <tr>
                                                                    <td colspan="2"><strong>Tahap: {{ $tahap }}</strong></td>
                                                                </tr>
                                                                @foreach ($keterangans as $ket)
                                                                    @foreach ($ket as $field => $content)
                                                                        <tr>
                                                                            <td><label class="form-label" for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}:</label></td>
                                                                            <td><input type="text" class="form-control border border-dark bg-secondary-lt" id="{{ $field }}" name="{{ $field }}" value="{{ $content }}" readonly></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach
                                                            @endforeach
                                                        </tbody>
                                                        
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="tab-pane fade" id="bimbingan" role="tabpanel">
                                    <div class="row" style="margin-top: 80px;">
                                        <div class="col-lg-12">
                                            <div>
                                                {{-- <h5>Center Timeline</h5> --}}
                                                @foreach ($bimbingan as $tahap_bimbingan => $keterangan_bimbingan)
                                                    @foreach ($keterangan_bimbingan as $ket_bimbingan)
                                                        @php $index = 0; @endphp
                                                        @foreach ($ket_bimbingan as $field_bimbingan => $content_bimbingan)
                                                            <div class="timeline">
                                                                <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                                                                    <i class="icon ri-stack-line"></i>
                                                                    <div class="date">Bimbingan Tahap {{ $tahap_bimbingan }}</div>
                                                                    <div class="content">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0">
                                                                                <img src="{{ asset('storage/biodata/pas-foto/' . $qr->pas_foto) }}" alt="" class="avatar-sm rounded material-shadow-none">
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <h5 class="fs-15">Bimbingan {{ ucwords(strtolower(str_replace('_', ' ', $field_bimbingan))) }}
                                                                                    <small class="text-muted fs-13 fw-normal"></small></h5>
                                                                                <p class="text-muted mb-2">{{ $content_bimbingan }}</p>
                                                                                <div class="hstack gap-2">
                                                                                    <a class="btn btn-sm btn-light"><span class="me-1">&#128293;</span> Tahap {{ $tahap_bimbingan }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $index++; @endphp 
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
    
    
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="passport" role="tabpanel">
                                    <div class="row" style="margin-top: 80px;">
                                        <div class="col-lg-12">
                                            <div>
                                                {{-- <h5>Center Timeline</h5> --}}
                                                @foreach ($passport as $tahap_passport => $keterangan_passport)
                                                    @foreach ($keterangan_passport as $ket_passport)
                                                        @php $index = 0; @endphp
                                                        @foreach ($ket_passport as $field_passport => $content_passport)
                                                            <div class="timeline">
                                                                <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                                                                    <i class="icon ri-stack-line"></i>
                                                                    <div class="date">Passport Tahap {{ $tahap_passport }}</div>
                                                                    <div class="content">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0">
                                                                                <img src="{{ asset('storage/biodata/pas-foto/' . $qr->pas_foto) }}" alt="" class="avatar-sm rounded material-shadow-none">
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <h5 class="fs-15">Pemeriksaan {{ ucwords(strtolower(str_replace('_', ' ', $field_passport))) }}
                                                                                    <small class="text-muted fs-13 fw-normal"> Tahap {{ $tahap_passport }}</small></h5>
                                                                                <p class="text-muted mb-2">{{ $content_passport }}</p>
                                                                                <div class="hstack gap-2">
                                                                                    <a class="btn btn-sm btn-light"><span class="me-1">&#128293;</span> Tahap {{ $tahap_passport }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $index++; @endphp 
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
    
    
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="manasik" role="tabpanel">
                                    <div class="row" style="margin-top: 80px;">
                                        <div class="col-lg-12">
                                            <div>
                                                {{-- <h5>Center Timeline</h5> --}}
                                                @foreach ($manasik as $tahap_manasik => $keterangan_manasik)
                                                    @foreach ($keterangan_manasik as $ket_manasik)
                                                        @php $index = 0; @endphp
                                                        @foreach ($ket_manasik as $field_manasik => $content_manasik)
                                                            <div class="timeline">
                                                                <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                                                                    <i class="icon ri-stack-line"></i>
                                                                    <div class="date">Manasik Tahap {{ $tahap_manasik }}</div>
                                                                    <div class="content">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0">
                                                                                <img src="{{ asset('storage/biodata/pas-foto/' . $qr->pas_foto) }}" alt="" class="avatar-sm rounded material-shadow-none">
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <h5 class="fs-15">Pemeriksaan {{ ucwords(strtolower(str_replace('_', ' ', $field_manasik))) }}
                                                                                    <small class="text-muted fs-13 fw-normal"></small></h5>
                                                                                <p class="text-muted mb-2">{{ $content_manasik }}</p>
                                                                                <div class="hstack gap-2">
                                                                                    <a class="btn btn-sm btn-light"><span class="me-1">&#128293;</span> Tahap {{ $tahap_manasik }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $index++; @endphp 
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
    
    
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div>


                        </div>
                        <!--end tab-content-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container-fluid -->
    </div>
@endsection
