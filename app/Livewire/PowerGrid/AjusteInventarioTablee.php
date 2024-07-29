<?php

namespace App\Livewire\PowerGrid;

use App\Models\AjusteInventario;
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

final class AjusteInventarioTablee extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

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
        return AjusteInventario::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('ajuste_inventario_no')
            ->add('sucursal_id',fn ($data) => e($data->sucursal->nombre))
            ->add('producto_id',fn ($data) => e($data->producto->nombre))
            ->add('fecha_ajuste_inventario')
            ->add('tipo_ajuste')
            ->add('descripcion')
            ->add('cantidad_traslado')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('No Ajuste', 'ajuste_inventario_no'),
            Column::make('Sucursal', 'sucursal_id'),
            Column::make('Producto', 'producto_id'),
            Column::make('Tipo ajuste', 'tipo_ajuste')
                ->sortable()
                ->searchable(),

            Column::make('Descripcion', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Cantidad', 'cantidad_traslado')
                ->sortable()
                ->searchable(),
                Column::make('Fecha', 'fecha_ajuste_inventario')
                ->sortable()
                ->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_ajuste_inventario'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(AjusteInventario $row): array
    {
        return [
            Button::add('show')
            ->slot('Mostrar')
            ->id()
            ->class('bg-yellow-500 hover:bg-yellow-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
            ->dispatch('show', ['rowId' => $row->id]),

            Button::add('delete')
            ->slot('Borrar')
            ->id()
            ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
            ->dispatch('delete', ['rowId' => $row->id]),

            Button::add('exportar')
            ->slot('Exportar')
            ->id()
            ->class('bg-green-500 hover:bg-green-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
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
