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
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Basic Datatables</h5>
                        </div>
                        <div class="card-body">

                            <table id="example"
                                class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Layanan</th>
                                        <th>Verifikasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $key => $item)
                                        <tr class="text-center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->jamaah->nama_lengkap }}</td>
                                            <td>{{ $item->id_layanan }}</td>
                                            <td>
                                                @if ($item->verifikasi == 'approved')
                                                    <span class="badge text-bg-success">Approved</span>
                                                @elseif($item->verifikasi == 'rejected')
                                                    <span class="badge text-bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge text-bg-secondary"">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailTransaksi{{ $item->id_transaksi }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <form action="{{ route('office-trans.approve', $item->id_transaksi) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button
                                                        class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm">
                                                        <i class="ri-lock-unlock-fill"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('office-trans.reject', $item->id_transaksi) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm">
                                                        <i class="ri-lock-password-fill"></i>
                                                    </button>
                                                </form>
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
@endsection
