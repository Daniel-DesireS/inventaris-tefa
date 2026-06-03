@extends('layout.app')

@section('content')

{{-- Tampilan daftar peminjaman, filter, dan tombol aksi --}}

<div class="container">

<h2>Data Peminjaman Inventaris TEFA</h2>

<a href="{{ route('peminjaman.create') }}"
   class="btn btn-success mb-3">
    Tambah Peminjaman
</a>

<form method="GET"
      action="{{ route('peminjaman.index') }}">

<div class="row mb-3">

<div class="col-md-4">

<input type="text"
       name="keyword"
       class="form-control"
       placeholder="Cari peminjam atau barang"
       value="{{ request('keyword') }}">

</div>

<div class="col-md-3">

<select name="status"
        class="form-control">

<option value="">
Semua Status
</option>

<option value="Dipinjam"
{{ request('status')=='Dipinjam' ? 'selected' : '' }}>
Dipinjam
</option>

<option value="Dikembalikan"
{{ request('status')=='Dikembalikan' ? 'selected' : '' }}>
Dikembalikan
</option>

<option value="Terlambat"
{{ request('status')=='Terlambat' ? 'selected' : '' }}>
Terlambat
</option>

</select>

</div>

<div class="col-md-2">

<button type="submit"
        class="btn btn-primary">
Cari
</button>

</div>

<div class="col-md-2">

<a href="{{ route('peminjaman.index') }}"
   class="btn btn-secondary">
Reset
</a>

</div>

</div>

</form>

<table class="table table-bordered">

<thead>

<tr>
    <th>ID</th>
    <th>Nama Peminjam</th>
    <th>Barang</th>
    <th>Jumlah</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

</thead>

<tbody>

@forelse($peminjaman as $item)

<tr>

<td>{{ $item->id }}</td>

<td>{{ $item->peminjam->nama_peminjam }}</td>

<td>{{ $item->barang->nama_barang }}</td>

<td>{{ $item->jumlah_pinjam }}</td>

<td>{{ $item->tanggal_pinjam }}</td>

<td>{{ $item->tanggal_kembali }}</td>

<td>

@if($item->status_peminjaman == 'Dipinjam')

<span class="badge bg-primary">
Dipinjam
</span>

@elseif($item->status_peminjaman == 'Dikembalikan')

<span class="badge bg-success">
Dikembalikan
</span>

@else

<span class="badge bg-danger">
Terlambat
</span>

@endif

</td>

<td>

<a href="{{ route('peminjaman.edit',$item->id) }}"
   class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('peminjaman.destroy',$item->id) }}"
      method="POST"
      style="display:inline">

@csrf
@method('DELETE')

<button type="submit"
        class="btn btn-danger btn-sm"
        onclick="return confirm('Yakin hapus data?')">
Hapus
</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="8" class="text-center">

Data tidak ditemukan

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection
