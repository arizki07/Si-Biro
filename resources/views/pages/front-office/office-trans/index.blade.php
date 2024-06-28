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
                                                <form action="{{ url('/verif/transaksi', $item->id_transaksi) }}"
                                                    method="POST" style="display:inline;" id="formApprove">
                                                    @csrf
                                                    <button type="button" id="btnApprove"
                                                        class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm">
                                                        <i class="ri-lock-unlock-fill"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/verif/transaksi', $item->id_transaksi) }}"
                                                    method="POST" style="display:inline;" id="formReject">
                                                    @csrf
                                                    <button type="button" id="btnReject"
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

    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/pages/sweetalerts.init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
    <script>
        document.getElementById('btnApprove').addEventListener('click', function() {
            swal.fire({
                icon: 'info',
                title: 'Proses Approve',
                html: `
                    <center>
                        <lottie-player src="https://lottie.host/1ae8263e-7260-48e6-89c7-282ab5ce909a/FhOMekG3Tf.json"  
                            background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay>
                        </lottie-player>
                    </center>
                    <br>
                    <h4 class="h4">Sedang memproses data. Proses mungkin membutuhkan beberapa detik.</h4>
                    <h4 class="h4">
                        <b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b>
                    </h4>
                `,
                showConfirmButton: false,
                showCancelButton: false,
                allowOutsideClick: false
            });

            setTimeout(function() {
                document.getElementById('formApprove').submit();
            }, 15000);
        });

        //reject
        document.getElementById('btnReject').addEventListener('click', function() {
            swal.fire({
                icon: 'info',
                title: 'Proses Reject',
                html: `
                    <center>
                        <lottie-player src="https://lottie.host/04412762-9109-48c0-b6f6-c57c9ff72cdc/rgc7wXYfLY.json"  
                            background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay>
                        </lottie-player>
                    </center>
                    <br>
                    <h4 class="h4">Sedang memproses data. Proses mungkin membutuhkan beberapa detik.</h4>
                    <h4 class="h4">
                        <b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b>
                    </h4>
                `,
                showConfirmButton: false,
                showCancelButton: false,
                allowOutsideClick: false
            });

            setTimeout(function() {
                document.getElementById('formReject').submit();
            }, 15000);
        });
    </script>
@endsection
