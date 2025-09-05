<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Exports\RiwayatExport;
use App\Models\PembayaranModel;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatController extends Controller
{
    public function index()
    {
        $kategori = KategoriModel::all();
        $infaqKategoriIds = KategoriModel::where('nama_kategori', 'like', '%infaq%')->pluck('id')->toArray();

        $kategoriDropdown = $kategori->map(function ($kat) use ($infaqKategoriIds) {
            if (in_array($kat->id, $infaqKategoriIds)) {
                return null;
            }
            return $kat;
        })->filter();

        $kategoriDropdown->prepend((object)[
            'id' => 'infaq',
            'nama_kategori' => 'Infaq'
        ]);

        $bulanDibayar = PembayaranModel::select('bulan_dibayar')
            ->distinct()
            ->orderByRaw("FIELD(bulan_dibayar, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
            ->get()
            ->pluck('bulan_dibayar')
            ->toArray();

        $allBulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        return view('admin.pembayaran.riwayat', [
            'kategori' => $kategoriDropdown,
            'bulan' => $bulanDibayar,
            'allBulan' => $allBulan
        ]);
    }

    public function export(Request $request)
    {
        $kategori = $request->input('kategori');
        $bulan = $request->input('bulan');

        if ($kategori === 'infaq') {
            $kategoriIds = KategoriModel::where('nama_kategori', 'like', '%infaq%')->pluck('id')->toArray();
        } else {
            $kategoriIds = $kategori ? [$kategori] : [];
        }

        $filename = 'riwayat_pembayaran_' . now()->format('Ymd_His');
        if ($kategori) $filename .= '_kategori_' . $kategori;
        if ($bulan) $filename .= '_bulan_' . $bulan;
        $filename .= '.xlsx';

        return Excel::download(
            new RiwayatExport($kategoriIds, $bulan),
            $filename
        );
    }
}
