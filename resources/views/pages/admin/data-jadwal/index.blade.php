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
                            <h5 class="card-title mb-0">Table {{ $title; }}</h5>
                            <div style="float: right;">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalgrid">
                                    <i class="ri-book-mark-fill"></i> Tambah Data Jadwal
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
                                        <th>Nomor Jadwal</th>
                                        <th>Judul Jadwal</th>
                                        <th>Tipe Jadwal</th>
                                        <th>Jangka Waktu</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php ($i = 1)
                                    @foreach ($jadwal as $jad)
                                        <tr class="text-center">
                                            <td>{{ $i++; }}</td>
                                            <td>JD-{{ $jad->nomor_jadwal }}</td>
                                            <td>{{ $jad->judul_jadwal }}</td>
                                            <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                            <td>{{ $jad->jangka_waktu }} Hari</td>
                                            <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"><i
                                                        class=" ri-edit-2-fill"></i></button>
                                                <button type="button"
                                                    class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"><i
                                                        class="ri-delete-bin-2-fill"></i></button>
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
                    <h5 class="modal-title" id="exampleModalgridLabel"><i class=" ri-book-mark-fill"></i> Add Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
    </div>
    {{-- End Modal Tambah --}}

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
                                            <input class="form-check-input" type="radio" name="type"
                                                id="type1" value="add">
                                            <label class="form-check-label" for="type1">
                                                Add
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type"
                                                id="type2" value="update">
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
                            <input type="file" name="file" required="required" accept=".xlsx" class="form-control">
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
