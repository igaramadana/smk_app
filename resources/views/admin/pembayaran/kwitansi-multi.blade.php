{{-- filepath: e:\smk-app\resources\views\admin\pembayaran\kwitansi-multi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .kwitansi-container { max-width: 800px; margin: 0 auto; border: 2px solid #000; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .logo { height: 80px; margin-bottom: 10px; }
        .title { font-size: 24px; font-weight: bold; margin: 0; }
        .subtitle { font-size: 16px; margin: 5px 0; }
        .content { margin: 20px 0; }
        .detail { margin-bottom: 15px; }
        .detail-row { display: flex; margin-bottom: 5px; }
        .detail-label { width: 150px; font-weight: bold; }
        .detail-value { flex: 1; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; }
        .signature { text-align: center; width: 200px; }
        .signature-line { border-top: 1px solid #000; margin-top: 60px; padding-top: 5px; }
        @media print { .no-print { display: none; } body { padding: 0; } .kwitansi-container { border: none; padding: 0; } }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <div class="kwitansi-container">
        <div class="header">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah" class="logo">
            <h1 class="title">KWITANSI PEMBAYARAN</h1>
            <p class="subtitle">MADRASAH IBTIDAIYAH RAUDLATUL FALAH</p>
            <p class="subtitle">Jl. KH. Wahid Hasyim No.42, Madyorenggo, Talok, Kec. Turen</p>
        </div>
        <div class="content">
            <div class="detail">
                <div class="detail-row">
                    <div class="detail-label">Tanggal</div>
                    <div class="detail-value">: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Telah diterima dari</div>
                    <div class="detail-value">: Orang Tua/Wali Siswa {{ $pembayarans->first()->siswa->nama_siswa }}</div>
                </div>
            </div>
            <div class="detail">
                <div class="detail-label" style="margin-bottom: 8px;">Rincian Pembayaran:</div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Bulan</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($pembayarans as $i => $pembayaran)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $pembayaran->kategori->nama_kategori }}</td>
                                <td>{{ $pembayaran->bulan_dibayar ?? '-' }}</td>
                                <td>Rp {{ number_format($pembayaran->kategori->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @php $total += $pembayaran->kategori->nominal; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right;">Total</th>
                            <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="footer">
            <div></div>
            <div class="signature">
                <div>{{ \Carbon\Carbon::now()->format('d F Y') }}</div>
                <div>Petugas,</div>
                <div class="signature-line"></div>
                <div>{{ $pembayarans->first()->petugas->nama_lengkap }}</div>
            </div>
        </div>
    </div>
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Cetak Kwitansi
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
            Tutup
        </button>
    </div>
    <script>
        window.onload = function() {
            @if(session('print'))
                setTimeout(function() {
                    window.print();
                    setTimeout(function() {
                        window.location.href = "{{ route('pembayaran.index') }}";
                    }, 1000);
                }, 500);
            @endif
        };
        window.onafterprint = function() {
            window.location.href = "{{ route('pembayaran.index') }}";
        };
    </script>
</body>
</html>