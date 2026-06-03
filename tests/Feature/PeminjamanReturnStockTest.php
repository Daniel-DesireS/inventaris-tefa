<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeminjamanReturnStockTest extends TestCase
{
    use RefreshDatabase;

    public function test_returning_peminjaman_increases_barang_stock(): void
    {
        $peminjam = Peminjam::create([
            'nama_peminjam' => 'Budi',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'no_hp' => '08123456789',
        ]);

        $barang = Barang::create([
            'nama_barang' => 'Laptop',
            'kategori_barang' => 'Elektronik',
            'stok' => 3,
            'kondisi_barang' => 'Baik',
        ]);

        $peminjaman = Peminjaman::create([
            'peminjam_id' => $peminjam->id,
            'barang_id' => $barang->id,
            'tanggal_pinjam' => '2026-06-03',
            'tanggal_kembali' => '2026-06-10',
            'jumlah_pinjam' => 2,
            'status_peminjaman' => 'Dipinjam',
        ]);

        $this->actingAs(User::factory()->create())
            ->put(route('peminjaman.update', $peminjaman->id), [
            'peminjam_id' => $peminjam->id,
            'barang_id' => $barang->id,
            'tanggal_pinjam' => '2026-06-03',
            'tanggal_kembali' => '2026-06-10',
            'jumlah_pinjam' => 2,
            'status_peminjaman' => 'Dikembalikan',
        ])->assertRedirect(route('peminjaman.index'));

        $barang->refresh();
        $this->assertSame(5, $barang->stok);
    }
}
