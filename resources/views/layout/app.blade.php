<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris TEFA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

{{-- Layout utama yang dipakai semua halaman aplikasi --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-black shadow">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            📦 Inventaris TEFA
        </a>

        <div class="d-flex align-items-center">

            <a href="{{ route('dashboard') }}"
               class="btn btn-secondary me-2">
                Dashboard
            </a>

            <a href="{{ route('barang.index') }}"
               class="btn btn-secondary me-2">
                Barang
            </a>

            <a href="{{ route('peminjaman.index') }}"
               class="btn btn-secondary me-3">
                Peminjaman
            </a>

            @auth

            <span class="me-3">
                {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button class="btn btn-danger">
                    Logout
                </button>

            </form>

            @endauth

        </div>

    </div>
</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card bg-secondary text-white shadow">
        <div class="card-body">

            @yield('content')

        </div>
    </div>

</div>

<img src="{{ asset('images/Roland.png') }}"
     alt="Karakter"
     style="
        position:fixed;
        bottom:0;
        right:0;
        height:270px;
        opacity:0.15;
        z-index:-1;
        pointer-events:none;
     ">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
