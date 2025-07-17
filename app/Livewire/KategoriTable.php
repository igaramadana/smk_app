<?php

namespace App\Livewire;

use App\Models\KategoriModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class KategoriTable extends PowerGridComponent
{
    public string $tableName = 'kategori-table-rlhd6s-table';

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
        return KategoriModel::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_kategori')
            ->add('nominal_formatted', function (KategoriModel $model) {
                return $this->formatRupiah($model->nominal);
            })
            ->add('created_at');
    }
    private function formatRupiah($value): string
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('No')
                ->field('row_number')
                ->index(),
            Column::make('Nama kategori', 'nama_kategori')
                ->sortable()
                ->searchable(),

            Column::make('Nominal', 'nominal_formatted')
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

    public function actions(KategoriModel $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('delete')
                ->slot(view('components.delete-button-kategori', ['rowId' => $row->id])->render())
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
