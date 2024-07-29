<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\EstadoCuenta;
use App\Models\Inventario;
use App\Models\NotaCredito;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class NotaCreditoController extends Component
{
    use LivewireAlert;
    public $title='Nota de Credito';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;
    public $nuevo_saldo=0, $fecha_abono=null;
    public $anulacion_venta=false,$anulado=false;


    //cliente
    public $codigo=null,$nombre_empresa='',$nombre_cliente='';

    //venta
    public $total_venta=0,$fecha_venta=null;

    //notacredito
    public $id=null,$no_nota_credito=null,$total_nota_credito=0,$fecha_nota_credito=null,$cantidad_existencia=null;

    public $venta_id=null,$cantidad_credito_actual=0,$cantidad_abono=0,$saldo_credito=0,$estado=0,$observaciones=null,$correlativo=0;
    public $tipo_pago=[['id'=>'0','nombre'=>'contado'],['id'=>'1','nombre'=>'credito'],['id'=>'2','nombre'=>'abono']];
    public $anulacion=false;

    public $ventas=null;

    protected $rules = [
        'venta_id' => 'required',
        'cantidad_credito_actual'=>'required',
        'cantidad_abono'=>'required',
        'saldo_credito'=>'required',
        'fecha_nota_credito'=>'required'
    ];

    protected $listeners=['edit', 'delete','show','pdfExportar'];

    public function render()
    {
        $data=NotaCredito::latest()->first();

        if ($data) {
            $this->id=$data->id+1;
            $this->no_nota_credito=$this->id;

        }else{
            $this->id=1;
            $this->no_nota_credito=$this->id;
        }

        return view('livewire.pages.nota_credito.index');
    }



    public function create(){

        $this->ventas=Venta::where('anulado','0')->get();
        $this->isCreate=true;

    }

    public function updatedVentaId($value){
        $venta=Venta::find($value);
        $this->correlativo=$venta->correlativo+1;

        $this->venta_id=$venta->id;
        $this->fecha_venta=$venta->fecha_venta;

        if ($venta->cancelado ===1) {
            $this->total_venta=$venta->total_venta-$venta->total_nota_credito;
        }else{
            $this->total_venta=$venta->saldo_venta;
        }


        $this->codigo=$venta->cliente->codigo;
        $this->nombre_empresa=$venta->cliente->nombre_empresa;
        $this->nombre_cliente=$venta->cliente->nombre_cliente;

    }

    public function updatedTotalNotaCredito($value){


        $this->validate(['total_nota_credito'=>"numeric|required|min:1|max:$this->total_venta"]);

        $this->nuevo_saldo=$this->total_venta-$value;
    }

    public function store(){

        $this->validate(['fecha_nota_credito'=>'required','total_nota_credito'=>"numeric|required|min:1|max:$this->total_venta"]);

        $data=Venta::find($this->venta_id);
        if($this->anulacion_venta){


            $da=NotaCredito::create(
                [
                    'no_nota_credito'=>$this->no_nota_credito,
                    'venta_id'=>$this->venta_id,
                    'total_venta'=>$this->total_venta,
                    'fecha_nota_credito'=>$this->fecha_nota_credito,
                    'total_nota_credito'=>$this->total_nota_credito,
                    'cliente_id'=>$data->cliente_id,
                    'total_saldo'=>$this->nuevo_saldo,
                    'correlativo'=>$this->correlativo,
                    'anulacion_venta'=>$this->anulado,
                    'observaciones'=>$this->observaciones,
                ]
            );

            foreach($data->productos as $key => $value){
                $cantidad_antes = DB::table('producto_sucursal')->where('producto_id','=',$value->id)->where('sucursal_id','=',$data->sucursal_id)->get();
                $can=(int)$cantidad_antes[0]->cantidad;
                $can=($can+$value->producto_venta->cantidad);

                DB::table('producto_sucursal')
              ->where('producto_id','=', $value->id,)
              ->where('sucursal_id','=',$data->sucursal_id)
              ->update(['cantidad' => $can]);

            }

            $this->alert('success', 'Anulado', [
                'position' => 'center',
                'timer' => '2000',
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'timerProgressBar' => true,
               ]);



        }else{

                    $da=NotaCredito::create(
                        [
                            'no_nota_credito'=>$this->no_nota_credito,
                            'venta_id'=>$this->venta_id,
                            'total_venta'=>$this->total_venta,
                            'fecha_nota_credito'=>$this->fecha_nota_credito,
                            'total_nota_credito'=>$this->total_nota_credito,
                            'total_saldo'=>$this->nuevo_saldo,
                            'cliente_id'=>$data->cliente_id,
                            'correlativo'=>$this->correlativo,
                            'anulacion_venta'=>$this->anulacion_venta,
                            'observaciones'=>$this->observaciones,
                        ]
                    );

                    $this->alert('success', 'No anulado', [
                        'position' => 'center',
                        'timer' => '2000',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'onConfirmed' => '',
                        'timerProgressBar' => true,
                       ]);



    };
    $this->dispatch('pg:eventRefresh-default');
    $this->cancel();

}

public function pdfExportar($id){

    return redirect()->route('pdfExportarNotaCredito',$id);

}




public function pdfExportarNotaCredito($id)
{



    $saldo_actual=0;
    $saldo_anterior=0;
    $nota_credito=NotaCredito::with('venta')->find($id)->toArray();


    $venta=Venta::find($nota_credito['venta_id'])->toArray();

    $no_venta=$nota_credito['venta_id'];

    $cliente=Cliente::find($nota_credito['venta']['cliente_id'])->toArray();

    //$user=User::find(1)->toArray();
    //$saldo_anterior=$venta['saldo_credito'];

    /*if ($venta['forma_pago']==='CREDI') {
        $data=EstadoCuenta::where('cliente_id','=',$venta['cliente_id'])->get();

        $saldo_actual=$saldo_anterior+$venta['total_venta'];
    }else{
        $saldo_anterior=0;
        $saldo_actual=$venta['total_venta'];
    }*/

    $pdf = FacadePdf::loadView('/livewire/pdf/pdfNotaCredito',['venta' => $venta,'cliente'=>$cliente,'nota_credito'=>$nota_credito]);



   // return $pdf->download("nota_credito_$no_venta.pdf");


    return $pdf->stream();


}




    public function anulacionVenta(){
        $this->disabled=true;
        $this->anulacion_venta=true;

    }

    public function delete($id){


        $data = NotaCredito::find($id);

               if($data->anulacion_venta){
                $this->alert('error', 'No es posible borrar nota de credito de anulacion', [
                    'position' => 'center',
                    'timer' => '2000',
                    'toast' => true,
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                    'timerProgressBar' => true,
                    'text' => 'No es posible borrar una nota de credito de anulacion',
                ]);


               }else{
                $data_venta=Venta::find($data->venta_id);

                if($data->correlativo==$data_venta->correlativo){
                    $this->isDelete = true;
                    $this->no_nota_credito=$data->no_nota_credito;
                    $this->id_data=$data->id;
                }else{
                    $this->alert('error', 'No es posible borrar', [
                        'position' => 'center',
                        'timer' => '2000',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'onConfirmed' => '',
                        'timerProgressBar' => true,
                        'text' => 'Existe una operacion anterior',
                    ]);
                };

               }



    }

    public function destroy($id)
    {
        $data = NotaCredito::find($id);
        $data_venta = Venta::find($data->venta_id);
        $this->correlativo=$data_venta->correlativo-1;

        $data_venta->update([
            'correlativo'=>$this->correlativo,
            'saldo_venta'=>($data->total_nota_credito+$data->total_saldo),
            'total_nota_credito'=>$data_venta->total_nota_credito-$data->total_nota_credito,
            'fecha_nota_credito'=>null
        ]);


        $data->delete();


    $this->alert('error', 'Borrado exitosamente', [
        'position' => 'center',
        'timer' => '2000',
        'toast' => true,
        'showConfirmButton' => false,
        'onConfirmed' => '',
        'timerProgressBar' => true,
        'text' => 'Registro borrado exitosamente',
    ]);



        if(DB::table('estado_cuentas')->where('cliente_id',$data->cliente_id)->exists()){
            $estado_cuenta_temp=EstadoCuenta::where('cliente_id',$data->cliente_id)->first();
            $estado_cuenta=DB::table('estado_cuentas')
            ->where('cliente_id','=', $data->cliente_id)
            ->update(['total_abono' => $estado_cuenta_temp->total_abono+$data->total_nota_credito]);
        }else{
            $data=EstadoCuenta::create(
                [
                'cliente_id'=>$data->cliente_id,
                'total_abono'=>$data->total_nota_credito,
                'total_credito'=>0,
                ]
                );


    };

    $this->dispatch('pg:eventRefresh-default');
    $this->cancel();

    }



    public function cancel(){
        $this->reset();
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){

        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at','correlativo']);
        $this->reset(['venta_id','cantidad_credito_actual','cantidad_abono','saldo_credito']);


    }
}
