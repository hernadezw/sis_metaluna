<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\Cliente;
use App\Models\EstadoCuenta;
use App\Models\Ruta;
use Livewire\Component;
//use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class EstadoCuentaController extends Component
{
    public $title='Estado Cuenta';
    public $data, $id_data,$id_last;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false,$isAddProduct=false,$disabled_nombre_producto=false,$disabled_existencia_producto=false,$disabled_codigo_producto=false,$disabled_subtotal_producto=false;



    public $ventas=[];



    public $filtroCodigoCliente=null;
    public $filtroNombreCliente=null;
    public $filtroClientes=null;
    public $filtroTipoCliente=null;
    public $filtroRutaCliente=null;

    public $forma_pagos,$envios,$tipo_clientes,$rutas,$total_ventas=0;
    public $clientes=[],$estado_cuentas=[];

    public function render()
    {

        $this->forma_pagos=DataSistema::$forma_pago;
        $this->clientes=Cliente::all();
        $this->envios=DataSistema::$envio;
        $this->tipo_clientes=DataSistema::$tipo_cliente;
        $this->rutas=Ruta::all();

        $this->estado_cuentas = DB::table('estado_cuentas')
        ->rightJoin('clientes','estado_cuentas.cliente_id','=','clientes.id')
        ->leftJoin('rutas','clientes.ruta_id','=','rutas.id')
        ->where('codigo_interno','LIKE',"%{$this->filtroCodigoCliente}%")
        ->where('codigo_mayorista','LIKE',"%{$this->filtroCodigoCliente}%")
        ->where('nombres_cliente','LIKE',"%{$this->filtroNombreCliente}%")
        ->where('tipo_cliente','LIKE',"%{$this->filtroTipoCliente}%")
        ->where('ruta_id','LIKE',"%{$this->filtroRutaCliente}%")
        ->get();

        return view('livewire.pages.estado_cuenta.index');
    }

    public function exportarGeneral()
    {
        $pdf = Pdf::loadView('/livewire/pdf/pdfEstadoCuentaVertical',['estado_cuenta' => $this->estado_cuentas]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter', 'landscape')->stream();
            }, 'name.pdf');
    }

    public function exportarFila(string $id)
    {

        $estado_cuenta = DB::table('estado_cuentas')
        ->rightJoin('clientes','estado_cuentas.cliente_id','=','clientes.id')
        ->leftJoin('rutas','clientes.ruta_id','=','rutas.id')
        ->where('clientes.codigo_interno','LIKE',"%{$id}%")
        ->get();

        $pdf = Pdf::loadView('/livewire/pdf/pdfEstadoCuentaVertical',['estado_cuenta' => $estado_cuenta]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter', 'landscape')->stream();
            }, 'name.pdf');
    }





}
