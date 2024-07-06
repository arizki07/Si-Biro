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
                    <div class="card bg-marketplace">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xxl-3 col-md-6 mb-3">
                                    <div>
                                        <label for="periode" class="form-label">Invoice Per Periode</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="periode" name="periode">
                                            <button class="btn btn-primary" type="button" id="searchButton"><i
                                                    class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6 mb-3" id="totalPendapatanContainer" style="display:none;">
                                    <div>
                                        <label for="totalPendapatan" class="form-label">Total Pendapatan Periode Ini</label>
                                        <div>
                                            <input type="text" class="form-control" id="totalPendapatan"
                                                name="totalPendapatan" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            const periode = document.getElementById('periode').value;
            if (periode) {
                // Show loading animation
                const loadingAnimation = Swal.fire({
                    icon: 'info',
                    title: 'Proses Pencarian',
                    html: `
                        <center>
                            <lottie-player src="https://assets2.lottiefiles.com/private_files/lf30_5XbiLO.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay>
                            </lottie-player>
                        </center>
                        <br>
                        <h4 class="h4">Sedang memproses data. Proses mungkin membutuhkan beberapa detik.</h4>
                        <h4 class="h4">
                            <b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b>
                        </h4>
                    `,
                    showConfirmButton: false,
                    showCancelButton: false,
                    allowOutsideClick: false
                });

                // Timeout to close the loading animation after 15 seconds
                setTimeout(() => {
                    loadingAnimation.close(); // Close the loading animation
                }, 15000);

                fetch(`/getPendapatanPeriode?periode=${periode}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingAnimation.close(); // Close the loading animation
                        const totalPendapatanContainer = document.getElementById('totalPendapatanContainer');
                        const totalPendapatan = document.getElementById('totalPendapatan');
                        totalPendapatan.value = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(data.totalPendapatan);
                        totalPendapatanContainer.style.display = 'block';
                    })
                    .catch(error => {
                        loadingAnimation.close(); // Close the loading animation
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memproses permintaan Anda. Silakan coba lagi.',
                        });
                    });
            } else {
                alert('Silakan pilih periode terlebih dahulu.');
            }
        });
    </script>
@endsection
