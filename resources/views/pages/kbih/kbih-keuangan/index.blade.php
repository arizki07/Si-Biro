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
                            <h5 class="card-title mb-0">Table {{ $title }}</h5>
                            <div style="float: right;">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#export">
                                    <i class=" ri-file-excel-fill"></i> Export Keuangan
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
                                        id="no_hp" placeholder="08xxx" value="{{ old('no_hp', $keu->jamaah->no_hp) }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Pembayaran</label>
                                    <input type="text" class="form-control border border-dark" name="jumlah_pembayaran"
                                        id="jumlah_pembayaran" placeholder="08xxx"
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
    <div class="modal modal-blur fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('export.keuangan.kbih') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export Data Keuangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xxl-12">
                            <label for="tipe_keuangan" class="form-label">Periode</label>
                            <select class="form-select" id="tipe_keuangan" name="periode_keuangan" required>
                                <option selected disabled>--Pilih Periode Keuangan--</option>
                                <option value="all">Semua Periode</option>
                                @foreach ($periode as $p)
                                    <option value="{{ $p }}">{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ms-auto"><i class="ri-upload-cloud-line"
                                style="margin-right:5px"></i> Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal IMport Excel --}}
@endsection
