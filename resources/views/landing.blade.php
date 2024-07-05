<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-sidebar="light" data-topbar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Landing - Wadi Fatimah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />


</head>
@include('components.modal')

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    {{-- <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark"
                        height="17">
                    <img src="assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light"
                        height="17"> --}}
                        <h4>Wadi Fatimah</h4>
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link fs-15 active" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15" href="#services">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15" href="#features">Tentang</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link fs-15" href="#reviews">Review</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link fs-15" href="#contact">Kontak</a>
                        </li>
                    </ul>

                    <div class="">
                        <a href="{{ route('login') }}"
                            class="btn btn-link fw-medium text-decoration-none text-dark">Sign in</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->
        <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

        <!-- start hero section -->
        <section class="section pb-0 hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10">
                        <div class="text-center mt-lg-5 pt-5">
                            <h1 class="display-6 fw-semibold mb-3 lh-base">SISTEM INFORMASI PELAYANAN HAJI BERBASIS WEB
                                DI
                                <span class="text-danger">KELOMPOK BIMBINGAN IBADAH HAJI (KBIH)
                                    WADI FATIMAH</span>
                            </h1>
                            <p class="lead text-muted lh-base">Wadi Fatimah adalah sistem informasi berbasis web yang dirancang untuk mengelola seluruh proses pelayanan haji dan umroh, mulai dari pendaftaran hingga pelaporan perjalanan, dengan mudah dan efisien.</p>
                        </div>                        

                        <div class="mt-4 mt-sm-5 pt-sm-5 mb-sm-n5 demo-carousel">
                            <div class="demo-img-patten-top d-none d-sm-block">
                                <img src="assets/images/landing/img-pattern.png" class="d-block img-fluid"
                                    alt="...">
                            </div>
                            <div class="demo-img-patten-bottom d-none d-sm-block">
                                <img src="assets/images/landing/img-pattern.png" class="d-block img-fluid"
                                    alt="...">
                            </div>
                            <div class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner shadow-lg p-2 bg-white rounded">
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <img src="assets/images/1.png" class="d-block w-100" alt="...">
                                    </div>
                                    {{-- <div class="carousel-item" data-bs-interval="2000">
                                        <img src="assets/images/crafser.jpg" class="d-block w-100" alt="...">
                                    </div> --}}
                                    {{-- <div class="carousel-item" data-bs-interval="2000">
                                        <img src="assets/images/2.png" class="d-block w-100" alt="...">
                                    </div> --}}
                                    <div class="carousel-item" data-bs-interval="2000">
                                        <img src="assets/images/4.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2000">
                                        <img src="assets/images/3.png" class="d-block w-100" alt="...">
                                    </div>
                                    {{-- <div class="carousel-item" data-bs-interval="2000">
                                        <img src="assets/images/demos/modern.png" class="d-block w-100"
                                            alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2000">
                                        <img src="assets/images/demos/interactive.png" class="d-block w-100"
                                            alt="...">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
            <div class="position-absolute start-0 end-0 bottom-0 hero-shape-svg">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none">
                        <path d="M 0,118 C 288,98.6 1152,40.4 1440,21L1440 140L0 140z">
                        </path>
                    </g>
                </svg>
            </div>
            <!-- end shape -->
        </section>
        <!-- end hero section -->

        <!-- start client section -->
        {{-- <div class="pt-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="text-center mt-5">
                            <h5 class="fs-20">Trusted <span class="text-primary text-decoration-underline">by</span>
                                the world's best</h5>

                            <!-- Swiper -->
                            <div class="swiper trusted-client-slider mt-sm-5 mt-4 mb-sm-5 mb-4" dir="ltr">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="assets/images/clients/amazon.svg" alt="client-img"
                                                class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="assets/images/clients/walmart.svg" alt="client-img"
                                                class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="assets/images/clients/lenovo.svg" alt="client-img"
                                                class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="assets/images/clients/paypal.svg" alt="client-img"
                                                class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="assets/images/clients/shopify.svg" alt="client-img"
                                                class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="assets/images/clients/verizon.svg" alt="client-img"
                                                class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div> --}}
        <!-- end client section -->

        <!-- start services -->
        <section class="section mt-5" id="services">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-semibold lh-base">Informasi pelayanan Haji di kelompok
                                bimbingan ibadah haji KBIH Wadi Fatimah.</h1>

                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm icon-effect">
                                    <div class="avatar-title bg-transparent text-success rounded-circle">
                                        <i class="ri-pencil-ruler-2-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-18">Bimbingan di tanah air</h5>
                                <p class="text-muted my-3 ff-secondary">Bimbingan di tanah air haji adalah serangkaian
                                    kegiatan pembinaan dan persiapan yang diberikan kepada calon jemaah haji sebelum
                                    mereka berangkat ke Tanah Suci.</p>
                                <div>
                                    <a href="#" class="fs-14 fw-medium" data-bs-toggle="modal"
                                        data-bs-target="#viewA">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm icon-effect">
                                    <div class="avatar-title bg-transparent text-success rounded-circle">
                                        <i class="ri-palette-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-18">Bimbingan di tanah suci</h5>
                                <p class="text-muted my-3 ff-secondary">Bimbingan haji di Tanah Suci adalah panduan
                                    yang diberikan kepada para jemaah untuk memastikan pelaksanaan ibadah haji berjalan
                                    dengan lancar dan sesuai dengan syariat Islam.</p>
                                <div>
                                    <a href="#" class="fs-14 fw-medium" data-bs-toggle="modal"
                                        data-bs-target="#viewB">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm icon-effect">
                                    <div class="avatar-title bg-transparent text-success rounded-circle">
                                        <i class="ri-lightbulb-flash-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-18">Pendampingan Ziarah di Makkah</h5>
                                <p class="text-muted my-3 ff-secondary">Pendampingan ziarah di Makkah adalah layanan
                                    yang diberikan kepada jemaah haji untuk mengunjungi tempat-tempat bersejarah dan
                                    sakral di kota Makkah dengan bimbingan dan penjelasan dari petugas yang
                                    berpengalaman.</p>
                                <div>
                                    <a href="#" class="fs-14 fw-medium" data-bs-toggle="modal"
                                        data-bs-target="#viewC">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm icon-effect">
                                    <div class="avatar-title bg-transparent text-success rounded-circle">
                                        <i class="ri-customer-service-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-18">Pendampingan Ziarah ke Madinah
                                </h5>
                                <p class="text-muted my-3 ff-secondary">Pendampingan ziarah ke Madinah adalah layanan
                                    yang diberikan kepada jemaah haji untuk mengunjungi tempat-tempat bersejarah dan
                                    sakral di kota Madinah dengan bimbingan dan penjelasan dari petugas yang
                                    berpengalaman.</p>
                                <div>
                                    <a href="#" class="fs-14 fw-medium" data-bs-toggle="modal"
                                        data-bs-target="#viewD">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end services -->

        <!-- start features -->
        <section class="section bg-light py-5" id="features">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-6 col-sm-7 mx-auto">
                        <div>
                            <img src="assets/images/landing/features/img-1.png" alt=""
                                class="img-fluid mx-auto">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-muted">
                            <div class="avatar-sm icon-effect mb-4">
                                <div class="avatar-title bg-transparent rounded-circle text-success h1">
                                    <i class="ri-collage-line fs-36"></i>
                                </div>
                            </div>
                            <h3 class="mb-3 fs-20">About Wadi Fatimah KBIH</h3>
                            <p class="mb-4 ff-secondary fs-16">Kegiatan KBIH merupakan suatu upaya pemenuhan kebutuhan
                                kepada para
                                jamaah Haji dan Umroh yang akan menjalankan dan melaksanakan, dalam
                                pelaksanaan ibadah Haji dan Umroh, akan sulit jika tidak mendapatkan bimbingan
                                dan pendampingan pada saat pelaksanaan ibadah Haji dan Umroh. Kelompok
                                Bimbingan Ibadah Haji masyarakat yang ingin melaksanakan ibadah haji dengan
                                pembimbingan ibadah. Dengan mengacu kepada Undang - undang Republik
                                Indonesia Nomor 17 Tahun 1999 tentang Penyelenggaraan Ibadah Haji
                                2
                                pembinaan terhadap jamaah haji mutlak dilakukan, yaitu kemandirian untuk
                                jamaah mewujudkan haji dalam melaksanakan ibadah haji, maka peranan KBIH
                                dalam hal ini tentunya sangat diperlukan, yaitu untuk membina dan membimbing
                                jamaah haji dalam hal pelaksanaan kegiatan ibadah haji di Tanah suci.</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end features -->

        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                {{-- <img src="assets/images/logo-light.png" alt="logo light" height="17"> --}}
                                <h4>Wadi Fatimah</h4>
                            </div>
                            <div class="mt-4 fs-13">
                                <p>Aplikasi Manajemen Pemberangkatan Haji & Umroh</p>
                                <p class="ff-secondary">Dengan Wadi Fatimah, Anda dapat mengelola proses pemberangkatan haji dan umroh dengan mudah, mulai dari pendaftaran, pengelolaan data jamaah, hingga pelaporan dan pemantauan hasil konseling anda.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-6 mt-4">
                                <h5 class="text-white mb-0">Kontak</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="#">Whatsapp</a></li>
                                        <li><a href="#">Instagram</a></li>
                                        <li><a href="#">Facebook</a></li>
                                        <li><a href="#">Web</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5 class="text-white mb-0">Menu</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="#home">Home</a></li>
                                        <li><a href="#features">Tentang</a></li>
                                        <li><a href="#services">Informasi</a></li>
                                        <li><a href="#contact">Kontak</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">

                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Velzon - Themesbrand
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-social-link">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-facebook-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-github-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-linkedin-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-google-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-dribbble-line"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->


    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- landing init -->
    <script src="assets/js/pages/landing.init.js"></script>
</body>

</html>
