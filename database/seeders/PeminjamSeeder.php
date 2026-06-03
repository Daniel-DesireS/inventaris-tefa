<?php

namespace Database\Seeders;

use App\Models\Peminjam;
use Illuminate\Database\Seeder;

class PeminjamSeeder extends Seeder
{
    // Mengisi data awal daftar peminjam
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Peminjam::create([
            'nama_peminjam'=>'Ahmad Fauzan',
            'kelas'=>'XI',
            'jurusan'=>'PPLG 1',
            'no_hp'=>'08123456789'
        ]);

        Peminjam::create([
            'nama_peminjam'=>'Rizky Pratama',
            'kelas'=>'XI',
            'jurusan'=>'PPLG 2',
            'no_hp'=>'089255677777'
        ]);

        Peminjam::create([
            'nama_peminjam'=>'Dinda Putri',
            'kelas'=>'XI',
            'jurusan'=>'PPLG 1',
            'no_hp'=>'083224023011'
        ]);
    }
}
