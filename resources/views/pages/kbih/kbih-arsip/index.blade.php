@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div style="float: right;">
                        <a href="{{ route('export.pdf.kbih') }}" type="button" id="btn-pdf" class="btn btn-danger ms-2">
                            <i class="ri-file-pdf-fill"></i> Export PDF All
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6">
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
                                                {{-- <a href="{{ route('export.id.jamaah', ['id_jamaah' => $jamaah->id_jamaah]) }}"
                                                    class="btn btn-primary">Download PDF</a> --}}


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

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
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
                            <div class="table-responsive">
                                <table id="alternative-pagination"
                                    class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                    style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Opsi</th>
                                            <th>Nama Jamaah</th>
                                            <th>Layanan</th>
                                            <th>Tipe Pembayaran</th>
                                            <th>Jumlah Pembayaran</th>
                                            <th>Status Pembayaran</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Verifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksi as $item)
                                            <tr class="text-center">
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailTransaksi{{ $item->id_transaksi }}">
                                                        <i class="ri-eye-fill"></i>
                                                    </button>
                                                </td>
                                                <td>{{ $item->jamaah->nama_lengkap }}</td>
                                                <td>{{ $item->layanan->judul_layanan }}</td>
                                                <td>{{ $item->tipe_pembayaran }}</td>
                                                <td>{{ $item->jumlah_pembayaran }}</td>
                                                <td>{{ $item->status_pembayaran }}</td>
                                                <td>{{ $item->tanggal_pembayaran }}</td>
                                                <td>
                                                    @if ($item->verifikasi == 'approved')
                                                        <span class="badge text-bg-success">Approved</span>
                                                    @elseif($item->verifikasi == 'rejected')
                                                        <span class="badge text-bg-danger">Rejected</span>
                                                    @else
                                                        <span class="badge text-bg-secondary">Pending</span>
                                                    @endif
                                                </td>
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

    {{-- detail transaksi --}}
    @foreach ($transaksi as $item)
        <div class="modal modal-blur fade" id="detailTransaksi{{ $item->id_transaksi }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-user" style="margin-right: 5px"></i> Detail
                            Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Foto KTP -->
                                <div class="card" style="max-width: 300px;">
                                    <div class="card-body">
                                        <h5 class="card-title">Foto Pembayaran</h5>
                                    </div>
                                    <img src="{{ asset('storage/transaksi/foto-bukti/' . $item->foto_bukti_pembayaran) }}"
                                        class="card-img-top" alt="Pas Foto" style="max-width: 200px; max-height: 200px;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control border border-dark bg-secondary-lt"
                                                name="nama_lengkap"
                                                value="{{ old('nama_lengkap', $item->jamaah->nama_lengkap) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Layanan</label>
                                            <input type="text" class="form-control border border-dark" name="umur"
                                                id="umur" placeholder="Masukkan Umur"
                                                value="{{ old('umur', $item->id_layanan) }}" readonly>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tipe Pembayaran</label>
                                                    <input type="text"
                                                        class="form-control border border-dark bg-secondary-lt"
                                                        name="jk"
                                                        value="{{ old('tipe_pembayaran', $item->tipe_pembayaran) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Jumlah Pembayaran</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="status" placeholder="Masukkan Status"
                                                        value="{{ old('jumlah_pembayaran', $item->jumlah_pembayaran) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status Pembayaran</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="tempat_lahir" id="tempat_lahir"
                                                        placeholder="Masukkan Tempat Lahir"
                                                        value="{{ old('status_pembayaran', $item->status_pembayaran) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pembayaran</label>
                                                    <input name="tgl_lahir" type="date"
                                                        class="form-control border border-dark"
                                                        value="{{ old('tanggal_pembayaran', $item->tanggal_pembayaran) }}"
                                                        readonly>
                                                </div>
                                            </div>
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
    {{-- end detail  --}}
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/pages/sweetalerts.init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
    <script>
        document.getElementById('btn-pdf').addEventListener('click', function(e) {
            e.preventDefault();

            swal.fire({
                icon: 'warning',
                html: `
            <center>
                <lottie-player src="https://lottie.host/6a9d2ba0-ea2e-4333-ba8b-46939e6900b0/dC8RooztT7.json"
                    background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay>
                </lottie-player>
            </center>
            <br>
            <h4 class="h4">Sedang proses Export data. Proses mungkin membutuhkan beberapa detik.</h4>
            <h4 class="h4">
                <b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b>
            </h4>
        `,
                showConfirmButton: false,
                showCancelButton: false,
                allowOutsideClick: false
            });

            setTimeout(function() {
                window.location.href = "{{ route('export.pdf.kbih') }}";

                Swal.fire({
                    icon: 'success',
                    title: 'PDF has been generated and downloaded successfully',
                    text: "{{ session()->get('success') }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            }, 15000);
        });
    </script>
    </script>
@endsection
