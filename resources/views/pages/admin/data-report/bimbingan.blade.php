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
                                    data-bs-target="#exampleModalgrid">
                                    <i class="ri-phone-fill"></i> Tambah Data {{ $title }}
                                </button>
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
                                        <th>Tgl Report</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($report as $rep)
                                        @if ($rep->tipe_report == 'MCU')
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
                                                @foreach ($biodata as $bio)
                                                    <td>{{ $bio->nama_lengkap }}</td>
                                                @endforeach
                                                <td>{{ \Carbon\Carbon::parse($rep->created_at)->format('d M Y') }}</td>
                                                <td>{{ $rep->status_report }}</td>
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

@section('scripting')
    {{--  --}}
@endsection
