<?php

namespace App\Livewire\PowerGrid;

use App\Models\NotaCredito;
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

final class NotaCreditoTable extends PowerGridComponent
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
        return NotaCredito::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('no_nota_credito')
            ->add('venta_id')
            ->add('total_venta')
            ->add('fecha_nota_credito_formatted', fn (NotaCredito $model) => Carbon::parse($model->fecha_nota_credito)->format('d/m/Y'))
            ->add('total_nota_credito')
            ->add('anulacion_venta')
            ->add('observaciones')
            ->add('anulacion_venta')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('No nota credito', 'no_nota_credito')
                ->sortable()
                ->searchable(),

            Column::make('Venta', 'venta_id'),

            Column::make('Total venta', 'total_venta')
                ->sortable()
                ->searchable(),

            Column::make('Fecha nota credito', 'fecha_nota_credito_formatted', 'fecha_nota_credito')
                ->sortable(),

            Column::make('Total nota credito', 'total_nota_credito')
                ->sortable()
                ->searchable(),

            Column::make('Anulacion venta', 'anulacion_venta')
                ->toggleable(hasPermission: false, trueLabel: 'SI', falseLabel: 'NO')
                ->sortable(),

            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_nota_credito'),
        ];
    }



    public function actions(NotaCredito $row): array
    {
        return [
            Button::add('exportar')
            ->slot('Exportar')
            ->id()
            ->class('bg-blue-500 hover:bg-blue-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
            ->dispatch('pdfExportar',['id'  => $row->id]),

                Button::add('borrar')
                ->slot('Borrar')
                ->id()
                ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('delete',['id'=> $row->id]),


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
