<?php

namespace App\Livewire;

use App\Models\Combustible;
use App\Models\User;
use App\Models\Vehiculo;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;

class CombustibleController extends Component

{
    //use LivewireAlert;
    public $title='Combustible';
    public $data, $id_venta=null,$id=null,$no_abono=0;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isCreateAnticipado = false,$isCreateAnticipadoAsignar = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;
    public $nuevo_saldo=0, $fecha_abono=null,$abono_anticipados=null;
    public $tipo_pago=null, $tipo_pago_id=null,$no_pago=0,$detalle_pago='',$clientes=null;
    public $estado=true;

    /////////filtros

    public $filtroCodigoCliente=null;
    Public $filtroFechaAbono=null;

    public $creditos=[];


    public $forma_pagos,$envios,$tipo_clientes,$rutas,$total_ventas=0;
    public $abonos=[],$estado_cuentas=[],$total_abonos;


    public $no_combustible=0, $user_id=null, $fecha_combustible=null, $total_combustible=0, $observaciones=null;
    public $vehiculo_id=null;
    public $combustibles=[];
    public $vehiculos=[];
    public $users=[];
    public $id_data=null;




    public $filtroNoCombustible=null;
    public $filtroUsuario=null;
    public $filtroVehiculo=null;
    public $filtroFechaCombustible=null;
    /////




    protected $rules = [
        'venta_id' => 'required',
        'cantidad_credito_actual'=>'required',
        'cantidad_abono'=>'required',
        'saldo_credito'=>'required'
    ];


    public function render()
    {

        $this->users=User::all();
        $this->vehiculos=Vehiculo::all();
        /*

        $this->abonos = DB::table('abonos')
        ->rightJoin('ventas','abonos.venta_id','=','ventas.id')
        ->rightJoin('clientes','ventas.cliente_id','=','clientes.id')
        ->where('abonos.no_abono','LIKE',"%{$this->filtroNoAbono}%")
        ->where('ventas.no_venta','LIKE',"%{$this->filtroNoVenta}%")
        ->where('abonos.fecha_abono','LIKE',"%{$this->filtroFechaAbono}%")
        ->where('clientes.nombres_cliente','LIKE',"%{$this->filtroNombreCliente}%")
        ->where('clientes.codigo_mayorista','LIKE',"%{$this->filtroCodigoCliente}%")
        ->get();


        $this->total_abonos = DB::table('abonos')
        ->rightJoin('ventas','abonos.venta_id','=','ventas.id')
        ->rightJoin('clientes','ventas.cliente_id','=','clientes.id')
        ->where('abonos.no_abono','LIKE',"%{$this->filtroNoAbono}%")
        ->where('ventas.no_venta','LIKE',"%{$this->filtroNoVenta}%")
        ->where('abonos.fecha_abono','LIKE',"%{$this->filtroFechaAbono}%")
        ->where('clientes.nombres_cliente','LIKE',"%{$this->filtroNombreCliente}%")
        ->where('clientes.codigo_mayorista','LIKE',"%{$this->filtroCodigoCliente}%")
        ->sum('abonos.total_abono');


*/

    $this->combustibles=Combustible::with('user')
    ->with('vehiculo')
    ->where('no_combustible','LIkE',"%{$this->filtroNoCombustible}%")
    ->where('fecha_combustible','LIkE',"%{$this->filtroFechaCombustible}%")
    ->whereRelation('user','id','LIKE',"%{$this->filtroUsuario}%")
    ->whereRelation('vehiculo','id','LIKE',"%{$this->filtroVehiculo}%")
    ->get();
        return view('livewire.pages.combustible.index');
    }

    public function create(){

        $this->vehiculos=Vehiculo::all();
        $this->users=User::all();

        if ($data=Combustible::latest()->first()) {
            $this->id=$data->id+1;
            $this->no_combustible=$this->id;
        }else{
            $this->id=1;
            $this->no_combustible=$this->id;
        }
        $this->fecha_combustible = Carbon::now()->toDateString();
        $this->isCreate=true;
    }

    public function store()
    {
        $this->validate([
            'total_combustible'=>"numeric|required|min:1",
            'fecha_combustible'=>'required',
            'user_id'=>'required',
            'vehiculo_id'=>'required',
        ]);


        $da=Combustible::create(
            [
                'no_combustible'=>$this->no_combustible,
                'fecha_combustible'=>$this->fecha_combustible,
                'total_combustible'=>$this->total_combustible,
                'user_id'=>$this->user_id,
                'vehiculo_id'=>$this->vehiculo_id,
                'observaciones'=>$this->observaciones,
            ]
        );

        $this->cancel();

    }



    public function exportarGeneral()
    {
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $pdf = Pdf::loadView('/livewire/pdf/pdfCombustibleGeneral',['combustibles' => $this->combustibles]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter', 'landscape')->stream();
            }, "$this->title-$fecha_reporte.pdf");
    }

    public function exportarFila($id)
    {

        $dato=Combustible::with('user')
        ->with('vehiculo')
        ->where('no_combustible','LIkE',"%{$this->filtroNoCombustible}%")
        ->where('fecha_combustible','LIkE',"%{$this->filtroFechaCombustible}%")
        ->whereRelation('user','id','LIKE',"%{$this->filtroUsuario}%")
        ->whereRelation('vehiculo','id','LIKE',"%{$this->filtroVehiculo}%")
        ->first();


        //$abono=Viatico::where('no_abono','=',$id)->with('venta')->get()->first()->toArray();

            //$cliente=Cliente::find($abono['cliente_id'])->toArray();
            $fecha_reporte=Carbon::now()->toDateTimeString();
            $pdf = Pdf::loadView('/livewire/pdf/pdfCombustible',['dato'=>$dato]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->setPaper('leter')->stream();
                }, "$this->title-$fecha_reporte.pdf");

    }



    public function delete($id){


        $data = Viatico::find($id);


                    $this->isDelete = true;
                    $this->no_abono=$data->no_abono;
                    $this->id_data=$data->id;





    }

    public function destroy($id)
    {
        $data = Viatico::find($id);

            $data->delete();


        $this->alert('error', 'Borrado exitosamente', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
            'timerProgressBar' => true,
            'text' => 'Registro borrado exitosamente'
        ]);




        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();

    }

    public function cancel(){
        $this->reset();

        $this->resetValidation();
    }


}

