<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .search {
            margin-bottom: auto;
            margin-top: 10px;
            margin-bottom: 10px;
            height: 50px;
            background-color: #fff;
            padding: 11px;
            border: gray 1px solid;
            border-radius: 30px;
        }

        .search-input {

            color: gray;
            border: 0;
            outline: 0;
            background: none;
            width: 0;
            caret-color: transparent;
            line-height: 20px;
            transition: width 0.4s linear;

        }

        .search .search-input {
            padding: 0 15px;
            width: 400px;
            caret-color: #536bf6;
            font-size: 21px;
            font-weight: 100;
            color: black;
            transition: width 0.4s linear;
        }

        .search-icon:hover {
            background: #1A237E;
            color: #fff;
        }

        .search-icon {

            height: 45px;
            width: 50px;
            float: right;
            margin-top: 14px;
            margin-left: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background-color: #536bf6;
            border-radius: 30px;    
            border: none;

        }

        a:link {
            text-decoration: none;
        }

        .nav-button {
            margin: 0.25rem;
            transition: 0.3s ease;
            border-radius: 0.5rem;
            padding: 10px 16px;
            font-weight: 500;
        }

        .nav-button:hover {
            transform: scale(1.05);
            background-color: #0056b3;
            color: white;
        }

        .nav-button.active {
            background-color: #0069d9 !important;
            color: white !important;
            border-color: #0069d9 !important;
        }

        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Centered Navigation Buttons -->
                    <div class="mx-auto justify-content-center">
                        <a href="{{ route('home') }}"
                            class="btn nav-button {{ request()->routeIs('home') ? 'active' : 'btn-outline-light' }}">
                            <i class="fa-solid fa-house"></i> Beranda
                        </a>
                        @if (Auth::check() && Auth::user()->peran == 'admin')
                            <a href="{{ route('user') }}"
                                class="btn nav-button {{ request()->routeIs('user') ? 'active' : 'btn-outline-light' }}">
                                <i class="fa-solid fa-user"></i> Pengguna
                            </a>
                        @endif
                        <a href="{{ route('produk') }}"
                            class="btn nav-button {{ request()->routeIs('produk') ? 'active' : 'btn-outline-light' }}">
                            <i class="fa-solid fa-box"></i> Produk
                        </a>
                        <a href="{{ route('transaksi') }}"
                            class="btn nav-button {{ request()->routeIs('transaksi') ? 'active' : 'btn-outline-light' }}">
                            <i class="fa-solid fa-cart-shopping"></i> Transaksi
                        </a>
                        <a href="{{ route('laporan') }}"
                            class="btn nav-button {{ request()->routeIs('laporan') ? 'active' : 'btn-outline-light' }}">
                            <i class="fa-solid fa-book"></i> Laporan
                        </a>
                    </div>
                </div>


                <!-- Right Side Auth Links -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
    </div>
    </nav>

    <main class="py-4">
        <div class="container">
            {{ $slot }}
        </div>
    </main>
    </div>
</body>

</html>
