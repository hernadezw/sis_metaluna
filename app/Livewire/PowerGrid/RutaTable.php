<?php

namespace App\Livewire\PowerGrid;

use App\Models\Ruta;
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

final class RutaTable extends PowerGridComponent
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
        return Ruta::query();
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
            ->add('primero_direccion_departamento')
            ->add('primero_direccion_municipio')
            ->add('segundo_direccion_departamento')
            ->add('segundo_direccion_municipio')
            ->add('tercero_direccion_departamento')
            ->add('tercero_direccion_municipio')
            ->add('cuarto_direccion_departamento')
            ->add('cuarto_direccion_municipio')
            ->add('quinto_direccion_departamento')
            ->add('quinto_direccion_municipio')
            ->add('estado');
            //->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo', 'codigo')
                ->sortable()
                ->searchable(),
            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),
            Column::make('Descripcion', 'descripcion')
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


    public function actions(Ruta $row): array
    {
        return [

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
