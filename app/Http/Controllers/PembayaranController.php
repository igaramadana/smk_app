<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
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
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id',
            'id_siswa' => 'required|exists:siswa,id',
            'id_kategori' => 'required|exists:kategori,id',
            'bulan_dibayar' => 'string|max:20',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        $tanggal = \DateTime::createFromFormat('d/m/Y', $request->tanggal_pembayaran);
        $tanggal_formatted = $tanggal->format('Y-m-d');

        DB::beginTransaction();
        try {
            $pembayaran = PembayaranModel::create([
                'id_siswa' => $request->id_siswa,
                'id_kategori' => $request->id_kategori,
                'id_petugas' => auth()->user()->id,
                'bulan_dibayar' => $request->bulan_dibayar,
                'tanggal_pembayaran' => $tanggal_formatted,
                'metode_pembayaran' => $request->metode_pembayaran,
            ]);

            $siswa = SiswaModel::find($request->id_siswa);
            $kategori = KategoriModel::find($request->id_kategori);

            if ($siswa->no_wa) {
                $message = "Halo orang tua/wali dari {$siswa->nama_siswa},\n\n"
                    . "Pembayaran {$kategori->nama_kategori} untuk bulan {$request->bulan_dibayar} "
                    . "sebesar Rp " . number_format($kategori->nominal, 0, ',', '.') . " "
                    . "telah berhasil diterima pada tanggal {$request->tanggal_pembayaran}.\n\n"
                    . "Metode Pembayaran: {$request->metode_pembayaran}\n"
                    . "Petugas: " . auth()->user()->nama_lengkap . "\n\n"
                    . "Terima kasih.";

                $this->fonnteService->sendMessage($siswa->no_wa, $message);
            }

            DB::commit();

            // Simpan ID pembayaran dalam session untuk dicetak
            return redirect()->route('pembayaran.kwitansi', $pembayaran->id)
                ->with('print', true); // Flag untuk auto print

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menyimpan pembayaran. Error: ' . $e->getMessage());
        }
    }

    public function kwitansi($id)
    {
        $pembayaran = PembayaranModel::with(['siswa', 'kategori', 'petugas'])->findOrFail($id);
        return view('admin.pembayaran.kwitansi', compact('pembayaran'));
    }
}
