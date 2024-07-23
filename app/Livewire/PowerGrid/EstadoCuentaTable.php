<?php

namespace App\Livewire\PowerGrid;

use App\Models\EstadoCuenta;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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

final class EstadoCuentaTable extends PowerGridComponent
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

        return EstadoCuenta::query()
        ->select('cliente_id','total_credito','total_abono','observaciones',DB::raw('(total_credito - total_abono) as saldo'));

        /*
        return Sucursal::query()
        ->leftJoin('producto_sucursal', 'sucursals.id', '=', 'producto_sucursal.sucursal_id')
        ->leftJoin('productos', 'productos.id', '=', 'producto_sucursal.producto_id')

        ->with('Productos')
        ->join('marcas', function ($data) {
            $data->on('productos.marca_id', '=', 'marcas.id');
        })
        ->select('productos.*','producto_sucursal.cantidad','marcas.nombre');
        dd( Producto::query()
        ->leftJoin('producto_sucursal', 'producto.id', '=', 'producto_sucursal.producto_id')

        ->select('productos.*')
        ->get());
*/
       /*
        return Inventario::query()
        ->leftjoin('productos', function ($productos) {
            $productos->on('inventarios.producto_id','=','productos.id');
        })
        ->select(['productos.id','productos.codigo','productos.nombre','inventarios.cantidad','inventarios.sucursal_id']);
    }else{
        return Inventario::where('sucursal_id',Auth::user()->sucursal_id)
        ->leftjoin('productos', function ($productos) {
            $productos->on('inventarios.producto_id','=','productos.id');
        })
        ->select(['productos.id','productos.codigo','productos.nombre','inventarios.cantidad','inventarios.sucursal_id']);
    }

    */
    //return ;
    //$data=Sucursal::find($this->sucur)->productos()->where('id',$values)->get();

    //$this->cantidad_existencia=$data[0]->invent->cantidad;

    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('cliente.codigo')
            ->add('cliente.nombre_empresa')
            ->add('total_abono')
            ->add('cliente.dias_limite_credito')
            ->add('total_credito')
            ->add('observacion')
            ->add('saldo');
                     //->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo Cliente', 'cliente.codigo'),
            Column::make('Nombre Cliente', 'cliente.nombre_empresa'),
            Column::make('Total abono', 'total_abono'),
            Column::make('Total credito', 'total_credito'),
            Column::make('Dias Limite Credito', 'cliente.dias_limite_credito'),
            Column::make('Observacion', 'observacion'),
            Column::make('saldo', 'saldo'),


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
