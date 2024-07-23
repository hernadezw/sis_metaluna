<?php

namespace App\Livewire\PowerGrid;

use App\Constantes\VehiculoData;
use App\Models\Vehiculo;
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

final class VehiculoTable extends PowerGridComponent
{
    use WithExport;
    public $tipo_vehiculo,$tipo_placa,$marca,$modelo;

    public function setUp(): array
    {

        $this->tipo_vehiculo=VehiculoData::$tipo_vehiculo;
        $this->tipo_placa=VehiculoData::$tipo_placa;
        $this->marca=VehiculoData::$marca_vehiculo;
        $this->modelo=VehiculoData::$modelo_vehiculo;
;


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
        return Vehiculo::query();
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
            ->add('tipo_vehiculo', function ($data) {
                foreach($this->tipo_vehiculo as $value){
                    if($value['id']==$data->tipo_vehiculo)
                    {
                        return $value['nombre'];
                    }
                }
            })
            ->add('tipo_placa', function ($data) {
                foreach($this->tipo_placa as $value){
                    if($value['id']==$data->tipo_placa)
                    {
                        return $value['valor'];
                    }
                }
            })
            ->add('numero_placa')
            ->add('marca', function ($data) {
                foreach($this->marca as $value){
                    if($value['id']==$data->marca)
                    {
                        return $value['nombre'];
                    }
                }
            })
            ->add('modelo', function ($data) {
                foreach($this->modelo as $value){
                    if($value['id']==$data->modelo)
                    {
                        return $value['nombre'];
                    }
                }
            })
            ->add('linea')
            ->add('alias')
            ->add('estado');
            //->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('Codigo', 'codigo')
                ->sortable()
                ->searchable(),

            Column::make('Tipo vehiculo', 'tipo_vehiculo')
                ->sortable()
                ->searchable(),

            Column::make('Tipo placa', 'tipo_placa')
                ->sortable()
                ->searchable(),

            Column::make('Numero placa', 'numero_placa')
                ->sortable()
                ->searchable(),

            Column::make('Marca', 'marca')
                ->sortable()
                ->searchable(),

            Column::make('Modelo', 'modelo')
                ->sortable()
                ->searchable(),

            Column::make('Linea', 'linea')
                ->sortable()
                ->searchable(),

            Column::make('Alias', 'alias')
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
        ];
    }



    public function actions(Vehiculo $row): array
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
