<?php

namespace App\Livewire\PowerGrid;

use App\Models\Abono;
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

final class AbonoTable extends PowerGridComponent
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
        return Abono::query()->with('venta');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('no_abono')
            ->add('venta_id')
            ->add('venta.cliente.nombre_empresa')
            ->add('saldo_credito')
            ->add('total_saldo')
            ->add('fecha_abono')
            ->add('total_abono')
            ->add('observaciones');
    }

    public function columns(): array
    {
        return [
            Column::make('No. abono', 'no_abono')
            ->searchable(),
            Column::make('No. Venta', 'venta_id')
            ->searchable(),

            Column::make('Cliente', 'venta.cliente.nombre_empresa')
            ->searchable(),
            Column::make('Fecha abono', 'fecha_abono')
            ->sortable()
            ->searchable(),
            Column::make('Saldo credito', 'saldo_credito'),
            Column::make('Abono anticipado', 'abono_anticipado')
            ->toggleable(false,'si', 'no'),
            Column::make('Total abono', 'total_abono'),
            Column::make('Total Saldo', 'total_saldo'),
            Column::make('Observaciones', 'observaciones'),
            Column::action('Action')


            /* Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),*/

        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('fecha'),
        ];
    }

    public function actions(Abono $row): array
    {
        return [
                Button::add('exportar')
                ->slot('Exportar')
                ->id()
                ->class('bg-yellow-500 hover:bg-yellow-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('pdfExportar',['id'  => $row->id]),
                Button::add('borrar')
                ->slot('Borrar')
                ->id()
                ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
                ->dispatch('delete',['id'=> $row->id]),

        ];
    }

   /*

    public function actions(EstadoCuenta $row): array
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
