<?php

namespace App\Livewire;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;



class InventarioController extends Component
{
    //

    public $existencia, $estado=1,$created_at,$updated_at, $producto_id;

    //
    public $title='Inventario';
    public $data, $id_data;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;
    public $isDelete = false;
    public $productos;

    public $dataa;

    public $products=[];
    public $producto_sucursal=[];

    public $sucursal_asignada;


    protected $rules = [
        'nombre' => 'required',
    ];

    protected $listeners=['edit', 'delete','show'];

    public function render()
    {

        return view('livewire.pages.inventario.index');

/*
        $this->productos = Producto::query()

       ->leftJoin('producto_sucursal', 'productos.id', '=', 'producto_sucursal.producto_id')
       ->leftJoin('sucursals', 'producto_sucursal.sucursal_id', '=', 'sucursals.id')
       ->select('productos.nombre as proo','productos.existencia', 'sucursals.nombre', 'producto_sucursal.cantidad',)

       ->get();

       $this->productos = Producto::query()


       ->leftJoin('producto_sucursal', 'productos.id', '=', 'producto_sucursal.producto_id')
       ->selectRaw('producto_sucursal.cantidad AS resultcantidad')
       ->selectRaw(
        DB::raw("SELECT cantidad AS canti
    FROM producto_sucursal
    WHERE producto_sucursal.producto_id=producto.id"));


    $this->productos = DB::table('productos')
            ->leftJoin('producto_sucursal', 'productos.id', '=', 'producto_sucursal.producto_id')
            ->join('sucursals', 'producto_sucursal.producto_id', '=', 'sucursals.id')
            ->select('productos.nombre','productos.existencia','sucursals.nombre as sucu','producto_sucursal.sucursal_id','producto_sucursal.cantidad')
            ->get();

    dd($this->productos->toJson());




    $this->productos = Producto::all();

    $this->producto_sucursal= DB::table('producto_sucursal')
    ->join('sucursals', 'producto_sucursal.sucursal_id', '=', 'sucursals.id')
    ->select('producto_id','sucursal_id','cantidad','nombre')
    ->get();
*/





















      //  dd($this->productos[0]);
        //$data=User::find(1);
        //$this->dataa=Sucursal::with('Productos')->where('id',1)->get()->pluck('Productos')->flatten();






        //$this->dataa=Producto::with('Sucursals')->where('id',1)->get();
        //$this->dataa=Sucursal::find(1)->productos()->get();
        //$this->sucursal_asignada=$data->sucursal->nombre;


       // dd($this->dataa);

/*

       $this->productos = Producto::query()
       ->leftJoin('producto_sucursal', 'productos.id', '=', 'producto_sucursal.producto_id')
       ->select('productos.*','producto_sucursal.cantidad')->get();


       */

       /*

       $this->productos = Producto::query()
        ->leftJoin('producto_sucursal', 'productos.id', '=', 'producto_sucursal.producto_id')
        ->select('productos.*','producto_sucursal.cantidad')
        ->groupBy('producto_sucursal.idSS')
        ->get();

*/

/*
        consulta funcionando antes de crear triger para agregar exsistencia total al registro pdocuto


        $this->productos = Producto::query()
        ->leftJoin('producto_sucursal', 'productos.id', '=', 'producto_sucursal.producto_id')
        ->select('productos.id')
        ->selectRaw('sum(producto_sucursal.cantidad) as countProduct')
        ->groupBy('productos.id')
        ->get();
*/













     //  dd($this->productos);






    }






}
