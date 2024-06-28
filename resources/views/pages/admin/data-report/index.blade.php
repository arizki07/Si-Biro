@extends('layout.main')

@section('css')
    <style>
        #scroll-horizontal thead th {
            border-bottom: 1px solid #ddd;
        }

        #scroll-horizontal tbody td {
            border-right: 1px solid #ddd;
        }

        #scroll-horizontal tbody tr:last-child td {
            border-bottom: 1px solid #ddd;
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
                        <h4 class="mb-sm-0">{{ $title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
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
                            <h5 class="card-title mb-0">Data {{ $title }}</h5>
                            <div style="float: right;">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#add-excel">
                                    Upload Excel {{ $title }}
                                </button>
                                {{-- <div class="col-sm-auto ms-auto">
                                    <div class="list-grid-nav hstack gap-1">
                                        <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-primary material-shadow-none"><i class="ri-more-2-fill"></i> Add Data {{ $title }}</button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#add-mcu">MCU</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#add-bimbingan">Bimbingan</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#add-passport">Passport</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#add-manasik">Manasik</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#add-excel">Upload By Excel</a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                                {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#importExcel">
                                    <i class=" ri-file-excel-fill"></i> Upload Excel
                                </button> --}}
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="scroll-horizontal"
                                class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Opsi</th>
                                        <th>Nama Jamaah</th>
                                        <th>Tahap</th>
                                        <th>Nama Tahap</th>
                                        <th>Layanan</th>
                                        <th>Tipe Jadwal</th>
                                        <th>Status</th>
                                        <th>File Opsional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($report as $rep)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <a type="button"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detail{{ $rep->id_report }}"><i
                                                        class="ri-eye-fill"></i></a>
                                                <a type="button"
                                                    class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $rep->id_report }}"><i
                                                        class="ri-delete-bin-2-fill"></i></a>
                                            </td>
                                            <td>{{ $rep->nama_lengkap }}</td>
                                            <td>{{ $rep->tahap_report }}</td>
                                            <td>
                                                @if ($rep->tipe_report == 'MCU')
                                                {{ $rep->judul_mcu }}
                                                @elseif ($rep->tipe_report == 'BIMBINGAN')
                                                {{ $rep->judul_bimbingan }} 
                                                @elseif ($rep->tipe_report == 'PASSPORT')
                                                {{ $rep->judul_passport }}
                                                @else
                                                {{ $rep->judul_manasik }}
                                                @endif
                                            </td>
                                            <td>LA-{{ $rep->id_layanan }}</td>
                                            <td>{{ $rep->tipe_report }}</td>
                                            {{-- <td>{{ \Carbon\Carbon::parse($rep->created_at)->format('d M Y') }}</td> --}}
                                            <td>{{ $rep->status_report }}</td>
                                            <td>
                                                @if ($rep->file_opsional == NULL || $rep->file_opsional == '')
                                                <a type="button" class="btn btn-outline-secondary waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#">Add File
                                                </a>
                                                @else
                                                {{-- Sementara --}}
                                                {{ $rep->file_opsional }}
                                                @endif
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

@section('scripting')
    {{-- Modal Import Excel --}}
<div class="modal modal-blur fade" id="add-excel" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('import') }}?proses=upload_report" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Excel Data Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-check-input" type="hidden" name="type" id="type1" value="add">
                    <div class="mb-3">
                        <label class="form-label">Pilih file excel (xlsx)</label>
                        <input type="file" name="file" required="required" accept=".xlsx"
                            class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ asset('doc/report/TEMPLATE_REPORT.xlsx') }}" class="btn btn-link link-secondary" download>Download Contoh Excel</a>
                    <button type="submit" class="btn btn-primary ms-auto"><i class="ri-upload-cloud-line"
                            style="margin-right:5px"></i> Import</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- End Modal IMport Excel --}}
@endsection
