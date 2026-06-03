<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    // Menampilkan daftar barang dan fitur pencarian
    public function index(Request $request)
{
    $keyword = $request->keyword;

    $barang = Barang::when($keyword, function ($query) use ($keyword) {
        return $query->where(
            'nama_barang',
            'like',
            '%' . $keyword . '%'
        )
        ->orWhere(
            'kategori_barang',
            'like',
            '%' . $keyword . '%'
        );
         })->get();

        return view(
            'barang.index',
            compact('barang')
        );
    }

    // Menampilkan halaman form tambah barang
    public function create()
    {
        return view('barang.create');
    }

    // Menyimpan data barang baru ke database
    public function store(Request $request)
    {
    $request->validate([
        'nama_barang'=>'required',
        'kategori_barang'=>'required',
        'stok'=>'required|integer|min:0',
        'kondisi_barang'=>'required',
        'foto'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $foto = null;

    if($request->hasFile('foto')){
        $foto = $request->file('foto')
            ->store('barang','public');
    }

    Barang::create([
        'nama_barang'=>$request->nama_barang,
        'kategori_barang'=>$request->kategori_barang,
        'stok'=>$request->stok,
        'kondisi_barang'=>$request->kondisi_barang,
        'foto'=>$foto
    ]);

    return redirect()
        ->route('barang.index')
        ->with('success','Barang berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    // Menampilkan halaman form edit barang
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.edit', compact('barang'));
    }

    // Memperbarui data barang yang sudah ada
    public function update(Request $request, $id)
    {
    $barang = Barang::findOrFail($id);

    $request->validate([
        'nama_barang'=>'required',
        'kategori_barang'=>'required',
        'stok'=>'required|integer|min:0',
        'kondisi_barang'=>'required',
        'foto'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $foto = $barang->foto;

    if($request->hasFile('foto')){
        $foto = $request->file('foto')
            ->store('barang','public');
    }

    $barang->update([
        'nama_barang'=>$request->nama_barang,
        'kategori_barang'=>$request->kategori_barang,
        'stok'=>$request->stok,
        'kondisi_barang'=>$request->kondisi_barang,
        'foto'=>$foto
    ]);

    return redirect()
        ->route('barang.index')
        ->with('success','Barang berhasil diubah');
    }

    // Menghapus barang dari database dan memberi notifikasi
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->peminjaman()->exists()) {
            return redirect()
                ->route('barang.index')
                ->with('error', 'Barang tidak dapat dihapus karena masih ada data peminjaman terkait.');
        }

        if ($barang->foto && file_exists(storage_path('app/public/' . $barang->foto))) {
            unlink(storage_path('app/public/' . $barang->foto));
        }

        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
