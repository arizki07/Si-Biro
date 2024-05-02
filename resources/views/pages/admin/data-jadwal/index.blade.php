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
                                        <th>Jangka Waktu</th>
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
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#">
                                                        <i class="ri-eye-fill"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"><i
                                                            class="ri-delete-bin-2-fill"></i></button>
                                                </td>
                                                <td>MCU-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ $jad->jangka_waktu }} Hari</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'PASSPORT')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#">
                                                        <i class="ri-eye-fill"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"><i
                                                            class="ri-delete-bin-2-fill"></i></button>
                                                </td>
                                                <td>PA-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ $jad->jangka_waktu }} Hari</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'BIMBINGAN')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#">
                                                        <i class="ri-eye-fill"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"><i
                                                            class="ri-delete-bin-2-fill"></i></button>
                                                </td>
                                                <td>BM-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ $jad->jangka_waktu }} Hari</td>
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

    {{-- Modal Tambah --}}
    {{-- <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel"><i class=" ri-book-mark-fill"></i> Add Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-marketplace d-flex">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="firstName" class="form-label">Nomor Jadwal</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter firstname">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Judul Jadwal</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter lastname">
                                </div>
                            </div>

                            <div class="col-xxl-6">
                                <label for="emailInput" class="form-label">Tipe Jadwal</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Enter your email">
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <label for="passwordInput" class="form-label">Jangka Waktu</label>
                                <input type="text" class="form-control" id="passwordInput" value=""
                                    placeholder="Enter password">
                            </div>
                            <!--end col-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control border border-dark" name=""
                                            id="" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Selesai</label>
                                        <input name="" type="date" class="form-control border border-dark"
                                            placeholder="YYYY-MM-DD" />
                                    </div>
                                </div>
                            </div>
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
    </div> --}}
    {{-- End Modal Tambah --}}
@endsection
