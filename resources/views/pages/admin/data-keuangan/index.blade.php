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
                            <h5 class="card-title mb-0">Table {{ $title }}</h5>
                            <div style="float: right;">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalgrid">
                                    <i class="ri-book-mark-fill"></i> Tambah Data Keuangan
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#importExcel">
                                    <i class=" ri-file-excel-fill"></i> Upload Excel
                                </button>
                            </div>
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
                                        <th>No</th>
                                        <th>Nama Jamaah</th>
                                        {{-- <th>Nomor Transaksi</th> --}}
                                        <th>Pembayaran</th>
                                        <th>Keuangan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($keuangan as $keu)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $keu->jamaah->nama_lengkap }}</td>
                                            {{-- <td>{{ $keu->id_transaksi }}</td> --}}
                                            <td>{{ $keu->pembayaran }}</td>
                                            <td>{{ $keu->tipe_keuangan }} </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#viewVer{{ $keu->id_jamaah }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $keu->id_keuangan }}">
                                                    <i class="ri-edit-2-fill"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDelete{{ $keu->id_keuangan }}">
                                                    <i class="ri-delete-bin-7-fill"></i>
                                                </button>
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel"><i class=" ri-book-mark-fill"></i> Add Keuangan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-marketplace d-flex">
                    <form method="post" action="{{ route('keuangan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="firstName" class="form-label">Nama Jamaah</label>
                                    <select name="id_jamaah" id="id_jamaah" class="form-control select2">
                                        <option> Pilih Nama Jamaah </option>
                                        @foreach ($jamaahs as $jam)
                                            <option value="{{ $jam->id_jamaah }}"
                                                {{ old('id_jamaah') == $jam->id_jamaah ? 'selected' : '' }}>
                                                {{ $jam->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Nomor Transaksi</label>
                                    <select name="id_transaksi" id="id_transaksi" class="form-control select2">
                                        <option> Pilih Nomor Jamaah </option>
                                        @foreach ($transaksi as $tran)
                                            <option value="{{ $tran->id_transaksi }}"
                                                {{ old('id_transaksi') == $tran->id_transaksi ? 'selected' : '' }}>
                                                {{ $tran->id_transaksi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-6">
                                <label for="pembayaran" class="form-label">Pembayaran</label>
                                <input type="pembayaran" name="pembayaran" class="form-control" id="pembayaran" required
                                    placeholder="Enter your Pembayaran">
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <label for="passwordInput" class="form-label">keuangan</label>
                                <select class="form-control select2" id="tipe_keuangan" name="tipe_keuangan" required>
                                    <option> Type Keuangan </option>
                                    <option value="CICILAN">Cicilan</option>
                                    <option value="PELUNASAN">Pelunasan</option>
                                </select>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}

    {{-- Modal Edit --}}
    @foreach ($keuangan as $keu)
        <div class="modal fade" id="editModal{{ $keu->id_keuangan }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $keu->id_keuangan }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $keu->id_keuangan }}"><i
                                class="ri-book-mark-fill"></i> Edit Keuangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <form action="{{ route('keuangan.update', $keu->id_keuangan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="id_jamaah" class="form-label">Nomor Jamaah</label>
                                        <select name="id_jamaah" id="id_jamaah" class="form-control select2">
                                            @foreach ($jamaahs as $jam)
                                                <option value="{{ $jam->id_jamaah }}"
                                                    {{ $keu->id_jamaah == $jam->id_jamaah ? 'selected' : '' }}>
                                                    {{ $jam->nama_lengkap }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="id_transaksi" class="form-label">Nomor Transaksi</label>
                                        <select name="id_transaksi" id="id_transaksi" class="form-control select2">
                                            @foreach ($transaksi as $tran)
                                                <option value="{{ $tran->id_transaksi }}"
                                                    {{ $keu->id_transaksi == $tran->id_transaksi ? 'selected' : '' }}>
                                                    {{ $tran->id_transaksi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxl-6">
                                    <label for="pembayaran" class="form-label">Pembayaran</label>
                                    <input type="text" name="pembayaran" class="form-control" id="pembayaran"
                                        value="{{ $keu->pembayaran }}" required placeholder="Enter your Pembayaran">
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <label for="tipe_keuangan" class="form-label">Tipe Keuangan</label>
                                    <select class="form-control select2" id="tipe_keuangan" name="tipe_keuangan"
                                        required>
                                        <option value="CICILAN" {{ $keu->tipe_keuangan == 'CICILAN' ? 'selected' : '' }}>
                                            Cicilan</option>
                                        <option value="PELUNASAN"
                                            {{ $keu->tipe_keuangan == 'PELUNASAN' ? 'selected' : '' }}>Pelunasan</option>
                                    </select>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End Modal Edit --}}

    {{-- Modal Delte --}}
    {{-- <div class="modal fade" id="confirmDelete{{ $keu->id_keuangan }}" tabindex="-1"
        aria-labelledby="confirmDeleteLabel{{ $keu->id_keuangan }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel{{ $keu->id_keuangan }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data keuangan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('keuangan.destroy', $keu->id_keuangan) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End Modal Delete --}}

    {{-- Modal View --}}
    @foreach ($keuangan as $keu)
        <div class="modal modal-blur fade" id="viewVer{{ $keu->id_jamaah }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-user" style="margin-right: 5px"></i> Detail
                            Keuangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control border border-dark bg-secondary-lt"
                                        name="nama_lengkap" id="nama_lengkap" placeholder="nama lengkap"
                                        value="{{ old('nama_lengkap', $keu->jamaah->nama_lengkap) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Umur</label>
                                    <input type="text" class="form-control border border-dark" name="umur"
                                        id="umur" placeholder="umur ...."
                                        value="{{ old('umur', $keu->jamaah->umur) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Rekening</label>
                                    <input type="text" class="form-control border border-dark" name="no_rekening"
                                        id="no_rekening" placeholder="no rek ..."
                                        value="{{ old('no_rekening', $keu->jamaah->no_rekening) }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">No Hp</label>
                                    <input type="text" class="form-control border border-dark" name="no_hp"
                                        id="no_hp" placeholder="08xxx"
                                        value="{{ old('no_hp', $keu->jamaah->no_hp) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Pembayaran</label>
                                    <input type="text" class="form-control border border-dark"
                                        name="jumlah_pembayaran" id="jumlah_pembayaran" placeholder="08xxx"
                                        value="RP, {{ old('jumlah_pembayaran', $keu->transaksi->jumlah_pembayaran) }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Type Pembayaran</label>
                                    <input type="text" class="form-control border border-dark" name="tipe_pembayaran"
                                        id="tipe_pembayaran" placeholder="no rek ..."
                                        value="{{ old('tipe_pembayaran', $keu->transaksi->tipe_pembayaran) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Status Pembayaran</label>
                                    <input type="text" class="form-control border border-dark"
                                        name="status_pembayaran" id="status_pembayaran" placeholder="08xxx"
                                        value="{{ old('status_pembayaran', $keu->transaksi->status_pembayaran) }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pembayaran</label>
                                    <input type="text" class="form-control border border-dark"
                                        name="tanggal_pembayaran" id="tanggal_pembayaran" placeholder=""
                                        value="{{ old('tanggal_pembayaran', $keu->transaksi->tanggal_pembayaran) }}"
                                        readonly>
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
    {{-- end modal view --}}

    {{-- Modal Import Excel --}}
    <div class="modal modal-blur fade" id="importExcel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('import') }}?proses=upload_jadwal" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih Type Proses</label>
                            <div class="col-lg-4 col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type1"
                                                value="add">
                                            <label class="form-check-label" for="type1">
                                                Add
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type2"
                                                value="update">
                                            <label class="form-check-label" for="type2">
                                                Update
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih file excel (xlsx)</label>
                            <input type="file" name="file" required="required" accept=".xlsx"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="" class="btn btn-link link-secondary">Download Contoh Excel</a>
                        <button type="submit" class="btn btn-primary ms-auto"><i class="ri-upload-cloud-line"
                                style="margin-right:5px"></i> Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal IMport Excel --}}
@endsection
