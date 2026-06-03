@extends('layout.app')

@section('content')

{{-- Tampilan statistik utama untuk dashboard inventaris --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="fw-bold">
            📊 Dashboard Inventaris TEFA
        </h1>

        <p class="text-secondary">
            Monitoring Barang dan Peminjaman
        </p>
    </div>

</div>

<div class="row g-4">

    <div class="col-md-3">
        <div class="card bg-dark text-white border-0 shadow-lg">
            <div class="card-body">
                <h6 class="text-secondary">Total Barang</h6>
                <h1 class="fw-bold">{{ $totalBarang }}</h1>
                <small class="text-success">Data Inventaris</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-primary text-white border-0 shadow-lg">
            <div class="card-body">
                <h6>Total Peminjaman</h6>
                <h1 class="fw-bold">{{ $totalPeminjaman }}</h1>
                <small>Riwayat Peminjaman</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning border-0 shadow-lg">
            <div class="card-body">
                <h6>Stok Menipis</h6>
                <h1 class="fw-bold">{{ $stokMenipis }}</h1>
                <small>Segera Restock</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white border-0 shadow-lg">
            <div class="card-body">
                <h6>Stok Habis</h6>
                <h1 class="fw-bold">{{ $stokHabis }}</h1>
                <small>Tidak Tersedia</small>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mt-2">

    <div class="col-md-4">
        <div class="card bg-success text-white border-0 shadow-lg">
            <div class="card-body text-center">
                <h5>Barang Tersedia</h5>
                <h1 class="display-4 fw-bold">
                    {{ $barangTersedia }}
                </h1>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white border-0 shadow-lg">
            <div class="card-body text-center">
                <h5>Dikembalikan</h5>
                <h1 class="display-4 fw-bold">
                    {{ $dikembalikan }}
                </h1>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-secondary text-white border-0 shadow-lg">
            <div class="card-body text-center">
                <h5>Sedang Dipinjam</h5>
                <h1 class="display-4 fw-bold">
                    {{ $dipinjam }}
                </h1>
            </div>
        </div>
    </div>

</div>

<div class="card bg-dark text-white border-0 shadow-lg mt-4">

    <div class="card-header">
        📋 Ringkasan Sistem
    </div>

    <div class="card-body">

        <p>
            <strong>Total Barang :</strong>
            {{ $totalBarang }}
        </p>

        <p>
            <strong>Total Peminjaman :</strong>
            {{ $totalPeminjaman }}
        </p>

        <p>
            <strong>Barang Tersedia :</strong>
            {{ $barangTersedia }}
        </p>

        <p>
            <strong>Barang Dikembalikan :</strong>
            {{ $dikembalikan }}
        </p>

    </div>

</div>

@endsection
