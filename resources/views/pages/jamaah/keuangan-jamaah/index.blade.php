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
@endsection
