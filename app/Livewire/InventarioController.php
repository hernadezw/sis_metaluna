<?php

namespace App\Livewire;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;



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

    protected $listeners=['edit', 'delete','show','pdfExportar'];

    public function render()
    {

        return view('livewire.pages.inventario.index');


    }

    public function pdfExportar(){
        return redirect()->route('pdfExportarInventario');
    }

    public function pdfExportarInventario()
    {

        $sucursal=Sucursal::with('Productos')->find(Auth::user()->sucursal_id);
        $productos=$sucursal->productos;

        //dd($productos);
        $pdf = FacadePdf::loadView('/livewire/pdf/pdfInventario ',['productos'=>$productos,'sucursal'=>$sucursal]);
        return $pdf->stream();

    }






}
