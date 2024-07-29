<?php

namespace App\Livewire\PowerGrid;

use App\Models\Compra;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CompraTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {


        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Compra::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('compra_no')
            ->add('compra_fecha_formatted', fn (Compra $model) => Carbon::parse($model->compra_fecha)->format('d/m/Y'))
            ->add('proveedor_id',fn ($data) => e($data->proveedor->nombre))
            ->add('sucursal_id',fn ($data) => e($data->sucursal->nombre));
            //->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Compra no', 'compra_no')
                ->sortable()
                ->searchable(),

            Column::make('Compra fecha', 'compra_fecha_formatted', 'compra_fecha')
                ->sortable(),

            Column::make('Proveedor', 'proveedor_id'),
            Column::make('Sucursal', 'sucursal_id'),


            /* Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),*/

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('compra_fecha'),
        ];
    }



    public function actions(Compra $row): array
    {
        return [
                Button::add('show')
                ->slot('Mostrar')
                ->id()
                ->class('bg-yellow-500 hover:bg-yellow-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('show', ['rowId' => $row->id]),

                Button::add('exportar')
                ->slot('Exportar')
                ->id()
                ->class('bg-green-500 hover:bg-green-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('pdfExportar',['id'  => $row->id]),

                Button::add('delete')
                ->slot('Borrar')
                ->id()
                ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm ')
                ->dispatch('delete',['id'  => $row->id]),

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
