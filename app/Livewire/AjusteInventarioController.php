<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\AjusteInventario;
use App\Models\Forma;
use App\Models\Producto;
use App\Models\ProductoSucursal;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AjusteInventarioController extends Component
{
    public $title='Ajuste Inventario';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    public $sucursales=null,$id=null;



    ////////////////////
    public $ajuste_inventario_no=null;
    public $productos,$producto_id=null, $descripcion=null, $estado=1,$cantidad_traslado=null,$tipo_ajuste=null,$sucursal_id=null;
    public $tipos_ajustes=null;
    ////////////////////


    public $fecha_ajuste_inventario=null;

    ////////////////////

    protected $listeners=['edit', 'delete','show'];

    public function render()
    {

        //dd($this->tipo_ajustes);
    ////////////////////
        return view('livewire.pages.ajuste_inventario.index');
    ////////////////////
    }

    public function create(){
        $this->tipos_ajustes=DataSistema::$tipo_ajuste_invetario;
        $data=AjusteInventario::latest()->first();

        if ( $data) {
            $this->id=$data->id+1;
            $this->ajuste_inventario_no=$this->id;

        }else{
            $this->id=1;
            $this->ajuste_inventario_no=$this->id;
        }



        $this->productos=Sucursal::find(Auth::user()->sucursal_id);
        $this->isCreate=true;
    }

    public function store(){


        $this->validate([
            'fecha_ajuste_inventario' => 'required',
            'producto_id' => 'required',
            'tipo_ajuste' => 'required',
            'cantidad_traslado' => 'numeric|required|min:1|max:99999',
            'descripcion' => 'required'
        ]);


        if($this->cantidad_traslado==0 ){
            $this->addError('cantidad_traslado', 'La cantidad debe ser superior a 0');
        }
            AjusteInventario::create(
                [
                'ajuste_inventario_no'=>$this->ajuste_inventario_no,
                'fecha_ajuste_inventario'=>$this->fecha_ajuste_inventario,
                'producto_id'=>$this->producto_id,
                'tipo_ajuste'=>$this->tipo_ajuste,
                'descripcion'=>$this->descripcion,
                'cantidad_traslado'=>$this->cantidad_traslado,
                'sucursal_id'=>Auth::user()->sucursal_id,
                ]
            );

            $pro_sucu=DB::table('producto_sucursal')
            ->where('producto_id' ,'=', $this->producto_id)
            ->where('sucursal_id','=', Auth::user()->sucursal_id)
            ->first();




            if($this->tipo_ajuste=="ingreso"){
                $cant=$this->cantidad_traslado+$pro_sucu->cantidad;
            }else{
                $cant=$pro_sucu->cantidad-$this->cantidad_traslado;
            }

            $pro_sucu=DB::table('producto_sucursal')
            ->where('producto_id' ,'=', $this->producto_id)
            ->where('sucursal_id','=', Auth::user()->sucursal_id)
            ->update(['cantidad' => $cant]);

            $da=DB::table('producto_sucursal')
            ->where('producto_id' ,'=', $this->producto_id)
            ->where('sucursal_id','=', Auth::user()->sucursal_id)
            ->sum('cantidad');


        Producto::find($this->producto_id)
                ->update(['existencia' => $da]);

            $this->dispatch('pg:eventRefresh-default');
            $this->cancel();
    }


    public function delete($rowId){
        $data = AjusteInventario::find($rowId);
        $this->ajuste_inventario_no=$data->ajuste_inventario_no;
        $this->id_data=$data->id;
        $this->ajuste_inventario_no = $data->ajuste_inventario_no;
        $this->isDelete = true;
}

public function destroy($rowId)
{
    $data=AjusteInventario::find($rowId);

    $pro_sucu=DB::table('producto_sucursal')
    ->where('producto_id' ,'=', $data->producto_id)
    ->where('sucursal_id','=', $data->sucursal_id)
    ->first();

    if($data->tipo_ajuste=="0"){
        $cant=$pro_sucu->cantidad-$data->cantidad_traslado;
    }else{
        $cant=$pro_sucu->cantidad+$data->cantidad_traslado;
    }

    $pro_sucu=DB::table('producto_sucursal')
    ->where('producto_id' ,'=', $data->producto_id)
    ->where('sucursal_id','=', $data->sucursal_id)
    ->update(['cantidad' => $cant]);



    $da=DB::table('producto_sucursal')
        ->where('producto_id' ,'=', $data->producto_id)
        ->sum('cantidad');


    Producto::find($data->producto_id)
            ->update(['existencia' => $da]);





    $data->delete();

    $this->dispatch('pg:eventRefresh-default');
    $this->cancel();

}




    public function cancel(){
        $this->resetInputFields();
        $this->resetValidation();

    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////
        $this->reset(['producto_id','tipo_ajuste','descripcion','cantidad_traslado']);
        ////////////////////
    }


}
