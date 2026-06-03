<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Peminjaman::with(['peminjam', 'barang'])->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'peminjam' => $item->peminjam->nama_peminjam ?? '-',
                'barang' => $item->barang->nama_barang ?? '-',
                'jumlah_pinjam' => $item->jumlah_pinjam,
                'tanggal_pinjam' => $item->tanggal_pinjam,
                'tanggal_kembali' => $item->tanggal_kembali,
                'status_peminjaman' => $item->status_peminjaman,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Peminjam',
            'Barang',
            'Jumlah',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }
}
