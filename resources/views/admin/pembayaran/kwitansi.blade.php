<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .kwitansi-container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 20px;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .logo {
            height: 80px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .subtitle {
            font-size: 16px;
            margin: 5px 0;
        }

        .content {
            margin: 20px 0;
        }

        .detail {
            margin-bottom: 15px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 5px;
        }

        .detail-label {
            width: 150px;
            font-weight: bold;
        }

        .detail-value {
            flex: 1;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 60px;
            padding-top: 5px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }

            .kwitansi-container {
                border: none;
                padding: 0;
            }
        }
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
                    <div class="detail-label">No. Kwitansi</div>
                    <div class="detail-value">: {{ $pembayaran->id }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal</div>
                    <div class="detail-value">: {{
                        \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y') }}</div>
                </div>
            </div>

            <div class="detail">
                <div class="detail-row">
                    <div class="detail-label">Telah diterima dari</div>
                    <div class="detail-value">: Orang Tua/Wali Siswa {{ $pembayaran->siswa->nama_siswa }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Untuk pembayaran</div>
                    <div class="detail-value">: {{ $pembayaran->kategori->nama_kategori }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Bulan</div>
                    <div class="detail-value">: {{ $pembayaran->bulan_dibayar ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jumlah</div>
                    <div class="detail-value">: Rp {{ number_format($pembayaran->kategori->nominal, 0, ',', '.') }}
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Metode Pembayaran</div>
                    <div class="detail-value">: {{ $pembayaran->metode_pembayaran }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div></div>
            <div class="signature">
                <div>{{ \Carbon\Carbon::now()->format('d F Y') }}</div>
                <div>Petugas,</div>
                <div class="signature-line"></div>
                <div>{{ $pembayaran->petugas->nama_lengkap }}</div>
            </div>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()"
            style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Cetak Kwitansi
        </button>
        <button onclick="window.close()"
            style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
            Tutup
        </button>
    </div>

    <script>
        // Auto print ketika halaman loaded jika ada flag print
        window.onload = function() {
            @if(session('print'))
                setTimeout(function() {
                    window.print();
                    // Setelah print, redirect kembali setelah 1 detik
                    setTimeout(function() {
                        window.location.href = "{{ route('pembayaran.index') }}";
                    }, 1000);
                }, 500);
            @endif
        };

        // Handle ketika print selesai atau dibatalkan
        window.onafterprint = function() {
            window.location.href = "{{ route('pembayaran.index') }}";
        };
    </script>
</body>

</html>
