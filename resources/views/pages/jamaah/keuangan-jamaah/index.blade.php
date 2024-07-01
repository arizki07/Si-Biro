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
                                            <td>{{ $keu->pembayaran }}</td>
                                            <td>{{ $keu->tipe_keuangan }}</td>
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

    {{-- Modal --}}
    @foreach ($keuangan as $keu)
        <div class="modal fade" id="viewVer{{ $keu->id_jamaah }}" tabindex="-1" aria-labelledby="exampleModalgridLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalgridLabel">Grid Modals</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);">
                            <div class="row g-3">
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="firstName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="firstName"
                                            placeholder="Enter firstname"
                                            value="{{ old('id_jamaah', $keu->jamaah->nama_lengkap) }}" disabled>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="lastName" class="form-label">Id Transaksi</label>
                                        <input type="text" class="form-control" id="lastName"
                                            placeholder="Enter lastname"
                                            value="{{ old('id_transaksi', $keu->id_transaksi) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xxl-6">
                                    <label for="emailInput" class="form-label">Pembayaran</label>
                                    <input type="email" class="form-control" id="emailInput"
                                        placeholder="Enter your email" value="{{ old('pembayaran', $keu->pembayaran) }}"
                                        disabled>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <label for="passwordInput" class="form-label">Tipe Pembayaran</label>
                                    <input type="text" class="form-control" id="passwordInput"
                                        value="{{ old('tipe_keuangan', $keu->tipe_keuangan) }}" disabled>
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
    @endforeach
    {{-- end modal --}}
@endsection
