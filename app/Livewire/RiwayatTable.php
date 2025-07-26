<?php

namespace App\Livewire;

use App\Models\PembayaranModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class RiwayatTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'riwayat_pembayaran_table';
    public string $primaryKey = 'pembayaran.id';
    public string $sortField = 'pembayaran.id';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput()
                ->showToggleColumns(),

            PowerGrid::footer()
                ->showPerPage(25, [10, 25, 50, 100, 250])
                ->showRecordCount(mode: 'full'),
        ];
    }

    public function datasource(): Builder
    {
        return PembayaranModel::query()
            ->join('siswa', 'pembayaran.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('kategori', 'pembayaran.id_kategori', '=', 'kategori.id')
            ->join('users', 'pembayaran.id_petugas', '=', 'users.id')
            ->select(
                'pembayaran.*',
                'siswa.nama_siswa as nama_siswa',
                'kelas.nama_kelas as nama_kelas',
                'kategori.nama_kategori as nama_kategori',
                'users.nama_lengkap as nama_petugas'
            );
    }

    public function relationSearch(): array
    {
        return [
            'siswa' => ['nama_siswa', 'nis'],
            'kelas' => ['nama_kelas'],
            'kategori' => ['nama_kategori'],
            'petugas' => ['nama_lengkap', 'email'],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_siswa')
            ->add('nama_kelas')
            ->add('nama_kategori')
            ->add('nama_petugas')
            ->add('bulan_dibayar_formatted', fn(PembayaranModel $model) => $this->formatBulan($model->bulan_dibayar))
            ->add('tanggal_pembayaran_formatted', fn(PembayaranModel $model) => Carbon::parse($model->tanggal_pembayaran)->translatedFormat('d F Y'))
            ->add('metode_pembayaran')
            ->add('nominal', fn(PembayaranModel $model) => 'Rp ' . number_format($model->kategori->nominal ?? 0, 0, ',', '.'));
    }

    protected function formatBulan($bulan)
    {
        if (empty($bulan)) {
            return '-';
        }

        if (!is_numeric($bulan)) {
            return $bulan;
        }

        $bulan = (int)$bulan;
        if ($bulan < 1 || $bulan > 12) {
            return 'Bulan tidak valid';
        }

        try {
            return Carbon::create()->month($bulan)->translatedFormat('F');
        } catch (\Exception $e) {
            return 'Bulan: ' . $bulan;
        }
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Siswa', 'nama_siswa')
                ->searchable()
                ->sortable(),

            Column::make('Kelas', 'nama_kelas')
                ->searchable()
                ->sortable(),

            Column::make('Kategori', 'nama_kategori')
                ->searchable()
                ->sortable(),

            Column::make('Petugas', 'nama_petugas')
                ->searchable()
                ->sortable(),

            Column::make('Bulan', 'bulan_dibayar_formatted', 'bulan_dibayar')
                ->sortable()
                ->searchable(),

            Column::make('Tanggal', 'tanggal_pembayaran_formatted', 'tanggal_pembayaran')
                ->sortable(),

            Column::make('Metode', 'metode_pembayaran')
                ->sortable()
                ->searchable(),

            Column::make('Nominal', 'nominal')
                ->sortable()
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('nama_siswa')->operators(['contains']),
            Filter::inputText('nama_kelas')->operators(['contains']),
            Filter::inputText('nama_kategori')->operators(['contains']),

            Filter::select('metode_pembayaran', 'metode_pembayaran')
                ->dataSource([
                    ['id' => 'tunai', 'name' => 'Tunai'],
                    ['id' => 'transfer', 'name' => 'Transfer'],
                ])
                ->optionValue('id')
                ->optionLabel('name'),

            Filter::datepicker('tanggal_pembayaran', 'tanggal_pembayaran')
                ->params([
                    'time' => false,
                ]),

            Filter::select('bulan_dibayar', 'bulan_dibayar')
                ->dataSource([
                    ['id' => '1', 'name' => 'Januari'],
                    ['id' => '2', 'name' => 'Februari'],
                    ['id' => '3', 'name' => 'Maret'],
                    ['id' => '4', 'name' => 'April'],
                    ['id' => '5', 'name' => 'Mei'],
                    ['id' => '6', 'name' => 'Juni'],
                    ['id' => '7', 'name' => 'Juli'],
                    ['id' => '8', 'name' => 'Agustus'],
                    ['id' => '9', 'name' => 'September'],
                    ['id' => '10', 'name' => 'Oktober'],
                    ['id' => '11', 'name' => 'November'],
                    ['id' => '12', 'name' => 'Desember'],
                ])
                ->optionValue('id')
                ->optionLabel('name'),
        ];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        PembayaranModel::find($rowId)->delete();
        $this->dispatch('showToast', ['type' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
