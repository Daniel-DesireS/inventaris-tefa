<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeminjamanCreateStockTest extends TestCase
{
    use RefreshDatabase;

    public function test_out_of_stock_items_are_disabled_in_create_form(): void
    {
        Peminjam::create([
            'nama_peminjam' => 'Budi',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'no_hp' => '08123456789',
        ]);

        Barang::create([
            'nama_barang' => 'Laptop',
            'kategori_barang' => 'Elektronik',
            'stok' => 0,
            'kondisi_barang' => 'Baik',
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('peminjaman.create'));

        $response->assertStatus(200);
        $response->assertSee('disabled');
    }
}
