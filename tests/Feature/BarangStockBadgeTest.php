<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangStockBadgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_out_of_stock_items_show_habis_badge(): void
    {
        Barang::create([
            'nama_barang' => 'Laptop',
            'kategori_barang' => 'Elektronik',
            'stok' => 0,
            'kondisi_barang' => 'Baik',
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('barang.index'));

        $response->assertStatus(200);
        $response->assertSee('Stok Habis');
    }
}
