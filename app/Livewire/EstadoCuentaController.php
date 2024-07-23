<?php

namespace App\Livewire;

use App\Models\EstadoCuenta;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class EstadoCuentaController extends Component
{
    public $title='Estado Cuenta';
    public $data, $id_data,$id_last;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isAddProduct=false,$disabled_nombre_producto=false,$disabled_existencia_producto=false,$disabled_codigo_producto=false,$disabled_subtotal_producto=false;

    public function render()
    {
        return view('livewire.pages.estado_cuenta.index');
    }

    public function exportarEstadoCuentaGeneral()
    {
        $id=0;
        return redirect()->route('pdfExportarEstadoCuenta',$id);
    }

    public function pdfExportar($id){
        return redirect()->route('pdfExportarEstadoCuenta',$id);
    }

    public function pdfExportarEstadoCuenta($id)
    {

        $estado_cuenta=null;


        if($id==='0')
        {
            $estado_cuenta=EstadoCuenta::with('cliente')->get()->toArray();

        }else{
            $estado_cuenta=EstadoCuenta::find($id)->toArray();

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


        $pdf = FacadePdf::loadView('/livewire/pdf/pdfEstadoCuentaVertical',['estado_cuenta' => $estado_cuenta]);



        //$pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->setPaper('leter', 'landscape')->download("estado_cuenta_general.pdf");

        //return redirect()->route('pdfVentaRapida',$id);

        //return $pdf->download('venta_pdf.pdf');
        //return $pdf->stream();
        //return $pdf->download('itsolutionstuff.pdf');

    }





}
