<?php

namespace App\Livewire;

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
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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
