<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangDeleteNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_barang_with_related_peminjaman_shows_error_notification(): void
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
            'stok' => 5,
            'kondisi_barang' => 'Baik',
        ]);

        Peminjaman::create([
            'peminjam_id' => $peminjam->id,
            'barang_id' => $barang->id,
            'tanggal_pinjam' => '2026-06-03',
            'tanggal_kembali' => '2026-06-10',
            'jumlah_pinjam' => 1,
            'status_peminjaman' => 'Dipinjam',
        ]);

        $response = $this->from(route('barang.index'))->delete(route('barang.destroy', $barang->id));

        $response->assertRedirect(route('barang.index'));
        $response->assertSessionHas('error', 'Barang tidak dapat dihapus karena masih ada data peminjaman terkait.');
    }
}
