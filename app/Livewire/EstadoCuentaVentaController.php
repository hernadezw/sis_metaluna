<?php

namespace App\Livewire;

use App\Models\Abono;
use App\Models\Cliente;
use App\Models\EstadoCuenta;
use App\Models\NotaCredito;
use App\Models\Venta;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class EstadoCuentaVentaController extends Component
{
    public $title='Estado Cuenta Venta';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    public $venta_id=null,$cantidad_credito_actual=null,$cantidad_abono=null,$saldo_credito=null,$estado=0;
    public $tipo_pago=[['id'=>'0','nombre'=>'contado'],['id'=>'1','nombre'=>'credito'],['id'=>'2','nombre'=>'abono']];


    public $ventas_credito=null;
    protected $listeners=['edit', 'delete','showDetalle','pdfExportar'];

    protected $rules = [
        'venta_id' => 'required',
        'cantidad_credito_actual'=>'required',
        'cantidad_abono'=>'required',
        'saldo_credito'=>'required'
    ];

    public function render()
    {
        return view('livewire.pages.estado_cuenta_venta.index');
    }




    public function pdfExportar($id){
        return redirect()->route('pdfExportarEstadoCuentaVenta',$id);
    }

    public function pdfExportarEstadoCuentaVenta($id)
    {



        $correl=0;

        $saldo_actual=0;
        $saldo_anterior=0;

        $venta=Venta::with('productos')->find($id)->toArray();
        $correl=$venta['correlativo'];

        $abono=Abono::where('venta_id','=',$id)->get()->toArray();

        $nota_credito=NotaCredito::where('venta_id','=',$id)->get()->toArray();


        $no_venta=$venta['no_venta'];


        $cliente=Cliente::find($venta['cliente_id'])->toArray();

        //$user=User::find(1)->toArray();
        $saldo_anterior=$venta['saldo_credito'];

        if ($venta['forma_pago']==='CREDI') {
            $data=EstadoCuenta::where('cliente_id','=',$venta['cliente_id'])->get();

            $saldo_actual=$saldo_anterior+$venta['total_venta'];
        }else{
            $saldo_anterior=0;
            $saldo_actual=$venta['total_venta'];
        }

        $pdf = FacadePdf::loadView('/livewire/pdf/pdfEstadoCuentaVenta',['venta' => $venta,'cliente'=>$cliente,'saldo_anterior'=>$saldo_anterior,'saldo_actual'=>$saldo_actual,'venta' => $venta,'cliente'=>$cliente,'abono'=>$abono,'nota_credito'=>$nota_credito,'correl'=>$correl]);



        //$pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->download("estado_cuenta_venta_$no_venta.pdf");

        //return redirect()->route('pdfVentaRapida',$id);

        //return $pdf->download('venta_pdf.pdf');
        //return $pdf->stream();
        //return $pdf->download('itsolutionstuff.pdf');

    }



    public function cancel(){
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){

        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        $this->reset(['venta_id','cantidad_credito_actual','cantidad_abono','saldo_credito']);


    }
}
