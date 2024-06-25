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
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
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
                                        <th>No.</th>
                                        <th>Nama Jamaah</th>
                                        <th>Layanan</th>
                                        <th>Tipe Pembayaran</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td><?= $i++ ?></td>
                                            <td>{{ $item->jamaah->nama_lengkap }}</td>
                                            <td>{{ $item->layanan->judul_layanan }}</td>
                                            <td>{{ $item->tipe_pembayaran }}</td>
                                            <td>{{ $item->jumlah_pembayaran }}</td>
                                            <td>{{ $item->status_pembayaran }}</td>
                                            <td>{{ $item->tanggal_pembayaran }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailTrans{{ $item->id_transaksi }}">
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

    @foreach ($data as $item)
        <div class="modal modal-blur fade" id="detailTrans{{ $item->id_jamaah }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-user" style="margin-right: 5px"></i> Detail
                            Jamaah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Foto KTP -->
                                <div class="card" style="max-width: 300px;">
                                    <div class="card-body">
                                        <h5 class="card-title">Pas Foto</h5>
                                    </div>
                                    <img src="{{ asset('storage/transaksi/foto-bukti/' . $item->foto_bukti_pembayaran) }}"
                                        class="card-img-top" alt="Pas Foto" style="max-width: 200px; max-height: 200px;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control border border-dark bg-secondary-lt"
                                                name="nama_lengkap"
                                                value="{{ old('nama_lengkap', $item->jamaah->nama_lengkap) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Layanan</label>
                                            <input type="text" class="form-control border border-dark" name="umur"
                                                id="umur" placeholder="Masukkan Umur"
                                                value="LA-{{ old('umur', $item->id_layanan) }}" readonly>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tipe Pembayaran</label>
                                                    <input type="text"
                                                        class="form-control border border-dark bg-secondary-lt"
                                                        name="jk" value="{{ old('jk', $item->tipe_pembayaran) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Jumlah Pembayaran</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="status" placeholder="Masukkan Status"
                                                        value="{{ old('status', $item->jumlah_pembayaran) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status Pembayaran</label>
                                                    <input type="text" class="form-control border border-dark"
                                                        name="tempat_lahir" id="tempat_lahir"
                                                        placeholder="Masukkan Tempat Lahir"
                                                        value="{{ old('tempat_lahir', $item->status_pembayaran) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pembayaran</label>
                                                    <input name="tgl_lahir" type="date"
                                                        class="form-control border border-dark"
                                                        value="{{ old('tgl_lahir', $item->tanggal_pembayaran) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function formatRupiah(value) {
            let numberString = value.replace(/[^,\d]/g, '').toString(),
                split = numberString.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/g);

            // Tambahkan tanda titik jika ada angka ribuan
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }

        // Event listener untuk format input saat engetik
        document.getElementById("jumlah_pembayaran").addEventListener("input", function() {
            let formattedValue = formatRupiah(this.value);
            this.value = formattedValue;
        });

        function logFormData(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            const form = event.target; // Get the form element
            const formData = new FormData(form); // Create FormData from the form

            // Log all form data in the console
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            // Submit the form after logging
            form.submit(); // Now submit the form
        }

        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }

        // $("#createForm").submit(function(e) {
        //     e.preventDefault();

        //     var formData = $(this).serialize();

        //     $.ajax({
        //         url: $(this).attr("action"),
        //         type: "POST",
        //         data: formData,
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
        //             "Authorization": "Bearer " + parsedObj.token.access_token
        //         },
        //         success: function(response) {
        //             console.log('berhasil han');
        //             console.log(response);
        //             swal("Info", "Data Berhasil disimpan.", "success");
        //             $('#createForm')[0].reset();
        //         },
        //         error: function(error) {
        //             console.error(error);
        //             swal("Gagal Menyimpan Data.");
        //         },
        //     });

        // });
    </script>
@endsection
