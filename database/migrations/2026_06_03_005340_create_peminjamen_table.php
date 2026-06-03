<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {

            $table->id();

            $table->foreignId('peminjam_id')
                ->constrained('peminjams');

            $table->foreignId('barang_id')
                ->constrained('barangs');

            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');

            $table->integer('jumlah_pinjam');

            $table->enum('status_peminjaman',[
                'Dipinjam',
                'Dikembalikan',
                'Terlambat'
        ]);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
