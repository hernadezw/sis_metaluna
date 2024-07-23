<?php

namespace App\Livewire\PowerGrid;

use App\Constantes\DataSistema;
use App\Constantes\DepartamentoMunicipio;
use App\Models\Proveedor;
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

final class ProveedorTable extends PowerGridComponent
{
    use WithExport;
    public $dep,$muni;

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
        $this->dep=DepartamentoMunicipio::$departamentos;
        $this->muni=DepartamentoMunicipio::$municipios;
        return Proveedor::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {



        return PowerGrid::fields()
            ->add('id')
            ->add('nombre')
            ->add('descripcion')
            ->add('nit')
            ->add('nombre_representante')
            ->add('telefono_principal')
            ->add('telefono_secundario')
            ->add('direccion_fisica')
            ->add('direccion_departamento', function ($dish) {
                foreach($this->dep as $value){
                    if($value['id']==$dish->direccion_departamento)
                    {
                        return $value['nombre'];
                    }
                }
            })
            ->add('direccion_municipio', function ($dish) {
                foreach($this->muni as $value){
                    if($value['id']==$dish->direccion_municipio)
                    {
                        return $value['nombre'];
                    }
                }


            })
            ->add('correo_electronico')
            ->add('estado');
/*

            ->add('traslado_fecha_formatted', fn (Traslado $model) => Carbon::parse($model->traslado_fecha)->format('d/m/Y'))
            ->add('sucursal_origen_id',fn ($data) => e($data->sucursalorigen->nombre))
            ->add('sucursal_destino_id',fn ($data) => e($data->sucursaldestino->nombre))
            //->add('created_at');
    */
    }

    public function columns(): array
    {
        return [

            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('Descripcion', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Nit', 'nit')
                ->sortable()
                ->searchable(),

            Column::make('Nombre representante', 'nombre_representante')
                ->sortable()
                ->searchable(),

            Column::make('Telefono principal', 'telefono_principal')
                ->sortable()
                ->searchable(),

            Column::make('Telefono secundario', 'telefono_secundario')
                ->sortable()
                ->searchable(),

            Column::make('Direccion fisica', 'direccion_fisica')
                ->sortable()
                ->searchable(),

            Column::make('Direccion departamento', 'direccion_departamento'),
            Column::make('Direccion municipio', 'direccion_municipio'),
            Column::make('Correo electronico', 'correo_electronico')
                ->sortable()
                ->searchable(),
         /*
            Column::make('Estado', 'estado')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

   Column::make('Created at', 'created_at')
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



    public function actions(Proveedor $row): array
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
