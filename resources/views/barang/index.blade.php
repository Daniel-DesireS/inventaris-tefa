@extends('layout.app')

@section('content')

{{-- Tampilan daftar barang beserta tombol aksi dan pencarian --}}

<h2>Data Barang</h2>

<a href="{{ route('barang.create') }}"
   class="btn btn-success mb-3">
   Tambah Barang
</a>

<form method="GET"
      action="{{ route('barang.index') }}"
      class="mb-3">

    <div class="input-group">
        <input type="text"
               name="keyword"
               class="form-control"
               placeholder="Cari barang..."
               value="{{ request('keyword', request('search')) }}">

        <button type="submit"
                class="btn btn-primary">
            Cari
        </button>
    </div>

</form>

<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($barang as $item)

        <tr>

            <td>{{ $item->id }}</td>

            <td>
                @if($item->foto)

                    <img src="{{ asset('storage/'.$item->foto) }}"
                         width="80"
                         height="80"
                         style="object-fit:cover;">

                @else

                    Tidak Ada Foto

                @endif
            </td>

            <td>{{ $item->nama_barang }}</td>

            <td>{{ $item->kategori_barang }}</td>

            <td>

                @if($item->stok <= 3)

                    <span class="badge bg-danger">
                        {{ $item->stok }}
                    </span>

                @else

                    {{ $item->stok }}

                @endif

            </td>

            <td>{{ $item->kondisi_barang }}</td>

            <td>

                <a href="{{ route('barang.edit',$item->id) }}"
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('barang.destroy',$item->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data?')">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>
            <td colspan="7" class="text-center">
                Data Tidak Ada
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

@endsection
