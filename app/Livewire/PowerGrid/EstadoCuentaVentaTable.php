<?php

namespace App\Livewire\PowerGrid;

use App\Models\EstadoCuenta;
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

final class EstadoCuentaVentaTable extends PowerGridComponent
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
        ->add('no_venta')
        ->add('fecha_venta_formatted', fn (Venta $model) => Carbon::parse($model->fecha_venta)->format('d/m/Y'))
        ->add('total_venta')
        ->add('abono_venta')
        ->add('saldo_venta')
        ->add('cliente_id',fn ($data) => e($data->cliente->nombre))
        ->add('sucursal_id')
        ->add('estado')
        ->add('cancelado')
        ->add('envio')
        ->add('en_ruta')
        ->add('entregado');
    }

    public function columns(): array
    {
        return [
            Column::make('No venta', 'no_venta')
            ->sortable()
            ->searchable(),

        Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
            ->sortable(),
        Column::make('Cliente', 'cliente_id')
            ->sortable()
            ->searchable(),

        Column::make('Total venta', 'total_venta')
            ->sortable()
            ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
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
