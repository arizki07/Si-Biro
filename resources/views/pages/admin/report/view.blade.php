@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $judul }}</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ $judul }}</h4>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="live-preview">
                                <div class="accordion" id="default-accordion-example">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne" style="background-color: green; color: white;">
                                                <i class="ri-folder-user-fill"></i> Data Biodata
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                @foreach ($jamaah as $item)
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <!-- Foto KTP -->
                                                            <div class="card" style="max-width: 300px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Pas Foto</h5>
                                                                </div>
                                                                <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                                    class="card-img-top" alt="Pas Foto"
                                                                    style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                            <br>
                                                            <div class="card" style="max-width: 300px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Foto KTP</h5>
                                                                </div>
                                                                <img src="{{ asset('storage/biodata/foto-ktp/' . $item->foto_ktp) }}"
                                                                    class="card-img-top" alt="Foto KTP"
                                                                    style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                            <br>
                                                            <div class="card" style="max-width: 300px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Foto KK</h5>
                                                                </div>
                                                                <img src="{{ asset('storage/biodata/foto-kk/' . $item->foto_kk) }}"
                                                                    class="card-img-top" alt="Foto kk"
                                                                    style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                            <!-- Pas Foto -->
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card bg-success text-white">
                                                                <div class="card-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama Lengkap</label>
                                                                        <input type="text"
                                                                            class="form-control border border-dark bg-secondary-lt"
                                                                            name="nama_lengkap"
                                                                            value="{{ old('nama_lengkap', $item->nama_lengkap) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Umur</label>
                                                                        <input type="text"
                                                                            class="form-control border border-dark"
                                                                            name="umur" id="umur"
                                                                            placeholder="Masukkan Umur"
                                                                            value="{{ old('umur', $item->umur) }}" readonly>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Jenis
                                                                                    Kelamin</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark bg-secondary-lt"
                                                                                    name="jk"
                                                                                    value="{{ old('jk', $item->jk) }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Status</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="status"
                                                                                    placeholder="Masukkan Status"
                                                                                    value="{{ old('status', $item->status) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tempat
                                                                                    Lahir</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="tempat_lahir" id="tempat_lahir"
                                                                                    placeholder="Masukkan Tempat Lahir"
                                                                                    value="{{ old('tempat_lahir', $item->tempat_lahir) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tanggal
                                                                                    Lahir</label>
                                                                                <input name="tgl_lahir" type="date"
                                                                                    class="form-control border border-dark"
                                                                                    value="{{ old('tgl_lahir', $item->tgl_lahir) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nomor HP</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="no_hp" id="no_hp"
                                                                                    placeholder="Masukkan Nomor HP"
                                                                                    value="{{ old('no_hp', $item->no_hp) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nomor HP
                                                                                    Wali</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="no_hp_wali" id="no_hp_wali"
                                                                                    placeholder="Masukkan Nomor HP Wali"
                                                                                    value="{{ old('no_hp_wali', $item->no_hp_wali) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nomor
                                                                                    Rekening</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="no_rekening" id="no_rekening"
                                                                                    placeholder="Masukkan Nomor Rekening"
                                                                                    value="{{ old('no_rekening', $item->no_rekening) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nomor KTP</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="no_ktp" id="no_ktp"
                                                                                    placeholder="Masukkan Nomor KTP"
                                                                                    value="{{ old('no_ktp', $item->no_ktp) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nomor KK</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="no_kk" id="no_kk"
                                                                                    placeholder="Masukkan Nomor KK"
                                                                                    value="{{ old('no_kk', $item->no_kk) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Bank</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="bank" id="bank"
                                                                                    placeholder="Masukkan Nomor KK"
                                                                                    value="{{ old('bank', $item->bank) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Berat
                                                                                    Badan</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="berat_badan" id="berat_badan"
                                                                                    placeholder="Masukkan Berat Badan"
                                                                                    value="{{ old('berat_badan', $item->berat_badan) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tinggi
                                                                                    Badan</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="tinggi_badan" id="tinggi_badan"
                                                                                    placeholder="Masukkan Tinggi Badan"
                                                                                    value="{{ old('tinggi_badan', $item->tinggi_badan) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Warna
                                                                                    Kulit</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="warna_kulit" id="warna_kulit"
                                                                                    placeholder="Masukkan Warna Kulit"
                                                                                    value="{{ old('warna_kulit', $item->warna_kulit) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Pekerjaan</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="pekerjaan" id="pekerjaan"
                                                                                    placeholder="Masukkan Pekerjaan"
                                                                                    value="{{ old('pekerjaan', $item->pekerjaan) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    class="form-label">Pendidikan</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="pendidikan" id="pendidikan"
                                                                                    placeholder="Masukkan Pendidikan"
                                                                                    value="{{ old('pendidikan', $item->pendidikan) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Pernah
                                                                                    Haji/Umroh</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="pernah_haji_umroh"
                                                                                    id="pernah_haji_umroh"
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
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="kecamatan" id="kecamatan"
                                                                                    placeholder="Masukkan Kecamatan"
                                                                                    value="{{ old('kecamatan', $item->kecamatan) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Kelurahan</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="kelurahan" id="kelurahan"
                                                                                    placeholder="Masukkan Kelurahan"
                                                                                    value="{{ old('kelurahan', $item->kelurahan) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    class="form-label">Kota/Kabupaten</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="kota_kabupaten"
                                                                                    id="kota_kabupaten"
                                                                                    placeholder="Masukkan Kota/Kabupaten"
                                                                                    value="{{ old('kota_kabupaten', $item->kota_kabupaten) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Provinsi</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="provinsi" id="provinsi"
                                                                                    placeholder="Masukkan Provinsi"
                                                                                    value="{{ old('provinsi', $item->provinsi) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Warga
                                                                                    Negara</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="warga_negara" id="warga_negara"
                                                                                    placeholder="Masukkan Warga Negara"
                                                                                    value="{{ old('warga_negara', $item->warga_negara) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Kode Pos</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="kode_pos" id="kode_pos"
                                                                                    placeholder="Masukkan Kode Pos"
                                                                                    value="{{ old('kode_pos', $item->kode_pos) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Golongan
                                                                                    Darah</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="gol_darah" id="gol_darah"
                                                                                    placeholder="Masukkan Golongan Darah"
                                                                                    value="{{ old('gol_darah', $item->gol_darah) }}"
                                                                                    readonly>
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
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo"
                                                style="background-color: rgb(0, 9, 128); color: white;">
                                                <i class="ri-money-dollar-box-fill"></i> Data keuangan
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    @foreach ($keuangan as $item)
                                                        <div class="col-md-8">
                                                            <div class="card bg-secondary text-white">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nama</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark bg-secondary-lt"
                                                                                    name="jk"
                                                                                    value="{{ old('nama_lengkap', $item->jamaah->nama_lengkap) }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Jumlah
                                                                                    Pembayaran</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="status"
                                                                                    placeholder="Masukkan Status"
                                                                                    value="{{ old('jumlah_pembayaran', $item->transaksi->jumlah_pembayaran) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    class="form-label">Pembayaran</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="tempat_lahir" id="tempat_lahir"
                                                                                    placeholder="Masukkan Tempat Lahir"
                                                                                    value="{{ old('pembayaran', $item->pembayaran) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tipe
                                                                                    Keuangan</label>
                                                                                <input name="tgl_lahir" type="text"
                                                                                    class="form-control border border-dark"
                                                                                    value="{{ old('tipe_keuangan', $item->tipe_keuangan) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree"
                                                style="background-color: rgb(128, 0, 0); color: white;">
                                                <i class="ri-bank-card-fill"></i> Data Transaksi
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                @foreach ($transaksi as $item)
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <!-- Foto KTP -->
                                                            <div class="card" style="max-width: 300px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Foto Pembayaran</h5>
                                                                </div>
                                                                <img src="{{ asset('storage/transaksi/foto-bukti/' . $item->foto_bukti_pembayaran) }}"
                                                                    class="card-img-top" alt="Pas Foto"
                                                                    style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card bg-danger text-white">
                                                                <div class="card-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama Lengkap</label>
                                                                        <input type="text"
                                                                            class="form-control border border-dark bg-secondary-lt"
                                                                            name="nama_lengkap"
                                                                            value="{{ old('nama_lengkap', $item->jamaah->nama_lengkap) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">layanan</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark bg-secondary-lt"
                                                                                    name="jk"
                                                                                    value="{{ old('id_layanan', $item->id_layanan) }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tipe
                                                                                    Pembayaran</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="status"
                                                                                    placeholder="Masukkan Status"
                                                                                    value="{{ old('tipe_pembayaran', $item->tipe_pembayaran) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Jumlah
                                                                                    Pembayaran</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="tempat_lahir" id="tempat_lahir"
                                                                                    placeholder="Masukkan Tempat Lahir"
                                                                                    value="{{ old('jumlah_pembayaran', $item->jumlah_pembayaran) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Status
                                                                                    Pembayaran</label>
                                                                                <input name="tgl_lahir" type="date"
                                                                                    class="form-control border border-dark"
                                                                                    value="{{ old('status_pembayaran', $item->status_pembayaran) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tanggal
                                                                                    Pembayaran</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-dark"
                                                                                    name="no_hp" id="no_hp"
                                                                                    placeholder="Masukkan Nomor HP"
                                                                                    value="{{ old('tanggal_pembayaran', $item->tanggal_pembayaran) }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
@endsection
