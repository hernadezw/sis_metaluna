<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Credito;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class CreditoController extends Component
{

    public $title='Credito';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $disabled=false;


    public $no_credito=null, $venta_id=null, $fecha_credito=null, $total_credito=null, $cliente_id=null, $observaciones=null, $created_at=null, $updated_at=null;
    public $nombres_cliente=null, $apellidos_cliente=null;
    protected $rules = [
        'codigo' => 'required',
        'tipo_vehiculo' => 'required',
        'tipo_placa' => 'required',
        'numero_placa' => 'required',
        'marca' => 'required',
        'modelo' => 'required',
        'linea' => 'required',
        'alias' => 'required',
    ];

    protected $listeners=['edit', 'delete','show','pdfExportar'];

    public function render()
    {
        return view('livewire.pages.credito.index');
    }


    public function show($rowId){

        $this->isShow=true;
        $data=Credito::find($rowId);

        $this->no_credito=$data->no_credito;
        $this->venta_id=$data->venta_id;
        $this->fecha_credito=$data->fecha_credito;
        $this->total_credito=$data->total_credito;

        $this->cliente_id=$data->cliente_id;
        $this->nombres_cliente=$data->cliente->nombres_cliente;
        $this->apellidos_cliente=$data->cliente->apellidos_cliente;

        $this->observaciones=$data->observaciones;
        $this->created_at=$data->created_at;
        $this->updated_at=$data->updated_at;

        $this->disabled=true;
        $this->isShow=true;
        ////////////////////
    }

    public function cancel(){
        $this->reset();
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','created_at','updated_at']);
        $this->reset(['no_credito','venta_id','fecha_credito','total_credito','cliente_id','nombres_cliente','apellidos_cliente','observaciones','created_at','updated_at']);
    }

    public function pdfExportar($id){
        return redirect()->route('pdfExportarCredito',$id);
    }

    public function pdfExportarCredito($id)
    {

        //$traslado=Traslado::with('productos')->find($id)->toArray();
        $credito=Credito::find($id)->toArray();
        $cliente=Cliente::find($credito['cliente_id'])->toArray();


        $pdf = FacadePdf::loadView('/livewire/pdf/pdfCredito ',['credito'=>$credito,'cliente'=>$cliente]);
            //return $pdf->download("abono_$no_abono.pdf");

        return $pdf->stream();


    }

}
