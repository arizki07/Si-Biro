<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/pages/sweetalerts.init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>

@if (session()->get('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session()->get('error') }}",
                showConfirmButton: true,
            });
        });
    </script>
@endif

@if (session()->get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Mohon Menunggu',
                html: '<div id="lottie-animation" style="width: 300px; height: 300px; margin: 0 auto;"></div><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit.</h1><h1 class="h4"><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    // Load your Lottie animation
                    const animationContainer = document.getElementById('lottie-animation');
                    const anim = bodymovin.loadAnimation({
                        container: animationContainer,
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: 'https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json',
                        rendererSettings: {
                            preserveAspectRatio: 'xMidYMid slice'
                        }
                    });

                    setTimeout(() => {
                        Swal.close();

                        Swal.fire({
                            icon: 'success',
                            title: '',
                            text: '{{ session()->get('success') }}',
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }, 2000);
                }
            });
        });
    </script>
@endif

{{-- <script>
    function btnDelete() {
        Swal.fire({
            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Are you Sure ?</h4><p class="text-muted mx-4 mb-0">Are you Sure You want to Delete ?</p></div></div>',
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
            confirmButtonText: "Yes, Delete It!",
            cancelButtonClass: "btn btn-danger w-xs mb-1",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    }
</script> --}}
<script>
    function confirmDelete(event, id) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus Data',
            html: `
                <center>
                    <lottie-player src="https://lottie.host/54b33864-47d1-4f30-b38c-bc2b9bdc3892/1xkjwmUkku.json"  
                        background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop autoplay>
                    </lottie-player>
                </center>
                <br>
                <h1 class="h4">Sedang menghapus data. Proses mungkin membutuhkan beberapa detik.</h1>
                <h1 class="h4">
                    <b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b>
                </h1>
            `,
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false
        });

        setTimeout(function() {
            document.getElementById('deleteForm' + id).submit();
        }, 3000);
    }
</script>
