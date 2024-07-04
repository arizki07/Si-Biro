@extends('layout.main')
@section('content')
    @include('components.alerts')

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
                <div class="col-lg-12">
                    <div class="card bg-marketplace d-flex">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                            <button type="button" class="btn btn-primary" style="float: right" data-bs-toggle="modal"
                                data-bs-target="#exampleModalgrid">
                                <i class=" ri-user-add-fill"></i> Tambah Data Jamaah
                            </button>
                        </div>
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
                                        <th>No Jamaah</th>
                                        <th>Nama Lengkap</th>
                                        <th>JK</th>
                                        <th>No Hp</th>
                                        <th>No Ktp</th>
                                        {{-- <th>No KK</th> --}}
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
                                                <button type="button"
                                                    class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id_jamaah }}"><i
                                                        class=" ri-edit-2-fill"></i></button>
                                                <form id="deleteForm{{ $item->id_jamaah }}"
                                                    action="{{ route('delete.biodata', $item->id_jamaah) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" type="button"
                                                        class="btn btn-danger icon waves-effect waves-light btn-sm deletePengguna"
                                                        data-toggle="tooltip"
                                                        onclick="confirmDelete(event, {{ $item->id_jamaah }})"
                                                        data-original-title="Delete">
                                                        <i class="ri-delete-bin-2-fill"></i>
                                                    </a>
                                                </form>
                                            </td>
                                            <td>JA-{{ $item['id_jamaah'] }}</td>
                                            <td>{{ $item['nama_lengkap'] }}</td>
                                            <td>{{ $item['jk'] }}</td>
                                            <td>{{ $item['no_hp'] }}</td>
                                            <td>{{ $item['no_ktp'] }}</td>
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
    {{-- Modal Tambah --}}
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel"><i class=" ri-user-add-fill"> Tambah Data
                            Jamaah</i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('store.biodata') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ID User</label>
                                <input type="text" class="form-control border border-dark bg-secondary-lt" name="id_user"
                                    value="{{ Auth::user()->nama }}" readonly disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="id_role" id="id_role" class="form-select border border-dark">
                                    <option value="" selected disabled>-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id_role }}">
                                            {{ ucwords(strtolower($role->role)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Layanan</label>
                                <select name="id_layanan" id="id_layanan" class="form-select border border-dark">
                                    <option value="" hidden>-- Pilih Layanan --</option>
                                    @foreach ($layanans as $layanan)
                                        <option value="{{ $layanan->id_layanan }}">{{ $layanan->judul_layanan }}</option>
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
                                            <option value="Pria" {{ old('jk') == 'Pria' ? 'selected' : '' }}>Pria
                                            </option>
                                            <option value="Wanita" {{ old('jk') == 'Wanita' ? 'selected' : '' }}>Wanita
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select border-dark">
                                            <option selected disabled>-- Pilih Status --</option>
                                            <option>Belum Menikah</option>
                                            <option>Sudah Menikah</option>
                                            <option>Janda/Duda</option>
                                        </select>
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
                                </div>
                                <div class="text-danger">*Nomor KTP harus terdiri dari 17 karakter.</div>

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
                                        <input type="text" class="form-control border border-dark" name="warna_kulit"
                                            id="warna_kulit" placeholder="Masukkan Warna Kulit"
                                            value="{{ old('warna_kulit') }}">
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
                                        <select name="pendidikan" class="form-select border-dark">
                                            <option selected disabled>-- Pilih Pendidikan --</option>
                                            <option value="Tidak Ada" {{ ($item->pendidikan == 'Tidak Ada') ? 'selected' : '' }}>Tidak Ada</option>
                                            <option value="SD" {{ ($item->pendidikan == 'SD') ? 'selected' : '' }}>SD</option>
                                            <option value="SMP Sederajat" {{ ($item->pendidikan == 'SMP Sederajat') ? 'selected' : '' }}>SMP Sederajat</option>
                                            <option value="SMA Sederajat" {{ ($item->pendidikan == 'SMA Sederajat') ? 'selected' : '' }}>SMA Sederajat</option>
                                            <option value="Diploma" {{ ($item->pendidikan == 'Diploma') ? 'selected' : '' }}>Diploma</option>
                                            <option value="Sarjana S1" {{ ($item->pendidikan == 'Sarjana S1') ? 'selected' : '' }}>Sarjana S1</option>
                                            <option value="Magister S2" {{ ($item->pendidikan == 'Magister S2') ? 'selected' : '' }}>Magister S2</option>
                                            <option value="Doktor S3" {{ ($item->pendidikan == 'Doktor S3') ? 'selected' : '' }}>Doktor S3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pernah Haji/Umroh</label>
                                        <select name="pernah_haji_umroh" class="form-select border-dark">
                                            <option value="" hidden>-- Pilih Keterangan --</option>
                                            <option>Sudah</option>
                                            <option>Belum</option>
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
                                        <input type="text" class="form-control border border-dark" name="gol_darah"
                                            id="gol_darah" placeholder="Masukkan Golongan Darah"
                                            value="{{ old('gol_darah') }}">
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
                                                    <select name="status" class="form-select border-dark">
                                                        <option selected disabled>-- Pilih Status --</option>
                                                        <option value="Belum Menikah" {{ ($item->status == 'Belum Menikah') ? 'selected' : '' }}>Belum Menikah</option>
                                                        <option value="Sudah Menikah" {{ ($item->status == 'Sudah Menikah') ? 'selected' : '' }}>Sudah Menikah</option>
                                                        <option value="Janda/Duda" {{ ($item->status == 'Janda/Duda') ? 'selected' : '' }}>Janda/Juda</option>
                                                    </select>
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
                                                    <select name="pendidikan" class="form-select border-dark">
                                                        <option selected disabled>-- Pilih Pendidikan --</option>
                                                        <option value="Tidak Ada" {{ ($item->pendidikan == 'Tidak Ada') ? 'selected' : '' }}></option>
                                                        <option value="SD" {{ ($item->pendidikan == 'SD') ? 'selected' : '' }}></option>
                                                        <option value="SMP Sederajat" {{ ($item->pendidikan == 'SMP Sederajat') ? 'selected' : '' }}></option>
                                                        <option value="SMA Sederajat" {{ ($item->pendidikan == 'SMA Sederajat') ? 'selected' : '' }}></option>
                                                        <option value="Diploma" {{ ($item->pendidikan == 'Diploma') ? 'selected' : '' }}></option>
                                                        <option value="Sarjana S1" {{ ($item->pendidikan == 'Sarjana S1') ? 'selected' : '' }}></option>
                                                        <option value="Magister S2" {{ ($item->pendidikan == 'Magister S2') ? 'selected' : '' }}></option>
                                                        <option value="Doktor S3" {{ ($item->pendidikan == 'Doktor S3') ? 'selected' : '' }}></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Pernah Haji/Umroh</label>
                                                    <select name="pernah_haji_umroh" class="form-select border-dark">
                                                        <option value="Sudah" {{ ($item->status == 'Sudah') ? 'selected' : '' }}>Sudah</option>
                                                        <option value="Belum" {{ ($item->status == 'Belum') ? 'selected' : '' }}>Belum</option>
                                                    </select>
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
    {{-- end modal Detail --}}

    {{-- CRASH Kalau jadiin foreach 2 as variable beda beda, jadiin satu ajah --}}
    {{-- Modal edit --}}
        <div class="modal fade" id="editModal{{ $item->id_jamaah }}" tabindex="-1" aria-labelledby="editModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class=" ri-user-add-fill"> Tambah Data
                                Jamaah</i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('update.biodata', $item->id_jamaah) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ID User</label>
                                    <input type="text" class="form-control border border-dark bg-secondary-lt"
                                        name="id_user" value="{{ Auth::user()->nama }}" readonly disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select name="id_role" id="id_role" class="form-select border border-dark" disabled>
                                        <option value="" hidden>-- Pilih Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id_role }}" {{ ($item->id_role == $role->id_role) ? 'selected' : '' }} disabled>
                                                {{ ucwords(strtolower($role->role)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Layanan</label>
                                    <select name="id_layanan" id="id_layanan" class="form-select border border-dark">
                                        <option value="" hidden>-- Pilih Layanan --</option>
                                        @foreach ($layanans as $layanan)
                                            <option value="{{ $layanan->id_layanan }}"
                                                @if ($item->id_layanan == $layanan->id_layanan) selected @endif>
                                                {{ $layanan->judul_layanan }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control border border-dark bg-secondary-lt"
                                        name="nama_lengkap" value="{{ $item->nama_lengkap }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Umur</label>
                                    <input type="text" class="form-control border border-dark" name="umur"
                                        id="umur" placeholder="Masukkan Umur" value="{{ $item->umur }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select name="jk" id="gender" class="form-select border-dark">
                                                <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                                                <option value="Pria" {{ $item->jk == 'Pria' ? 'selected' : '' }}>Pria
                                                </option>
                                                <option value="Wanita" {{ $item->jk == 'Wanita' ? 'selected' : '' }}>
                                                    Wanita
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select border-dark">
                                                <option selected disabled>-- Pilih Status --</option>
                                                <option value="Belum Menikah" {{ ($item->status == 'Belum Menikah') ? 'selected' : '' }}>Belum Menikah</option>
                                                <option value="Sudah Menikah" {{ ($item->status == 'Sudah Menikah') ? 'selected' : '' }}>Sudah Menikah</option>
                                                <option value="Janda/Duda" {{ ($item->status == 'Janda/Duda') ? 'selected' : '' }}>Janda/Juda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir"
                                                value="{{ $item->tempat_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input name="tgl_lahir" type="date"
                                                class="form-control border border-dark" placeholder="YYYY-MM-DD"
                                                value="{{ $item->tgl_lahir }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor HP</label>
                                            <input type="text" class="form-control border border-dark" name="no_hp"
                                                id="no_hp" placeholder="Masukkan Nomor HP"
                                                value="{{ $item->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor HP Wali</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="no_hp_wali" id="no_hp_wali" placeholder="Masukkan Nomor HP Wali"
                                                value="{{ $item->no_hp_wali }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Rekening</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="no_rekening" id="no_rekening" placeholder="Masukkan Nomor Rekening"
                                                value="{{ $item->no_rekening }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor KTP</label>
                                            <input type="text" class="form-control border border-dark" name="no_ktp"
                                                id="no_ktp" placeholder="Masukkan Nomor KTP"
                                                value="{{ $item->no_ktp }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor KK</label>
                                            <input type="text" class="form-control border border-dark" name="no_kk"
                                                id="no_kk" placeholder="Masukkan Nomor KK"
                                                value="{{ $item->no_kk }}">
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
                                                        {{ $item->bank == $bank['code'] . '-' . $bank['name'] ? 'selected' : '' }}>
                                                        {{ $bank['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Berat Badan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="berat_badan" id="berat_badan" placeholder="Masukkan Berat Badan"
                                                value="{{ $item->berat_badan }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tinggi Badan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan Tinggi Badan"
                                                value="{{ $item->tinggi_badan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Warna Kulit</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="warna_kulit" id="warna_kulit" placeholder="Masukkan Warna Kulit"
                                                value="{{ $item->warna_kulit }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan"
                                                value="{{ $item->pekerjaan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pendidikan</label>
                                                <select name="pendidikan" class="form-select border-dark" disabled>
                                                    <option selected disabled>-- Pilih Pendidikan --</option>
                                                    <option value="Tidak Ada" {{ ($item->pendidikan == 'Tidak Ada') ? 'selected' : '' }}>Tidak Ada</option>
                                                    <option value="SD" {{ ($item->pendidikan == 'SD') ? 'selected' : '' }}>SD</option>
                                                    <option value="SMP Sederajat" {{ ($item->pendidikan == 'SMP Sederajat') ? 'selected' : '' }}>SMP Sederajat</option>
                                                    <option value="SMA Sederajat" {{ ($item->pendidikan == 'SMA Sederajat') ? 'selected' : '' }}>SMA Sederajat</option>
                                                    <option value="Diploma" {{ ($item->pendidikan == 'Diploma') ? 'selected' : '' }}>Diploma</option>
                                                    <option value="Sarjana S1" {{ ($item->pendidikan == 'Sarjana S1') ? 'selected' : '' }}>Sarjana S1</option>
                                                    <option value="Magister S2" {{ ($item->pendidikan == 'Magister S2') ? 'selected' : '' }}>Magister S2</option>
                                                    <option value="Doktor S3" {{ ($item->pendidikan == 'Doktor S3') ? 'selected' : '' }}>Doktor S3</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pernah Haji/Umroh</label>
                                                <select name="pernah_haji_umroh" class="form-select border-dark" disabled>
                                                    <option value="Sudah" {{ ($item->status == 'Sudah') ? 'selected' : '' }}>Sudah</option>
                                                    <option value="Belum" {{ ($item->status == 'Belum') ? 'selected' : '' }}>Belum</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Kelurahan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="kelurahan" id="kelurahan" placeholder="Masukkan Kelurahan"
                                                value="{{ $item->kelurahan }}">
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
                                                        {{ $item->kecamatan == $kecamatan['kecamatan'] ? 'selected' : '' }}>
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
                                                        {{ $item->kota_kabupaten == $kota['kota'] ? 'selected' : '' }}>
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
                                                        {{ $item->provinsi == $prov['provinsi'] ? 'selected' : '' }}>
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
                                                value="{{ $item->kode_pos }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="3"
                                        class="form-control border border-dark" placeholder="Masukkan Alamat Lengkap">{{ $item->alamat_lengkap }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Warga Negara</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="warga_negara" id="warga_negara" placeholder="Masukkan Warga Negara"
                                                value="{{ $item->warga_negara }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Golongan Darah</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="gol_darah" id="gol_darah" placeholder="Masukkan Golongan Darah"
                                                value="{{ $item->gol_darah }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Foto KTP</label>
                                            <input type="file" class="form-control border border-dark" name="foto_ktp"
                                                id="foto_ktp" value="{{ $item->foto_ktp }}">
                                        </div>
                                        @if ($item->foto_ktp)
                                            <div class="mb-3">
                                                <label class="form-label">Foto KTP Sekarang</label>
                                                <img src="{{ asset('storage/biodata/foto-ktp/' . $item->foto_ktp) }}"
                                                    alt="Foto KTP" style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Foto KK</label>
                                            <input type="file" class="form-control border border-dark" name="foto_kk"
                                                id="foto_kk" value="{{ $item->foto_kk }}">
                                        </div>
                                        @if ($item->foto_kk)
                                            <div class="mb-3">
                                                <label class="form-label">Foto KK Sekarang</label>
                                                <img src="{{ asset('storage/biodata/foto-kk/' . $item->foto_kk) }}"
                                                    alt="Foto KK" style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Foto Passport</label>
                                            <input type="file" class="form-control border border-dark"
                                                name="foto_passport" id="foto_passport"
                                                value="{{ $item->foto_passport }}">
                                        </div>
                                        @if ($item->foto_passport)
                                            <div class="mb-3">
                                                <label class="form-label">Foto Passport Sekarang</label>
                                                <img src="{{ asset('storage/biodata/foto-passport/' . $item->foto_passport) }}"
                                                    alt="Foto Passport" style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pas Foto</label>
                                            <input type="file" class="form-control border border-dark" name="pas_foto"
                                                id="pas_foto" value="{{ $item->pas_foto }}">
                                        </div>
                                        @if ($item->pas_foto)
                                            <div class="mb-3">
                                                <label class="form-label">Pas Foto Sekarang</label>
                                                <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                    alt="Pas Foto" style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i
                                        class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
    @endforeach
    {{-- end modal edit --}}
@endsection
