<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use App\Models\Peminjaman;
use App\Models\Peminjam;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman dengan pencarian dan filter status
    public function index(Request $request)
{
    $keyword = $request->keyword;
    $status = $request->status;

    $peminjaman = Peminjaman::with([
        'peminjam',
        'barang'
    ]);

    // Search
    if ($keyword) {
        $peminjaman->where(function($query) use ($keyword){

            $query->whereHas('peminjam', function($q) use ($keyword){
                $q->where(
                    'nama_peminjam',
                    'like',
                    "%{$keyword}%"
                );
            })

            ->orWhereHas('barang', function($q) use ($keyword){
                $q->where(
                    'nama_barang',
                    'like',
                    "%{$keyword}%"
                );
            })

            ->orWhere(
                'status_peminjaman',
                'like',
                "%{$keyword}%"
            );
        });
    }

    // Filter Status
    if ($status) {
        $peminjaman->where(
            'status_peminjaman',
            $status
        );
    }

    $peminjaman = $peminjaman->get();

    return view(
        'peminjaman.index',
        compact('peminjaman')
    );
}

    // Menampilkan halaman form tambah peminjaman
    public function create()
    {
        $peminjam = Peminjam::all();
        $barang = Barang::all();

        return view('peminjaman.create',
            compact('peminjam','barang'));
    }

    // Menyimpan data peminjaman dan mengurangi stok barang
    public function store(Request $request)
    {
        $request->validate([
            'peminjam_id'=>'required',
            'barang_id'=>'required',
            'tanggal_pinjam'=>'required',
            'tanggal_kembali'=>'required',
            'jumlah_pinjam'=>'required|integer|min:1',
            'status_peminjaman'=>'required'
        ]);

        $barang = Barang::findOrFail(
            $request->barang_id
        );

        if($request->jumlah_pinjam > $barang->stok)
        {
            return back()
                ->with('error',
                'Jumlah pinjam melebihi stok');
        }

        Peminjaman::create([
            'peminjam_id' => $request->peminjam_id,
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'status_peminjaman' => $request->status_peminjaman
        ]);

        $barang->stok -= $request->jumlah_pinjam;
        $barang->save();

        return redirect()->route('peminjaman.index')
            ->with('success','Data berhasil disimpan');
    }

    public function exportPdf()
    {
        $peminjaman = Peminjaman::with(['peminjam', 'barang'])
            ->orderBy('id', 'desc')
            ->get();

        return Pdf::loadView('peminjaman.export-pdf', compact('peminjaman'))
            ->download('laporan-peminjaman.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'laporan-peminjaman.xlsx');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjam = Peminjam::all();
        $barang = Barang::all();

        return view('peminjaman.edit',
            compact(
                'peminjaman',
                'peminjam',
                'barang'
            ));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'peminjam_id' => 'required',
            'barang_id' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'jumlah_pinjam' => 'required|integer|min:1',
            'status_peminjaman' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        if(
            $peminjaman->status_peminjaman != 'Dikembalikan'
            &&
            $request->status_peminjaman == 'Dikembalikan'
        )
        {
            $barang = Barang::find(
                $peminjaman->barang_id
            );

            $barang->stok +=
                $peminjaman->jumlah_pinjam;

            $barang->save();
        }

        $peminjaman->update([
            'peminjam_id' => $request->peminjam_id,
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'status_peminjaman' => $request->status_peminjaman
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success','Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success','Data berhasil dihapus');
    }
}
