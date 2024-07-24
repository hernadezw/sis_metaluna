<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\Abono;
use App\Models\Cliente;
use App\Models\EstadoCuenta;
use App\Models\Venta;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AbonoController extends Component
{
    use LivewireAlert;
    public $title='Abono';
    public $data, $id_venta=null,$id=null,$no_abono=0;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isCreateAnticipado = false,$isCreateAnticipadoAsignar = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;
    public $nuevo_saldo=0, $fecha_abono=null,$abono_anticipados=null;
    public $tipo_pago=null, $tipo_pago_id=null,$no_pago=0,$detalle_pago='',$clientes=null;


    public $venta_id=null,$abono_anticipado_id=null,$cantidad_credito_actual=0,$cantidad_abono=0,$saldo_credito=0,$estado=0,$observaciones=null,$correlativo=0;
    public $id_data=null;

    //bono anticipado
    public $cliente_id=null;
    public $cantidad_abono_anticipado=null;
    //bono anticipado asignar
    public $saldo_credito_asignar=0;
    public $cantidad_abono_asignar=0;
    public $nuevo_saldo_asignar=0;
    public $asignar_venta_id=null;
    public $asignar_abono_anticipado_id=null;

    public $ventas=null;
    public $ventas_credito=null;

    protected $listeners=['pdfExportar','delete'];

    protected $rules = [
        'venta_id' => 'required',
        'cantidad_credito_actual'=>'required',
        'cantidad_abono'=>'required',
        'saldo_credito'=>'required'
    ];


    public function render()
    {

        return view('livewire.pages.abono.index');
    }

    public function create(){
        $data=Abono::latest()->first();

        if ($data) {
            $this->id=$data->id+1;
            $this->no_abono=$this->id;

        }else{
            $this->id=1;
            $this->no_abono=$this->id;
        }

        $this->tipo_pago=DataSistema::$forma_pago;

        $this->ventas_credito=Venta::where('cancelado','0')->get();
        $this->isCreate=true;

    }
/////////////////////////////////BONO ANTICIPADO/////////////////////////////

    public function abonoAnticipado(){
        $data=Abono::latest()->first();

        if ($data) {
            $this->id=$data->id+1;
            $this->no_abono=$this->id;

        }else{
            $this->id=1;
            $this->no_abono=$this->id;
        }

        $this->tipo_pago=DataSistema::$forma_pago;

        $this->clientes=Cliente::all();
        $this->isCreateAnticipado=true;

    }



    public function updatedVentaId($value){
        $venta=Venta::find($value);
        $this->cliente_id=$venta->cliente_id;
        $this->correlativo=$venta->correlativo+1;
        $this->id_venta=$venta->id;
        $this->saldo_credito=$venta->saldo_venta;
        $this->cantidad_credito_actual=$venta->saldo_venta;
        $this->reset(['abono_anticipado_id','cantidad_abono','nuevo_saldo']);
    }

    public function updatedCantidadAbono($value){
            $this->validate([
                'cantidad_abono'=>"numeric|required|min:1|max:$this->saldo_credito"
            ]);
        $this->nuevo_saldo=$this->saldo_credito-$value;
    }

    public function pdfExportar($id){

        return redirect()->route('pdfExportarAbono',$id);

    }



    public function store()
    {
        $this->validate([
            'cantidad_abono'=>"numeric|required|min:1|max:$this->saldo_credito"
        ]);


        $da=Abono::create(
            [
                'abono_anticipado'=>false,
                'abono_anticipado_asignado'=>false,
                'no_abono'=>$this->no_abono,
                'fecha_abono_anticipado'=>$this->fecha_abono,
                'venta_id'=>$this->id_venta,
                'fecha_abono'=>$this->fecha_abono,
                'saldo_credito'=>$this->saldo_credito,
                'total_abono'=>$this->cantidad_abono,
                'total_saldo'=>$this->nuevo_saldo,
                'correlativo'=>$this->correlativo,
                'cliente_id'=>$this->cliente_id,
                'observaciones'=>$this->observaciones,
                'tipo_pago'=>$this->tipo_pago_id,
                'no_pago'=>$this->no_pago,
                'detalle_pago'=>$this->detalle_pago,
            ]
        );

        if($this->nuevo_saldo!=0){
            $venta=DB::table('ventas')
            ->where('id','=', $this->id_venta)
            ->update(['correlativo'=>$this->correlativo,'saldo_venta'=>$this->nuevo_saldo]);
        }else{
            $venta=DB::table('ventas')
            ->where('id','=', $this->id_venta)
            ->update(['correlativo'=>$this->correlativo,'saldo_venta'=>$this->nuevo_saldo,'cancelado'=>true, 'fecha_cancelado'=>$this->fecha_abono]);
        };

        if(DB::table('estado_cuentas')->where('cliente_id',$this->cliente_id)->exists()){
            $estado_cuenta_temp=EstadoCuenta::where('cliente_id',$this->cliente_id)->first();
            $estado_cuenta=DB::table('estado_cuentas')
            ->where('cliente_id','=', $this->cliente_id)
            ->update(['total_abono' => $this->cantidad_abono+$estado_cuenta_temp->total_abono]);
        }else{
            $data=EstadoCuenta::create(
                [
                'cliente_id'=>$this->cliente_id,
                'total_abono'=>$this->cantidad_abono,
                'total_credito'=>0,
                ]
                );

        };


        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();

    }

    public function storeAnticipado(){


        $da=Abono::create(
            [
                'abono_anticipado'=>true,
                'no_abono'=>$this->no_abono,
                'fecha_abono'=>$this->fecha_abono,
                'fecha_abono_anticipado'=>$this->fecha_abono,
                'saldo_credito'=>$this->saldo_credito,
                'total_abono'=>$this->cantidad_abono_anticipado,
                'total_saldo'=>'0',
                'correlativo'=>'0',
                'cliente_id'=>$this->cliente_id,
                'observaciones'=>$this->observaciones,
                'tipo_pago'=>$this->tipo_pago_id,
                'detalle_pago'=>$this->detalle_pago,
            ]
        );

        $this->cancel();
        //return redirect()->route('pdfExportarAbono',$this->no_abono);
}



//////////////////////////////////ASIGNAR ABONO ANTICIPADO/////////////////////////////////////
public function updatedAsignarVentaId($value){

    $venta=Venta::find($value);

    $this->cliente_id=$venta->cliente_id;
    $this->correlativo=$venta->correlativo+1;
    $this->id_venta=$venta->id;
    $this->saldo_credito_asignar=$venta->saldo_venta;
    $this->cantidad_credito_actual=$venta->saldo_venta;
    $this->reset(['abono_anticipado_id','cantidad_abono','nuevo_saldo']);
}






public function updatedAsignarAbonoAnticipadoId($value){
    $data=Abono::find($value);
    $this->cantidad_abono_asignar=$data->total_abono;
    $this->nuevo_saldo_asignar=$this->saldo_credito_asignar-$this->cantidad_abono_asignar;


}





public function storeAsignarAbonoAnticipado($value){



    $data = Abono::find($value);
    $data->update([
            'venta_id'=>$this->id_venta,
            'fecha_abono'=>$this->fecha_abono,
            'saldo_credito'=>$this->saldo_credito_asignar,
            'total_abono'=>$this->cantidad_abono_asignar,
            'total_saldo'=>$this->nuevo_saldo_asignar,
            'correlativo'=>$this->correlativo,
            'observaciones'=>$this->observaciones,
            'tipo_pago'=>$this->tipo_pago_id,
            'no_pago'=>$this->no_pago,
            'detalle_pago'=>$this->detalle_pago,
            'abono_anticipado_asignado'=>true,
        ]);

    if($this->nuevo_saldo!=0){
        $venta=DB::table('ventas')
        ->where('id','=', $this->id_venta)
        ->update(['correlativo'=>$this->correlativo,'saldo_venta'=>$this->nuevo_saldo]);
    }else{
        $venta=DB::table('ventas')
        ->where('id','=', $this->id_venta)
        ->update(['correlativo'=>$this->correlativo,'saldo_venta'=>$this->nuevo_saldo,'cancelado'=>true, 'fecha_cancelado'=>$this->fecha_abono]);
    };

    if(DB::table('estado_cuentas')->where('cliente_id',$this->cliente_id)->exists()){
        $estado_cuenta_temp=EstadoCuenta::where('cliente_id',$this->cliente_id)->first();
        $estado_cuenta=DB::table('estado_cuentas')
        ->where('cliente_id','=', $this->cliente_id)
        ->update(['total_abono' => $this->cantidad_abono+$estado_cuenta_temp->total_abono]);


    }else{
        $data=EstadoCuenta::create(
            [
            'cliente_id'=>$this->cliente_id,
            'total_abono'=>$this->cantidad_abono,
            'total_credito'=>0,
            ]
            );
    };



    $this->cancel();
    return redirect()->route('pdfExportarAbono',$this->no_abono);
}


    public function abonoAnticipadoAsignar(){
        $data=Abono::latest()->first();

        if ($data) {
            $this->id=$data->id+1;
            $this->no_abono=$this->id;

        }else{
            $this->id=1;
            $this->no_abono=$this->id;
        }
        $this->tipo_pago=DataSistema::$forma_pago;
        $this->ventas=Venta::where('cancelado','0')->get();
        $this->abono_anticipados=Abono::where('abono_anticipado',true)->where('abono_anticipado_asignado',false)->get();
        $this->isCreateAnticipadoAsignar=true;
    }


    public function updatedAbonoAnticipadoId($value){
        $data=Abono::find($value);
        $this->cantidad_abono=$data->total_abono;
        $this->nuevo_saldo=$this->saldo_credito-$this->cantidad_abono;
    }






    public function pdfExportarAbono($id)
    {

        $abono=Abono::with('venta')->find($id)->toArray();

        $no_abono=$abono['no_abono'];
        if($abono['venta_id']==null){

            $cliente=Cliente::find($abono['cliente_id'])->toArray();
            $pdf = FacadePdf::loadView('/livewire/pdf/pdfAbonoAnticipado',['cliente'=>$cliente,'abono'=>$abono]);
            return $pdf->download("abono_$no_abono.pdf");

        }else{
            $venta=Venta::find($abono['venta_id'])->toArray();
            $no_venta=$abono['venta']['no_venta'];
            $cliente=Cliente::find($abono['venta']['cliente_id'])->toArray();
            $pdf = FacadePdf::loadView('/livewire/pdf/pdfAbono',['venta' => $venta,'cliente'=>$cliente,'abono'=>$abono]);
            return $pdf->download("abono_$no_venta.pdf");
        }




        //$user=User::find(1)->toArray();
        //$saldo_anterior=$venta['saldo_credito'];

        /*if ($venta['forma_pago']==='CREDI') {
            $data=EstadoCuenta::where('cliente_id','=',$venta['cliente_id'])->get();

            $saldo_actual=$saldo_anterior+$venta['total_venta'];
        }else{
            $saldo_anterior=0;
            $saldo_actual=$venta['total_venta'];
        }*/





        //$pdf = Pdf::loadView('pdf.invoice', $data);


        //return redirect()->route('pdfVentaRapida',$id);

        //return $pdf->download('venta_pdf.pdf');
        //return $pdf->stream();
        //return $pdf->download('itsolutionstuff.pdf');

    }

    public function delete($id){


        $data = Abono::find($id);
        if($data->abono_anticipado){

            if($data->abono_anticipado_asignado!=true){
                $this->isDelete = true;
                $this->no_abono=$data->no_abono;
                $this->id_data=$data->id;
                $this->no_abono=$data->no_abono;


            }else{

                $data_venta=Venta::find($data->venta_id);

                if($data->correlativo==$data_venta->correlativo){
                    $this->isDelete = true;
                    $this->no_abono=$data->no_abono;
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
                }
            };

        }else{
            $data_venta=Venta::find($data->venta_id);

            if($data->correlativo==$data_venta->correlativo){
                $this->isDelete = true;
                $this->no_abono=$data->no_abono;
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
            }
            $this->id_data=$data->id;
            $this->no_abono=$data->no_abono;
        }
        //dd($this->no_abono);
        //$this->id_data=$data->id;



    }

    public function destroy($id)
    {
        $data = Abono::find($id);

        if ($data->abono_anticipado_asignado==false && $data->abono_anticipado==true ) {

            $data->delete();
        }else{

            $this->cantidad_abono=$data->total_abono;
            $this->cliente_id=$data->cliente_id;

            $data_venta = Venta::find($data->venta_id);
            $this->correlativo=$data_venta->correlativo-1;

            if($data_venta->cancelado){
                $data_venta->update([
                    'correlativo'=>$this->correlativo,
                    'saldo_venta'=>$data->saldo_credito,
                    'cancelado'=>false,
                ]);
            }else{
                $data_venta->update([
                    'correlativo'=>$this->correlativo,
                    'saldo_venta'=>$data->saldo_credito
                ]);
            }
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



            if(DB::table('estado_cuentas')->where('cliente_id',$this->cliente_id)->exists()){
                $estado_cuenta_temp=EstadoCuenta::where('cliente_id',$this->cliente_id)->first();
                $estado_cuenta=DB::table('estado_cuentas')
                ->where('cliente_id','=', $this->cliente_id)
                ->update(['total_abono' => $estado_cuenta_temp->total_abono-$this->cantidad_abono]);
            }else{

                $data=EstadoCuenta::create(
                    [
                    'cliente_id'=>$this->cliente_id,
                    'total_abono'=>$this->cantidad_abono,
                    'total_credito'=>0,
                    ]
                    );

            };
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
        $this->reset(['venta_id','cantidad_credito_actual','cantidad_abono','saldo_credito','no_abono','id']);


    }
}
