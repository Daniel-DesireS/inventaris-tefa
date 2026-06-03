@extends('layout.app')

@section('content')

{{-- Form untuk mengubah data barang yang sudah ada --}}

<h2>Edit Barang</h2>

<form action="{{ route('barang.update',$barang->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               class="form-control"
               value="{{ $barang->nama_barang }}">
    </div>

    <div class="mb-3">
        <label>Kategori Barang</label>
        <input type="text"
               name="kategori_barang"
               class="form-control"
               value="{{ $barang->kategori_barang }}">
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number"
               name="stok"
               class="form-control"
               value="{{ $barang->stok }}">
    </div>

    <div class="mb-3">
        <label>Kondisi Barang</label>
        <input type="text"
               name="kondisi_barang"
               class="form-control"
               value="{{ $barang->kondisi_barang }}">
    </div>

    <div class="mb-3">
        <label>Foto Barang</label>
        <input type="file"
               name="foto"
               class="form-control">
    </div>

    @if($barang->foto)
        <div class="mb-3">
            <img src="{{ asset('storage/'.$barang->foto) }}"
                 width="150">
        </div>
    @endif

    <button type="submit"
            class="btn btn-warning">
        Update
    </button>

    <a href="{{ route('barang.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection
