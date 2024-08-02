<?php

namespace App\Livewire\PowerGrid;

use App\Models\Envio;
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

final class EnvioTable extends PowerGridComponent
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
        return Envio::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('envio_no')
            ->add('envio_fecha_formatted', fn (Envio $model) => Carbon::parse($model->envio_fecha)->format('d/m/Y'))
            ->add('ruta_id')
            ->add('ruta.codigo')
            ->add('ruta.nombre')
            ->add('proceso_id')
            ->add('proceso_nombre')
            ->add('estado_envio')
            ->add('estado_nombre')
            ->add('estado_fecha')
            ->add('estado_observacion')
            ->add('user_id_created_at')
            ->add('user_name_created_at')
            ->add('observaciones_inicio_envio')
            ->add('observaciones_fin_envio')
            ->add('visible')
            ->add('finalizado');
            //->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Envio no', 'envio_no')
                ->sortable()
                ->searchable(),

            Column::make('Envio fecha', 'envio_fecha_formatted', 'envio_fecha')
                ->sortable(),

                Column::make('Estado Envio',  'estado_envio')
                ->sortable(),

                Column::make('Ruta Codigo', 'ruta.codigo'),
                Column::make('Ruta Nombre', 'ruta.nombre'),






            /* Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),*/

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('envio_fecha'),
        ];
    }



    public function actions(Envio $row): array
    {
        return [


                Button::add('finalizar')
                ->slot('Finalizar')
                ->id()
                ->class('bg-orange-500 hover:bg-orange-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('finalizar',['id'  => $row->id]),

                Button::add('exportar')
                ->slot('Exportar')
                ->id()
                ->class('bg-blue-500 hover:bg-blue-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('pdfExportar',['id'  => $row->id]),

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
