@extends('layout.main')
@section('content')
    @include('components.alerts')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $judul }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{ $judul }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab"
                                        aria-selected="false">
                                        Layanan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#product1" role="tab"
                                        aria-selected="false">
                                        Uraian Layanan
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content  text-muted">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">


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
                                                                <th>Opsi</th>
                                                                <th>ID Layanan</th>
                                                                <th>Judul Layanan</th>
                                                                <th>Kuota</th>
                                                                <th>Tahun Pemberangkatan</th>
                                                                <th>Bulan Pemberangkatan</th>
                                                                <th>Paket</th>
                                                                <th>Status Paket</th>
                                                                <th>Deskripsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php($no = 1)
                                                            @foreach ($layanan as $item)
                                                                <tr class="text-center">
                                                                    <td>{{ $no++ }}</td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#detailModal{{ $item->id_layanan }}">
                                                                            <i class="ri-eye-fill"></i>
                                                                        </button>
                                                                    </td>
                                                                    <td>LA-{{ $item->id_layanan }}</td>
                                                                    <td>{{ $item->judul_layanan }}</td>
                                                                    <td>{{ $item->kuota }}</td>
                                                                    <td>{{ $item->tahun_pemberangkatan }}</td>
                                                                    <td>{{ $item->bulan_pemberangkatan }}</td>
                                                                    <td>{{ $item->paket }}</td>
                                                                    <td>{{ $item->status_paket }}</td>
                                                                    <td>{{ $item->deskripsi }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product1" role="tabpanel">
                                    <form action="">
                                        <div class="col-xxl-6">
                                            <label for="">Nama Layanan</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-xxl-6 ">
                                            <div>
                                                <label for="exampleFormControlTextarea5" class="form-label">Uraian</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 ">
                                            <div>
                                                <label for="exampleFormControlTextarea5"
                                                    class="form-label">Keterangan</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>

            </div>
        </div>
    </div>

    @foreach ($layanan as $item)
        <div class="modal fade" id="detailModal{{ $item->id_layanan }}" tabindex="-1" aria-labelledby="detailModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel"><i class="ri-phone-fill"></i>Detail Layanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <form enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="row">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="text-align: center;">
                                                    <!-- Menggunakan text-align: center; untuk membuat gambar berada di tengah secara horizontal -->
                                                    <img src="{{ asset('storage/layanan/foto-bg/' . $item->foto_bg) }}"
                                                        class="card-img-top" alt="Foto BG"
                                                        style="width: 100%; object-fit: cover; margin: 0 auto;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6">
                                    <div>
                                        <label for="firstName" class="form-label">Judul Layanan</label>
                                        <input type="text" class="form-control" id="firstName"
                                            placeholder="Enter Layanan" name="judul_layanan"
                                            value="{{ old('judul_layanan', $item->judul_layanan) }}" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="lastName" class="form-label">Kuota</label>
                                        <input type="text" class="form-control" id="lastName"
                                            placeholder="Enter Kuota" name="kuota"
                                            value="{{ old('kuota', $item->kuota) }}" readonly>
                                    </div>
                                </div>

                                <div class="col-xxl-6">
                                    <label for="emailInput" class="form-label">Tahun Pemberangkatan</label>
                                    <input type="text" class="form-control" id="emailInput"
                                        placeholder="Enter Tahum Pemberangkatan" name="tahun_pemberangkatan"
                                        value="{{ old('tahun_pemberangkatan', $item->tahun_pemberangkatan) }}" readonly>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <label for="passwordInput" class="form-label">Bulan Pemberangkatan</label>
                                    <input type="text" class="form-control" id="passwordInput"
                                        placeholder="Enter Bulan Pemberangkatan" name="bulan_pemberangkatan"
                                        value="{{ old('bulan_pemberangkatan', $item->bulan_pemberangkatan) }}" readonly>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <label for="passwordInput" class="form-label">Paket</label>
                                    <input type="text" class="form-control" id="passwordInput"
                                        placeholder="Enter Paket" name="paket"
                                        value="{{ old('paket', $item->paket) }}" readonly>
                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-xxl-6">
                                    <label for="passwordInput" class="form-label">Status Paket</label>
                                    <input type="text" class="form-control" id="passwordInput"
                                        placeholder="Enter Status Paket" name="status_paket"
                                        value="{{ old('status_paket', $item->status_paket) }}" readonly>
                                </div>
                                <!--end col-->
                                <div class="mb-3">
                                    <label class="form-label">Deksripsi</label>
                                    <textarea id="" cols="30" rows="3" class="form-control border border-dark"
                                        placeholder="Masukkan Deskripsi" name="deskripsi" readonly>{{ old('deskripsi', $item->deskripsi) }} </textarea>
                                </div>

                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
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
@endsection
