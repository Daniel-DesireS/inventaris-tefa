<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    // Mengisi data awal transaksi peminjaman contoh
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Peminjaman::create([
            'peminjam_id'=>1,
            'barang_id'=>1,
            'tanggal_pinjam'=>now(),
            'tanggal_kembali'=>now()->addDays(3),
            'jumlah_pinjam'=>1,
            'status_peminjaman'=>'Dipinjam'
        ]);
    }
}
