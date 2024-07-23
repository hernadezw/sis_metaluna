<?php

namespace App\Livewire\PowerGrid;

use App\Models\Credito;
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

final class CreditoTable extends PowerGridComponent
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
        return Credito::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('no_credito')
            ->add('venta.no_venta')
            ->add('fecha_credito_formatted', fn (Credito $model) => Carbon::parse($model->fecha_credito)->format('d/m/Y'))
            ->add('total_credito')
            ->add('cliente.nombre_empresa')
            ->add('observaciones')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('No credito', 'no_credito')
                ->sortable()
                ->searchable(),

            Column::make('No Venta', 'venta.no_venta'),
            Column::make('Fecha credito', 'fecha_credito_formatted', 'fecha_credito')
                ->sortable(),
                Column::make('Total Credito', 'total_credito'),
            Column::make('Cliente', 'cliente.nombre_empresa'),
            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_credito'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Credito $row): array
    {
        return [
            Button::add('show')
            ->slot('Mostrar')
            ->id()
            ->class('bg-yellow-500 hover:bg-yellow-700 cursor-pointer text-white px-1 py-0.5 rounded text-sm')
            ->dispatch('show', ['rowId' => $row->id]),

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
