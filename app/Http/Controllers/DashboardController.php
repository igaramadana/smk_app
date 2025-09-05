<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use App\Models\KategoriModel;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {
        $title = 'Dashboard Admin';
        $totalDana = PembayaranModel::with('kategori')
            ->whereHas('siswa')
            ->whereHas('kategori')
            ->get()
            ->sum(function ($pembayaran) {
                return $pembayaran->kategori->nominal;
            });

        $totalSiswa = SiswaModel::count();
        $totalKategori = KategoriModel::count();

        $transaksiTerakhir = PembayaranModel::with(['siswa', 'kategori', 'petugas'])
            ->whereHas('siswa')
            ->whereHas('kategori')
            ->orderBy('tanggal_pembayaran', 'desc')
            ->take(5)
            ->get();

        // Data untuk grafik
        $tahunIni = date('Y');
        $dataBulanan = [];

        for ($i = 1; $i <= 12; $i++) {
            $total = PembayaranModel::whereHas('kategori')
                ->whereYear('tanggal_pembayaran', $tahunIni)
                ->whereMonth('tanggal_pembayaran', $i)
                ->with('kategori')
                ->get()
                ->sum(function ($pembayaran) {
                    return $pembayaran->kategori->nominal;
                });

            $dataBulanan[] = $total;
        }

        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

        return view('admin.dashboard', compact(
            'totalDana',
            'totalSiswa',
            'totalKategori',
            'transaksiTerakhir',
            'dataBulanan',
            'namaBulan',
            'tahunIni',
            'title',
        ));
    }

    public function getChartData(Request $request)
    {
        $tahun = $request->query('tahun', date('Y'));
        $dataBulanan = [];

        for ($i = 1; $i <= 12; $i++) {
            $total = PembayaranModel::whereHas('kategori')
                ->whereYear('tanggal_pembayaran', $tahun)
                ->whereMonth('tanggal_pembayaran', $i)
                ->with('kategori')
                ->get()
                ->sum(function ($pembayaran) {
                    return $pembayaran->kategori->nominal;
                });

            $dataBulanan[] = $total;
        }

        return response()->json([
            'dataBulanan' => $dataBulanan
        ]);
    }
}
