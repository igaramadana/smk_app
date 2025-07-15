<?php

namespace App\Livewire;

use App\Models\KelasModel;
use App\Models\SiswaModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class SiswaTable extends PowerGridComponent
{
    public string $tableName = 'siswa-table-suqcl9-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return SiswaModel::query()->with('kelas');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nis')
            ->add('nama_siswa')
            ->add('nama_kelas', fn(SiswaModel $model) => $model->kelas->nama_kelas ?? 'Kelas tidak tersedia')
            ->add('jenis_kelamin', fn(SiswaModel $model) => $model->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan')
            ->add('alamat')
            ->add('no_wa');
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('No')
                ->field('row_number')
                ->index(),
            Column::make('Nis', 'nis')
                ->sortable()
                ->searchable(),

            Column::make('Nama Siswa', 'nama_siswa')
                ->sortable()
                ->searchable(),

            Column::make('Kelas', 'nama_kelas')
                ->sortable()
                ->searchable(),

            Column::make('Jenis kelamin', 'jenis_kelamin')
                ->sortable()
                ->searchable(),

            Column::make('Alamat', 'alamat')
                ->sortable()
                ->searchable(),

            Column::make('No wa', 'no_wa')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(SiswaModel $row): array
    {
        $kelas = KelasModel::all(); // Tambahkan ini

        return [
            Button::add('edit')
                ->slot(view('components.edit-button-siswa', [
                    'siswa_id' => $row->id,
                    'nis' => $row->nis,
                    'nama_siswa' => $row->nama_siswa,
                    'id_kelas' => $row->id_kelas, // Pastikan ini ada
                    'kelas' => $kelas, // Tambahkan ini
                    'jenis_kelamin' => $row->jenis_kelamin,
                    'alamat' => $row->alamat,
                    'no_wa' => $row->no_wa
                ])->render()),
            Button::add('delete')
                ->slot(view('components.delete-button-siswa', ['siswa_id' => $row->id])->render())
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
