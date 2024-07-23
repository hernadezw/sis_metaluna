<?php

namespace App\Livewire\PowerGrid;

use App\Models\Servicio;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

final class ServicioTable extends PowerGridComponent
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
        return Servicio::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('no_servicio')
            ->add('fecha_servicio_formatted', fn (Servicio $model) => Carbon::parse($model->fecha_servicio)->format('d/m/Y'))
            ->add('total_servicio')
            ->add('vehiculo_id',fn ($data) => e($data->vehiculo->alias))
            ->add('descripcion')
            ->add('observaciones')
            ->add('estado');
            //->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('No servicio', 'no_servicio')
                ->sortable()
                ->searchable(),

            Column::make('Fecha servicio', 'fecha_servicio_formatted', 'fecha_servicio')
                ->sortable(),

            Column::make('Total servicio', 'total_servicio')
                ->sortable()
                ->searchable(),

            Column::make('Vehiculo id', 'vehiculo_id'),
            Column::make('Descripcion', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),



            /* Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),*/

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_servicio'),
        ];
    }



    public function actions(Servicio $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->id()
                ->class('bg-green-500 hover:bg-green-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('edit', ['rowId' => $row->id]),

                Button::add('show')
                ->slot('Mostrar')
                ->id()
                ->class('bg-yellow-500 hover:bg-yellow-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('show', ['rowId' => $row->id]),

                Button::add('delete')
                ->slot('Borrar')
                ->id()
                ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('delete', ['rowId' => $row->id])
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
