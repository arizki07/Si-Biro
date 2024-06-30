@extends('layout.main')
@section('content')
    @include('components.alerts')

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $judul }}</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center">
                                <!-- Button-tabs -->
                                <ul class="nav">
                                    <a href="#tabs-profile-8"
                                        class="active nav-link btn btn-warning d-none d-sm-inline-block border border-warning"
                                        data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1"
                                        style="margin-right: 10px">
                                        <i class="fa-solid fa-list-ul"></i>
                                        View Profile
                                    </a>
                                    <a href="#tabs-home-8"
                                        class="nav-link btn btn-info d-none d-sm-inline-block border border-danger"
                                        data-bs-toggle="tab" aria-selected="false" role="tab">
                                        <i class="fa-solid fa-hand-holding-medical"></i>
                                        View Table
                                    </a>
                                </ul>
                                <!-- Button untuk tambah data biodata -->
                                <button type="button" class="btn btn-primary waves-effect waves-light ms-3"
                                    data-bs-toggle="modal" data-bs-target="#tambahBiodataModal">
                                    <i class="ri-file-pdf-fill me-1"></i> Tambah Biodata
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tabs-profile-8" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <!-- Content for View Profile tab -->
                                    @php
                                        $userJamaah = $jamaah->first();
                                    @endphp

                                    <div class="container-fluid">
                                        <div class="profile-foreground position-relative mx-n4 mt-n4">
                                            <div class="profile-wid-bg">
                                                <img src="assets/images/profile-bg.jpg" alt=""
                                                    class="profile-wid-img" />
                                            </div>
                                        </div>
                                        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                                            @if ($biodataStatus == 'kosong')
                                                <!-- Notification when biodata is not filled -->
                                                <div class="alert alert-danger" role="alert">
                                                    Anda harus mengisi biodata diri terlebih dahulu.
                                                </div>
                                            @else
                                                @foreach ($jamaah as $item)
                                                    <div class="row g-4">
                                                        <div class="col-auto">
                                                            <div class="avatar-lg">
                                                                <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                                    class="img-thumbnail rounded-circle" alt="Pas Foto">
                                                                {{-- <img src="assets/images/users/avatar-1.jpg" alt="user-img"
                                                                    class="img-thumbnail rounded-circle" /> --}}
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col">
                                                            <div class="p-2">
                                                                <h3 class="text-white mb-1">{{ $item->nama_lengkap }}</h3>
                                                                <p class="text-white-75">{{ $item->pekerjaan }}</p>
                                                                <div class="hstack text-white-50 gap-1">
                                                                    <div class="me-2">
                                                                        <i
                                                                            class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>
                                                                        {{ $item->kota_kabupaten }}, {{ $item->provinsi }}
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>
                                                                        {{ $item->pekerjaan }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end row-->
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <!-- Tab panes -->
                                                                <div class="tab-content pt-4 text-muted">
                                                                    <div class="tab-pane fade show active" id="overview-tab"
                                                                        role="tabpanel">
                                                                        <div class="row">
                                                                            <div class="col-xxl-12">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title mb-5 text-white">
                                                                                        Complete
                                                                                        Your Profile</h5>
                                                                                    <div
                                                                                        class="progress animated-progress custom-progress progress-label">
                                                                                        @if ($biodataStatus == 'approved')
                                                                                            <div class="progress-bar bg-success"
                                                                                                role="progressbar"
                                                                                                style="width: 100%"
                                                                                                aria-valuenow="100"
                                                                                                aria-valuemin="0"
                                                                                                aria-valuemax="100">
                                                                                                <div class="label">100%
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="progress-bar bg-info"
                                                                                                role="progressbar"
                                                                                                style="width: 0%"
                                                                                                aria-valuenow="0"
                                                                                                aria-valuemin="0"
                                                                                                aria-valuemax="0">
                                                                                                <div class="label">0%
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>

                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title mb-3">Info
                                                                                        </h5>
                                                                                        <div class="table-responsive">
                                                                                            <table
                                                                                                class="table table-borderless mb-0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th class="ps-0"
                                                                                                            scope="row">
                                                                                                            Full Name :</th>
                                                                                                        <td
                                                                                                            class="text-muted">
                                                                                                            {{ $item->nama_lengkap }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th class="ps-0"
                                                                                                            scope="row">
                                                                                                            Mobile :</th>
                                                                                                        <td
                                                                                                            class="text-muted">
                                                                                                            {{ $item->no_hp }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th class="ps-0"
                                                                                                            scope="row">
                                                                                                            Location :</th>
                                                                                                        <td
                                                                                                            class="text-muted">
                                                                                                            {{ $item->kota_kabupaten }},
                                                                                                            {{ $item->provinsi }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th class="ps-0"
                                                                                                            scope="row">
                                                                                                            Joining Date
                                                                                                        </th>
                                                                                                        <td
                                                                                                            class="text-muted">
                                                                                                            {{ $item->created_at }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div><!-- end card body -->
                                                                                </div><!-- end card -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tabs-home-8" role="tabpanel" aria-labelledby="table-tab">
                                    <!-- Content for View Table tab -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-marketplace d-flex">
                                                <div class="card-body">
                                                    <style>
                                                        #scroll-horizontal thead th {
                                                            border-bottom: 1px solid #ddd;
                                                            /* Garis bawah untuk header */
                                                        }

                                                        #scroll-horizontal tbody td {
                                                            border-right: 1px solid #ddd;
                                                            /* Garis kanan untuk sel dalam tabel */
                                                        }

                                                        #scroll-horizontal tbody tr:last-child td {
                                                            border-bottom: 1px solid #ddd;
                                                            /* Garis bawah untuk baris terakhir */
                                                        }
                                                    </style>
                                                    <table id="scroll-horizontal"
                                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                                        style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Opsi</th>
                                                                <th>Nama Lengkap</th>
                                                                <th>JK</th>
                                                                <th>No Hp</th>
                                                                <th>No Ktp</th>
                                                                <th>No KK</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php($i = 1)
                                                            @foreach ($jamaah as $item)
                                                                <tr class="text-center">
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#detailjamaah{{ $item->id_jamaah }}">
                                                                            <i class="ri-eye-fill"></i>
                                                                        </button>

                                                                    </td>
                                                                    <td>{{ $item['nama_lengkap'] }}</td>
                                                                    <td>{{ $item['jk'] }}</td>
                                                                    <td>{{ $item['no_hp'] }}</td>
                                                                    <td>{{ $item['no_ktp'] }}</td>
                                                                    <td>{{ $item['no_kk'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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
    </div>
    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambahBiodataModal" tabindex="-1" aria-labelledby="tambahBiodataModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBiodataModalLabel"><i class=" ri-user-add-fill"> Tambah Data
                            Jamaah</i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('jamaah.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </div>
                            </div>
                            <!-- Input ID User -->
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

                            <!-- Input Role -->
                            <input type="hidden" name="id_role" value="{{ Auth::user()->role_id }}">

                            <!-- Input ID Jamaah -->
                            <input type="hidden" name="id_jamaah"
                                value="{{ Auth::user()->jamaah ? Auth::user()->jamaah->id_jamaah : '' }}">

                            <div class="mb-3">
                                <label class="form-label">Layanan</label>
                                <select name="id_layanan" id="id_layanan" class="form-select border border-dark">
                                    <option selected disabled>-- Pilih Layanan --</option>
                                    @foreach ($layanans as $layanan)
                                        <option value="{{ $layanan->id_layanan }}"
                                            {{ $layanan->kuota <= 0 ? 'disabled' : '' }}>
                                            {{ $layanan->judul_layanan }}
                                            ({{ $layanan->kuota > 0 ? 'Kuota Tersedia' : 'Kuota Habis' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control border border-dark bg-secondary-lt"
                                    name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Umur</label>
                                <input type="text" class="form-control border border-dark" name="umur"
                                    id="umur" placeholder="Masukkan Umur" value="{{ old('umur') }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select name="jk" id="gender" class="form-select border-dark">
                                            <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                                            <option value="Pria" {{ old('jk') == 'Pria' ? 'selected' : '' }}>
                                                Pria
                                            </option>
                                            <option value="Wanita" {{ old('jk') == 'Wanita' ? 'selected' : '' }}>
                                                Wanita
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control border border-dark" name="status"
                                            placeholder="Masukkan Status" value="{{ old('status') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control border border-dark" name="tempat_lahir"
                                            id="tempat_lahir" placeholder="Masukkan Tempat Lahir"
                                            value="{{ old('tempat_lahir') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input name="tgl_lahir" type="date" class="form-control border border-dark"
                                            placeholder="YYYY-MM-DD" value="{{ old('tgl_lahir') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control border border-dark" name="no_hp"
                                            id="no_hp" placeholder="Masukkan Nomor HP" value="{{ old('no_hp') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor HP Wali</label>
                                        <input type="text" class="form-control border border-dark" name="no_hp_wali"
                                            id="no_hp_wali" placeholder="Masukkan Nomor HP Wali"
                                            value="{{ old('no_hp_wali') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Rekening</label>
                                        <input type="text" class="form-control border border-dark" name="no_rekening"
                                            id="no_rekening" placeholder="Masukkan Nomor Rekening"
                                            value="{{ old('no_rekening') }}">
                                    </div>
                                    <div class="text-danger">*Nomor Rekening harus terdiri dari 17 karakter.</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor KTP</label>
                                        <input type="text" class="form-control border border-dark" name="no_ktp"
                                            id="no_ktp" placeholder="Masukkan Nomor KTP" value="{{ old('no_ktp') }}">
                                    </div>
                                    <div class="text-danger">*Nomor KTP harus terdiri dari 16 karakter.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor KK</label>
                                        <input type="text" class="form-control border border-dark" name="no_kk"
                                            id="no_kk" placeholder="Masukkan Nomor KK" value="{{ old('no_kk') }}">
                                    </div>
                                    <div class="text-danger">*Nomor Rekening harus terdiri dari 17 karakter.</div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Grup</label>
                                        <select name="kode_grup" id="gender" class="form-select border-dark">
                                            <option selected disabled>-- Pilih Grup --</option>
                                            <option value="A" {{ old('kode_grup') == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ old('kode_grup') == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="C" {{ old('kode_grup') == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D" {{ old('kode_grup') == 'D' ? 'selected' : '' }}>D
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Bank</label>
                                        <select class="form-control border-dark" data-choices name="bank"
                                            id="choices-single-default">
                                            <option selected disabled>-- Pilih Bank --</option>
                                            @foreach ($json_bank as $bank)
                                                <option value="{{ $bank['code'] }}-{{ $bank['name'] }}"
                                                    {{ old('bank') == $bank['code'] . '-' . $bank['name'] ? 'selected' : '' }}>
                                                    {{ $bank['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Berat Badan</label>
                                        <input type="text" class="form-control border border-dark" name="berat_badan"
                                            id="berat_badan" placeholder="Masukkan Berat Badan"
                                            value="{{ old('berat_badan') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tinggi Badan</label>
                                        <input type="text" class="form-control border border-dark" name="tinggi_badan"
                                            id="tinggi_badan" placeholder="Masukkan Tinggi Badan"
                                            value="{{ old('tinggi_badan') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Warna Kulit</label>
                                        <select name="warna_kulit" id="gender" class="form-select border-dark">
                                            <option selected disabled>-- Pilih Warna Kulit --</option>
                                            <option value="Putih" {{ old('warna_kulit') == 'Putih' ? 'selected' : '' }}>
                                                Putih
                                            </option>
                                            <option value="Hitam" {{ old('warna_kulit') == 'Hitam' ? 'selected' : '' }}>
                                                Hitam
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control border border-dark" name="pekerjaan"
                                            id="pekerjaan" placeholder="Masukkan Pekerjaan"
                                            value="{{ old('pekerjaan') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pendidikan</label>
                                        <input type="text" class="form-control border border-dark" name="pendidikan"
                                            id="pendidikan" placeholder="Masukkan Pendidikan"
                                            value="{{ old('pendidikan') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pernah Haji/Umroh</label>
                                        <select name="pernah_haji_umroh" id="gender" class="form-select border-dark">
                                            <option selected disabled>-- Pilih Pernah Haji/Umroh --</option>
                                            <option value="Sudah"
                                                {{ old('pernah_haji_umroh') == 'Sudah' ? 'selected' : '' }}>Sudah
                                            </option>
                                            <option value="Belum"
                                                {{ old('pernah_haji_umroh') == 'Belum' ? 'selected' : '' }}>Belum
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kelurahan</label>
                                        <input type="text" class="form-control border border-dark" name="kelurahan"
                                            id="kelurahan" placeholder="Masukkan Kelurahan"
                                            value="{{ old('kelurahan') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kecamatan</label>
                                        <select class="form-control border-dark" data-choices name="kecamatan"
                                            id="choices-single-default">
                                            <option selected disabled>-- Pilih Kecamatan --</option>
                                            @foreach ($json_kecamatan as $kecamatan)
                                                <option value="{{ $kecamatan['kecamatan'] }}"
                                                    {{ old('kecamatan') == $kecamatan['kecamatan'] ? 'selected' : '' }}>
                                                    {{ $kecamatan['kecamatan'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kota/Kabupaten</label>
                                        <select class="form-control border-dark" data-choices name="kota_kabupaten"
                                            id="choices-single-default">
                                            <option selected disabled>-- Pilih Kota/Kabupaten --</option>
                                            @foreach ($json_kota as $kota)
                                                <option value="{{ $kota['kota'] }}"
                                                    {{ old('kota_kabupaten') == $kota['kota'] ? 'selected' : '' }}>
                                                    {{ $kota['kota'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Provinsi</label>
                                        <select class="form-control border-dark" data-choices name="provinsi"
                                            id="choices-single-default">
                                            <option selected disabled>-- Pilih Provinsi --</option>
                                            @foreach ($json_provinsi as $prov)
                                                <option value="{{ $prov['provinsi'] }}"
                                                    {{ old('provinsi') == $prov['provinsi'] ? 'selected' : '' }}>
                                                    {{ $prov['provinsi'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control border border-dark" name="kode_pos"
                                            id="kode_pos" placeholder="Masukkan Kode Pos"
                                            value="{{ old('kode_pos') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="3"
                                    class="form-control border border-dark" placeholder="Masukkan Alamat Lengkap">{{ old('alamat_lengkap') }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Warga Negara</label>
                                        <input type="text" class="form-control border border-dark" name="warga_negara"
                                            id="warga_negara" placeholder="Masukkan Warga Negara"
                                            value="{{ old('warga_negara') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Golongan Darah</label>
                                        <select name="gol_darah" id="gender" class="form-select border-dark">
                                            <option selected disabled>-- Pilih Golongan Darah --</option>
                                            <option value="A" {{ old('gol_darah') == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ old('gol_darah') == 'B' ? 'selected' : '' }}>
                                                B
                                            </option>
                                            <option value="AB" {{ old('gol_darah') == 'AB' ? 'selected' : '' }}>
                                                AB
                                            </option>
                                            <option value="O" {{ old('gol_darah') == 'O' ? 'selected' : '' }}>
                                                O
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto KTP</label>
                                        <input type="file" class="form-control border border-dark" name="foto_ktp"
                                            id="foto_ktp">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto KK</label>
                                        <input type="file" class="form-control border border-dark" name="foto_kk"
                                            id="foto_kk">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Passport</label>
                                        <input type="file" class="form-control border border-dark"
                                            name="foto_passport" id="foto_passport">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pas Foto</label>
                                        <input type="file" class="form-control border border-dark" name="pas_foto"
                                            id="pas_foto">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}

    {{-- modal detail --}}
    @foreach ($jamaah as $item)
        <div class="modal modal-blur fade" id="detailjamaah{{ $item->id_jamaah }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-user" style="margin-right: 5px"></i> Detail
                            Jamaah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Foto KTP -->
                                <div class="card" style="max-width: 300px;">
                                    <div class="card-body">
                                        <h5 class="card-title">Pas Foto</h5>
                                    </div>
                                    <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                        class="card-img-top" alt="Pas Foto" style="max-width: 200px; max-height: 200px;">
                                </div>
                                <br>
                                <div class="card" style="max-width: 300px;">
                                    <div class="card-body">
                                        <h5 class="card-title">Foto KTP</h5>
                                    </div>
                                    <img src="{{ asset('storage/biodata/foto-ktp/' . $item->foto_ktp) }}"
                                        class="card-img-top" alt="Foto KTP" style="max-width: 200px; max-height: 200px;">
                                </div>
                                <br>
                                <div class="card" style="max-width: 300px;">
                                    <div class="card-body">
                                        <h5 class="card-title">Foto KK</h5>
                                    </div>
                                    <img src="{{ asset('storage/biodata/foto-kk/' . $item->foto_kk) }}"
                                        class="card-img-top" alt="Foto kk" style="max-width: 200px; max-height: 200px;">
                                </div>
                                <!-- Pas Foto -->
                            </div>
                            <div class="col-md-8">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control border border-dark bg-secondary-lt"
                                                name="nama_lengkap"
                                                value="{{ old('nama_lengkap', $item->nama_lengkap) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Umur</label>
                                            <input type="text" class="form-control border border-dark" name="umur"
                                                id="umur" placeholder="Masukkan Umur"
                                                value="{{ old('umur', $item->umur) }}" readonly>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <input type="text"
                                                        class="form-control border border-dark bg-secondary-lt"
                                                        name="jk" value="{{ old('jk', $item->jk) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="status" placeholder="Masukkan Status"
                                                        value="{{ old('status', $item->status) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="tempat_lahir" id="tempat_lahir"
                                                        placeholder="Masukkan Tempat Lahir"
                                                        value="{{ old('tempat_lahir', $item->tempat_lahir) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input name="tgl_lahir" type="date"
                                                        class="form-control border border-dark"
                                                        value="{{ old('tgl_lahir', $item->tgl_lahir) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor HP</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="no_hp" id="no_hp" placeholder="Masukkan Nomor HP"
                                                        value="{{ old('no_hp', $item->no_hp) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor HP Wali</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="no_hp_wali" id="no_hp_wali"
                                                        placeholder="Masukkan Nomor HP Wali"
                                                        value="{{ old('no_hp_wali', $item->no_hp_wali) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Rekening</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="no_rekening" id="no_rekening"
                                                        placeholder="Masukkan Nomor Rekening"
                                                        value="{{ old('no_rekening', $item->no_rekening) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor KTP</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="no_ktp" id="no_ktp" placeholder="Masukkan Nomor KTP"
                                                        value="{{ old('no_ktp', $item->no_ktp) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor KK</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="no_kk" id="no_kk" placeholder="Masukkan Nomor KK"
                                                        value="{{ old('no_kk', $item->no_kk) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Bank</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="bank" id="bank" placeholder="Masukkan Nomor KK"
                                                        value="{{ old('bank', $item->bank) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Berat Badan</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="berat_badan" id="berat_badan"
                                                        placeholder="Masukkan Berat Badan"
                                                        value="{{ old('berat_badan', $item->berat_badan) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tinggi Badan</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="tinggi_badan" id="tinggi_badan"
                                                        placeholder="Masukkan Tinggi Badan"
                                                        value="{{ old('tinggi_badan', $item->tinggi_badan) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Warna Kulit</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="warna_kulit" id="warna_kulit"
                                                        placeholder="Masukkan Warna Kulit"
                                                        value="{{ old('warna_kulit', $item->warna_kulit) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Pekerjaan</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan"
                                                        value="{{ old('pekerjaan', $item->pekerjaan) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Pendidikan</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="pendidikan" id="pendidikan"
                                                        placeholder="Masukkan Pendidikan"
                                                        value="{{ old('pendidikan', $item->pendidikan) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Pernah Haji/Umroh</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="pernah_haji_umroh" id="pernah_haji_umroh"
                                                        placeholder="Masukkan Pernah Haji/Umroh"
                                                        value="{{ old('pernah_haji_umroh', $item->pernah_haji_umroh) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kecamatan</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="kecamatan" id="kecamatan" placeholder="Masukkan Kecamatan"
                                                        value="{{ old('kecamatan', $item->kecamatan) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kelurahan</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="kelurahan" id="kelurahan" placeholder="Masukkan Kelurahan"
                                                        value="{{ old('kelurahan', $item->kelurahan) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kota/Kabupaten</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="kota_kabupaten" id="kota_kabupaten"
                                                        placeholder="Masukkan Kota/Kabupaten"
                                                        value="{{ old('kota_kabupaten', $item->kota_kabupaten) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Provinsi</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="provinsi" id="provinsi" placeholder="Masukkan Provinsi"
                                                        value="{{ old('provinsi', $item->provinsi) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Warga Negara</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="warga_negara" id="warga_negara"
                                                        placeholder="Masukkan Warga Negara"
                                                        value="{{ old('warga_negara', $item->warga_negara) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kode Pos</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="kode_pos" id="kode_pos" placeholder="Masukkan Kode Pos"
                                                        value="{{ old('kode_pos', $item->kode_pos) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Golongan Darah</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="gol_darah" id="gol_darah"
                                                        placeholder="Masukkan Golongan Darah"
                                                        value="{{ old('gol_darah', $item->gol_darah) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Lengkap</label>
                                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="3"
                                                class="form-control border border-dark" placeholder="Masukkan Alamat Lengkap" value="" readonly>{{ old('alamat_lengkap', $item->alamat_lengkap) }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal Detail --}}
@endsection
