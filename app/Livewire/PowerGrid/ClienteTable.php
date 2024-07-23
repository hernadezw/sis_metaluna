<?php

namespace App\Livewire\PowerGrid;

use App\Models\Cliente;
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

final class ClienteTable extends PowerGridComponent
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
        return Cliente::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('codigo_interno')
            ->add('codigo_mayorista')
            ->add('nombre_empresa')
            ->add('nombres_cliente')
            ->add('apellidos_cliente')
            ->add('cui')
            ->add('numero_patente')
            ->add('nit')
            ->add('telefono_principal')
            ->add('telefono_secundario')
            ->add('direccion_fisica')
            ->add('direccion_departamento')
            ->add('direccion_municipio')
            ->add('ubicacion_latitud')
            ->add('ubicacion_longitud')
            ->add('correo_electronico')
            ->add('descuento')
            ->add('limite_credito')
            ->add('dias_limite_credito')
            ->add('tipo_cliente')
            ->add('estado');
            //->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo Interno', 'codigo_interno')
                ->sortable()
                ->searchable(),
            Column::make('Tipo cliente', 'tipo_cliente')
                ->sortable()
                ->searchable(),
            Column::make('Codigo Mayorista', 'codigo_mayorista')
                ->sortable()
                ->searchable(),

            Column::make('Nombre empresa', 'nombre_empresa')
                ->sortable()
                ->searchable(),

            Column::make('Nombres cliente', 'nombres_cliente')
                ->sortable()
                ->searchable(),

            Column::make('Apellidos cliente', 'apellidos_cliente')
                ->sortable()
                ->searchable(),

            Column::make('Nit', 'nit')
                ->sortable()
                ->searchable(),

            Column::make('Telefono principal', 'telefono_principal')
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

            Column::make('Limite credito', 'limite_credito')
                ->sortable()
                ->searchable(),

            Column::make('Dias limite credito', 'dias_limite_credito')
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



    public function actions(Cliente $row): array
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
