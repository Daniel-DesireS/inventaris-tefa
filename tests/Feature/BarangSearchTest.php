<?php

namespace Tests\Feature;

use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_barang_search_accepts_search_parameter(): void
    {
        Barang::create([
            'nama_barang' => 'Laptop Asus',
            'kategori_barang' => 'Laptop',
            'stok' => 5,
            'kondisi_barang' => 'Baik',
        ]);

        Barang::create([
            'nama_barang' => 'Mouse Logitech',
            'kategori_barang' => 'Aksesoris',
            'stok' => 10,
            'kondisi_barang' => 'Baik',
        ]);

        $response = $this->get(route('barang.index', ['search' => 'Laptop']));

        $response->assertStatus(200);
        $response->assertSee('Laptop Asus');
        $response->assertDontSee('Mouse Logitech');
    }
}
