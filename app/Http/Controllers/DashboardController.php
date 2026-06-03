<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    // Menghitung data statistik untuk ditampilkan di dashboard
    public function index()
    {
        $totalBarang = Barang::count();

        $totalPeminjaman = Peminjaman::count();

        $stokMenipis = Barang::where('stok', '<=', 3)
                             ->where('stok', '>', 0)
                             ->count();

        $stokHabis = Barang::where('stok', 0)
                           ->count();

        $barangTersedia = Barang::where('stok', '>', 0)
                                ->count();

        $dikembalikan = Peminjaman::where(
            'status_peminjaman',
            'Dikembalikan'
        )->count();

        $dipinjam = Peminjaman::where(
            'status_peminjaman',
            'Dipinjam'
        )->count();

        return view(
            'dashboard',
            compact(
                'totalBarang',
                'totalPeminjaman',
                'stokMenipis',
                'stokHabis',
                'barangTersedia',
                'dikembalikan',
                'dipinjam'
            )
        );
    }
}
