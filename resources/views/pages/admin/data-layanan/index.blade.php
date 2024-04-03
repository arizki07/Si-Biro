@extends('layout.main')
@section('content')
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
                            <div style="float: right;">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalgrid">
                                    <i class="ri-phone-fill"></i> Tambah Data Layanan
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
                                        <th>Opsi</th>
                                        <th>Judul Layanan</th>
                                        <th>Kuota</th>
                                        <th>Tahun Pemberangkatan</th>
                                        <th>Bulan Pemberangkatan</th>
                                        <th>Paket</th>
                                        <th>Status Paket</th>
                                        <th>Deskripsi</th>
                                        <th>Foto Background</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
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
                    <h5 class="modal-title" id="exampleModalgridLabel"><i class="ri-phone-fill"></i>Add Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="firstName" class="form-label">Judul Layanan</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter firstname">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Kuota</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter lastname">
                                </div>
                            </div>

                            <div class="col-xxl-6">
                                <label for="emailInput" class="form-label">Tahun Pemberangkatan</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Enter your email">
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <label for="passwordInput" class="form-label">Bulan Pemberangkatan</label>
                                <input type="text" class="form-control" id="passwordInput" value=""
                                    placeholder="Enter password">
                            </div>
                            <!--end col-->
                            <!--end col-->
                            <div class="col-xxl-6">
                                <label for="passwordInput" class="form-label">Paket</label>
                                <input type="text" class="form-control" id="passwordInput" value=""
                                    placeholder="Enter password">
                            </div>
                            <!--end col-->
                            <!--end col-->
                            <div class="col-xxl-6">
                                <label for="passwordInput" class="form-label">Status Paket</label>
                                <input type="text" class="form-control" id="passwordInput" value=""
                                    placeholder="Enter password">
                            </div>
                            <!--end col-->
                            <div class="mb-3">
                                <label class="form-label">Deksripsi</label>
                                <textarea name="" id="" cols="30" rows="3" class="form-control border border-dark"
                                    placeholder="Masukkan Deskripsi"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Background</label>
                                <input type="file" class="form-control border border-dark" name=""
                                    id="">
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
            <form method="post" action="/testkapas/import_excel" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-4 col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Add
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Update
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih file excel (xlsx)</label>
                            <input type="file" name="file" required="required"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
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
