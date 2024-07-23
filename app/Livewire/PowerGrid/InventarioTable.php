<?php

namespace App\Livewire\PowerGrid;

use App\Models\Producto;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class InventarioTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        //

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage('20')
                ->showRecordCount(),
            Detail::make()
                ->view('components.frk.details.detailInventarioTable')
                ->showCollapseIcon(),
        ];
    }

    public function datasource(): Builder
    {
        return Producto::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('codigo')
            ->add('nombre')
            ->add('descripcion')
            ->add('calibre')
            ->add('capacidad')
            ->add('peso')
            ->add('longitud')
            ->add('divisible')
            ->add('existencia')
            ->add('estado')
            ->add('marca_id',fn ($data) => e($data->marca->nombre))
            ->add('tipo_id',fn ($data) => e($data->tipo->nombre))
            ->add('material_id',fn ($data) => e($data->material->nombre));


            //->add('created_at')

            //->add('created_at');
    }

    public function columns(): array
    {
        return [
            //Column::make('Id', 'id'),
            Column::make('Codigo', 'codigo')
                ->sortable()
                ->searchable(),

            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),
/*
            Column::make('Descripcion', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Calibre', 'calibre')
                ->sortable()
                ->searchable(),

            Column::make('Capacidad', 'capacidad')
                ->sortable()
                ->searchable(),

            Column::make('Peso', 'peso')
                ->sortable()
                ->searchable(),

            Column::make('Longitud', 'longitud')
                ->sortable()
                ->searchable(),

            Column::make('Divisible', 'divisible')
                ->sortable()
                ->searchable(),
*/
            Column::make('Existencia', 'existencia')
                ->sortable(),



            Column::make('Marca', 'marca_id'),
            Column::make('Tipo', 'tipo_id'),
            Column::make('Material', 'material_id'),

            /* Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),*/

            /* Column::make('Updated at', 'updated_at_formatted', 'updated_at')
                ->sortable(),*/


            /* Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),*/
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

  /*

    public function actions(Producto $row): array
    {
        return [

            ];
    }


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
