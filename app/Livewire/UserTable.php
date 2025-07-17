<?php

namespace App\Livewire;

use App\Models\UserModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'user-table-by08qt-table';

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
    public int $roleId = 2;

    public function datasource(): Builder
    {
        return UserModel::query()->where('id_role', $this->roleId);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_lengkap')
            ->add('email')
            ->add('foto_profile', fn(UserModel $model) => $model->foto_profile ? '<img src="' . asset('storage/' . $model->foto_profile) . '" alt="Foto Profile" class="rounded-full" style="max-width: 100px; max-height: 100px;">' : 'Tidak ada foto')
            ->add('id_role')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('No')
                ->field('row_number')
                ->index(),
            Column::make('Nama lengkap', 'nama_lengkap')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Foto profile', 'foto_profile'),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(UserModel $row): array
    {
        return [
            Button::add('delete')
                ->slot(view('components.delete-button-petugas', ['rowId' => $row->id])->render())
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
