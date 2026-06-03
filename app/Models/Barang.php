<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Kolom yang diizinkan untuk diisi saat membuat atau mengubah barang
    protected $fillable = [
    'nama_barang',
    'kategori_barang',
    'stok',
    'kondisi_barang',
    'foto'
];

public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}
}
