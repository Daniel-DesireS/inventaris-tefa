@extends('layout.app')

@section('content')

{{-- Form untuk mengubah status atau data peminjaman --}}

<h2>Edit Peminjaman</h2>

<form action="{{ route('peminjaman.update',$peminjaman->id) }}"
      method="POST">

@csrf
@method('PUT')

<div class="mb-3">
    <label>Peminjam</label>
    <select name="peminjam_id" class="form-control">
        @foreach($peminjam as $p)
            <option value="{{ $p->id }}"
                {{ old('peminjam_id', $peminjaman->peminjam_id) == $p->id ? 'selected' : '' }}>
                {{ $p->nama_peminjam }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Barang</label>
    <select name="barang_id" class="form-control">
        @foreach($barang as $b)
            <option value="{{ $b->id }}"
                {{ old('barang_id', $peminjaman->barang_id) == $b->id ? 'selected' : '' }}>
                {{ $b->nama_barang }} (Stok : {{ $b->stok }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Jumlah Pinjam</label>
    <input type="number" name="jumlah_pinjam" class="form-control"
           value="{{ old('jumlah_pinjam', $peminjaman->jumlah_pinjam) }}">
</div>

<div class="mb-3">
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" class="form-control"
           value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}">
</div>

<div class="mb-3">
    <label>Tanggal Kembali</label>
    <input type="date" name="tanggal_kembali" class="form-control"
           value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status_peminjaman" class="form-control">
        <option value="Dipinjam" {{ old('status_peminjaman', $peminjaman->status_peminjaman) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
        <option value="Dikembalikan" {{ old('status_peminjaman', $peminjaman->status_peminjaman) == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
        <option value="Terlambat" {{ old('status_peminjaman', $peminjaman->status_peminjaman) == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
    </select>
</div>

<button class="btn btn-primary">
    Update
</button>

</form>

@endsection
