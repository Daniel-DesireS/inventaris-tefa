@extends('layout.app')

@section('content')

{{-- Form untuk membuat transaksi peminjaman baru --}}

<h2>Tambah Peminjaman</h2>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('peminjaman.store') }}"
      method="POST">

@csrf

<div class="mb-3">
    <label>Peminjam</label>

    <select name="peminjam_id"
            class="form-control">

        @foreach($peminjam as $p)

        <option value="{{ $p->id }}">
            {{ $p->nama_peminjam }}
        </option>

        @endforeach

    </select>
</div>

<div class="mb-3">
    <label>Barang</label>

    <select name="barang_id"
            class="form-control">

        @foreach($barang as $b)

        <option value="{{ $b->id }}">
            {{ $b->nama_barang }}
            (Stok : {{ $b->stok }})
        </option>

        @endforeach

    </select>
</div>

<div class="mb-3">
    <label>Jumlah Pinjam</label>

    <input type="number"
           name="jumlah_pinjam"
           class="form-control">
</div>

<div class="mb-3">
    <label>Tanggal Pinjam</label>

    <input type="date"
           name="tanggal_pinjam"
           class="form-control">
</div>

<div class="mb-3">
    <label>Tanggal Kembali</label>

    <input type="date"
           name="tanggal_kembali"
           class="form-control">
</div>

<div class="mb-3">
    <label>Status</label>

    <select name="status_peminjaman"
            class="form-control">

        <option value="Dipinjam">
            Dipinjam
        </option>

        <option value="Dikembalikan">
            Dikembalikan
        </option>

        <option value="Terlambat">
            Terlambat
        </option>

    </select>

</div>

<button class="btn btn-success">
    Simpan
</button>

</form>

@endsection
