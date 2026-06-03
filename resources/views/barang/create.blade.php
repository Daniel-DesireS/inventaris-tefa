@extends('layout.app')

@section('content')

{{-- Form untuk menambah barang baru ke inventaris --}}

<h2>Tambah Barang</h2>

<form action="{{ route('barang.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Kategori Barang</label>
        <input type="text"
               name="kategori_barang"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number"
               name="stok"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Kondisi Barang</label>
        <input type="text"
               name="kondisi_barang"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Foto Barang</label>
        <input type="file"
               name="foto"
               class="form-control">
    </div>

    <button class="btn btn-success">
        Simpan
    </button>

</form>

@endsection
