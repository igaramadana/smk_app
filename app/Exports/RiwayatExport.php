<?php

namespace App\Exports;

use App\Models\PembayaranModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class RiwayatExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle, WithEvents
{
    protected $kategori;
    protected $bulan;
    protected $title;
    protected $totalNominal = 0;

    public function __construct($kategori = null, $bulan = null, $title = 'Laporan Pembayaran')
    {
        $this->kategori = $kategori;
        $this->bulan = $bulan;
        $this->title = $title;
    }

    public function query()
    {
        $query = PembayaranModel::with([
            'siswa' => function ($query) {
                $query->withTrashed()->with('kelas');
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

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        return [
            ['LAPORAN PEMBAYARAN SPP'],
            [''],
            [
                'NO',
                'NIS',
                'NAMA SISWA',
                'KELAS',
                'KATEGORI PEMBAYARAN',
                'NOMINAL',
                'PETUGAS',
                'BULAN DIBAYAR',
                'TANGGAL PEMBAYARAN',
                'METODE PEMBAYARAN'
            ]
        ];
    }

    public function map($pembayaran): array
    {
        static $i = 1;
        $nominal = $pembayaran->kategori ? $pembayaran->kategori->nominal : 0;
        $this->totalNominal += $nominal;

        return [
            $i++,
            $pembayaran->siswa ? $pembayaran->siswa->nis : 'N/A',
            $pembayaran->siswa ? $pembayaran->siswa->nama_siswa : 'Siswa Tidak Ditemukan',
            $pembayaran->siswa && $pembayaran->siswa->kelas ? $pembayaran->siswa->kelas->nama_kelas : 'N/A',
            $pembayaran->kategori ? $pembayaran->kategori->nama_kategori : 'N/A',
            $nominal,
            $pembayaran->petugas ? $pembayaran->petugas->nama_lengkap : 'N/A',
            $pembayaran->bulan_dibayar ? Carbon::create()->month($pembayaran->bulan_dibayar)->translatedFormat('F') : '-',
            Carbon::parse($pembayaran->tanggal_pembayaran)->translatedFormat('d F Y'),
            ucfirst($pembayaran->metode_pembayaran),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $totalRow = $lastRow + 1;

        // Merge judul laporan
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');

        // Styling judul laporan
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A3:J3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Styling data
        $sheet->getStyle('A4:J' . $lastRow)
            ->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);

        // Format currency untuk kolom nominal (menggunakan format custom untuk Rupiah)
        $sheet->getStyle('F4:F' . $lastRow)
            ->getNumberFormat()
            ->setFormatCode('"Rp"#,##0.00;[Red]"Rp"-#,##0.00');

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(15);

        // Set alignment untuk kolom tertentu
        $sheet->getStyle('A:A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B:B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F:F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('I:I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('J:J')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set wrap text
        $sheet->getStyle('A3:J' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);

        // Set row height untuk header
        $sheet->getRowDimension(3)->setRowHeight(25);

        // Tambahkan total
        $sheet->setCellValue('E' . $totalRow, 'TOTAL PEMBAYARAN');
        $sheet->mergeCells('E' . $totalRow . ':F' . $totalRow);
        $sheet->setCellValue('F' . $totalRow, $this->totalNominal);

        // Style untuk total
        $sheet->getStyle('E' . $totalRow . ':F' . $totalRow)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2F75B5'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Format currency untuk total
        $sheet->getStyle('F' . $totalRow)
            ->getNumberFormat()
            ->setFormatCode('"Rp"#,##0.00;[Red]"Rp"-#,##0.00');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Freeze pane pada header
                $event->sheet->freezePane('A4');

                // Set print setup
                $event->sheet->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0);

                // Set margin
                $event->sheet->getPageMargins()
                    ->setTop(0.5)
                    ->setRight(0.5)
                    ->setLeft(0.5)
                    ->setBottom(0.5);

                // Set header dan footer
                $event->sheet->getHeaderFooter()
                    ->setOddHeader('&C&H' . $this->title)
                    ->setOddFooter('&L&B' . $this->title . ' &RPage &P of &N');
            },
        ];
    }
}
