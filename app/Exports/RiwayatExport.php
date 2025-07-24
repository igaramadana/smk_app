<?php

namespace App\Exports;

use App\Models\PembayaranModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RiwayatExport implements FromQuery, WithHeadings, WithMapping
{
    protected $kategori;
    protected $bulan;

    public function __construct($kategori = null, $bulan = null)
    {
        $this->kategori = $kategori;
        $this->bulan = $bulan;
    }

    public function query()
    {
        $query = PembayaranModel::with([
            'siswa' => function ($query) {
                $query->withTrashed();
            },
            'kategori',
            'petugas'
        ])
            ->orderBy('tanggal_pembayaran', 'desc');

        if ($this->kategori) {
            $query->where('id_kategori', $this->kategori);
        }

        if ($this->bulan) {
            $query->where('bulan_dibayar', $this->bulan);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama Siswa',
            'Kategori Pembayaran',
            'Petugas',
            'Bulan Dibayar',
            'Tanggal Pembayaran',
            'Metode Pembayaran'
        ];
    }

    public function map($pembayaran): array
    {
        return [
            $pembayaran->siswa ? $pembayaran->siswa->nis : 'N/A',
            $pembayaran->siswa ? $pembayaran->siswa->nama_siswa : 'Siswa Tidak Ditemukan',
            $pembayaran->kategori ? $pembayaran->kategori->nama_kategori : 'N/A',
            $pembayaran->petugas ? $pembayaran->petugas->nama_lengkap : 'N/A',
            $pembayaran->bulan_dibayar,
            $pembayaran->tanggal_pembayaran,
            $pembayaran->metode_pembayaran,
        ];
    }
}
