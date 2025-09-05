<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Models\KelasModel;
use App\Models\PembayaranModel;
use App\Services\FonnteService;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }
    public function index()
    {
        $siswas = SiswaModel::orderBy('nama_siswa', 'asc')->get();
        $kategoris = KategoriModel::orderBy('nama_kategori', 'asc')->get();

        return view('admin.pembayaran.input', compact('siswas', 'kategoris'));
    }

    public function getSiswaByKelas($kelasId)
    {
        $siswas = SiswaModel::where('id_kelas', $kelasId)
            ->orderBy('nama_siswa', 'asc')
            ->get(['id', 'nama_siswa']);

        return response()->json($siswas);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'payments' => 'required|array|min:1',
            // 'payments.*.id_kelas' => 'required|exists:kelas,id',
            'payments.*.id_siswa' => 'required|exists:siswa,id',
            'payments.*.id_kategori' => 'required|exists:kategori,id',
            'payments.*.bulan_dibayar' => 'nullable|string|max:20',
            'payments.*.tanggal_pembayaran' => 'required|date',
            'payments.*.metode_pembayaran' => 'required|string|max:50',
            'id_petugas' => 'required|exists:users,id',
        ]);

        DB::beginTransaction();
        $successCount = 0;
        $errors = [];
        $lastPaymentId = null;
        $notifications = [];

        try {
            $groupedPayments = [];
            foreach ($request->payments as $payment) {
                $siswaId = $payment['id_siswa'];
                if (!isset($groupedPayments[$siswaId])) {
                    $groupedPayments[$siswaId] = [];
                }
                $groupedPayments[$siswaId][] = $payment;
            }

            foreach ($groupedPayments as $siswaId => $payments) {
                try {
                    $siswa = SiswaModel::find($siswaId);
                    $kelas = KelasModel::find($payments[0]['id_kelas']);
                    $totalPembayaran = 0;
                    $paymentDetails = [];
                    $nomorTransaksi = null;
                    $tanggalFormatted = null;
                    $metodePembayaran = null;

                    foreach ($payments as $payment) {
                        // Konversi format tanggal
                        $tanggal = \DateTime::createFromFormat('d/m/Y', $payment['tanggal_pembayaran']);
                        if (!$tanggal) {
                            throw new \Exception('Format tanggal tidak valid');
                        }
                        $tanggal_formatted = $tanggal->format('Y-m-d');

                        $existingPayment = PembayaranModel::where('id_siswa', $payment['id_siswa'])
                            ->where('id_kategori', $payment['id_kategori'])
                            ->when(!empty($payment['bulan_dibayar']), function ($query) use ($payment) {
                                return $query->where('bulan_dibayar', $payment['bulan_dibayar']);
                            })
                            ->first();

                        if ($existingPayment) {
                            throw new \Exception("Pembayaran untuk {$siswa->nama_siswa} sudah ada");
                        }

                        $pembayaran = PembayaranModel::create([
                            // 'id_kelas' => $payment['id_kelas'],
                            'id_siswa' => $payment['id_siswa'],
                            'id_kategori' => $payment['id_kategori'],
                            'id_petugas' => $request->id_petugas,
                            'bulan_dibayar' => $payment['bulan_dibayar'] ?? null,
                            'tanggal_pembayaran' => $tanggal_formatted,
                            'metode_pembayaran' => $payment['metode_pembayaran'],
                        ]);

                        $lastPaymentId = $pembayaran->id;
                        $kategori = KategoriModel::find($payment['id_kategori']);
                        $totalPembayaran += $kategori->nominal;

                        $paymentDetails[] = [
                            'nama_kategori' => $kategori->nama_kategori,
                            'bulan_dibayar' => $payment['bulan_dibayar'] ?? null,
                            'nominal' => $kategori->nominal
                        ];

                        if ($nomorTransaksi === null) {
                            $nomorTransaksi = 'MIR' . date('Ym') . str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT);
                            $tanggalFormatted = date('d-m-Y', strtotime($tanggal_formatted));
                            $metodePembayaran = $payment['metode_pembayaran'];
                        }

                        $successCount++;
                    }

                    if ($siswa->no_wa) {
                        $message = "*KOMITE MI RAUDLATUL FALAH*\n";
                        $message .= "INFORMASI PEMBAYARAN\n";
                        $message .= "===================================\n\n";
                        $message .= "Terima kasih, transaksi pembayaran anda telah kami terima, dengan rincian sebagai berikut:\n\n";
                        $message .= "*Siswa*:\n";
                        $message .= "NIS      : " . $siswa->nis . "\n";
                        $message .= "Nama  : " . $siswa->nama_siswa . "\n";
                        $message .= "Kelas   : " . $kelas->nama_kelas . "\n\n";
                        $message .= "*Transaksi*:\n";
                        $message .= "Nomor   : " . $nomorTransaksi . "\n";
                        $message .= "Tanggal : " . $tanggalFormatted . "\n";
                        $message .= "Metode : " . strtoupper($metodePembayaran) . "\n";
                        $message .= "Operator : " . auth()->user()->nama_lengkap . "\n\n";
                        $message .= "*Rincian Pembayaran*:\n";

                        foreach ($paymentDetails as $detail) {
                            $message .= "* " . $detail['nama_kategori'];
                            if (!empty($detail['bulan_dibayar'])) {
                                $message .= "(" . strtoupper($detail['bulan_dibayar']) . ") ";
                            }
                            $message .= " Rp" . number_format($detail['nominal'], 0, ',', '.') . "\n";
                        }

                        $message .= "-------------------------------------------------------\n";
                        $message .= "Total Pembayaran: Rp" . number_format($totalPembayaran, 0, ',', '.') . "\n\n";
                        $message .= "Informasi Lebih Lanjut Hubungi:\n";
                        $message .= "☎️ TESTING: 08123456789";

                        $this->fonnteService->sendMessage($siswa->no_wa, $message);
                    }
                } catch (\Exception $e) {
                    $errors[] = [
                        'siswa' => $siswa ? $siswa->nama_siswa : 'Unknown',
                        'error' => $e->getMessage()
                    ];
                    continue;
                }
            }

            if ($successCount === 0) {
                throw new \Exception("Tidak ada pembayaran yang berhasil disimpan");
            }

            DB::commit();

            $redirect = redirect();

            if ($successCount === 1 && count($errors) === 0) {
                $redirect = $redirect->route('pembayaran.kwitansi', $lastPaymentId)
                    ->with('print', true);
            } else {
                $redirect = $redirect->route('pembayaran.index');
            }

            return $redirect->with('success', "Berhasil menyimpan $successCount pembayaran.")
                ->with('errors', $errors);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menyimpan pembayaran. Error: ' . $e->getMessage())
                ->with('validation_errors', $errors);
        }
    }

    public function getBulanTerbayar($siswaId, $kategoriId)
    {
        $bulanTerbayar = PembayaranModel::where('id_siswa', $siswaId)
            ->where('id_kategori', $kategoriId)
            ->whereNotNull('bulan_dibayar')
            ->pluck('bulan_dibayar')
            ->toArray();

        return response()->json($bulanTerbayar);
    }

    public function getBulanBelumTerbayar($siswaId, $kategoriId)
    {
        $allBulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $sudahDibayar = PembayaranModel::where('id_siswa', $siswaId)
            ->where('id_kategori', $kategoriId)
            ->whereNotNull('bulan_dibayar')
            ->pluck('bulan_dibayar')
            ->toArray();

        $belumDibayar = array_values(array_diff($allBulan, $sudahDibayar));

        return response()->json($belumDibayar);
    }

    public function kwitansi($id)
    {
        $pembayaran = PembayaranModel::with(['siswa', 'kategori', 'petugas'])->findOrFail($id);
        return view('admin.pembayaran.kwitansi', compact('pembayaran'));
    }
}
