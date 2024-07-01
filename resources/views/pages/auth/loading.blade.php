<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOADING AUTHENTICATION</title>
    <style>
        .spinner {
            width: 100%;
            height: 4px;
            overflow: hidden;
            background-color: #f3f3f3;
            position: relative;
            margin-top: 20px;
        }

        .spinner::before {
            content: '';
            display: block;
            position: absolute;
            width: 200%;
            height: 100%;
            background: linear-gradient(90deg, rgba(52, 152, 219, 0) 0%, rgba(52, 152, 219, 1) 50%, rgba(52, 152, 219, 0) 100%);
            animation: slide 2s linear infinite;
        }

        @keyframes slide {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .navbar-brand img {
            width: 350px;
            /* Perbesar gambar */
            height: 350px;
            /* Perbesar gambar */
            display: block;
            margin: 0 auto;
        }

        .page-center {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="page page-center">
        <div class="container container-slim py-4">
            <div class="text-center">
                <div class="mb-3">
                    <a href="." class="navbar-brand navbar-brand-autodark">
                        <img src="assets/images/ka'bah.png" alt="Logo">
                    </a>
                </div>
                <div class="text-secondary mb-3">
                    <h3 class="text-center">Sedang proses masuk halaman dashboard {{ Auth::user()->role->role }}</h3>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-indeterminate"></div>
                </div>
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('dashboard') }}";
        }, 3000);
    </script>
</body>

</html>
