<?php

namespace App\Livewire\PowerGrid;

use App\Models\Venta;
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

final class VentaTable extends PowerGridComponent
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
        return Venta::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('cliente.nombre_empresa')
            ->add('no_venta')
            ->add('fecha_venta_formatted', fn (Venta $model) => Carbon::parse($model->fecha_venta)->format('d/m/Y'))
            ->add('total_venta')
            ->add('observaciones_venta')
            ->add('forma_pago')
            ->add('efectivo')
            ->add('credito')
            ->add('total_credito')
            ->add('no_credito')
            ->add('observaciones_credito')
            ->add('anulado')
            ->add('fecha_anulado_formatted', fn (Venta $model) => Carbon::parse($model->fecha_anulado)->format('d/m/Y'))
            ->add('observaciones_anulado')
            ->add('nota_credito')
            ->add('fecha_nota_credito_formatted', fn (Venta $model) => Carbon::parse($model->fecha_nota_credito)->format('d/m/Y'))
            ->add('total_nota_credito')
            ->add('cancelado')
            ->add('fecha_cancelado_formatted', fn (Venta $model) => Carbon::parse($model->fecha_cancelado)->format('d/m/Y'))
            ->add('saldo_venta')
            ->add('visible')
            ->add('sucursal_id')
            ->add('envio')
            ->add('en_ruta')
            ->add('entregado')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('No venta', 'no_venta')
            ->sortable()
            ->searchable(),

            Column::make('Cliente id', 'cliente.nombre_empresa'),


            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
                ->sortable(),

            Column::make('Total venta', 'total_venta')
                ->sortable()
                ->searchable(),
            Column::make('Forma pago', 'forma_pago')
                ->sortable()
                ->searchable(),

                Column::make('Saldo venta', 'saldo_venta')
                ->sortable()
                ->searchable(),


            Column::make('anulado', 'anulado')
                ->toggleable(false,'si', 'no'),




            Column::make('Cancelado', 'cancelado')
                ->sortable()
                ->toggleable(false,'cancelado', 'pendiente'),

            Column::action('Action')




        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_venta'),
            Filter::datepicker('fecha_anulado'),
            Filter::datepicker('fecha_nota_credito'),
            Filter::datepicker('fecha_cancelado'),
        ];
    }



    public function actions(Venta $row): array
    {
        return [
                Button::add('exportar')
                ->slot('Exportar')
                ->id()
                ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('pdfExportar',['id'  => $row->id]),


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
