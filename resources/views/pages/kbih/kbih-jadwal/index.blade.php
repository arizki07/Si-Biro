@extends('layout.main')

@section('css')
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
@endsection

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
                            {{-- <div style="float: right;">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalgrid">
                                    <i class="ri-book-mark-fill"></i> Tambah Data Jadwal
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#importExcel">
                                    <i class=" ri-file-excel-fill"></i> Upload Excel
                                </button>
                            </div> --}}
                        </div>

                        <div class="card-body">
                            <table id="scroll-horizontal"
                                class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Opsi</th>
                                        <th>Nomor Jadwal</th>
                                        <th>Judul Jadwal</th>
                                        <th>Tipe Jadwal</th>
                                        {{-- <th>Jangka Waktu</th> --}}
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($jadwal as $jad)
                                        @if ($jad->tipe_jadwal == 'MCU')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>MCU-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'PASSPORT')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    </button>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>PA-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'BIMBINGAN')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    </button>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>BM-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'MANASIK')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    </button>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>BM-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @endif
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
