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
                            <table id="scroll-horizontal"
                                class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                <thead>
                                    <tr class="text-center">
                                        <th>Opsi</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Layanan</th>
                                        <th>No Ktp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jamaah as $item)
                                        <tr class="text-center">
                                            <td>
                                                <a href="/kb-view"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm">
                                                    <i class="ri-eye-fill"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/biodata/pas-foto/' . $item->pas_foto) }}"
                                                    class="card-img-top" alt="Pas Foto"
                                                    style="max-width: 40px; max-height: 40px; border-radius: 50%; width: 40px; height: 40px; object-fit: cover;">

                                            </td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>LA-{{ $item->id_layanan }}</td>
                                            <td>{{ $item->no_ktp }}</td>

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
