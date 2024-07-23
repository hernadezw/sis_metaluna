<?php

namespace App\Livewire\PowerGrid;

use App\Models\Traslado;
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

final class TrasladoTable extends PowerGridComponent
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
        return Traslado::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('traslado_no')
            ->add('traslado_fecha_formatted', fn (Traslado $model) => Carbon::parse($model->traslado_fecha)->format('d/m/Y'))
            ->add('sucursal_origen_id',fn ($data) => e($data->sucursalorigen->nombre))
            ->add('sucursal_destino_id',fn ($data) => e($data->sucursaldestino->nombre))
            ->add('estado');
            //->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('Traslado no', 'traslado_no')
                ->sortable()
                ->searchable(),

            Column::make('Traslado fecha', 'traslado_fecha_formatted', 'traslado_fecha')
                ->sortable(),

            Column::make('Origen', 'sucursal_origen_id'),
            Column::make('Destino', 'sucursal_destino_id'),

            /* Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),*/

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('traslado_fecha'),
        ];
    }



    public function actions(Traslado $row): array
    {
        return [


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
