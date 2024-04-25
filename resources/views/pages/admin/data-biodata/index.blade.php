@extends('layout.main')
@section('content')
    @include('components.alerts')

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Datatables</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Datatables</li>
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
                            <h5 class="card-title mb-0">Scroll - Horizontal</h5>
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
                                                <button type="button"
                                                    class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id_jamaah }}"><i
                                                        class=" ri-edit-2-fill"></i></button>
                                                <form method="POST"
                                                    action="{{ route('delete.biodata', $item->id_jamaah) }}"
                                                    id="delete-form" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        onclick="btnDelete()">
                                                        <i class="ri-delete-bin-2-fill"></i>
                                                    </button>
                                                </form>
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
                                    <option value="" hidden>-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id_role }}"
                                            {{ $role->id_role == $role->id_role ? 'selected' : '' }}>
                                            {{ $role->nama_role }}
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
                                <input type="text" class="form-control border border-dark" name="umur" id="umur"
                                    placeholder="Masukkan Umur" value="{{ old('umur') }}">
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor KTP</label>
                                        <input type="text" class="form-control border border-dark" name="no_ktp"
                                            id="no_ktp" placeholder="Masukkan Nomor KTP" value="{{ old('no_ktp') }}">
                                    </div>
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
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Passport</label>
                                        <input type="text" class="form-control border border-dark" name="no_passport"
                                            id="no_passport" placeholder="Masukkan Nomor Passport"
                                            value="{{ old('no_passport') }}">
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
                                        <input type="text" class="form-control border border-dark"
                                            name="pernah_haji_umroh" id="pernah_haji_umroh"
                                            placeholder="Masukkan Pernah Haji/Umroh"
                                            value="{{ old('pernah_haji_umroh') }}">
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
                            Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Foto KTP</h5>
                                            </div>
                                            <img src="{{ asset('storage/biodata/foto-ktp/' . $item->foto_ktp) }}"
                                                class="card-img-top" alt="Foto KTP" width="300" height="300">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Pas Foto</h5>
                                            </div>
                                            <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                class="card-img-top" alt="Pas Foto" width="300" height="300">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control border border-dark bg-secondary-lt"
                                name="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Umur</label>
                            <input type="text" class="form-control border border-dark" name="umur" id="umur"
                                placeholder="Masukkan Umur" value="{{ old('umur', $item->umur) }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jk" id="gender" class="form-select border-dark">
                                        <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control border border-dark" name="status"
                                        placeholder="Masukkan Status" value="{{ old('status', $item->status) }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control border border-dark" name="tempat_lahir"
                                        id="tempat_lahir" placeholder="Masukkan Tempat Lahir"
                                        value="{{ old('tempat_lahir', $item->tempat_lahir) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input name="tgl_lahir" type="date" class="form-control border border-dark"
                                        placeholder="YYYY-MM-DD" /
                                        value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control border border-dark" name="no_hp"
                                        id="no_hp" placeholder="Masukkan Nomor HP"
                                        value="{{ old('no_hp', $item->no_hp) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor HP Wali</label>
                                    <input type="text" class="form-control border border-dark" name="no_hp_wali"
                                        id="no_hp_wali" placeholder="Masukkan Nomor HP Wali"
                                        value="{{ old('no_hp_wali', $item->no_hp_wali) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Rekening</label>
                                    <input type="text" class="form-control border border-dark" name="no_rekening"
                                        id="no_rekening" placeholder="Masukkan Nomor Rekening"
                                        value="{{ old('no_rekening', $item->no_rekening) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor KTP</label>
                                    <input type="text" class="form-control border border-dark" name="no_ktp"
                                        id="no_ktp" placeholder="Masukkan Nomor KTP"
                                        value="{{ old('no_ktp', $item->no_ktp) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor KK</label>
                                    <input type="text" class="form-control border border-dark" name="no_kk"
                                        id="no_kk" placeholder="Masukkan Nomor KK"
                                        value="{{ old('no_kk', $item->no_kk) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Passport</label>
                                    <input type="text" class="form-control border border-dark" name="no_passport"
                                        id="no_passport" placeholder="Masukkan Nomor Passport"
                                        value="{{ old('no_passport', $item->no_passport) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Bank</label>
                                    <select name="bank" id="gender" class="form-select border-dark">
                                        <option value="" hidden>-- Pilih Bank --</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BSI">BSI</option>
                                        <option value="BJB">BJB</option>
                                        <option value="MANDIRI">MANDIRI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Berat Badan</label>
                                    <input type="text" class="form-control border border-dark" name="berat_badan"
                                        id="berat_badan" placeholder="Masukkan Berat Badan"
                                        value="{{ old('verat_badan', $item->verat_badan) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tinggi Badan</label>
                                    <input type="text" class="form-control border border-dark" name="tinggi_badan"
                                        id="tinggi_badan" placeholder="Masukkan Tinggi Badan"
                                        value="{{ old('tinggi_badan', $item->tinggi_badan) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Warna Kulit</label>
                                    <input type="text" class="form-control border border-dark" name="warna_kulit"
                                        id="warna_kulit" placeholder="Masukkan Warna Kulit"
                                        value="{{ old('warna_kulit', $item->warna_kulit) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control border border-dark" name="pekerjaan"
                                        id="pekerjaan" placeholder="Masukkan Pekerjaan"
                                        value="{{ old('pekerjaan', $item->pekerjaan) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pendidikan</label>
                                    <input type="text" class="form-control border border-dark" name="pendidikan"
                                        id="pendidikan" placeholder="Masukkan Pendidikan"
                                        value="{{ old('pendidikan', $item->pendidikan) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pernah Haji/Umroh</label>
                                    <input type="text" class="form-control border border-dark"
                                        name="pernah_haji_umroh" id="pernah_haji_umroh"
                                        placeholder="Masukkan Pernah Haji/Umroh"
                                        value="{{ old('pernah_haji_umroh', $item->pernah_haji_umroh) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control border border-dark" name="kelurahan"
                                        id="kelurahan" placeholder="Masukkan Kelurahan"
                                        value="{{ old('kelurahan', $item->kelurahan) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control border border-dark" name="kecamatan"
                                        id="kecamatan" placeholder="Masukkan Kecamatan"
                                        value="{{ old('kecamatan', $item->kecamatan) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <input type="text" class="form-control border border-dark" name="kota_kabupaten"
                                        id="kota_kabupaten" placeholder="Masukkan Kota/Kabupaten"
                                        value="{{ old('kota_kabupaten', $item->kota_kabupaten) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Provinsi</label>
                                    <input type="text" class="form-control border border-dark" name="provinsi"
                                        id="provinsi" placeholder="Masukkan Provinsi"
                                        value="{{ old('provinsi', $item->provinsi) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control border border-dark" name="kode_pos"
                                        id="kode_pos" placeholder="Masukkan Kode Pos"
                                        value="{{ old('kode_pos', $item->kode_pos) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="3"
                                class="form-control border border-dark" placeholder="Masukkan Alamat Lengkap" value="" readonly>{{ old('alamat_lengkap', $item->alamat_lengkap) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Warga Negara</label>
                                    <input type="text" class="form-control border border-dark" name="warga_negara"
                                        id="warga_negara" placeholder="Masukkan Warga Negara"
                                        value="{{ old('warga_negara', $item->warga_negara) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Golongan Darah</label>
                                    <input type="text" class="form-control border border-dark" name="gol_darah"
                                        id="gol_darah" placeholder="Masukkan Golongan Darah"
                                        value="{{ old('gol_darah', $item->gol_darah) }}" readonly>
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

    {{-- Modal edit --}}
    @foreach ($jamaah as $jam)
        <div class="modal fade" id="editModal{{ $jam->id_jamaah }}" tabindex="-1" aria-labelledby="editModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class=" ri-user-add-fill"> Tambah Data
                                Jamaah</i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('update.biodata', $jam->id_jamaah) }}"
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
                                    <select name="id_role" id="id_role" class="form-select border border-dark">
                                        <option value="" hidden>-- Pilih Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id_role }}"
                                                {{ $role->id_role == $role->id_role ? 'selected' : '' }}>
                                                {{ $role->nama_role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Layanan</label>
                                    <select name="id_layanan" id="id_layanan" class="form-select border border-dark">
                                        <option value="" hidden>-- Pilih Layanan --</option>
                                        @foreach ($layanans as $layanan)
                                            <option value="{{ $layanan->id_layanan }}">{{ $layanan->judul_layanan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control border border-dark bg-secondary-lt"
                                        name="nama_lengkap" value="{{ $jam->nama_lengkap }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Umur</label>
                                    <input type="text" class="form-control border border-dark" name="umur"
                                        id="umur" placeholder="Masukkan Umur" value="{{ $jam->umur }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select name="jk" id="gender" class="form-select border-dark">
                                                <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                                                <option value="Pria" {{ $jam->jk == 'Pria' ? 'selected' : '' }}>Pria
                                                </option>
                                                <option value="Wanita" {{ $jam->jk == 'Wanita' ? 'selected' : '' }}>
                                                    Wanita
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <input type="text" class="form-control border border-dark" name="status"
                                                placeholder="Masukkan Status" value="{{ $jam->status }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir"
                                                value="{{ $jam->tempat_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input name="tgl_lahir" type="date"
                                                class="form-control border border-dark" placeholder="YYYY-MM-DD"
                                                value="{{ $jam->tgl_lahir }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor HP</label>
                                            <input type="text" class="form-control border border-dark" name="no_hp"
                                                id="no_hp" placeholder="Masukkan Nomor HP"
                                                value="{{ $jam->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor HP Wali</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="no_hp_wali" id="no_hp_wali" placeholder="Masukkan Nomor HP Wali"
                                                value="{{ $jam->no_hp_wali }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Rekening</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="no_rekening" id="no_rekening" placeholder="Masukkan Nomor Rekening"
                                                value="{{ $jam->no_rekening }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor KTP</label>
                                            <input type="text" class="form-control border border-dark" name="no_ktp"
                                                id="no_ktp" placeholder="Masukkan Nomor KTP"
                                                value="{{ $jam->no_ktp }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor KK</label>
                                            <input type="text" class="form-control border border-dark" name="no_kk"
                                                id="no_kk" placeholder="Masukkan Nomor KK"
                                                value="{{ $jam->no_kk }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Passport</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="no_passport" id="no_passport" placeholder="Masukkan Nomor Passport"
                                                value="{{ $jam->no_passport }}">
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
                                                        {{ $jam->bank == $bank['code'] . '-' . $bank['name'] ? 'selected' : '' }}>
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
                                                value="{{ $jam->berat_badan }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tinggi Badan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan Tinggi Badan"
                                                value="{{ $jam->tinggi_badan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Warna Kulit</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="warna_kulit" id="warna_kulit" placeholder="Masukkan Warna Kulit"
                                                value="{{ $jam->warna_kulit }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan"
                                                value="{{ $jam->pekerjaan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pendidikan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="pendidikan" id="pendidikan" placeholder="Masukkan Pendidikan"
                                                value="{{ $jam->pendidikan }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pernah Haji/Umroh</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="pernah_haji_umroh" id="pernah_haji_umroh"
                                                placeholder="Masukkan Pernah Haji/Umroh"
                                                value="{{ $jam->pernah_haji_umroh }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Kelurahan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="kelurahan" id="kelurahan" placeholder="Masukkan Kelurahan"
                                                value="{{ $jam->kelurahan }}">
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
                                                        {{ $jam->kecamatan == $kecamatan['kecamatan'] ? 'selected' : '' }}>
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
                                                        {{ $jam->kota_kabupaten == $kota['kota'] ? 'selected' : '' }}>
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
                                                        {{ $jam->provinsi == $prov['provinsi'] ? 'selected' : '' }}>
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
                                                value="{{ $jam->kode_pos }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="3"
                                        class="form-control border border-dark" placeholder="Masukkan Alamat Lengkap">{{ $jam->alamat_lengkap }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Warga Negara</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="warga_negara" id="warga_negara" placeholder="Masukkan Warga Negara"
                                                value="{{ $jam->warga_negara }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Golongan Darah</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="gol_darah" id="gol_darah" placeholder="Masukkan Golongan Darah"
                                                value="{{ $jam->gol_darah }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Foto KTP</label>
                                            <input type="file" class="form-control border border-dark" name="foto_ktp"
                                                id="foto_ktp" value="{{ $jam->foto_ktp }}">
                                        </div>
                                        @if ($jam->foto_ktp)
                                            <div class="mb-3">
                                                <label class="form-label">Foto KTP Sekarang</label>
                                                <img src="{{ asset('storage/biodata/foto-ktp/' . $jam->foto_ktp) }}"
                                                    alt="Foto KTP" style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Foto KK</label>
                                            <input type="file" class="form-control border border-dark" name="foto_kk"
                                                id="foto_kk" value="{{ $jam->foto_kk }}">
                                        </div>
                                        @if ($jam->foto_kk)
                                            <div class="mb-3">
                                                <label class="form-label">Foto KK Sekarang</label>
                                                <img src="{{ asset('storage/biodata/foto-kk/' . $jam->foto_kk) }}"
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
                                                value="{{ $jam->foto_passport }}">
                                        </div>
                                        @if ($jam->foto_passport)
                                            <div class="mb-3">
                                                <label class="form-label">Foto Passport Sekarang</label>
                                                <img src="{{ asset('storage/biodata/foto-passport/' . $jam->foto_passport) }}"
                                                    alt="Foto Passport" style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pas Foto</label>
                                            <input type="file" class="form-control border border-dark" name="pas_foto"
                                                id="pas_foto" value="{{ $jam->pas_foto }}">
                                        </div>
                                        @if ($jam->pas_foto)
                                            <div class="mb-3">
                                                <label class="form-label">Pas Foto Sekarang</label>
                                                <img src="{{ asset('storage/biodata/pas-foto/' . $jam->pas_foto) }}"
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
                                        class="icon icon-tabler icon-tabler-device-floppy" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
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
