<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: wheat;
            /* Warna latar belakang */
            color: #333;
            /* Warna teks */
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            margin-top: 50px;
            /* Jarak dari atas */
        }

        .title {
            font-size: 84px;
            margin-bottom: 30px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .content-text {
            background-color: #fff;
            /* Warna latar belakang konten */
            padding: 20px;
            border-radius: 8px;
            /* Sudut border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Bayangan */
            max-width: 600px;
            /* Lebar maksimum konten */
            margin: auto;
            /* Posisi tengah */
            text-align: left;
            /* Teks rata kiri */
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Spk Pemilihan Hp
            </div>

            <div class="content-text">
                <p>
                    Simple Additive Weighting (SAW) adalah salah satu metode dalam Sistem Pendukung Keputusan (SPK) yang digunakan untuk membantu pengambilan keputusan dengan cara memberikan bobot pada setiap kriteria yang ada dalam alternatif yang dievaluasi. Prosesnya melibatkan langkah-langkah berikut:
                </p>
                <p>
                    SAW sering digunakan karena kemampuannya yang sederhana dan mudah dipahami dalam menangani berbagai jenis kriteria dan alternatif.
                </p>
            </div>
        </div>
    </div>
</body>

</html>